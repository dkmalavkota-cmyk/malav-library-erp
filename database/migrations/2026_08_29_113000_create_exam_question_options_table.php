<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_question_options', function (Blueprint $table) {

            $table->id();

            // Question
            $table->unsignedBigInteger('exam_question_id');

            $table->foreign('exam_question_id')
                ->references('id')
                ->on('exam_questions')
                ->cascadeOnDelete();

            // Option
            $table->text('option_text');

            // Correct answer
            $table->boolean('is_correct')
                ->default(false);

            // Display order
            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();

            $table->index([
                'exam_question_id',
                'sort_order',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_question_options');
    }
};