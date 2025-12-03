<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seller_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_variant_id')->constrained('item_variants')->cascadeOnDelete();
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete(); // make sure sellers are users
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('discount_price', 12, 2)->nullable();
            $table->timestamp('discount_ends_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_prices');
    }
};
