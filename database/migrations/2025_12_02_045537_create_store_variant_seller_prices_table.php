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
        Schema::create('store_variant_seller_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_variant_id')->constrained('store_variant')->cascadeOnDelete(); // store-specific
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete(); // assuming sellers are users
            $table->decimal('price', 12, 2); // custom price for this seller and store variant
            $table->decimal('discount_price', 12, 2)->nullable();
            $table->timestamp('discount_ends_at')->nullable(); // optional countdown for discount

            $table->timestamps();

            $table->unique(['store_variant_id', 'seller_id']); // one price per seller per store variant
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_variant_seller_prices');
    }
};
