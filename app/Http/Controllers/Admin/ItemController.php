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
use App\Models\ItemInventoryLocation;


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
        $items = Item::with(['colors', 'sizes', 'packagingTypes', 'variants'])->get();
        return view('admin.items.index', compact('items'));
    }


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


    // Store a newly created item
    public function store(Request $request)
    {
        $item = new Item();

        $validatedItem = $request->validate([

            'item_category_id' => 'required|exists:item_categories,id',
        ]);

        $item = Item::create([

            'category_id' => $validatedItem['item_category_id'], // Assuming you're passing the category ID
        ]);

        // Create a new Item and assign validated data
        $item = new Item();

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
        // 1️⃣ Eager load relations
        $item->load([
            'variants.itemColor',
            'variants.itemSize',
            'variants.itemPackagingType',
            'colors',
            'sizes',
            'packagingTypes',
            'categories'
        ]);
        logger('Step 1: Loaded item relations', ['item_id' => $item->id]);

        // 2️⃣ Get related data
        $colors = $item->colors;
        $sizes = $item->sizes;
        $packagingTypes = $item->packagingTypes;
        $inventoryLocations = ItemInventoryLocation::all();
        $sellers = User::where('role', 'seller')->get();
        logger('Step 2: Retrieved related collections', [
            'colors' => $colors->pluck('name'),
            'sizes' => $sizes->pluck('name'),
            'packagingTypes' => $packagingTypes->pluck('name')
        ]);

        // 3️⃣ Decode item images
        $itemImages = [];
        if ($item->product_images) {
            $clean = preg_replace('/[^\[\]{}",:a-zA-Z0-9_\.\-\/]/', '', $item->product_images);
            $itemImages = json_decode($clean, true) ?: [];
        }
        logger('Step 3: Decoded item images', ['itemImages' => $itemImages]);

        // 4️⃣ Prepare variant data
        // ✅ Prepare variant data including only variant images
        $variantData = $item->variants->map(function ($variant) {
            $images = [];

            if ($variant->images) {
                if (is_string($variant->images)) {
                    $images = json_decode($variant->images, true) ?: [];
                } elseif (is_array($variant->images)) {
                    $images = $variant->images;
                }
            }


            return [
                'color' => $variant->itemColor->name ?? null,
                'size' => $variant->itemSize->name ?? null,
                'packaging' => $variant->itemPackagingType->name ?? null,
                'img' => count($images) > 0 ? asset('storage/' . $images[0]) : '/img/default.jpg',
                'images' => array_map(fn($i) => asset('storage/' . $i), $images),
                'price' => $variant->price,
                'stock' => $variant->stock,
                'disabled' => $variant->status !== 'active',
            ];
        });
        logger('Step 4: Prepared variant data', ['variantData' => $variantData->toArray()]);

        // 5️⃣ Merge all images (item + variant images)
        $variantImages = $item->variants->pluck('images')
            ->filter()
            ->map(function ($img) {
                if (is_string($img)) {
                    return json_decode($img, true);
                }
                return $img;
            })
            ->flatten()
            ->toArray();
        logger('Step 5: Flattened variant images', ['variantImages' => $variantImages]);

        $allImages = array_values(array_unique(array_merge($itemImages, $variantImages)));
        logger('Step 6: Merged all images', ['allImages' => $allImages]);

        // 6️⃣ Return view
        return view('admin.items.show', compact(
            'item',
            'colors',
            'sizes',
            'packagingTypes',
            'sellers',
            'inventoryLocations',
            'variantData' // pass only variant images
        ));
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


    // Save Draft method/////////////////////////////////////////////////////////////////////////////////////////
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

                'selectedCategories' => 'nullable|string', // Will be JSON encoded array of category IDs
                'newCategoryNames' => 'nullable|string', // Will be JSON encoded array of new category names

                'product_images' => 'nullable|array',
                'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);

            Log::info('Validation passed for save draft.', $validatedData);

            Log::info('Request Data:', $request->all());


            // Decode JSON inputs
            $selectedCategories = json_decode($request->input('selectedCategories', '[]'), true);
            $newCategoryNames = json_decode($request->input('newCategoryNames', '[]'), true);

            // Determine completeness
            $requiredFields = ['product_name', 'product_description', 'category_id', 'product_images'];
            $isComplete = true;
            foreach ($requiredFields as $field) {
                if ($field === 'category_id' && empty($selectedCategories) && empty($newCategoryNames)) {
                    $isComplete = false;
                    break;
                }
                if ($field === 'product_images' && !$request->hasFile('product_images')) {
                    $isComplete = false;
                    break;
                }
                if (in_array($field, ['product_name', 'product_description']) && empty($request->input($field))) {
                    $isComplete = false;
                    break;
                }
            }

            // Create the item
            $item = new Item();
            $item->product_name = $request->input('product_name');
            $item->product_description = $request->input('product_description');
            $item->packaging_details = $request->input('packaging_details') ?? null;

            // Status always inactive initially
            $item->status = 'inactive';
            $item->incomplete = !$isComplete; // true if incomplete, false if complete

            // Handle images

            if ($request->hasFile('product_images')) {
                $paths = [];
                foreach ($request->file('product_images') as $file) {
                    // Store file in public disk
                    $path = $file->store('images/product_images', 'public');
                    $paths[] = 'storage/' . $path; // relative path for Blade asset()
                }
                // Save JSON array of paths
                $item->product_images = json_encode($paths);
            }

            $item->save();


            Log::info('Saved item product_images JSON:', ['product_images' => $item->product_images]);

            // Handle existing and new categories
            // ✅ Handle existing & new categories (Dynamic categories like colors/sizes)
            $existingCategoryIds = $request->input('categories', []);  // array of existing IDs
            $newCategoryNames = $request->input('newCategories', []);  // array of new names

            Log::info('Categories received:', [
                'existing' => $existingCategoryIds,
                'new' => $newCategoryNames
            ]);

            // ✅ Create new categories and collect IDs
            foreach ($newCategoryNames as $name) {
                if (!empty($name)) {
                    $cat = ItemCategory::firstOrCreate(['category_name' => $name]);
                    $existingCategoryIds[] = $cat->id;
                }
            }

            // ✅ Attach all category IDs to item
            if (!empty($existingCategoryIds)) {
                $item->categories()->sync($existingCategoryIds);
            }

            Log::info('Final attached categories:', $existingCategoryIds);


            // Colors
            $colorIds = $request->input('colors', []); // existing color IDs
            $newColorNames = $request->input('newColors', []); // new color names

            foreach ($newColorNames as $name) {
                if (!empty($name)) {
                    $color = ItemColor::firstOrCreate(['name' => $name]);
                    $colorIds[] = $color->id;
                }
            }
            $item->colors()->sync($colorIds);

            // Sizes
            $sizeIds = $request->input('sizes', []);
            $newSizeNames = $request->input('newSizes', []);

            foreach ($newSizeNames as $name) {
                if (!empty($name)) {
                    $size = ItemSize::firstOrCreate(['name' => $name]);
                    $sizeIds[] = $size->id;
                }
            }
            $item->sizes()->sync($sizeIds);

            // Packaging
            $packIds = $request->input('packaging', []);

            $packIdsWithQuantity = collect($packIds)->mapWithKeys(function ($id) use ($request) {

                // Handle custom packs
                if (str_starts_with($id, 'custom_')) {
                    $name = $request->input("custom_pack_name.$id"); // get the name
                    $pack = ItemPackagingType::create([
                        'name' => $name,
                        'quantity' => $request->input("packaging_qty.$id", 1),
                    ]);
                    $id = $pack->id; // replace temporary string ID with numeric ID
                }

                return [$id => ['quantity' => $request->input("packaging_qty.$id", 1)]];
            })->toArray();

            $item->packagingTypes()->sync($packIdsWithQuantity);

            // Commit the transaction
            DB::commit();

            Log::info('Draft saved successfully.');

            return response()->json([
                'success' => true,
                'message' => $isComplete ? 'Item saved as complete (inactive)' : 'Item saved as draft (inactive)',
            ]);

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

    public function uploadImages(Request $request)
    {
        $request->validate([
            'product_images' => 'required|array',
            'product_images.*' => 'image|max:5120', // 5MB max
        ]);

        $paths = [];
        foreach ($request->file('product_images') as $file) {
            $path = $file->store('images/product_images', 'public');
            $paths[] = 'storage/' . $path; // store relative path
        }

        // Here, instead of returning JSON, we return JS to redirect with a popup
        $redirect = route('admin.items.index');
        $message = 'Images uploaded successfully!';

        return response()->json([
            'redirect' => $redirect,
            'message' => $message,
            'paths' => $paths,
        ]);
    }

    public function updateStatus(Request $request, Item $item)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,unavailable,draft',
        ]);

        $item->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status updated successfully.');
    }


}
