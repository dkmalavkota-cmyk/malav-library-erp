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
        Schema::table('exam_attempts', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Library Student / External Exam User
            |--------------------------------------------------------------------------
            |
            | Library students use student_id.
            | External/public students use exam_user_id.
            |
            | Therefore student_id must allow NULL.
            |
            */

            $table->foreignId('student_id')
                ->nullable()
                ->change();

            /*
            |--------------------------------------------------------------------------
            | External / Public Exam User
            |--------------------------------------------------------------------------
            */

            $table->foreignId('exam_user_id')
                ->nullable()
                ->after('student_id')
                ->constrained('exam_users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index([
                'exam_user_id',
                'exam_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_attempts', function (Blueprint $table) {

            $table->dropForeign([
                'exam_user_id',
            ]);

            $table->dropIndex([
                'exam_user_id',
                'exam_id',
            ]);

            $table->dropColumn('exam_user_id');

            /*
            |--------------------------------------------------------------------------
            | Restore student_id as NOT NULL
            |--------------------------------------------------------------------------
            */

            $table->foreignId('student_id')
                ->nullable(false)
                ->change();
        });
    }
};