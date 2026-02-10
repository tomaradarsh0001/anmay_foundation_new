<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phonepe_payments', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_order_id')->unique();
            $table->string('transaction_id')->nullable();
            $table->decimal('amount', 10, 2); // In INR
            $table->integer('amount_paise'); // Original amount in paise
            $table->string('status'); // PENDING, SUCCESS, FAILED, PROCESSING
            $table->string('payment_method')->nullable();
            $table->string('payment_gateway')->default('PhonePe');
            
            // Donor information
            $table->string('donor_name');
            $table->string('donor_email');
            $table->string('donor_phone');
            
            // UDF fields
            $table->string('udf1')->nullable();
            $table->string('udf2')->nullable();
            $table->string('udf3')->nullable();
            $table->string('udf4')->nullable();
            $table->string('udf5')->nullable();
            
            // Response data
            $table->json('callback_data')->nullable();
            $table->text('error_message')->nullable();
            $table->string('error_code')->nullable();
            
            // Timestamps
            $table->timestamp('payment_date')->nullable();
            $table->timestamps();
            
            // Indexes for faster queries
            $table->index('merchant_order_id');
            $table->index('transaction_id');
            $table->index('status');
            $table->index('created_at');
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phonepe_payments');
    }
};