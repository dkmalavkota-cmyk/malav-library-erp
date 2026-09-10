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
        Schema::create('exam_attempts', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Library
            |--------------------------------------------------------------------------
            | libraries.id is UNSIGNED INT in this project.
            */
            $table->unsignedInteger('library_id');

            /*
            |--------------------------------------------------------------------------
            | Exam & Student
            |--------------------------------------------------------------------------
            */
            $table->foreignId('exam_id')
                ->constrained('exams')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Attempt Information
            |--------------------------------------------------------------------------
            */
            $table->unsignedInteger('attempt_number')->default(1);

            $table->enum('status', [
                'in_progress',
                'submitted',
                'expired',
                'cancelled',
            ])->default('in_progress');

            /*
            |--------------------------------------------------------------------------
            | Timing
            |--------------------------------------------------------------------------
            */
            $table->timestamp('started_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Result
            |--------------------------------------------------------------------------
            */
            $table->decimal('total_marks', 10, 2)->default(0);
            $table->decimal('obtained_marks', 10, 2)->default(0);

            $table->unsignedInteger('correct_answers')->default(0);
            $table->unsignedInteger('wrong_answers')->default(0);
            $table->unsignedInteger('unanswered')->default(0);

            $table->boolean('is_passed')->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */
            $table->index([
                'library_id',
                'student_id',
            ]);

            $table->index([
                'library_id',
                'exam_id',
            ]);

            $table->index([
                'exam_id',
                'student_id',
                'attempt_number',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Library Foreign Key
            |--------------------------------------------------------------------------
            */
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
        Schema::dropIfExists('exam_attempts');
    }
};