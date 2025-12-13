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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('phone_number', 15)->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role', ['admin', 'seller', 'stock_keeper', 'user'])->nullable(); // Added the role column
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('store_id')->nullable()->constrained()->cascadeOnDelete(); // for seller
            $table->foreignId('inventory_location_id')->nullable()->constrained('item_inventory_locations')->cascadeOnDelete();// for stock_keeper

            // Add the 'created_by' field as a foreign key
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // Add foreign key reference to 'users' table
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
