<?php

// namespace App\Http\Controllers\Admin;

// use App\Models\Product;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Schema;

// class ProductController extends Controller
// {
//     public function index()
//     {
//         $product = Product::all();
//         return view('admin.products.index', compact('product'));
//     }

//     public function create()
//     {
//         return view('admin.products.create');
//     }

//     public function store(Request $request)
//     {
//         $columns = Schema::getColumnListing('product');
//         $rules = [];
//         foreach ($columns as $column) {
//             if (!in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
//                 $rules[$column] = 'required';
//             }
//         }
//         $data = $request->validate($rules);
//         return Product::create($data);
//     }

//     public function show(Product $product)
//     {
//         return view('admin.products.show', ['product' => $product]);
//     }

//     public function edit(Product $product)
//     {
//         return view('admin.products.edit', ['product' => $product]);
//     }

//     public function update(Request $request, Product $product)
//     {
//         $columns = Schema::getColumnListing('product');
//         $rules = [];
//         foreach ($columns as $column) {
//             if (!in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
//                 $rules[$column] = 'sometimes|required';
//             }
//         }
//         $data = $request->validate($rules);
//         $product->update($data);
//         return $product;
//     }

//     public function destroy(Product $product)
//     {
//         $product->delete();
//         return response()->json(['message' => 'Deleted successfully']);
//     }
// }
