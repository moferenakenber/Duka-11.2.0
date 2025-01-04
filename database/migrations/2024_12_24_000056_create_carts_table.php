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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key

            // Add user_id column to associate the cart with a user (seller)
            $table->foreignId('user_id')
                ->constrained()  // Automatically references the 'users' table
                ->onDelete('cascade');  // Delete cart if user is deleted

            // Add customer_id column to associate the cart with a customer (nullable)
            $table->foreignId('customer_id')
                ->nullable()  // Customer can be null
                ->constrained()  // Automatically references the 'customers' table
                ->onDelete('set null');  // Set customer_id to null if customer is deleted

            // Add seller_id column to explicitly associate the cart with a seller (nullable)
            $table->foreignId('seller_id')
                ->nullable()  // Seller can be null, only if needed
                ->constrained('users')  // Reference users table for sellers
                ->onDelete('set null');  // Set seller_id to null if seller is deleted

            $table->timestamps();  // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
