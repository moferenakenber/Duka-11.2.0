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
    // {
    //     Schema::create('user_management', function (Blueprint $table) {
    //         $table->id();
    //         $table->unsignedBigInteger('user_id');
    //         $table->json('permissions')->nullable();
    //         $table->json('login_history')->nullable();
    //         $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
    //         $table->unsignedBigInteger('payroll_id')->nullable();
    //         $table->unsignedBigInteger('payment_history_id')->nullable();
    //         $table->timestamps();

    //         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    //         $table->foreign('payroll_id')->references('id')->on('payroll')->onDelete('set null');
    //         $table->foreign('payment_history_id')->references('id')->on('payment_history')->onDelete('set null');
    //     });
    // }

    {
        Schema::create('user_management', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->json('permissions')->nullable();
            $table->json('login_history')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_management');
    }
};
