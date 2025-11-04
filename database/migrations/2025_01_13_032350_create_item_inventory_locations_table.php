<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('item_inventory_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Main Warehouse", "Store 1"
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_inventory_locations');
    }
};
