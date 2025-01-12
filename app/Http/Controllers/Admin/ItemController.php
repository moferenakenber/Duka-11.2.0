<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;


//This single line generates the following routes:
//
//GET /item                → index method
//GET /item/create         → create method
//POST /item               → store method
//GET /item/{item}         → show method
//GET /item/{item}/edit    → edit method
//PUT/PATCH /item/{item}   → update method
//DELETE /item/{item}      → destroy method

class ItemController extends Controller
{
    // Display a listing of the items
    public function index()
    {
        $items = Item::all();
        return view('admin.items.index', compact('items'));
    }

    // Show the form for creating a new item
    public function create()
    {
        return view('admin.items.create');
    }

    // Store a newly created item
    public function store(Request $request)
    {
        $item = new Item();

        $validatedItem = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'catoption' => 'required|array|min:1',
            'pacoption' => 'required|array|min:1',
            'price' => 'required|min:1',
            'status' => 'required',
            'stock' => 'required|min:1',
            'piecesinapacket' => 'required|min:1',
            'packetsinacartoon' => 'required|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validation for images

            // 'product_name' => 'required|string',
            // 'product_description' => 'required|string',
            // 'status' => 'required|string',
            // 'packaging' => 'required|array',
            // 'colors' => 'required|array',
            // 'sizes' => 'required|array',
            // 'image_a' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            // 'image_b' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            // 'image_c' => 'nullable|image|mimes:jpg,jpeg,png,gif',

            // owner
            // properties
            // price
            // stock
            // catagory

        ]);

        // product_name: hfd
        // product_description: fgh
        // status: in_stock

        // catagory

        // owner

        // stock - warehouse a, warehouse b, warehouse c, store

        // colors[]: Black
        // sizes[]: Small

        // price for colores
        // price for sizes
        // price for per piece
        // price for packets
        // price for cartons
        // price for more than 20 cartons
        // price for customers
        // price for sellers
        // price for user

        // customer_price: 45
        // seller_price: 454
        // user_price: 54545
        // image_a: (binary)
        // image_b: (binary)
        // image_c: (binary)
        /*
                $item->name = $request->name;
                $item->save();
        */

        $item = Item::create([
            'name' => $validatedItem['name'],
            'description' => $validatedItem['description'],
            'catoption' => json_encode($validatedItem['catoption']),
            'pacoption' => json_encode($validatedItem['pacoption']),
            'price' => $validatedItem['price'],
            'status' => $validatedItem['status'],
            'stock' => $validatedItem['stock'],
            'piecesinapacket' => $validatedItem['piecesinapacket'],
            'packetsinacartoon' => $validatedItem['packetsinacartoon'],
        ]);

        // Handle image uploads
        // if ($request->hasFile('images')) {
        //     foreach ($request->file('images') as $image) {
        //         $filename = time() . '_' . $image->getClientOriginalName(); // Create a unique filename
        //         $image->storeAs('uploads', $filename, 'public'); // Store in storage/app/public/uploads
        //         // Optionally, you might want to save the image paths to the database associated with the item
        //         // For example, you can push to an array, or save paths in a separate column if necessary
        //         $item->images()->create(['path' => 'uploads/' . $filename]); // Assuming you have a relation set up for images
        //     }
        // }


        // Handle image uploads
        $imagePaths = []; // Create an array to store image paths
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName(); // Create a unique filename
                // Store image in public disk (storage/app/public)
                $image->storeAs('uploads', $filename, 'public');

                // Add the image path to the array
                $imagePaths[] = 'uploads/' . $filename;
            }

            // Store the image paths as a JSON array in the images column
            $item->update(['images' => json_encode($imagePaths)]);
        }

        return redirect()->route('admin.items.index')->with('success', 'item registered successfully!');
    }

    // Show the details of a specific item
    public function show(Item $item)
    {
        $sellers = User::where('role', 'seller')->get(); // assuming sellers have 'seller' role
        return view('admin.items.show', compact('item', 'sellers'));
    }

    // Show the form for editing the specified item
    public function edit(Item $item)
    {
        return view('admin.items.edit', compact('item'));
    }

    // Update the specified item
    public function update(Request $request, Item $item)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'piecesinapacket' => 'required|numeric',
            'packetsinacartoon' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif', // Only validate if image is uploaded
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Store the uploaded image and get its path
            $imagePath = $request->file('image')->store('public/images');
        } else {
            // If no image is uploaded, keep the existing image or leave as null
            $imagePath = $item->image; // Retain the existing image path if no new image is uploaded
        }

        // Update the item
        $item->update([
            'name' => $request->name,
            'description' => $request->description,
            'catoption' => $request->catoption ? json_encode($request->catoption) : null, // Ensure it's an array or null
            'pacoption' => $request->pacoption ? json_encode($request->pacoption) : null, // Ensure it's an array or null
            'price' => $request->price,
            'status' => $request->status,
            'stock' => $request->stock,
            'image' => $imagePath, // Store the image path
            'piecesinapacket' => $request->piecesinapacket,
            'packetsinacartoon' => $request->packetsinacartoon,
        ]);

        return redirect()->route('admin.items.index')->with('success', 'Item updated successfully.');
    }


    // Remove the specified item
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('admin.items.index')->with('success', 'Item deleted successfully.');
    }
}
