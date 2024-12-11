<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate(['id' => 'required','userId' => 'required','title' => 'required','metaTitle' => 'required','slug' => 'required','summary' => 'required','type' => 'required','sku' => 'required','price' => 'required','discount' => 'required','quantity' => 'required','shop' => 'required','createdAt' => 'required','updatedAt' => 'required','publishedAt' => 'required','startsAt' => 'required','endsAt' => 'required','content' => 'required',]);
        return Product::create($data);
    }
}
