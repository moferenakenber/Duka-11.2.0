<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['id','userId','customerId','sessionId','token','status','subTotal','itemDiscount','tax','shipping','total','promo','discount','grandTotal','createdAt','updatedAt','content'];

    public function customerId()
    {
        return $this->belongsTo(App\Models\Customers::class);
    }
    public function userId()
    {
        return $this->belongsTo(App\Models\User::class);
    }}
