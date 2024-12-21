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
            $table->decimal('stock')->default('0');
            $table->string('image')->default('not available');
            $table->decimal('piecesinapacket', 8,2 );
            $table->decimal('packetsinacartoon', 8, 2);
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
