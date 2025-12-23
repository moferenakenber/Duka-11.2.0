<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('store_variant', function (Blueprint $table) {
            $table->id();

            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->foreignId('item_variant_id')->constrained('item_variants')->cascadeOnDelete();

            $table->boolean('active')->default(true);

            $table->string('manual_status', 20)->default('auto'); // auto | forced
            $table->string('forced_status', 20)->nullable();      // active | inactive | out_of_stock | unavailable

            $table->integer('stock')->default(0);

            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->timestamp('discount_ends_at')->nullable();

            $table->timestamps();
            $table->unique(['store_id', 'item_variant_id']);
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('store_variant');
    }
};
