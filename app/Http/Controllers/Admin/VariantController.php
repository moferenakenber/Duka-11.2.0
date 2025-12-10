<?php

namespace App\Http\Controllers\Admin;


use App\Models\ItemVariant;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemStock;
use Illuminate\Support\Facades\Log;
use App\Models\ItemSize;
use App\Models\ItemColor;
use App\Models\ItemPackagingType;
use App\Models\ItemInventoryLocation;
use App\Models\Customer;
use App\Models\User; // for sellers
use App\Models\Store;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Item $item)
    {
        $item->load([
            'variants',
            'colors',
            'sizes',
            'packagingTypes' => function ($q) {
                $q->withPivot('quantity');
            }
        ]);

        // Get variants collection
        $variants = $item->variants;

        // --- Filtering by status ---
        $currentFilter = request('filter', 'all');
        $variants = match ($currentFilter) {
            'active' => $variants->where('status', 'active'),
            'inactive' => $variants->where('status', 'inactive'),
            'unavailable' => $variants->where('status', 'unavailable'),
            'draft' => $variants->where('status', 'draft'),
            default => $variants,
        };

        // --- Optional: Sorting ---
        $sort = request('sort', 'id'); // default sort by ID
        $direction = request('direction', 'asc');

        $variants = match ($sort) {
            'price' => $direction === 'asc' ? $variants->sortBy('price') : $variants->sortByDesc('price'),
            'color' => $direction === 'asc' ? $variants->sortBy(fn($v) => $v->itemColor->name ?? '') : $variants->sortByDesc(fn($v) => $v->itemColor->name ?? ''),
            'packaging' => $direction === 'asc' ? $variants->sortBy(fn($v) => $v->itemPackagingType->name ?? '') : $variants->sortByDesc(fn($v) => $v->itemPackagingType->name ?? ''),
            default => $direction === 'asc' ? $variants->sortBy('id') : $variants->sortByDesc('id'),
        };

        if (request()->wantsJson()) {
            // Return JSON for API
            return response()->json([
                'item' => $item,
                'variants' => $variants,
                'colors' => $item->colors,
                'sizes' => $item->sizes,
                'packagingTypes' => $item->packagingTypes,
            ]);
        }

        // Return Blade view for web
        return view('admin.variants.index', [
            'item' => $item,
            'variants' => $variants,
            'currentFilter' => $currentFilter,
            'sort' => $sort,
            'direction' => $direction,
            'inventoryLocations' => ItemInventoryLocation::all(),
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    // // Validate the incoming request
    // $request->validate([
    //     'variants' => 'required|array|min:1',
    //     'variants.*.item_color_id' => 'nullable|exists:item_colors,id',
    //     'variants.*.item_size_id' => 'nullable|exists:item_sizes,id',
    //     'variants.*.item_packaging_type_id' => 'nullable|array',
    //     'variants.*.item_packaging_type_id.*' => 'exists:item_packaging_types,id',
    //     'variants.*.price' => 'required|numeric',
    //     'variants.*.discount_price' => 'nullable|numeric',
    //     'variants.*.inventory_location_id' => 'required|exists:item_inventory_locations,id',
    //     'variants.*.is_active' => 'boolean',
    //     'variants.*.stock' => 'required|integer|min:0',
    //     'variants.*.image' => 'nullable|image|max:2048',
    //     'variants.*.barcode' => 'nullable|string|unique:item_variants,barcode',
    // ]);

    // $variants = $request->input('variants', []);

    // try {
    //     foreach ($variants as $variantData) {

    //         $quantity = $variantData['stock'] ?? 0;
    //         unset($variantData['stock']);

    //         $packagingIds = $variantData['item_packaging_type_id'] ?? [];
    //         unset($variantData['item_packaging_type_id']);

    //         $variantData['item_color_id'] = $variantData['item_color_id'] ?? null;
    //         $variantData['item_size_id'] = $variantData['item_size_id'] ?? null;
    //         $variantData['inventory_location_id'] = $variantData['inventory_location_id'] ?? null;
    //         $variantData['barcode'] = $variantData['barcode'] ?? null;

    //         // Handle image upload
    //         if (isset($variantData['image']) && $variantData['image'] instanceof \Illuminate\Http\UploadedFile) {
    //             $variantData['image'] = $variantData['image']->store('variants', 'public');
    //         }

    //         $variantData['owner_id'] = auth()->id() ?? 1;
    //         $variantData['is_active'] = isset($variantData['is_active']) ? 1 : 0;
    //         $variantData['item_id'] = $item->id;

    //         // Remove packaging from main data since it’s pivot
    //         $packagingIds = $variantData['item_packaging_type_id'] ?? [];
    //         unset($variantData['item_packaging_type_id']);

    //         // Create the variant
    //         $savedVariant = ItemVariant::create($variantData);

    //         // Attach packaging types (many-to-many)
    //         if (!empty($packagingIds)) {
    //             $savedVariant->packagingTypes()->sync($packagingIds);
    //         }

    //         // Create stock entry
    //         ItemStock::updateOrCreate(
    //             [
    //                 'item_variant_id' => $savedVariant->id,
    //                 'item_inventory_location_id' => $variantData['inventory_location_id']
    //             ],
    //             [
    //                 'quantity' => $quantity
    //             ]
    //         );
    //     }

    //     return redirect()->back()->with('success', 'Variants saved successfully!');

    // } catch (\Exception $e) {
    //     Log::error('Variant store failed', [
    //         'message' => $e->getMessage(),
    //         'stack' => $e->getTraceAsString(),
    //         'item_id' => $item->id,
    //         'variants' => $variants
    //     ]);

    //     return response()->json([
    //         'message' => 'Variant store failed. Check logs.'
    //     ], 500);
    // }




    // if ($request->has('variants')) {
    //     foreach ($request->variants as $variant) {
    //         if (
    //             isset($variant['item_color_id']) &&
    //             isset($variant['item_size_id']) &&
    //             isset($variant['item_packaging_type_id']) &&
    //             isset($variant['price']) &&
    //             isset($variant['stock'])
    //         ) {
    //             ItemVariant::create([
    //                 'item_id' => $itemId,
    //                 'item_color_id' => $variant['item_color_id'],
    //                 'item_size_id' => $variant['item_size_id'],
    //                 'item_packaging_type_id' => $variant['item_packaging_type_id'],
    //                 'price' => $variant['price'],
    //                 'stock' => $variant['stock'],
    //             ]);
    //         }
    //     }
    // }

    // return redirect()->back()->with('success', 'Variants saved successfully!');

    // Log the entire request


    public function store(Request $request, $itemId)
    {
        Log::info('Variant store request:', $request->all());

        if ($request->has('variants')) {
            foreach ($request->variants as $index => $variantData) {

                $images = [];

                // 1. Direct file upload (multiple files)
                if ($request->hasFile("variants.$index.image")) {
                    Log::info("Direct upload detected for variant $index");

                    foreach ($request->file("variants.$index.image") as $file) {
                        $path = $file->store('images/variant_images', 'public');
                        $images[] = $path;

                        Log::info("Uploaded file for variant $index:", [
                            'original_name' => $file->getClientOriginalName(),
                            'stored_path' => $path,
                            'size' => $file->getSize(),
                            'mime' => $file->getClientMimeType()
                        ]);
                    }
                }

                // 2. Already uploaded via Axios, paths in hidden input
                if (!empty($variantData['image_paths'])) {
                    Log::info("Axios-uploaded images for variant $index", $variantData['image_paths']);
                    foreach ($variantData['image_paths'] as $path) {
                        // Remove 'storage/' prefix if present
                        $images[] = str_replace('storage/', '', $path);
                    }
                }

                // Avoid duplicate barcode
                $barcode = $variantData['barcode'] ?? null;
                if ($barcode && ItemVariant::where('barcode', $barcode)->exists()) {
                    $barcode = null; // or generate a unique one
                    Log::warning("Duplicate barcode detected for variant $index, setting to null");
                }

                // Log final images array
                Log::info("Final images array for variant $index:", $images);

                // Create variant
                $variant = ItemVariant::create([
                    'item_id' => $itemId,
                    'item_color_id' => $variantData['item_color_id'] ?? null,
                    'item_size_id' => $variantData['item_size_id'] ?? null,
                    'item_packaging_type_id' => $variantData['item_packaging_type_id'] ?? null,
                    'price' => $variantData['price'] ?? 0,
                    'discount_price' => $variantData['discount_price'] ?? null,
                    'barcode' => $barcode,
                    'images' => json_encode($images ?: []), // encode JSON
                    'is_active' => true,
                    'status' => 'active',
                    // 'packaging_total_pieces' => $variantData['total_pieces'] ?? 1,
                ]);


                Log::info("Variant created with ID: {$variant->id}");

                // Save stock
                ItemStock::create([
                    'item_variant_id' => $variant->id,
                    'item_inventory_location_id' => $variantData['inventory_location_id'] ?? ItemInventoryLocation::first()->id,
                    'quantity' => $variantData['stock'] ?? 0,
                ]);

            }

            Log::info("Final images array:", $images);
            Log::info("Variant created:", ['id' => $variant->id]);
        }

        return redirect()->back()->with('success', 'Variants saved successfully!');

    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(ItemVariant $variant)
    {
        // Load relationships
        $variant->load('item.colors', 'item.sizes', 'item.packagingTypes', 'customerPrices', 'sellerPrices', 'stores');

        // Load all customers and sellers for the dropdown
        $customers = Customer::all();
        $sellers = User::where('role', 'seller')->get();
        $stores = Store::all(); // <-- add this

        return view('admin.variants.edit', compact('variant', 'customers', 'sellers', 'stores'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemVariant $variant)
    {
        // Validate input if needed
        $data = $request->validate([
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.discount_price' => 'nullable|numeric|min:0',
            'variants.*.barcode' => 'nullable|string|max:255',
            'variants.*.status' => 'required|in:active,inactive',
            'variants.*.item_color_id' => 'nullable|exists:item_colors,id',
            'variants.*.item_size_id' => 'nullable|exists:item_sizes,id',
            'variants.*.item_packaging_type_id' => 'nullable|exists:item_packaging_types,id',
            'variants.*.customer_prices.*.customer_id' => 'nullable|exists:users,id',
            'variants.*.customer_prices.*.price' => 'nullable|numeric|min:0',
            'variants.*.seller_prices.*.seller_id' => 'nullable|exists:users,id',
            'variants.*.seller_prices.*.price' => 'nullable|numeric|min:0',
            'variants.*.seller_prices.*.discount_price' => 'nullable|numeric|min:0',
            'variants.*.seller_prices.*.discount_ends_at' => 'nullable|date',
        ]);


        // Update variant main fields
        foreach ($data['variants'] as $v) {
            $variant->update([
                'item_color_id' => $v['item_color_id'] ?? null,
                'item_size_id' => $v['item_size_id'] ?? null,
                'item_packaging_type_id' => $v['item_packaging_type_id'] ?? null,
                'price' => $v['price'] ?? 0,
                'discount_price' => $v['discount_price'] ?? null,
                'barcode' => $v['barcode'] ?? null,
                'status' => $v['status'] ?? 'inactive',
            ]);

            // Handle customer-specific prices
            if (!empty($v['customer_prices'])) {
                foreach ($v['customer_prices'] as $cp) {
                    if ($cp['customer_id']) {
                        $variant->customerPrices()->updateOrCreate(
                            ['customer_id' => $cp['customer_id']],
                            ['price' => $cp['price'] ?? 0]
                        );
                    }
                }
            }

            // Handle seller-specific prices
            if (!empty($v['seller_prices'])) {
                foreach ($v['seller_prices'] as $sp) {
                    if ($sp['seller_id']) {
                        $variant->sellerPrices()->updateOrCreate(
                            ['seller_id' => $sp['seller_id']],
                            [
                                'price' => $sp['price'] ?? 0,
                                'discount_price' => $sp['discount_price'] ?? null,
                                'discount_ends_at' => $sp['discount_ends_at'] ?? null
                            ]
                        );
                    }
                }
            }
        }
        return redirect()->route('admin.variants.index', ['item' => $variant->item_id])

            ->with('success', 'Variant updated successfully!');



    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    // public function itemsIndex()
    // {
    //     // Log the access
    //     Log::info('itemsIndex() invoked', [
    //         'user_id' => auth()->id() ?? null,
    //         'timestamp' => now(),
    //     ]);

    //     $items = Item::with(['colors', 'sizes', 'packagingTypes', 'variants'])->get();
    //     Log::info('Items loaded', $items->toArray());

    //     // Optionally check the data
    //     // dd($items);

    //     return view('admin.variants.items_index', compact('items'));
    // }

    // public function itemsIndex()
    // {
    //     // Load all items with relationships
    //     $items = Item::with(['colors', 'sizes', 'packagingTypes', 'variants'])->get();

    //     // Load global data (if you want separate collections too)
    //     $colors = ItemColor::all();
    //     $sizes = ItemSize::all();
    //     $packagingTypes = ItemPackagingType::all();
    //     $inventoryLocations = ItemInventoryLocation::all();

    //     // Log for debugging

    //     Log::info('ItemsIndex invoked', [
    //         'items_count' => $items->count(),
    //         'first_item' => $items->first()?->toArray(),
    //     ]);

    //     // Pass everything to the view
    //     return view('admin.variants.items_index', compact(
    //         'items',
    //         'colors',
    //         'sizes',
    //         'packagingTypes',
    //         'inventoryLocations'
    //     ));
    // }

    public function itemsIndex()
    {
        $items = Item::with(['colors', 'sizes', 'packagingTypes', 'variants'])->get();
        Log::info('Items loaded', $items->toArray());

        return view('admin.variants.items_index', compact('items'));
    }


    public function updateStatus(Request $request, ItemVariant $variant)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,unavailable,out_of_stock',
        ]);

        $variant->status = $request->status;
        $variant->save();

        return redirect()->back()->with('success', 'Variant status updated successfully.');
    }


    public function uploadImages(Request $request)
    {
        $request->validate([
            'variant_images' => 'required|array',
            'variant_images.*' => 'image|max:5120', // 5MB max
        ]);

        $paths = [];
        foreach ($request->file('variant_images') as $file) {
            $path = $file->store('images/variant_images', 'public');
            $paths[] = 'storage/' . $path;
        }

        return response()->json([
            'success' => true,
            'paths' => $paths
        ]);
    }






}
