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

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Item $item)
    {
        // Eager load relationships
        $item->load(['colors', 'sizes', 'packagingTypes', 'variants']);

        return view('admin.variants.index', [
            'item' => $item,
            'variants' => $item->variants,
            'inventoryLocations' => ItemInventoryLocation::all(),
        ]);
        // return view('admin.variants.index', [
        //     'item' => $item,
        //     'variants' => $item->variants,
        //     'colors' => ItemColor::all(),
        //     'sizes' => ItemSize::all(),
        //     'packagingTypes' => ItemPackagingType::all(),
        //     'inventoryLocations' => ItemInventoryLocation::all(),
        // ]);
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
    public function store(Request $request, $itemId)
    {
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
        Log::info('Variant store request:', $request->all());

        if ($request->has('variants')) {
            foreach ($request->variants as $variantData) {
                // Save variant (without stock)
                $variant = ItemVariant::create([
                    'item_id' => $itemId,
                    'item_color_id' => $variantData['item_color_id'] ?? null,
                    'item_size_id' => $variantData['item_size_id'] ?? null,
                    'item_packaging_type_id' => $variantData['item_packaging_type_id'] ?? null,
                    'price' => $variantData['price'] ?? 0,
                    'is_active' => true,
                ]);

                // Save stock for the variant
                ItemStock::create([
                    'item_variant_id' => $variant->id,
                    'item_inventory_location_id' => 1, // default location ID
                    'quantity' => $variantData['stock'] ?? 0,
                ]);
            }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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







}
