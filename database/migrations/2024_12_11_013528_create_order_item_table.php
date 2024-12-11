<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class create_order_item_table extends Migration
{
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->bigint('id');
            $table->bigint('productId');
            $table->bigint('orderId');
            $table->varchar(100)('sku');
            $table->float('price');
            $table->float('discount');
            $table->smallint('quantity');
            $table->datetime('createdAt');
            $table->datetime('updatedAt');
            $table->text('content');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_item');
    }
}