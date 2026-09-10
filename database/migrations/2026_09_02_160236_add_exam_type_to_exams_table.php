<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->string('exam_type', 50)
                ->default('regular')
                ->after('slug')
                ->index();
        });
    }

    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropIndex(['exam_type']);
            $table->dropColumn('exam_type');
        });
    }
};