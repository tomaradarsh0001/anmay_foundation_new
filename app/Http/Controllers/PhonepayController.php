<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get access token from PhonePe'
            ], 500);
        }

        // Validate amount
        $amount = $request->amount;
        if (!is_numeric($amount) || $amount <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid amount. Please enter a valid amount.'
            ], 400);
        }
        session([
                'donor_name' => $request->fullName,
                'donor_email' => $request->email,
                'donor_phone' => $request->phone
            ]);
        // Convert to paise (PhonePe expects amount in paise)
        $amountPaise = (int) ($amount * 100);
        $merchantOrderId = 'ORDER_' . time() . '_' . rand(1000, 9999);

        // Prepare payload as per PhonePe documentation
        $payload = [
            "merchantId" => $this->merchantId,
            "merchantOrderId" => $merchantOrderId,
            "amount" => $amountPaise,
            "expireAfter" => 1200, // 20 minutes in seconds
            "metaInfo" => [
                "udf1" => $request->fullName ?? 'User',
                "udf2" => $request->email ?? 'user@example.com',
                "udf3" => $request->phone ?? '0000000000',
                "udf4" => "Donation",
                "udf5" => "Anmay Foundation"
            ],
            "paymentFlow" => [
                "type" => "PG_CHECKOUT",
                "message" => "Donation Payment for Anmay Foundation",
                "merchantUrls" => [
                    // Make sure this URL is accessible and has https
                "redirectUrl" => route('payment.success')                ]
            ]
        ];

        Log::info('PhonePe Payment Payload', $payload);

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                // IMPORTANT: PhonePe uses 'O-Bearer' not just 'Bearer'
                'Authorization' => 'O-Bearer ' . $accessToken
            ])->timeout(30)->post(
                'https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/pay',
                $payload
            );

            Log::info('PhonePe API Response Status', [
                'status' => $response->status(),
                'headers' => $response->headers()
            ]);

            $responseData = $response->json();
            Log::info('PhonePe Payment Response', $responseData);

            // Check if we got a successful response
            if ($response->successful()) {
                if (isset($responseData['redirectUrl'])) {
                    return response()->json([
                        'success' => true,
                        'paymentUrl' => $responseData['redirectUrl'],
                        'orderId' => $responseData['orderId'] ?? $merchantOrderId,
                        'message' => 'Payment initiated successfully'
                    ]);
                } elseif (isset($responseData['data']['instrumentResponse']['redirectInfo']['url'])) {
                    // Alternative response format
                    return response()->json([
                        'success' => true,
                        'paymentUrl' => $responseData['data']['instrumentResponse']['redirectInfo']['url'],
                        'orderId' => $responseData['orderId'] ?? $merchantOrderId,
                        'message' => 'Payment initiated successfully'
                    ]);
                }
            }

            // If we reach here, something went wrong
            return response()->json([
                'success' => false,
                'message' => 'Failed to initiate payment',
                'error' => $responseData['message'] ?? 'Unknown error',
                'debug' => $responseData
            ]);

        } catch (\Exception $e) {
            Log::error('PhonePe Payment Exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment gateway error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Payment success callback
   public function paymentSuccess(Request $request)
{
    Log::info('Payment Success Callback Received', $request->all());
    
    // Extract parameters from PhonePe callback
    $transactionId = $request->input('transactionId') ?? $request->input('id') ?? 'TXN_' . time();
    $status = $request->input('status') ?? 'SUCCESS';
    $amount = $request->input('amount') ?? 0;
    $merchantOrderId = $request->input('merchantOrderId') ?? $request->input('merchantTransactionId') ?? 'ORDER_' . time();
    
    // If you stored donor info in session or database, retrieve it
    $donorName = session('donor_name') ?? $request->input('udf1') ?? 'Guest Donor';
    $donorEmail = session('donor_email') ?? $request->input('udf2') ?? 'Not Provided';
    $donorPhone = session('donor_phone') ?? $request->input('udf3') ?? 'Not Provided';
    
    // Clear session data if stored
    session()->forget(['donor_name', 'donor_email', 'donor_phone']);
    
    return view('pages.payment-success', [
        'transaction_id' => $transactionId,
        'merchant_order_id' => $merchantOrderId,
        'amount' => $amount,
        'donor_name' => $donorName,
        'email' => $donorEmail,
        'phone' => $donorPhone,
        'status' => $status,
        'payment_method' => $request->input('paymentMethod') ?? 'PhonePe',
        'payment_gateway' => $request->input('gateway') ?? 'PhonePe'
    ]);
}

    // Payment failure callback
    public function paymentFailure(Request $request)
    {
        Log::info('Payment Failure Callback', $request->all());
        
        return view('donation-failure', [
            'message' => 'Payment failed. Please try again.',
            'error' => $request->error ?? 'Unknown error'
        ]);
    }
}