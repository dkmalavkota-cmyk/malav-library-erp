<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_subjects', function (Blueprint $table) {

            $table->id();

            // Library / Tenant
            $table->unsignedInteger('library_id');

            $table->foreign('library_id')
                ->references('id')
                ->on('libraries')
                ->cascadeOnDelete();

            // Subject details
            $table->string('name');
            $table->string('slug');

            $table->text('description')->nullable();

            // Status
            $table->boolean('is_active')
                ->default(true);

            // Display order
            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();

            // Unique subject slug inside a library
            $table->unique([
                'library_id',
                'slug',
            ]);

            // Useful index
            $table->index([
                'library_id',
                'is_active',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_subjects');
    }
};