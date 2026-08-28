<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('library_id')
                ->nullable()
                ->after('id');

            $table->foreign('library_id')
                ->references('id')
                ->on('libraries')
                ->nullOnDelete();

            $table->index('library_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['library_id']);
            $table->dropIndex(['library_id']);
            $table->dropColumn('library_id');
        });
    }
};