<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('phonepe_payments', function (Blueprint $table) {
            $table->timestamp('last_checked_at')->nullable()->after('payment_date');
            $table->integer('check_count')->default(0)->after('last_checked_at');
            $table->index(['status', 'last_checked_at']); // For faster queries
        });
    }

    public function down(): void
    {
        Schema::table('phonepe_payments', function (Blueprint $table) {
            $table->dropColumn(['last_checked_at', 'check_count']);
            $table->dropIndex(['status', 'last_checked_at']);
        });
    }
};