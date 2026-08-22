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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string('student_code')->unique();
            $table->string('photo')->nullable();

            $table->string('first_name');
            $table->string('last_name')->nullable();

            $table->string('father_name');

            $table->string('mobile', 15)->index();
            $table->string('whatsapp', 15)->nullable();

            $table->string('email')->nullable()->unique();

            $table->enum('gender', ['Male', 'Female', 'Other']);

            $table->date('dob')->nullable();

            $table->string('aadhaar_number')->nullable()->unique();

            $table->text('address')->nullable();

            $table->string('city')->nullable();
            $table->string('state')->nullable();

            $table->string('college')->nullable();
            $table->string('course')->nullable();

            $table->string('preparing_for')->nullable();

            $table->date('joining_date');

            $table->enum('status', [
                'Active',
                'Inactive',
                'Suspended',
            ])->default('Active');

            $table->text('remarks')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};