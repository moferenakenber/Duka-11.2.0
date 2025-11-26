<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {


            // All properties should have images, price, stock

            $table->id();
            $table->string('sku')->unique(); // no "after" needed

            $table->string('product_name')->nullable();
            $table->text('product_description')->nullable();
            $table->text('packaging_details')->nullable();
            $table->json('selectedCategories')->nullable();
            $table->json('newCategoryNames')->nullable();
            $table->json('product_images')->nullable();


            $table->enum('status', ['draft', 'active', 'inactive', 'unavailable'])->default('draft');
            $table->boolean('incomplete')->default(true);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('item_category_id')->nullable();

            $table->string('barcode')->nullable()->unique();
            $table->bigInteger('sold_count')->default(0)->nullable(false); // Assuming this is the sold count
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->decimal('discount_percentage', 5, 2)->nullable();


            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('item_variants', function (Blueprint $table) {
        //     $table->dropForeign(['item_id']); // Drop foreign key constraint on item_id
        // });


        Schema::dropIfExists('items');
        Schema::dropIfExists('item_colors');

    }
};
