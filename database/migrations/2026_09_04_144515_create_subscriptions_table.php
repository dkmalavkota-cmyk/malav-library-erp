<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            // libraries.id is INT UNSIGNED, so library_id must match it.
            $table->unsignedInteger('library_id');

            $table->string('plan_name', 100);

            $table->date('starts_at');
            $table->date('ends_at');

            // trial, active, expired, cancelled
            $table->string('status', 30)->default('trial')->index();

            $table->decimal('amount', 12, 2)->default(0);

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->foreign('library_id')
                ->references('id')
                ->on('libraries')
                ->cascadeOnDelete();

            $table->index(['library_id', 'status']);
            $table->index(['starts_at', 'ends_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};