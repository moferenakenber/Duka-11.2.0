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
        Schema::create('item_variant_packaging_quantity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_variant_id')->constrained('item_variants')->onDelete('cascade');
            $table->foreignId('item_packaging_type_id')->constrained('item_packaging_types')->onDelete('cascade');
            $table->foreignId('item_color_id')->constrained('item_colors')->onDelete('cascade'); // Added color_id
            $table->foreignId('item_size_id')->constrained('item_sizes')->onDelete('cascade'); // Added size_id
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_variant_packaging_quantity');
    }
};
