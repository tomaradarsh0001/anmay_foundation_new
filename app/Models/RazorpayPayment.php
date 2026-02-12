<?php
// app/Models/RazorpayPayment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazorpayPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_order_id',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'amount',
        'currency',
        'status',
        'full_name',
        'email',
        'phone',
        'description',
        'payment_response',
        'failure_reason'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_response' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_FAILED = 'failed';
    const STATUS_REFUNDED = 'refunded';

    public function markAsPaid($razorpayPaymentId, $razorpaySignature, $paymentResponse = [])
    {
        $this->update([
            'razorpay_payment_id' => $razorpayPaymentId,
            'razorpay_signature' => $razorpaySignature,
            'status' => self::STATUS_PAID,
            'payment_response' => array_merge($this->payment_response ?? [], $paymentResponse),
            'failure_reason' => null
        ]);
    }

    public function markAsFailed($failureReason, $additionalData = [])
    {
        $this->update([
            'status' => self::STATUS_FAILED,
            'failure_reason' => $failureReason,
            'payment_response' => array_merge($this->payment_response ?? [], $additionalData)
        ]);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopePaid($query)
    {
        return $query->where('status', self::STATUS_PAID);
    }

    public function isPaid()
    {
        return $this->status === self::STATUS_PAID;
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isFailed()
    {
        return $this->status === self::STATUS_FAILED;
    }
}