<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedInteger('library_id')
                ->nullable()
                ->after('id');

            $table->index('library_id');

            $table->foreign('library_id')
                ->references('id')
                ->on('libraries')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['library_id']);
            $table->dropIndex(['payments_library_id_index']);
            $table->dropColumn('library_id');
        });
    }
};