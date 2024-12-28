<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate(['id' => 'required','userId' => 'required','customerId' => 'required','sessionId' => 'required','token' => 'required','status' => 'required','subTotal' => 'required','itemDiscount' => 'required','tax' => 'required','shipping' => 'required','total' => 'required','promo' => 'required','discount' => 'required','grandTotal' => 'required','createdAt' => 'required','updatedAt' => 'required','content' => 'required',]);
        return Order::create($data);
    }
}
