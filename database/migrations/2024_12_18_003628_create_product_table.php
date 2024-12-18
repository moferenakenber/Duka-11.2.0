<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class create_product_table extends Migration
{
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigint('id');
            $table->bigint('userId');
            $table->varchar(75)('title');
            $table->varchar(100)('metaTitle');
            $table->varchar(100)('slug');
            $table->tinytext('summary');
            $table->smallint('type');
            $table->varchar(100)('sku');
            $table->float('price');
            $table->float('discount');
            $table->smallint('quantity');
            $table->tinyint(1)('shop');
            $table->datetime('createdAt');
            $table->datetime('updatedAt');
            $table->datetime('publishedAt');
            $table->datetime('startsAt');
            $table->datetime('endsAt');
            $table->text('content');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product');
    }
}