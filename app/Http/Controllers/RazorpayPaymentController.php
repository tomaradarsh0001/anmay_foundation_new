<?php
// app/Http/Controllers/RazorpayPaymentController.php

namespace App\Http\Controllers;

use App\Models\RazorpayPayment;
use App\Services\RazorpayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RazorpayPaymentController extends Controller
{
    protected $razorpayService;

    public function __construct(RazorpayService $razorpayService)
    {
        $this->razorpayService = $razorpayService;
    }

    public function showDonationForm()
    {
        return view('pages.razorpay');
    }

    public function initiatePayment(Request $request)
    {
        try {
            $request->validate([
                'fullName' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|size:10',
                'amount' => 'required|numeric|min:1'
            ]);

            // Generate unique merchant order ID
            $merchantOrderId = 'DON_' . strtoupper(Str::random(10)) . '_' . time();

            // Create payment record
            $payment = RazorpayPayment::create([
                'merchant_order_id' => $merchantOrderId,
                'amount' => $request->amount,
                'currency' => 'INR',
                'status' => RazorpayPayment::STATUS_PENDING,
                'full_name' => $request->fullName,
                'email' => $request->email,
                'phone' => $request->phone,
                'description' => 'Donation from ' . $request->fullName
            ]);

            // Create Razorpay order
            $razorpayOrder = $this->razorpayService->createOrder(
                $request->amount,
                'INR',
                $merchantOrderId,
                [
                    'merchant_order_id' => $merchantOrderId,
                    'full_name' => $request->fullName,
                    'email' => $request->email,
                    'phone' => $request->phone
                ]
            );

            // Update with Razorpay order ID
            $payment->update([
                'razorpay_order_id' => $razorpayOrder['id']
            ]);

            return response()->json([
                'success' => true,
                'razorpay_order_id' => $razorpayOrder['id'],
                'razorpay_key' => config('services.razorpay.key'),
                'amount' => $request->amount * 100,
                'currency' => 'INR',
                'merchant_order_id' => $merchantOrderId,
                'customer_details' => [
                    'name' => $request->fullName,
                    'email' => $request->email,
                    'contact' => $request->phone
                ],
                'theme' => [
                    'color' => '#00b09b'
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Payment initiation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment initiation failed. Please try again.'
            ], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        try {
            $request->validate([
                'razorpay_order_id' => 'required|string',
                'razorpay_payment_id' => 'required|string',
                'razorpay_signature' => 'required|string'
            ]);

            // Find payment record
            $payment = RazorpayPayment::where('razorpay_order_id', $request->razorpay_order_id)->first();
            
            if (!$payment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment record not found'
                ], 404);
            }

            // Check if already paid
            if ($payment->isPaid()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Payment already verified',
                    'razorpay_payment_id' => $payment->razorpay_payment_id,
                    'merchant_order_id' => $payment->merchant_order_id
                ]);
            }

            // Verify signature
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $isVerified = $this->razorpayService->verifyPaymentSignature($attributes);

            if ($isVerified) {
                // Fetch payment details
                $paymentDetails = $this->razorpayService->fetchPayment($request->razorpay_payment_id);
                
                // Capture payment if not already captured
                if ($paymentDetails->status !== 'captured') {
                    $capturedPayment = $this->razorpayService->capturePayment(
                        $request->razorpay_payment_id,
                        $payment->amount
                    );
                    $paymentStatus = $capturedPayment->status;
                } else {
                    $paymentStatus = $paymentDetails->status;
                }

                if ($paymentStatus === 'captured') {
                    // IMPORTANT: Mark as paid immediately
                    $payment->markAsPaid(
                        $request->razorpay_payment_id,
                        $request->razorpay_signature,
                        [
                            'payment_details' => $paymentDetails->toArray(),
                            'verified_at' => now()->toDateTimeString()
                        ]
                    );

                    Log::info('Payment verified and marked as paid', [
                        'merchant_order_id' => $payment->merchant_order_id,
                        'razorpay_payment_id' => $request->razorpay_payment_id,
                        'status' => $payment->status
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Payment verified successfully',
                        'razorpay_payment_id' => $request->razorpay_payment_id,
                        'merchant_order_id' => $payment->merchant_order_id,
                        'status' => $payment->status
                    ]);
                } else {
                    throw new \Exception('Payment not captured. Status: ' . $paymentStatus);
                }
            } else {
                $payment->markAsFailed('Signature verification failed');
                
                return response()->json([
                    'success' => false,
                    'message' => 'Payment verification failed'
                ], 400);
            }

        } catch (\Exception $e) {
            Log::error('Payment verification failed: ' . $e->getMessage(), [
                'order_id' => $request->razorpay_order_id ?? null
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed. Please contact support.'
            ], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $paymentId = $request->query('razorpay_payment_id');
        $merchantOrderId = $request->query('merchant_order_id');
        
        $payment = RazorpayPayment::where('razorpay_payment_id', $paymentId)
            ->orWhere('merchant_order_id', $merchantOrderId)
            ->first();
        
        // If payment is still pending, try to verify with Razorpay
        if ($payment && $payment->isPending() && $payment->razorpay_payment_id) {
            try {
                $paymentDetails = $this->razorpayService->fetchPayment($payment->razorpay_payment_id);
                if ($paymentDetails->status === 'captured') {
                    $payment->markAsPaid(
                        $payment->razorpay_payment_id,
                        $payment->razorpay_signature,
                        ['retrieved_on_success_page' => true]
                    );
                }
            } catch (\Exception $e) {
                Log::error('Failed to fetch payment on success page', [
                    'payment_id' => $payment->razorpay_payment_id,
                    'error' => $e->getMessage()
                ]);
            }
        }
        
        return view('pages.razorpay-success', compact('payment'));
    }

public function paymentFailed(Request $request)
{
    $razorpayOrderId = $request->query('razorpay_order_id');
    $razorpayPayment = null;
    
    if ($razorpayOrderId) {
        try {
            $razorpayPayment = RazorpayPayment::where('razorpay_order_id', $razorpayOrderId)->first();
            
            if ($razorpayPayment && $razorpayPayment->status === RazorpayPayment::STATUS_PENDING) {
                $razorpayPayment->markAsFailed('Payment cancelled - user closed modal', [
                    'user_cancelled' => true,
                    'timestamp' => now()->toDateTimeString(),
                    'query_params' => $request->all()
                ]);
                
                Log::info('Payment marked as failed due to modal close', [
                    'merchant_order_id' => $razorpayPayment->merchant_order_id,
                    'razorpay_order_id' => $razorpayOrderId
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error in paymentFailed: ' . $e->getMessage(), [
                'order_id' => $razorpayOrderId
            ]);
        }
    }
    
    // Always pass the variable to the view (could be null)
    return view('pages.razorpay-failed', compact('razorpayPayment'));
}

    public function getPaymentStatus($merchantOrderId)
    {
        try {
            $payment = RazorpayPayment::where('merchant_order_id', $merchantOrderId)->firstOrFail();
            
            // Double check with Razorpay if payment is pending but has payment ID
            if ($payment->isPending() && $payment->razorpay_payment_id) {
                try {
                    $paymentDetails = $this->razorpayService->fetchPayment($payment->razorpay_payment_id);
                    if ($paymentDetails->status === 'captured') {
                        $payment->markAsPaid(
                            $payment->razorpay_payment_id,
                            $payment->razorpay_signature,
                            ['retrieved_via_status_check' => true]
                        );
                    }
                } catch (\Exception $e) {
                    // Ignore fetch errors
                }
            }
            
            return response()->json([
                'success' => true,
                'status' => $payment->status,
                'razorpay_payment_id' => $payment->razorpay_payment_id,
                'amount' => $payment->amount,
                'paid_at' => $payment->updated_at,
                'is_paid' => $payment->isPaid()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }
    }
        public function index(Request $request)
    {
        try {
            $query = RazorpayPayment::query();

            // Apply search filter
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('merchant_order_id', 'LIKE', "%{$search}%")
                      ->orWhere('razorpay_order_id', 'LIKE', "%{$search}%")
                      ->orWhere('razorpay_payment_id', 'LIKE', "%{$search}%")
                      ->orWhere('full_name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%")
                      ->orWhere('phone', 'LIKE', "%{$search}%");
                });
            }

            // Apply status filter
            if ($request->filled('status') && $request->status != 'all') {
                $status = strtolower($request->status);
                $query->where('status', $status);
            }

            // Apply single date filter
            if ($request->filled('date')) {
                $query->whereDate('created_at', $request->date);
            }

            // Apply date range filter
            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }

            if ($request->filled('end_date')) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }

            // Apply sorting
            $query->orderBy('created_at', 'desc');

            // Get paginated results
            $payments = $query->paginate(15)->withQueryString();

            // Calculate statistics
            $stats = $this->getPaymentStatistics();

            return view('admin.payments.razorpay.index', compact('payments', 'stats'));

        } catch (\Exception $e) {
            Log::error('Error in razorpay payment index: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

   
public function show($id)
{
    try {
        $payment = RazorpayPayment::findOrFail($id);
        
        // Decode payment response for display
        if ($payment->payment_response && is_string($payment->payment_response)) {
            $payment->payment_response = json_decode($payment->payment_response, true);
        }
        
        return view('admin.payments.razorpay.show', compact('payment'));
        
    } catch (\Exception $e) {
        Log::error('Error in razorpay payment show: ' . $e->getMessage());
        return redirect()->route('admin.payments.razorpay.index')
            ->with('error', 'Payment not found!');
    }
}

public function destroy($id)
{
    try {
        $payment = RazorpayPayment::findOrFail($id);
        
        // Only allow deletion of pending or failed payments
        if (!in_array($payment->status, ['pending', 'failed'])) {
            return redirect()->back()
                ->with('error', 'Only pending or failed payments can be deleted!');
        }
        
        $payment->delete();
        
        Log::info('Razorpay payment deleted', [
            'payment_id' => $payment->id,
            'merchant_order_id' => $payment->merchant_order_id,
            'status' => $payment->status
        ]);
        
        return redirect()->route('admin.payments.razorpay.index')
            ->with('success', 'Payment record deleted successfully!');
        
    } catch (\Exception $e) {
        Log::error('Error deleting payment: ' . $e->getMessage());
        return redirect()->back()
            ->with('error', 'Failed to delete payment record!');
    }
}

    /**
     * Update payment status.
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,paid,failed,refunded'
            ]);

            $payment = RazorpayPayment::findOrFail($id);
            $payment->status = $request->status;
            $payment->save();

            Log::info('Razorpay payment status updated', [
                'payment_id' => $payment->id,
                'merchant_order_id' => $payment->merchant_order_id,
                'new_status' => $request->status
            ]);

            return redirect()->back()->with('success', 'Payment status updated successfully!');

        } catch (\Exception $e) {
            Log::error('Error updating payment status: ' . $e->getMessage());
            return back()->with('error', 'Failed to update payment status!');
        }
    }

    /**
     * Get payment statistics.
     */
    private function getPaymentStatistics()
    {
        try {
            $stats = [];
            
            // Total payments count
            $stats['total'] = RazorpayPayment::count();
            
            // Successful payments count
            $stats['success'] = RazorpayPayment::where('status', 'paid')->count();
            
            // Pending payments count
            $stats['pending'] = RazorpayPayment::where('status', 'pending')->count();
            
            // Failed payments count
            $stats['failed'] = RazorpayPayment::where('status', 'failed')->count();
            
            // Today's total payments count
            $stats['today_total'] = RazorpayPayment::whereDate('created_at', today())->count();
            
            // Today's amount
            $stats['today_amount'] = RazorpayPayment::whereDate('created_at', today())
                ->where('status', 'paid')
                ->sum('amount') ?? 0;
            
            // Total amount from successful payments
            $stats['total_amount'] = RazorpayPayment::where('status', 'paid')
                ->sum('amount') ?? 0;
            
            // Success rate
            $stats['success_rate'] = $stats['total'] > 0 
                ? round(($stats['success'] / $stats['total']) * 100, 2) 
                : 0;
            
            // Average donation amount
            $stats['avg_amount'] = $stats['success'] > 0 
                ? round($stats['total_amount'] / $stats['success'], 2) 
                : 0;
            
            // This month stats
            $stats['month_total'] = RazorpayPayment::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();
            
            $stats['month_amount'] = RazorpayPayment::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->where('status', 'paid')
                ->sum('amount') ?? 0;
            
            return $stats;
            
        } catch (\Exception $e) {
            Log::error('Error calculating payment statistics: ' . $e->getMessage());
            
            return [
                'total' => 0,
                'success' => 0,
                'pending' => 0,
                'failed' => 0,
                'today_total' => 0,
                'today_amount' => 0,
                'total_amount' => 0,
                'success_rate' => 0,
                'avg_amount' => 0,
                'month_total' => 0,
                'month_amount' => 0
            ];
        }
    }

    /**
     * Export payments to CSV.
     */
    public function export(Request $request)
    {
        try {
            $query = RazorpayPayment::query();

            // Apply filters similar to index
            if ($request->filled('status') && $request->status != 'all') {
                $query->where('status', strtolower($request->status));
            }

            if ($request->filled('date')) {
                $query->whereDate('created_at', $request->date);
            }

            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }

            if ($request->filled('end_date')) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }

            $payments = $query->orderBy('created_at', 'desc')->get();

            $filename = 'razorpay_payments_' . date('Y-m-d_His') . '.csv';
            
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ];

            $columns = [
                'Merchant Order ID',
                'Razorpay Order ID',
                'Razorpay Payment ID',
                'Donor Name',
                'Donor Email',
                'Donor Phone',
                'Amount',
                'Currency',
                'Status',
                'Description',
                'Failure Reason',
                'Created Date',
                'Payment Date'
            ];

            $callback = function() use ($payments, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($payments as $payment) {
                    fputcsv($file, [
                        $payment->merchant_order_id,
                        $payment->razorpay_order_id,
                        $payment->razorpay_payment_id,
                        $payment->full_name,
                        $payment->email,
                        $payment->phone,
                        $payment->amount,
                        $payment->currency,
                        strtoupper($payment->status),
                        $payment->description,
                        $payment->failure_reason,
                        $payment->created_at->format('Y-m-d H:i:s'),
                        $payment->updated_at->format('Y-m-d H:i:s')
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            Log::error('Error exporting payments: ' . $e->getMessage());
            return back()->with('error', 'Failed to export payments!');
        }
    }
}