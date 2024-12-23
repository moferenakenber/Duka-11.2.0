<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('catoption');
            $table->json('pacoption');
            $table->decimal('price', 8, 2);
            $table->string('status')->default('available');
            $table->integer('stock')->default(0); // Changed to integer
            $table->json('images')->nullable();
            $table->integer('piecesinapacket')->default(0);
            $table->integer('packetsinacartoon')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
