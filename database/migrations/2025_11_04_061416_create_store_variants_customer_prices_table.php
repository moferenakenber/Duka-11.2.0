<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('store_variants_customer_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_variant_id')->constrained('store_variants')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->decimal('price', 12, 2);
            $table->decimal('discount_price', 12, 2)->nullable();
            $table->timestamp('discount_ends_at')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            // One price per customer per store variant
            $table->unique(['store_variant_id', 'customer_id'], 'store_variant_customer_unique');

            // Performance
            $table->index(['customer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_variant_customer_prices');
    }
};
