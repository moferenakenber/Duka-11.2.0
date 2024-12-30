<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class VisitorController extends Controller
{
    // Show the homepage for visitors
    public function index()
    {
        // Optionally, fetch some items to show on the homepage
        //Z$items = Item::all(); // Example to display all items
        //return view('visitor.home', compact('items'));
        return view('visitor.home');
    }

    // Show a specific item for the visitor
    public function show($id)
    {
        //$item = Item::findOrFail($id);  // Fetch the item by ID
       //return view('visitor.show', compact('item'));
       //return view('visitor.show');
    }

    // Create new item page (if applicable)
    public function create()
    {
        //return view('visitor.create');
    }

    // Store new item (if applicable)
    public function store(Request $request)
    {
        // Validate and store the item
        // Item::create($request->all());
        //return redirect()->route('visitor.home');
    }

    // Edit item page (if applicable)
    public function edit($id)
    {
        // $item = Item::findOrFail($id);
        // return view('visitor.edit', compact('item'));
    }

    // Update item (if applicable)
    public function update(Request $request, $id)
    {
        // $item = Item::findOrFail($id);
        // $item->update($request->all());
        // return redirect()->route('visitor.show', $item->id);
    }

    // Destroy item (if applicable)
    public function destroy($id)
    {
        // $item = Item::findOrFail($id);
        // $item->delete();
        // return redirect()->route('visitor.home');
    }

    // Show the cart for visitors
    public function showCart()
    {
        // $cart = session()->get('cart', []);  // Get cart from session
        // return view('visitor.cart', compact('cart'));
    }

    // Add item to the cart for visitors
    public function addToCart($itemId)
    {
        // $cart = session()->get('cart', []);  // Get the current cart

        // // Find the item in the database
        // $item = Item::find($itemId);

        // if ($item) {
        //     // Check if the item is already in the cart
        //     if (isset($cart[$itemId])) {
        //         $cart[$itemId]['quantity']++;  // Increment the quantity if it exists
        //     } else {
        //         // Add the item to the cart
        //         $cart[$itemId] = [
        //             'name' => $item->name,
        //             'price' => $item->price,
        //             'quantity' => 1,
        //         ];
        //     }

        //     // Save the cart back to the session
        //     session(['cart' => $cart]);
        // }

        // return redirect()->route('visitor.cart');
    }

    // Remove item from the cart for visitors
    public function removeFromCart($itemId)
    {
        // $cart = session()->get('cart', []);  // Get the current cart

        // if (isset($cart[$itemId])) {
        //     unset($cart[$itemId]);  // Remove the item
        //     session(['cart' => $cart]);  // Save the updated cart back to session
        // }

        // return redirect()->route('visitor.cart');
    }
}
