<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\ItemCategory;
use App\Models\ItemSize;
use App\Models\ItemColor;
use App\Models\ItemPackagingType;
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
    // public function create()
    // {
    //     // Fetch categories to display in the form
    //     $categories = ItemCategory::all();
    //     $categories = $categories->toArray();



    //     // Log the categories being passed to the view
    //     Log::info('Categories sent to admin.items.create:', $categories);
    //     $colors = []; // Initialize colors array if needed
    //     $sizes = []; // Initialize sizes array if needed
    //     $packagings = []; // Initialize packaging array if needed

    //     // Pass the categories to the view
    //     return view('admin.items.create', compact('categories', 'colors', 'sizes', 'packagings'));
    // }

    public function create()
{
    return view('admin.items.create', [
        'categories' => ItemCategory::all(),
        'colors' => ItemColor::all(),
        'sizes' => ItemSize::all(),
        'packagingTypes' => ItemPackagingType::all(),
        'sellers' => User::where('role', 'seller')->get(),
    ]);
}


    // Save Draft method
    public function saveDraft(Request $request)
    {
        Log::info('First Log -> Draft save request received. ItemController -> saveDraft');
        Log::info('Second Log -> Request Data:', $request->all());




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

                'selectedCategories' => 'nullable|string', // Will be JSON encoded array of category IDs
                'newCategoryNames' => 'nullable|string', // Will be JSON encoded array of new category names

                'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                //'variants' => 'required|array',
                //'barcode' => 'required|string',
                //'images' => 'required|array',

            ]);

            Log::info('Validation passed for save draft.', $validatedData);

            Log::info('Request Data:', $request->all());


            // Decode JSON inputs
            $selectedCategories = json_decode($request->input('selectedCategories', '[]'), true);
            $newCategoryNames = json_decode($request->input('newCategoryNames', '[]'), true);


            // Create a new draft item
            $draft = new Item();
            $draft->product_name = $validatedData['product_name'];
            $draft->product_description = $validatedData['product_description'] ?? null;
            $draft->incomplete = true; // Drafts are always incomplete
            $draft->status = 'draft';

            // Handle image upload if exists
            if ($request->hasFile('product_images')) {
                $images = [];
                foreach ($request->file('product_images') as $image) {
                    $path = $image->store('images', 'public');
                    $images[] = $path;
                }
                $path = $request->file('product_images')->store('images', 'public');
                $draft->images = json_encode($images); // Store as JSON
            }

            $draft->save();

            // Handle existing and new categories
            $categoryIds = [];

            // Process existing categories
            if (!empty($selectedCategories)) {
                $categoryIds = array_merge($categoryIds, array_filter($selectedCategories, 'is_numeric'));
            }

            // Process new categories
            if (!empty($newCategoryNames)) {
                foreach ($newCategoryNames as $categoryName) {
                    $category = ItemCategory::firstOrCreate(['category_name' => $categoryName]);
                    $categoryIds[] = $category->id;
                }
            }

            // Attach categories to the draft item
            if (!empty($categoryIds)) {
                $draft->categories()->attach($categoryIds);
            }


            // Commit the transaction
            DB::commit();

            Log::info('Draft saved successfully.');

            // Return a success response
            return response()->json(['success' => true, 'message' => 'Draft saved successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error saving draft:', ['exception' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            return response()->json([
                'success' => false,
                'message' => 'Error saving draft.',
                'error' => $e->getMessage(), // Show actual error
            ], 500);
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
        //$item->category_id = $validatedItem['item_category_id']; // Assuming you're passing the category ID
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
        $item->load([
            'variants.itemColor',
            'variants.itemSize',
            'variants.itemPackagingType',
        ]);
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
