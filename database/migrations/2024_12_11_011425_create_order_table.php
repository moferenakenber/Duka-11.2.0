<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class create_order_table extends Migration
{
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigint('id');
            $table->bigint('userId');
            $table->bigint('customerId');
            $table->varchar(100)('sessionId');
            $table->varchar(100)('token');
            $table->smallint('status');
            $table->float('subTotal');
            $table->float('itemDiscount');
            $table->float('tax');
            $table->float('shipping');
            $table->float('total');
            $table->varchar(50)('promo');
            $table->float('discount');
            $table->float('grandTotal');
            $table->datetime('createdAt');
            $table->datetime('updatedAt');
            $table->text('content');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order');
    }
}