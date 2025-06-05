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
        Schema::create('item_variant_prices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('item_variant_id')->constrained()->onDelete('cascade');

            // For customer-specific prices (links to your users table)
            // Nullable because a price might be a base price or role price.
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            // If you have a separate 'customers' table, use:
            // $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('cascade');

            // For role-specific prices: stores the role name/identifier from the users table.
            // Nullable because a price might be a base price or customer-specific.
            $table->string('applies_to_role')->nullable();

            $table->decimal('price', 10, 2);
            $table->timestamps();


            // A price is for:
            // 1. Base: item_variant_id, currency (user_id IS NULL, applies_to_role IS NULL)
            // 2. User-specific: item_variant_id, user_id, currency (applies_to_role IS NULL)
            // 3. Role-specific: item_variant_id, applies_to_role, currency (user_id IS NULL)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_variant_prices');
    }
};
