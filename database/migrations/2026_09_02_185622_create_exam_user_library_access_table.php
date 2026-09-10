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
        Schema::create('exam_user_library_access', function (Blueprint $table) {

            $table->id();

            // Public / external examination candidate
            $table->foreignId('exam_user_id')
                ->constrained('exam_users')
                ->cascadeOnDelete();

            // Library whose examination/test-series access is granted
            $table->unsignedInteger('library_id');

            // Access status
            $table->enum('status', [
                'active',
                'expired',
                'revoked',
            ])->default('active');

            // How the candidate received access
            $table->enum('access_type', [
                'free',
                'purchased',
                'assigned',
                'subscription',
            ])->default('free');

            // Optional access validity
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();

            $table->timestamps();

            // Same user cannot have duplicate access to same library
            $table->unique([
                'exam_user_id',
                'library_id',
            ]);

            // Fast library-wise lookup
            $table->index([
                'library_id',
                'status',
            ]);

            $table->foreign('library_id')
                ->references('id')
                ->on('libraries')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_user_library_access');
    }
};