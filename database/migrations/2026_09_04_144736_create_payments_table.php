<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saas_payments', function (Blueprint $table) {
            $table->id();

            // libraries.id is INT UNSIGNED
            $table->unsignedInteger('library_id');

            // subscriptions.id is BIGINT UNSIGNED
            $table->foreignId('subscription_id')
                ->nullable();

            $table->decimal('amount', 12, 2);
            $table->string('currency', 10)->default('INR');

            // cash, upi, bank_transfer, card, gateway, etc.
            $table->string('payment_method', 50)->nullable();

            // Gateway/order/transaction/reference number
            $table->string('transaction_id', 150)->nullable()->index();

            // pending, paid, failed, refunded
            $table->string('status', 30)->default('pending')->index();

            $table->timestamp('paid_at')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->foreign('library_id')
                ->references('id')
                ->on('libraries')
                ->cascadeOnDelete();

            $table->foreign('subscription_id')
                ->references('id')
                ->on('subscriptions')
                ->nullOnDelete();

            $table->index(['library_id', 'status']);
            $table->index(['library_id', 'paid_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saas_payments');
    }
};