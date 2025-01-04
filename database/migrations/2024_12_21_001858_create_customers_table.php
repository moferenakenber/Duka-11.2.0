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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('phone_number', 15)->unique()->nullable();
            $table->string('email')->unique();
            $table->text('city')->nullable();
            $table->unsignedBigInteger('created_by')->nullable(); // ID of the user who created the customer
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade'); // Foreign key
            $table->timestamps();
            //$table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // Add foreign key reference to 'users' table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
