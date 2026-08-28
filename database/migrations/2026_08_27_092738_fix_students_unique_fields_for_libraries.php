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
        Schema::table('students', function (Blueprint $table) {
            $table->dropUnique('students_student_code_unique');
            $table->dropUnique('students_email_unique');
            $table->dropUnique('students_aadhaar_number_unique');

            $table->unique(['library_id', 'student_code']);
            $table->unique(['library_id', 'email']);
            $table->unique(['library_id', 'aadhaar_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropUnique(['library_id', 'student_code']);
            $table->dropUnique(['library_id', 'email']);
            $table->dropUnique(['library_id', 'aadhaar_number']);

            $table->unique('student_code');
            $table->unique('email');
            $table->unique('aadhaar_number');
        });
    }
};