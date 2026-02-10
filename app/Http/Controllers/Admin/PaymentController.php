<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhonePePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = PhonePePayment::latest();

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        $payments = $query->paginate(20)->withQueryString();
        // dd($payments);
        // Statistics
        $stats = [
            'total' => PhonePePayment::count(),
            'success' => PhonePePayment::success()->count(),
            'pending' => PhonePePayment::pending()->count(),
            'failed' => PhonePePayment::failed()->count(),
            'today_total' => PhonePePayment::today()->count(),
            'today_success' => PhonePePayment::today()->success()->count(),
            'today_amount' => PhonePePayment::today()->success()->sum('amount'),
            'month_amount' => PhonePePayment::thisMonth()->success()->sum('amount'),
            'total_amount' => PhonePePayment::success()->sum('amount')
        ];
        // dd($stats);
        // Daily chart data (last 30 days)
        $dailyData = PhonePePayment::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(amount) as amount')
            )
            ->where('created_at', '>=', now()->subDays(30))
            ->where('status', 'SUCCESS')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.payments.index', compact('payments', 'stats', 'dailyData'));
    }

    public function show($id)
    {
        $payment = PhonePePayment::findOrFail($id);
        
        return view('admin.payments.show', compact('payment'));
    }

    public function destroy($id)
    {
        $payment = PhonePePayment::findOrFail($id);
        
        // Only allow deletion of failed or old pending payments
        if ($payment->status === 'SUCCESS') {
            return redirect()->back()->with('error', 'Cannot delete successful payments.');
        }

        $payment->delete();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment record deleted successfully.');
    }

    public function export(Request $request)
    {
        $query = PhonePePayment::query();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        $payments = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="payments_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($payments) {
            $file = fopen('php://output', 'w');
            
            // CSV header
            fputcsv($file, [
                'Order ID', 'Transaction ID', 'Donor Name', 'Email', 'Phone',
                'Amount (₹)', 'Status', 'Payment Method', 'Date'
            ]);

            // CSV rows
            foreach ($payments as $payment) {
                fputcsv($file, [
                    $payment->merchant_order_id,
                    $payment->transaction_id ?? 'N/A',
                    $payment->donor_name,
                    $payment->donor_email,
                    $payment->donor_phone,
                    $payment->amount,
                    $payment->status,
                    $payment->payment_method ?? 'N/A',
                    $payment->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Check status for a specific payment
public function checkStatus($id)
{
    $payment = PhonePePayment::findOrFail($id);
    
    try {
        // Use the PhonepayController's sync method
        $phonepayController = new \App\Http\Controllers\PhonepayController();
        $status = $phonepayController->syncPaymentStatus($payment->merchant_order_id);
        
        if ($status !== false) {
            // Refresh payment data
            $payment->refresh();
            
            return redirect()->route('admin.payments.show', $payment->id)
                ->with('success', 'Payment status updated to: ' . $status);
        }
        
        return redirect()->route('admin.payments.show', $payment->id)
            ->with('error', 'Failed to check payment status');
            
    } catch (\Exception $e) {
        return redirect()->route('admin.payments.show', $payment->id)
            ->with('error', 'Error: ' . $e->getMessage());
    }
}

// Bulk status check
public function bulkCheckStatus(Request $request)
{
    $orderIds = $request->input('order_ids', []);
    $status = $request->input('status', 'PENDING');
    
    if (empty($orderIds)) {
        $orderIds = PhonePePayment::where('status', $status)->pluck('merchant_order_id')->toArray();
    }
    
    $results = [];
    $phonepayController = new \App\Http\Controllers\PhonepayController();
    
    foreach ($orderIds as $orderId) {
        $statusResult = $phonepayController->syncPaymentStatus($orderId);
        $results[$orderId] = $statusResult !== false ? $statusResult : 'FAILED_TO_CHECK';
    }
    
    return response()->json([
        'success' => true,
        'message' => 'Bulk status check completed',
        'results' => $results
    ]);
}
}