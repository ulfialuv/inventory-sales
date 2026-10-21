<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->string('payment_method', 30)
                ->default('cash');

            $table->string('payment_status', 30)
                ->default('paid');

            $table->string('order_status', 30)
                ->default('completed');

            $table->string('transfer_proof')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'payment_status',
                'order_status',
                'transfer_proof',
            ]);
        });
    }
};