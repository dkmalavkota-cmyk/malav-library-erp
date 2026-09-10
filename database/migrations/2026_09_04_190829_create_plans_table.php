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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100)->unique();

            $table->decimal('monthly_price', 10, 2)->default(0);
            $table->decimal('yearly_price', 10, 2)->default(0);

            $table->unsignedInteger('student_limit')->nullable();

            $table->boolean('exam_access')->default(false);
            $table->boolean('question_bank_access')->default(false);
            $table->boolean('current_affairs_access')->default(false);
            $table->boolean('major_test_access')->default(false);
            $table->boolean('assigned_test_access')->default(false);
            $table->boolean('public_exam_access')->default(false);
            $table->boolean('advanced_reports_access')->default(false);

            $table->boolean('is_active')->default(true)->index();

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};