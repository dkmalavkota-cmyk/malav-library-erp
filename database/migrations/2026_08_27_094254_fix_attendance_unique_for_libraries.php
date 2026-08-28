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
        Schema::table('attendance_logs', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropUnique(
                'attendance_logs_student_id_attendance_date_unique'
            );
        });

        Schema::table('attendance_logs', function (Blueprint $table) {
            $table->unique(
                ['library_id', 'student_id', 'attendance_date'],
                'attendance_logs_library_student_date_unique'
            );

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_logs', function (Blueprint $table) {
            $table->dropForeign(['student_id']);

            $table->dropUnique(
                'attendance_logs_library_student_date_unique'
            );

            $table->unique(
                ['student_id', 'attendance_date'],
                'attendance_logs_student_id_attendance_date_unique'
            );

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->cascadeOnDelete();
        });
    }
};