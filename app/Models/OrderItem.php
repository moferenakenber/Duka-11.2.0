<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_item';
    protected $fillable = ['id','productId','orderId','sku','price','discount','quantity','createdAt','updatedAt','content'];

    public function orderId()
    {
        return $this->belongsTo(App\Models\Order::class);
    }
    public function productId()
    {
        return $this->belongsTo(App\Models\Product::class);
    }}
