<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {

            $table->id();

            // Commercial / Multi-library support
            $table->unsignedInteger('library_id');

            // Exam category
            $table->foreignId('exam_category_id')
                ->constrained('exam_categories')
                ->cascadeOnDelete();

            // Basic information
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();

            // Exam configuration
            $table->unsignedInteger('duration_minutes')->default(60);
            $table->unsignedInteger('total_marks')->default(0);
            $table->unsignedInteger('passing_marks')->default(0);

            // Negative marking
            $table->boolean('negative_marking')->default(false);
            $table->decimal('negative_marks', 5, 2)->default(0);

            // Attempts
            $table->unsignedInteger('attempt_limit')->default(1);

            // Availability
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();

            // Status
            $table->boolean('is_active')->default(true);
            $table->boolean('is_published')->default(false);

            $table->timestamps();

            // Foreign key
            $table->foreign('library_id')
                ->references('id')
                ->on('libraries')
                ->cascadeOnDelete();

            // Same slug allowed in different libraries
            $table->unique(['library_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};