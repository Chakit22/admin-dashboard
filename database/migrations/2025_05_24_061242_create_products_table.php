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
            $table->string('name');          // e.g., "Nike Dunk Low Panda"
            $table->string('brand');         // e.g., "Nike"
            $table->string('size');          // e.g., "US 10"
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();  // Store the image path
            $table->boolean('is_approved')->default(false);
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
