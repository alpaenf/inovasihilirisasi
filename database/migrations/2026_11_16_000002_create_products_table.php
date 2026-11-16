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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs')->onDelete('restrict');
            $table->string('name')->index();
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->longText('description');
            $table->string('main_image');
            $table->longText('benefits')->nullable();
            $table->string('external_url', 500)->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->enum('status', ['draft', 'published'])->default('published')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

