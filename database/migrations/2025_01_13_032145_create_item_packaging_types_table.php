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

        Schema::create('item_packaging_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "pieces", "packet", "cartoon"
            $table->string('image')->nullable(); // Path to the image for the size
            $table->boolean('disabled')->default(false);
            // $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 10, 2)->default(0.00); // Price for the size
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_packaging_types');
    }
};
