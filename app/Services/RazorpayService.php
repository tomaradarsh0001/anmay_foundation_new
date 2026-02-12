<?php
// app/Services/RazorpayService.php

namespace App\Services;

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Illuminate\Support\Facades\Log;

class RazorpayService
{
    protected $api;
    protected $key;
    protected $secret;

    public function __construct()
    {
        $this->key = config('services.razorpay.key');
        $this->secret = config('services.razorpay.secret');
        
        $this->api = new Api($this->key, $this->secret);
    }

    public function createOrder($amount, $currency = 'INR', $receipt = null, $notes = [])
    {
        try {
            $orderData = [
                'receipt' => $receipt ?? 'order_' . time(),
                'amount' => (int)($amount * 100),
                'currency' => $currency,
                'notes' => $notes
            ];

            $order = $this->api->order->create($orderData);
            
            Log::info('Razorpay order created', [
                'order_id' => $order['id'],
                'amount' => $amount,
                'receipt' => $receipt
            ]);
            
            return $order;
        } catch (\Exception $e) {
            Log::error('Razorpay order creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function verifyPaymentSignature($attributes)
    {
        try {
            $this->api->utility->verifyPaymentSignature($attributes);
            return true;
        } catch (SignatureVerificationError $e) {
            Log::error('Razorpay signature verification failed: ' . $e->getMessage());
            return false;
        }
    }

    public function fetchPayment($paymentId)
    {
        try {
            return $this->api->payment->fetch($paymentId);
        } catch (\Exception $e) {
            Log::error('Razorpay payment fetch failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function capturePayment($paymentId, $amount)
    {
        try {
            $payment = $this->api->payment->fetch($paymentId);
            
            if ($payment->status !== 'captured') {
                $capturedPayment = $payment->capture(['amount' => (int)($amount * 100)]);
                Log::info('Razorpay payment captured', ['payment_id' => $paymentId]);
                return $capturedPayment;
            }
            
            return $payment;
        } catch (\Exception $e) {
            Log::error('Razorpay payment capture failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function fetchOrder($orderId)
    {
        try {
            return $this->api->order->fetch($orderId);
        } catch (\Exception $e) {
            Log::error('Razorpay order fetch failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function fetchOrderPayments($orderId)
    {
        try {
            $order = $this->api->order->fetch($orderId);
            return $order->payments();
        } catch (\Exception $e) {
            Log::error('Razorpay order payments fetch failed: ' . $e->getMessage());
            throw $e;
        }
    }
}