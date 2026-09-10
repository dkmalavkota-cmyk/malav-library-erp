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
        Schema::create('exam_categories', function (Blueprint $table) {

            $table->id();

            // Library / Tenant
            $table->unsignedInteger('library_id');

$table->foreign('library_id')
    ->references('id')
    ->on('libraries')
    ->cascadeOnDelete();

            // Category details
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();

            // Display / management
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            // Same category name can exist in different libraries,
            // but cannot be duplicated inside the same library.
            $table->unique(['library_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_categories');
    }
};