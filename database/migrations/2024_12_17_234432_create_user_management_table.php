<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class create_user_management_table extends Migration
{
    public function up()
    {
        Schema::create('user_management', function (Blueprint $table) {
            $table->bigint unsigned('id');
            $table->bigint unsigned('user_id');
            $table->json('permissions');
            $table->json('login_history');
            $table->enum('active','inactive','suspended')('status');
            $table->int unsigned('payroll_id');
            $table->int unsigned('payment_history_id');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_management');
    }
}