<?php
// database/migrations/xxxx_xx_xx_create_razorpay_payments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('razorpay_payments', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_order_id')->unique();
            $table->string('razorpay_order_id')->nullable()->index();
            $table->string('razorpay_payment_id')->nullable()->index();
            $table->string('razorpay_signature')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('INR');
            $table->string('status')->default('pending')->index(); // pending, paid, failed, refunded
            $table->string('full_name');
            $table->string('email')->index();
            $table->string('phone')->index();
            $table->text('description')->nullable();
            $table->json('payment_response')->nullable();
            $table->text('failure_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('razorpay_payments');
    }
};