<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_questions', function (Blueprint $table) {

            $table->id();

            // Library / Tenant
            $table->unsignedInteger('library_id');

            $table->foreign('library_id')
                ->references('id')
                ->on('libraries')
                ->cascadeOnDelete();

            // Subject
            $table->foreignId('subject_id')
                ->constrained('exam_subjects')
                ->cascadeOnDelete();

            // Topic
            $table->foreignId('topic_id')
                ->constrained('exam_topics')
                ->cascadeOnDelete();

            // Question
            $table->text('question_text');

            // Optional explanation
            $table->text('explanation')->nullable();

            // Marks
            $table->decimal('marks', 8, 2)->default(1);

            // Negative marking
            $table->decimal('negative_marks', 8, 2)->default(0);

            // Difficulty
            $table->enum('difficulty', [
                'Easy',
                'Medium',
                'Hard',
            ])->default('Medium');

            // Status
            $table->boolean('is_active')->default(true);

            // Display order
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            // Useful indexes
            $table->index([
                'library_id',
                'subject_id',
                'topic_id',
            ]);

            $table->index([
                'library_id',
                'is_active',
            ]);

            $table->index([
                'topic_id',
                'sort_order',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_questions');
    }
};