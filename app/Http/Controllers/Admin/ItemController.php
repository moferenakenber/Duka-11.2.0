<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\ItemCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;






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
        // Fetch categories to display in the form
        $categories = ItemCategory::all();

        // Pass the categories to the view
        return view('admin.items.create', compact('categories'));
    }

    // Save Draft method
    public function saveDraft(Request $request)
    {
        Log::info('Draft save request received.');
        Log::info('Request Data:', $request->all());

        // Start a database transaction
        DB::beginTransaction();
        try {
            // Validate form data
            $validatedData = $request->validate([
                'product_name' => 'required|string|max:255',
                'product_description' => 'nullable|string',
                'packaging_details' => 'nullable|string',
                'variation' => 'nullable|string',
                'price' => 'nullable|numeric',
                'product_images' => 'nullable|image|max:2048',
                //'item_category_id' => 'nullable|exists:categories,id', // Ensure category exists or create a new one
                'item_category_id' => 'nullable|in:new,' . implode(',', ItemCategory::pluck('id')->toArray()),

                'new_category_name' => 'required_if:item_category_id,new|string', // Handle new category name

            ]);

            Log::info('Validation passed for save draft.', $validatedData);

            // Check if a new category is provided and handle accordingly
            // $categoryId = $request->item_category_id;
            // if ($request->filled('new_category_name')) {
            //     // Create a new category if the new_category_name is provided
            //     $newCategory = ItemCategory::create([
            //         'category_name' => $request->new_category_name,
            //     ]);

            //     $categoryId = $newCategory->id;  // Update categoryId to the newly created category
            //     Log::info('New category created with ID: ' . $categoryId);
            // }

            // If 'item_category_id' is 'new', create a new category
            // If the category is new, create it and get the ID
            $categoryId = $request->item_category_id;
            if ($categoryId === 'new') {
                $category = ItemCategory::create([
                    'category_name' => $request->new_category_name
                ]);
                $categoryId = $category->id;
            } else {
                $categoryId = (int) $categoryId;
            }

            // Create a new item and set additional fields
            $draft = new Item($validatedData);
            $draft->category_id = $categoryId; // Associate the category with the item
            $draft->incomplete = true; // Ensure drafts are always incomplete
            $draft->status = 'draft';  // Set the status to 'draft'

            // Handle image upload if exists
            if ($request->hasFile('product_images')) {
                $path = $request->file('product_images')->store('images', 'public');
                $draft->product_images = $path;
            }

            $draft->save();

            // Commit the transaction
            DB::commit();

            Log::info('Draft saved successfully.');



            // Return a success response
            return response()->json(['success' => true, 'message' => 'Draft saved successfully'], 200);
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            Log::error('Error saving draft:', ['exception' => $e]);

            // Return an error response
            return response()->json(['success' => false, 'message' => 'Error saving draft. Please try again.'], 500);
        }
    }


    // Store a newly created item
    public function store(Request $request)
    {
        $item = new Item();

        $validatedItem = $request->validate([
            // 'name' => 'required|string|max:255',
            // 'description' => 'required|string|max:255',
            // 'catoption' => 'required|array|min:1',
            // 'pacoption' => 'required|array|min:1',
            // 'price' => 'required|min:1',
            // 'status' => 'required',
            // 'stock' => 'required|min:1',
            // 'piecesinapacket' => 'required|min:1',
            // 'packetsinacartoon' => 'required|min:1',
            // 'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validation for images

            'item_category_id' => 'required|exists:item_categories,id',



            // 'product_name' => 'required|string',
            // 'product_description' => 'required|string',
            // 'category' => 'required|integer',
            // 'status' => 'required|in:draft,active,inactive',
            // 'variants' => 'required|array',
            // 'images' => 'required|array',


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
            // 'name' => $validatedItem['name'],
            // 'description' => $validatedItem['description'],
            // 'catoption' => json_encode($validatedItem['catoption']),
            // 'pacoption' => json_encode($validatedItem['pacoption']),
            // 'price' => $validatedItem['price'],
            // 'status' => $validatedItem['status'],
            // 'stock' => $validatedItem['stock'],
            // 'piecesinapacket' => $validatedItem['piecesinapacket'],
            // 'packetsinacartoon' => $validatedItem['packetsinacartoon'],
            'category_id' => $validatedItem['item_category_id'], // Assuming you're passing the category ID
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

        // Create a new Item and assign validated data
        $item = new Item();
        $item->category_id = $validatedItem['item_category_id']; // Assuming you're passing the category ID
        // Assign other fields (if any)
        $item->save(); // Save the item

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
