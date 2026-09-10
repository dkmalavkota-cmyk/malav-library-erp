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
        Schema::create('exam_assignments', function (Blueprint $table) {

            $table->id();

            /*
             * IMPORTANT:
             * libraries.id is INT UNSIGNED,
             * so library_id must also be INT UNSIGNED.
             */
            $table->unsignedInteger('library_id');

            $table->unsignedBigInteger('exam_id');

            $table->unsignedBigInteger('student_id');

            $table->enum('status', [
                'assigned',
                'started',
                'completed',
                'expired',
                'cancelled',
            ])->default('assigned');

            $table->timestamp('assigned_at')->nullable();

            $table->timestamps();

            /*
             * Foreign Keys
             */
            $table->foreign('library_id')
                ->references('id')
                ->on('libraries')
                ->cascadeOnDelete();

            $table->foreign('exam_id')
                ->references('id')
                ->on('exams')
                ->cascadeOnDelete();

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->cascadeOnDelete();

            /*
             * Same student cannot receive
             * the same exam twice.
             */
            $table->unique([
                'exam_id',
                'student_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_assignments');
    }
};