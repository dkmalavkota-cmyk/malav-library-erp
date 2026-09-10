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
        Schema::create('student_exam_accounts', function (Blueprint $table) {

            $table->id();

            // Existing ERP student
            $table->foreignId('student_id')
                ->unique()
                ->constrained('students')
                ->cascadeOnDelete();

            // Student exam portal login
            $table->string('email')->nullable()->unique();

            $table->string('password');

            $table->boolean('is_active')
                ->default(true);

            $table->timestamp('last_login_at')
                ->nullable();

            $table->rememberToken();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_exam_accounts');
    }
};