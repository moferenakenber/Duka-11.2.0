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




            $table->id();
            $table->string('product_name')->nullable();
            $table->text('product_description')->nullable();
            $table->text('packaging_details')->nullable();
            $table->string('variation')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('status', ['draft', 'active', 'inactive', 'unavailable'])->default('draft');
            $table->boolean('incomplete')->default(true);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('item_category_id')->nullable();
            $table->json('product_images')->nullable();
            $table->json('selectedCategories')->nullable();
            $table->json('newCategoryNames')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('category_id')->references('id')->on('item_categories')->onDelete('cascade');
            $table->foreign('item_category_id')->references('id')->on('item_categories')->onDelete('cascade');




            // $table->id();
            // $table->string('product_name')->nullable();
            // $table->text('product_description')->nullable();
            // $table->foreignId('item_category_id')->nullable()->constrained()->onDelete('cascade');
            // $table->enum('status', ['draft', 'active', 'inactive', 'unavailable'])->default('draft'); // Set by the user when the item is ready
            // $table->boolean('incomplete')->default(true);
            // $table->timestamps();

            // $table->unsignedBigInteger('category_id')->nullable();  // Add the foreign key column
            // // Foreign key constraint
            // $table->foreign('category_id')->references('id')->on('item_categories')->onDelete('cascade')->nullable();
            // //$table->json('images')->nullable();






            // $table->decimal('price', 8, 2);
            // $table->string('status')->default('available');
            // $table->integer('stock')->default(0); // Changed to integer
            // $table->json('images')->nullable();
            // $table->integer('piecesinapacket')->default(0);
            // $table->integer('packetsinacartoon')->default(0);
            // $table->timestamps();


            // _token: 78dsKLbM6Hx1bAz67kJUdjWIdYX1pirhZbI3bxKy
            // product_name: dfgdfgdsdf
            // product_description: fgdfgsdfsdf
            // item_category_id: 1
            // new_category_name:
            // status: draft
            // incomplete: 1
            // packaging[]: piece
            // colors[]: green
            // colors[]: purple
            // sizes[]: large
            // image_a: (binary)
            // image_b: (binary)
            // image_c: (binary)


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

    }
};
