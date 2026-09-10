<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_question', function (Blueprint $table) {

            $table->id();

            // Exam
            $table->foreignId('exam_id')
                ->constrained('exams')
                ->cascadeOnDelete();

            // Question Bank Question
            $table->foreignId('exam_question_id')
                ->constrained('exam_questions')
                ->cascadeOnDelete();

            // Exam-specific order
            $table->unsignedInteger('sort_order')
                ->default(0);

            // Exam-specific marks
            $table->decimal('marks', 8, 2)
                ->nullable();

            // Exam-specific negative marks
            $table->decimal('negative_marks', 8, 2)
                ->nullable();

            $table->timestamps();

            // Same question should not be added twice
            $table->unique([
                'exam_id',
                'exam_question_id',
            ]);

            // Faster ordering
            $table->index([
                'exam_id',
                'sort_order',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_question');
    }
};