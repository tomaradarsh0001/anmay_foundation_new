<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhonePePayment extends Model
{
    use HasFactory;

        protected $table = 'phonepe_payments';


    protected $fillable = [
    'merchant_order_id',
    'transaction_id',
    'amount',
    'amount_paise',
    'status',
    'payment_method',
    'payment_gateway',
    'donor_name',
    'donor_email',
    'donor_phone',
    'udf1',
    'udf2',
    'udf3',
    'udf4',
    'udf5',
    'callback_data',
    'error_message',
    'error_code',
    'payment_date',
    'payment_mode',       // New field
    'bank_name',          // New field
    'account_number',     // New field (masked)
    'utr_number',         // New field
    'vpa',                // New field for UPI
    'ifsc_code',          // New field
      'last_checked_at',
    'check_count',
];

// Add method to extract payment details from callback
public function extractPaymentDetails()
{
    if (empty($this->callback_data)) {
        return null;
    }

    $details = [];
    
    if (isset($this->callback_data['paymentDetails']) && is_array($this->callback_data['paymentDetails'])) {
        $firstPayment = $this->callback_data['paymentDetails'][0];
        
        $details = [
            'payment_mode' => $firstPayment['paymentMode'] ?? null,
            'transaction_id' => $firstPayment['transactionId'] ?? null,
            'timestamp' => isset($firstPayment['timestamp']) ? date('Y-m-d H:i:s', $firstPayment['timestamp'] / 1000) : null,
        ];

        if (isset($firstPayment['splitInstruments']) && is_array($firstPayment['splitInstruments'])) {
            $firstInstrument = $firstPayment['splitInstruments'][0];
            
            if (isset($firstInstrument['rail'])) {
                $rail = $firstInstrument['rail'];
                $details['rail_type'] = $rail['type'] ?? null;
                $details['utr'] = $rail['utr'] ?? null;
                $details['upi_transaction_id'] = $rail['upiTransactionId'] ?? null;
                $details['vpa'] = $rail['vpa'] ?? null;
            }

            if (isset($firstInstrument['instrument'])) {
                $instrument = $firstInstrument['instrument'];
                $details['account_type'] = $instrument['accountType'] ?? null;
                $details['account_holder'] = $instrument['accountHolderName'] ?? null;
                $details['masked_account'] = $instrument['maskedAccountNumber'] ?? null;
                $details['ifsc'] = $instrument['ifsc'] ?? null;
                $details['bank_id'] = $instrument['bankId'] ?? null;
            }
        }
    }

    return $details;
}

    protected $casts = [
        'amount' => 'decimal:2',
        'callback_data' => 'array',
        'payment_date' => 'datetime',
         'last_checked_at' => 'datetime',
    'check_count' => 'integer',
        'transaction_id' => 'string',
    'payment_method' => 'string',
    ];

    // Scopes for easy querying
    public function scopeSuccess($query)
    {
        return $query->where('status', 'COMPLETED');
    }

public function scopeNeedsChecking($query)
{
    return $query->whereIn('status', ['PENDING', 'FAILED', 'INITIATED'])
        ->where(function($q) {
            $q->whereNull('last_checked_at')
              ->orWhere('last_checked_at', '<', now()->subSeconds(5));
        });
}

// Method to increment check count
public function incrementCheckCount()
{
    $this->check_count = ($this->check_count ?? 0) + 1;
    $this->last_checked_at = now();
    $this->save();
}

    public function scopePending($query)
    {
        return $query->where('status', 'PENDING');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'FAILED');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('merchant_order_id', 'like', "%{$search}%")
              ->orWhere('transaction_id', 'like', "%{$search}%")
              ->orWhere('donor_name', 'like', "%{$search}%")
              ->orWhere('donor_email', 'like', "%{$search}%")
              ->orWhere('donor_phone', 'like', "%{$search}%");
        });
    }

    // Helper methods
    public function isSuccess()
    {
        return $this->status === 'COMPLETED';
    }

    public function isPending()
    {
        return $this->status === 'PENDING';
    }

    public function isFailed()
    {
        return $this->status === 'FAILED';
    }

    public function getStatusBadgeClass()
    {
        return match($this->status) {
            'COMPLETED' => 'badge-success',
            'PENDING' => 'badge-warning',
            'FAILED' => 'badge-danger',
            'PROCESSING' => 'badge-info',
            default => 'badge-secondary'
        };
    }

    public function getFormattedAmount()
    {
        return '₹' . number_format($this->amount, 2);
    }

    public function getFormattedDate($format = 'd M Y, h:i A')
    {
        return $this->created_at->format($format);
    }
}