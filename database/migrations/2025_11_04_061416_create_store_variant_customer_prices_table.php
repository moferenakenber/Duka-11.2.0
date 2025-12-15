<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('store_variant_customer_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_variant_id')->constrained('store_variant')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->decimal('price', 12, 2);
            $table->decimal('discount_price', 12, 2)->nullable();
            $table->timestamp('discount_ends_at')->nullable();
            $table->timestamps();

            // Shorter index name to avoid MySQL limit
            $table->unique(['store_variant_id', 'customer_id'], 'store_var_cust_unique'); // one price per customer per store variant
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_variant_customer_prices');
    }
};
