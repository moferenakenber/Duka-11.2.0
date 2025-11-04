<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('item_variant_customer_prices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('item_variant_id')->constrained('item_variants')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade'); // assuming customers are in users table
            $table->decimal('price', 10, 2); // custom price for this customer and variant

            $table->timestamps();

            $table->unique(['item_variant_id', 'customer_id']); // ensure one price per variant per customer
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_variant_customer_prices');
    }
};
