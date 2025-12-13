<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Size name only
            $table->foreignId('itemid')->nullable()->constrained('items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_sizes');
    }
};
