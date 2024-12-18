<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class create_user_managements_table_v2 extends Migration
{
    // public function up()
    // {
    //     Schema::create('user_management', function (Blueprint $table) {
    //         $table->bigint unsigned('id');
    //         $table->bigint unsigned('user_id');
    //         $table->json('permissions');
    //         $table->json('login_history');
    //         $table->enum('active','inactive','suspended')('status');
    //         $table->int unsigned('payroll_id');
    //         $table->int unsigned('payment_history_id');
    //         $table->timestamp('created_at');
    //         $table->timestamp('updated_at');
    //     });
    // }

    public function up()
    {
        Schema::create('user_managements_v2', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->json('permissions')->nullable();
            $table->json('login_history')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->unsignedInteger('payroll_id')->nullable();
            $table->unsignedInteger('payment_history_id')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->primary('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('payroll_id')->references('id')->on('payroll')->onDelete('SET NULL');
            $table->foreign('payment_history_id')->references('id')->on('payment_history')->onDelete('SET NULL');
        });
    }



    public function down()
    {
        Schema::dropIfExists('user_management');
    }
}
