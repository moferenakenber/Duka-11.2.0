<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('item_variants', function (Blueprint $table) {
            $table->id();

            $table->string('sku')->unique()->nullable(); // no "after" needed


            // Relationships
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('item_color_id')->nullable()->constrained('item_colors')->onDelete('set null');
            $table->foreignId('item_size_id')->nullable()->constrained('item_sizes')->onDelete('set null');
            $table->foreignId('item_packaging_type_id')->nullable()->constrained('item_packaging_types')->onDelete('set null');
            $table->foreignId('owner_id')->nullable()->constrained('users'); // who added the variant

            $table->string('barcode')->nullable()->unique();
            // Variant-specific fields
            // the following three have depriciated as price is now in store_variation talble sorry
            // which means store, seller, customer sould use these from there prespective places
            $table->decimal('price', 10, 2); // base price
            $table->decimal('discount_price', 10, 2)->nullable(); // optional discounted price
            $table->decimal('discount_percentage', 5, 2)->nullable()->default(0); // added this column
            $table->json('images')->nullable();

            // Status enum
            $table->enum('status', ['active', 'inactive', 'unavailable', 'out_of_stock'])->default('inactive');
            $table->boolean('is_active')->default(0);
            $table->integer('packaging_total_pieces')->default(1);



            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_variants');
    }
};
