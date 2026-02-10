<?php

namespace App\Http\Controllers;

use App\Models\PhonePePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PhonepayController extends Controller
{
    // PhonePe sandbox credentials
    private $clientId = 'M23EAVEL66U6Q_2602091652';
    private $clientSecret = 'YjVjNGVkNDctZDk0Ny00ODIwLTk5ZDAtNjhlMWU1MDJkY2Q3';
    private $clientVersion = '1';
    private $merchantId = 'M23EAVEL66U6Q';

    // Get access token
    private function getAccessToken()
    {
        try {
            $response = Http::asForm()->post('https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token', [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'client_version' => $this->clientVersion,
                'grant_type' => 'client_credentials'
            ]);

            Log::info('PhonePe Token Response', ['response' => $response->body()]);

            $data = $response->json();

            if (isset($data['access_token'])) {
                return $data['access_token'];
            }

            throw new \Exception('Access token not received: ' . $response->body());
        } catch (\Exception $e) {
            Log::error('Failed to get access token', ['error' => $e->getMessage()]);
            return null;
        }
    }

    // Show donation form
    public function showDonationForm()
    {
        return view('pages.phonepay');
    }

    // Initiate payment
    public function initiatePayment(Request $request)
    {
        Log::info('Payment Request Received', $request->all());

        // Validate request
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits:10',
            'amount' => 'required|numeric|min:1|max:1000000'
        ]);

        // Generate merchant order ID
        $merchantOrderId = 'ORDER_' . time() . '_' . rand(1000, 9999);

        // Store payment in database
        $payment = PhonePePayment::create([
            'merchant_order_id' => $merchantOrderId,
            'amount' => $validated['amount'],
            'amount_paise' => (int) ($validated['amount'] * 100),
            'status' => 'PENDING',
            'donor_name' => $validated['fullName'],
            'donor_email' => $validated['email'],
            'donor_phone' => $validated['phone'],
            'udf1' => $validated['fullName'],
            'udf2' => $validated['email'],
            'udf3' => $validated['phone'],
            'udf4' => 'Donation',
            'udf5' => 'Anmay Foundation'
        ]);

        // Store in session for callback
        Session::put([
            'merchant_order_id' => $merchantOrderId,
            'payment_id' => $payment->id
        ]);

        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            // Update payment status
            $payment->update([
                'status' => 'FAILED',
                'error_message' => 'Failed to get access token'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to get access token from PhonePe'
            ], 500);
        }

        // Prepare payload
        $payload = [
            "merchantId" => $this->merchantId,
            "merchantOrderId" => $merchantOrderId,
            "amount" => $payment->amount_paise,
            "expireAfter" => 1200,
            "metaInfo" => [
                "udf1" => $validated['fullName'],
                "udf2" => $validated['email'],
                "udf3" => $validated['phone'],
                "udf4" => "Donation",
                "udf5" => "Anmay Foundation"
            ],
            "paymentFlow" => [
                "type" => "PG_CHECKOUT",
                "message" => "Donation Payment for Anmay Foundation",
                "merchantUrls" => [
                    "redirectUrl" => route('payment.callback'),
                    "failureUrl" => route('payment.failed')
                ]
            ]
        ];

        Log::info('PhonePe Payment Payload', $payload);

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'O-Bearer ' . $accessToken
            ])->timeout(30)->post(
                'https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/pay',
                $payload
            );

            $responseData = $response->json();
            
            if ($response->successful()) {
                $paymentUrl = $responseData['redirectUrl'] 
                    ?? $responseData['data']['instrumentResponse']['redirectInfo']['url'] 
                    ?? null;

                if ($paymentUrl) {
                    // Update payment with initial response
                    $payment->update([
                        'callback_data' => $responseData
                    ]);

                    return response()->json([
                        'success' => true,
                        'paymentUrl' => $paymentUrl,
                        'orderId' => $responseData['orderId'] ?? $merchantOrderId,
                        'message' => 'Payment initiated successfully'
                    ]);
                }
            }

            // Update payment on failure
            $payment->update([
                'status' => 'FAILED',
                'error_message' => $responseData['message'] ?? 'Failed to initiate payment',
                'callback_data' => $responseData
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to initiate payment',
                'error' => $responseData['message'] ?? 'Unknown error'
            ]);

        } catch (\Exception $e) {
            // Update payment on exception
            $payment->update([
                'status' => 'FAILED',
                'error_message' => 'Payment gateway error: ' . $e->getMessage()
            ]);

            Log::error('PhonePe Payment Exception', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Payment gateway error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Payment callback - This is where PhonePe redirects after payment
    public function paymentCallback(Request $request)
    {
        Log::info('Payment Callback Received', $request->all());

        // Extract parameters from callback URL
        $merchantOrderId = $request->input('merchantOrderId') 
            ?? $request->input('merchantTransactionId')
            ?? Session::get('merchant_order_id');

        if (!$merchantOrderId) {
            Log::error('No merchant order ID found in callback');
            return $this->showFailedPage(null, null, null, 'NO_ORDER_ID');
        }

        // Find payment record
        $payment = PhonePePayment::where('merchant_order_id', $merchantOrderId)->first();

        if (!$payment) {
            Log::error('Payment record not found', ['order_id' => $merchantOrderId]);
            return $this->showFailedPage(null, null, $merchantOrderId, 'RECORD_NOT_FOUND');
        }

        // Check payment status via API
        $statusCheck = $this->checkOrderStatus($merchantOrderId, $payment);

        if ($statusCheck['success']) {
            $status = $statusCheck['status'];
            $transactionId = $statusCheck['transaction_id'];
            $paymentDetails = $statusCheck['payment_details'];
            
            // Update payment record with API response
            $updateData = [
                'status' => $status,
                'transaction_id' => $transactionId,
                'callback_data' => array_merge(
                    (array) $payment->callback_data ?? [],
                    ['callback_params' => $request->all(), 'status_check_response' => $statusCheck['data']]
                ),
                'payment_date' => now()
            ];

            // Extract payment method from payment details if available
            if (!empty($paymentDetails)) {
                $firstPayment = $paymentDetails[0];
                $updateData['payment_method'] = $firstPayment['paymentMode'] ?? null;
                
                // Extract additional info from split instruments
                if (!empty($firstPayment['splitInstruments'])) {
                    $firstInstrument = $firstPayment['splitInstruments'][0];
                    if (isset($firstInstrument['rail']['type'])) {
                        $updateData['payment_method'] .= ' (' . $firstInstrument['rail']['type'] . ')';
                    }
                }
            }

            $payment->update($updateData);

            // Route to appropriate page based on status
            return $this->routeToStatusPage($payment, $status);
        } else {
            // If status check fails, use callback params
            return $this->handleCallbackWithoutStatusCheck($request, $payment);
        }
    }

    // Check order status using the correct API endpoint
    private function checkOrderStatus($merchantOrderId, $payment = null)
    {
        $accessToken = $this->getAccessToken();
        
        if (!$accessToken) {
            return [
                'success' => false,
                'message' => 'Failed to get access token'
            ];
        }

        try {
            // Use the correct endpoint: /order/{merchantOrderId}/status
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'O-Bearer ' . $accessToken
            ])->timeout(30)->get(
                "https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/order/{$merchantOrderId}/status"
            );

            Log::info('Status Check Response', [
                'url' => "https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/order/{$merchantOrderId}/status",
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            $responseData = $response->json();
            
            if ($response->successful()) {
                $status = strtoupper($responseData['state'] ?? 'PENDING');
                $transactionId = null;
                $paymentDetails = $responseData['paymentDetails'] ?? [];
                
                // Extract transaction ID from payment details
                if (!empty($paymentDetails)) {
                    $firstPayment = $paymentDetails[0];
                    $transactionId = $firstPayment['transactionId'] ?? null;
                }
                
                return [
                    'success' => true,
                    'status' => $status,
                    'transaction_id' => $transactionId,
                    'payment_details' => $paymentDetails,
                    'data' => $responseData,
                    'message' => 'Status retrieved successfully'
                ];
            }

            return [
                'success' => false,
                'message' => 'Failed to check status: ' . ($responseData['message'] ?? 'Unknown error'),
                'data' => $responseData
            ];

        } catch (\Exception $e) {
            Log::error('Order Status Check Error', [
                'error' => $e->getMessage(),
                'order_id' => $merchantOrderId
            ]);
            
            return [
                'success' => false,
                'message' => 'Error checking order status: ' . $e->getMessage()
            ];
        }
    }

    // Handle callback when status check fails
    private function handleCallbackWithoutStatusCheck(Request $request, PhonePePayment $payment)
    {
        // Extract parameters from callback URL
        $transactionId = $request->input('transactionId') 
            ?? $request->input('id') 
            ?? $request->input('merchantTransactionId')
            ?? null;

        $status = strtoupper($request->input('status') 
            ?? $request->input('code') 
            ?? $request->input('paymentStatus')
            ?? 'PENDING');

        $amount = $request->input('amount') 
            ?? $request->input('transactionAmount')
            ?? null;

        // Update payment with callback data
        $updateData = [
            'transaction_id' => $transactionId,
            'status' => $status,
            'callback_data' => array_merge(
                (array) $payment->callback_data ?? [],
                ['callback_params' => $request->all()]
            ),
            'payment_date' => now()
        ];

        if ($amount) {
            $updateData['amount'] = $amount / 100;
            $updateData['amount_paise'] = $amount;
        }

        if ($request->filled('paymentMethod')) {
            $updateData['payment_method'] = $request->input('paymentMethod');
        }

        $payment->update($updateData);

        return $this->routeToStatusPage($payment, $status);
    }

    // Route to appropriate page based on status
    private function routeToStatusPage(PhonePePayment $payment, $status)
    {
        Session::forget(['merchant_order_id', 'payment_id']);

        switch ($status) {
            case 'COMPLETED':
            case 'SUCCESS':
            case 'PAYMENT_SUCCESS':
                return $this->showSuccessPage($payment);
            
            case 'PENDING':
            case 'PROCESSING':
            case 'INITIATED':
                return $this->showPendingPage($payment);
            
            default:
                $payment->update([
                    'error_message' => 'Payment failed with status: ' . $status,
                    'error_code' => 'STATUS_' . $status
                ]);
                return $this->showFailedPage($payment);
        }
    }

    // Payment success page
    private function showSuccessPage(PhonePePayment $payment)
    {
        return view('pages.payment-success', [
            'transaction_id' => $payment->transaction_id,
            'merchant_order_id' => $payment->merchant_order_id,
            'amount' => $payment->amount_paise,
            'donor_name' => $payment->donor_name,
            'email' => $payment->donor_email,
            'phone' => $payment->donor_phone,
            'status' => $payment->status,
            'payment_method' => $payment->payment_method,
            'payment_date' => $payment->payment_date?->format('d M Y, h:i A') ?? now()->format('d M Y, h:i A')
        ]);
    }

    // Payment pending page
    private function showPendingPage(PhonePePayment $payment)
    {
        return view('pages.payment-pending', [
            'transaction_id' => $payment->transaction_id,
            'merchant_order_id' => $payment->merchant_order_id,
            'amount' => $payment->amount_paise,
            'donor_name' => $payment->donor_name,
            'status' => $payment->status,
            'payment_date' => $payment->created_at->format('d M Y, h:i A')
        ]);
    }

    // Payment failed page
    private function showFailedPage(PhonePePayment $payment)
    {
        return view('pages.payment-failed', [
            'transaction_id' => $payment->transaction_id ?? 'N/A',
            'merchant_order_id' => $payment->merchant_order_id,
            'amount' => $payment->amount_paise,
            'error_message' => $payment->error_message ?? 'Payment failed',
            'error_code' => $payment->error_code ?? 'DECLINED',
            'status' => $payment->status,
            'payment_date' => $payment->created_at->format('d M Y, h:i A')
        ]);
    }

    // Public payment failure callback
    public function paymentFailed(Request $request)
    {
        Log::info('Payment Failure Callback Received', $request->all());

        $merchantOrderId = $request->input('merchantOrderId') 
            ?? $request->input('merchantTransactionId')
            ?? Session::get('merchant_order_id');

        $payment = PhonePePayment::where('merchant_order_id', $merchantOrderId)->first();

        if ($payment) {
            $payment->update([
                'status' => 'FAILED',
                'transaction_id' => $request->input('transactionId'),
                'error_message' => $request->input('error') ?? $request->input('message') ?? 'Payment failed',
                'error_code' => $request->input('errorCode') ?? $request->input('responseCode'),
                'callback_data' => array_merge(
                    (array) $payment->callback_data ?? [],
                    ['failure_callback' => $request->all()]
                ),
                'payment_date' => now()
            ]);
        }

        Session::forget(['merchant_order_id', 'payment_id']);

        return view('pages.payment-failed', [
            'transaction_id' => $request->input('transactionId') ?? ($payment->transaction_id ?? 'N/A'),
            'merchant_order_id' => $merchantOrderId,
            'amount' => $payment->amount_paise ?? ($request->input('amount') ?? 0),
            'error_message' => $request->input('error') ?? ($payment->error_message ?? 'Payment declined by bank'),
            'error_code' => $request->input('errorCode') ?? ($payment->error_code ?? 'DECLINED'),
            'status' => 'FAILED',
            'payment_date' => now()->format('d M Y, h:i A')
        ]);
    }

    // Check payment status (public API)
    public function checkPaymentStatus(Request $request)
    {
        $orderId = $request->input('order_id') 
            ?? $request->input('transaction_id')
            ?? Session::get('merchant_order_id');

        if (!$orderId) {
            return response()->json([
                'success' => false,
                'message' => 'Order ID is required'
            ], 400);
        }

        $statusCheck = $this->checkOrderStatus($orderId);

        if ($statusCheck['success']) {
            // Find and update payment in database
            $payment = PhonePePayment::where('merchant_order_id', $orderId)->first();
            
            if ($payment) {
                $payment->update([
                    'status' => $statusCheck['status'],
                    'transaction_id' => $statusCheck['transaction_id'],
                    'callback_data' => array_merge(
                        (array) $payment->callback_data ?? [],
                        ['status_check' => $statusCheck['data'], 'checked_at' => now()->toISOString()]
                    )
                ]);
            }
            
            return response()->json([
                'success' => true,
                'status' => $statusCheck['status'],
                'transaction_id' => $statusCheck['transaction_id'],
                'order_id' => $orderId,
                'data' => $statusCheck['data'],
                'message' => 'Status checked successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $statusCheck['message'],
            'order_id' => $orderId,
            'data' => $statusCheck['data'] ?? null
        ]);
    }

    // Sync payment status (helper method for admin)
    public function syncPaymentStatus($orderId)
    {
        $statusCheck = $this->checkOrderStatus($orderId);
        
        if ($statusCheck['success']) {
            $payment = PhonePePayment::where('merchant_order_id', $orderId)->first();
            
            if ($payment) {
                $payment->update([
                    'status' => $statusCheck['status'],
                    'transaction_id' => $statusCheck['transaction_id'],
                    'callback_data' => array_merge(
                        (array) $payment->callback_data ?? [],
                        ['status_sync' => $statusCheck['data'], 'synced_at' => now()->toISOString()]
                    )
                ]);
                
                return $statusCheck['status'];
            }
        }
        
        return false;
    }

    // Check status for a specific payment (admin)
    public function checkStatus($id)
    {
        $payment = PhonePePayment::findOrFail($id);
        
        $status = $this->syncPaymentStatus($payment->merchant_order_id);
        
        if ($status !== false) {
            $payment->refresh();
            return redirect()->route('admin.payments.show', $payment->id)
                ->with('success', 'Payment status updated to: ' . $status);
        }
        
        return redirect()->route('admin.payments.show', $payment->id)
            ->with('error', 'Failed to check payment status');
    }

    // Bulk status check (admin)
    public function bulkCheckStatus(Request $request)
    {
        $orderIds = $request->input('order_ids', []);
        $status = $request->input('status', 'PENDING');
        
        if (empty($orderIds)) {
            $orderIds = PhonePePayment::where('status', $status)->pluck('merchant_order_id')->toArray();
        }
        
        $results = [];
        
        foreach ($orderIds as $orderId) {
            $statusResult = $this->syncPaymentStatus($orderId);
            $results[$orderId] = $statusResult !== false ? $statusResult : 'FAILED_TO_CHECK';
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Bulk status check completed',
            'results' => $results
        ]);
    }

    // Auto-check pending payments (can be called via cron job)
    public function autoCheckPendingPayments()
    {
        $pendingPayments = PhonePePayment::where('status', 'PENDING')
            ->orWhere('status', 'PROCESSING')
            ->orWhere('status', 'INITIATED')
            ->where('created_at', '>', now()->subHours(24)) // Check only payments from last 24 hours
            ->get();

        $results = [];
        
        foreach ($pendingPayments as $payment) {
            $status = $this->syncPaymentStatus($payment->merchant_order_id);
            $results[$payment->merchant_order_id] = $status !== false ? $status : 'FAILED_TO_CHECK';
        }
        
        Log::info('Auto-check pending payments completed', ['results' => $results]);
        
        return response()->json([
            'success' => true,
            'message' => 'Auto-check completed',
            'total_checked' => count($pendingPayments),
            'results' => $results
        ]);
    }
}