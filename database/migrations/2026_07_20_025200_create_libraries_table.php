<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('libraries', function (Blueprint $table) {
            $table->id();

            $table->string('name', 150);
            $table->string('code', 30)->unique();

            $table->string('logo')->nullable();
            $table->text('address')->nullable();

            $table->string('city', 80)->nullable();
            $table->string('state', 80)->nullable();
            $table->string('country', 80)->default('India');

            $table->string('phone', 30)->nullable();
            $table->string('whatsapp', 30)->nullable();

            $table->string('email', 150)->nullable();
            $table->string('website', 150)->nullable();

            $table->time('opening_time')->default('06:00:00');
            $table->time('closing_time')->default('22:00:00');

            $table->boolean('sunday_open')->default(true);

            $table->string('currency', 10)->default('INR');
            $table->string('student_prefix', 20)->default('LIB');

            $table->enum('status', [
                'active',
                'suspended',
            ])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libraries');
    }
};