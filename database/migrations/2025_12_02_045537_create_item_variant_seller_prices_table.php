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
        Schema::create('item_variant_seller_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_variant_id')->constrained('item_variants')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade'); // assuming sellers are in users table
            $table->decimal('price', 10, 2); // custom price for this seller and variant
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->timestamp('discount_ends_at')->nullable(); // optional countdown for discounts

            $table->timestamps();

            $table->unique(['item_variant_id', 'seller_id']); // ensure one price per variant per seller
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_variant_seller_prices');
    }
};
