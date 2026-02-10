<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('phonepe_payments', function (Blueprint $table) {
            $table->string('payment_mode')->nullable()->after('payment_method');
            $table->string('bank_name')->nullable()->after('payment_mode');
            $table->string('account_number')->nullable()->after('bank_name');
            $table->string('utr_number')->nullable()->after('account_number');
            $table->string('vpa')->nullable()->after('utr_number');
            $table->string('ifsc_code')->nullable()->after('vpa');
        });
    }

    public function down(): void
    {
        Schema::table('phonepe_payments', function (Blueprint $table) {
            $table->dropColumn([
                'payment_mode',
                'bank_name',
                'account_number',
                'utr_number',
                'vpa',
                'ifsc_code'
            ]);
        });
    }
};