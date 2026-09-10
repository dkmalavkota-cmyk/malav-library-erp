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
        Schema::create('exam_attempt_answers', function (Blueprint $table) {

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
            | Attempt
            |--------------------------------------------------------------------------
            */
            $table->foreignId('exam_attempt_id')
                ->constrained('exam_attempts')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Question
            |--------------------------------------------------------------------------
            */
            $table->foreignId('exam_question_id')
                ->constrained('exam_questions')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Selected Option
            |--------------------------------------------------------------------------
            |
            | Stores the selected option ID from
            | exam_question_options table.
            |
            */
            $table->foreignId('selected_option_id')
                ->nullable()
                ->constrained('exam_question_options')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Answer Status
            |--------------------------------------------------------------------------
            */
            $table->boolean('is_answered')->default(false);

            $table->boolean('is_correct')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Marks
            |--------------------------------------------------------------------------
            */
            $table->decimal('marks_awarded', 10, 2)
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Answered Time
            |--------------------------------------------------------------------------
            */
            $table->timestamp('answered_at')->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Library Foreign Key
            |--------------------------------------------------------------------------
            */
            $table->foreign('library_id')
                ->references('id')
                ->on('libraries')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Prevent duplicate answer records
            |--------------------------------------------------------------------------
            |
            | One attempt can have only one answer record
            | for each question.
            |
            */
            $table->unique([
                'exam_attempt_id',
                'exam_question_id',
            ], 'exam_attempt_question_unique');

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */
            $table->index([
                'library_id',
                'exam_attempt_id',
            ]);

            $table->index([
                'library_id',
                'exam_question_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_attempt_answers');
    }
};