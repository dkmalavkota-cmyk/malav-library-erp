<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('membership_plans', function (Blueprint $table) {
            $table->dropUnique('membership_plans_code_unique');

            $table->unique(
                ['library_id', 'code'],
                'membership_plans_library_code_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('membership_plans', function (Blueprint $table) {
            $table->dropUnique('membership_plans_library_code_unique');

            $table->unique('code');
        });
    }
};