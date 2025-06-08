<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    // {
    //     Schema::create('item_variants', function (Blueprint $table) {
    //         $table->id();
    //         $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
    //         $table->foreignId('item_color_id')->nullable()->constrained('item_colors')->onDelete('set null');
    //         $table->foreignId('item_size_id')->nullable()->constrained('item_sizes')->onDelete('set null');
    //         $table->foreignId('item_packaging_type_id')->nullable()->constrained('item_packaging_types')->onDelete('set null');
    //         $table->boolean('is_active')->default(true);
    //         $table->integer('price');
    //         $table->integer('stock');
    //         $table->foreignId('owner_id')->constrained('users');
    //         $table->timestamps();
    //     });
    // }
    {
        Schema::create('item_variants', function (Blueprint $table) {
            $table->id();

            // Relationships
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('item_color_id')->nullable()->constrained('item_colors')->onDelete('set null');
            $table->foreignId('item_size_id')->nullable()->constrained('item_sizes')->onDelete('set null');
            $table->foreignId('item_packaging_type_id')->nullable()->constrained('item_packaging_types')->onDelete('set null');
            $table->foreignId('owner_id')->constrained('users'); // who added the variant

            // Variant-specific fields
            // $table->decimal('default_price', 10, 2)->default(0);

            // $table->foreignId('variant_price_id')->nullable()->constrained('item_variant_price')->onDelete('set null'); // Link to default price if exists

            // Just use unsignedBigInteger without foreign key
            $table->unsignedBigInteger('variant_price_id')->nullable();

            $table->integer('stock')->default(0); // Stock for this combination
            $table->string('image')->nullable(); // Optional image representing this variant
            $table->boolean('is_active')->default(true); // Enabled or not

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_variants'); // Drop referencing table first
        Schema::dropIfExists('item_sizes');    // Then drop referenced table
        Schema::dropIfExists('item_colors');
        Schema::dropIfExists('item_packaging_types');
        Schema::dropIfExists('item_variant_prices');
    }
};
