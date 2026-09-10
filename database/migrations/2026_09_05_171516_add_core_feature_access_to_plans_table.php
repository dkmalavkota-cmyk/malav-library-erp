<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->boolean('student_management_access')
                ->default(true)
                ->after('student_limit');

            $table->boolean('membership_access')
                ->default(true)
                ->after('student_management_access');

            $table->boolean('seat_management_access')
                ->default(true)
                ->after('membership_access');

            $table->boolean('attendance_access')
                ->default(true)
                ->after('seat_management_access');

            $table->boolean('payment_access')
                ->default(true)
                ->after('attendance_access');

            $table->boolean('expense_access')
                ->default(true)
                ->after('payment_access');

            $table->boolean('id_card_access')
                ->default(true)
                ->after('expense_access');

            $table->boolean('reports_access')
                ->default(true)
                ->after('id_card_access');
        });
    }

    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn([
                'student_management_access',
                'membership_access',
                'seat_management_access',
                'attendance_access',
                'payment_access',
                'expense_access',
                'id_card_access',
                'reports_access',
            ]);
        });
    }
};