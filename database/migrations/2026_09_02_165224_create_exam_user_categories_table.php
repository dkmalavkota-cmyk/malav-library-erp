<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_user_categories', function (Blueprint $table) {

            $table->id();

            // External / public examination candidate
            $table->foreignId('exam_user_id')
                ->constrained('exam_users')
                ->cascadeOnDelete();

            // Existing examination category
            $table->foreignId('exam_category_id')
                ->constrained('exam_categories')
                ->cascadeOnDelete();

            $table->timestamps();

            // Same category cannot be selected twice
            $table->unique([
                'exam_user_id',
                'exam_category_id',
            ]);

            // Useful lookup index
            $table->index([
                'exam_category_id',
                'exam_user_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_user_categories');
    }
};