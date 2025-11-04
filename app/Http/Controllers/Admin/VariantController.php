<?php

namespace App\Http\Controllers\Admin;


use App\Models\ItemVariant;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemStock;
use Illuminate\Support\Facades\Log;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Item $item)
    {
        try {
            // ✅ Validate the variants array
            $request->validate([
                'variants.*.item_color_id' => 'nullable|exists:item_colors,id',
                'variants.*.item_size_id' => 'nullable|exists:item_sizes,id', // nullable now
                'variants.*.item_packaging_type_id' => 'nullable|exists:item_packaging_types,id',
                'variants.*.price' => 'required|numeric',
                'variants.*.discount_price' => 'nullable|numeric',
                'variants.*.inventory_location_id' => 'required|exists:item_inventory_locations,id',
                'variants.*.is_active' => 'boolean',
                'variants.*.stock' => 'required|integer|min:0',
                'variants.*.image' => 'nullable|image|max:2048',
                'variants.*.barcode' => 'nullable|string|unique:item_variants,barcode',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::error('Variant validation failed', $e->errors());

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        $variants = $request->input('variants', []);

        if (!is_array($variants) || count($variants) === 0) {
            Log::warning('No variants provided', ['item_id' => $item->id]);
            return response()->json(['message' => 'No variants provided'], 422);
        }

        try {
            foreach ($variants as $variantData) {

                // Extract stock
                $quantity = $variantData['stock'] ?? 0;
                unset($variantData['stock']);

                // Convert empty strings to null for nullable foreign keys
                $variantData['item_color_id'] = $variantData['item_color_id'] ?: null;
                $variantData['item_size_id'] = $variantData['item_size_id'] ?: null;
                $variantData['item_packaging_type_id'] = $variantData['item_packaging_type_id'] ?: null;
                $variantData['inventory_location_id'] = $variantData['inventory_location_id'] ?: null;
                $variantData['barcode'] = $variantData['barcode'] ?? null;

                // Handle image upload
                if (isset($variantData['image']) && $variantData['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $variantData['image'] = $variantData['image']->store('variants', 'public');
                }

                $variantData['owner_id'] = auth()->id() ?? 1;
                $variantData['is_active'] = isset($variantData['is_active']) ? 1 : 0;
                $variantData['item_id'] = $item->id;

                // Create Variant
                $savedVariant = ItemVariant::create($variantData);

                // Create Stock
                ItemStock::updateOrCreate(
                    [
                        'item_variant_id' => $savedVariant->id,
                        'item_inventory_location_id' => $variantData['inventory_location_id']
                    ],
                    [
                        'quantity' => $quantity
                    ]
                );
            }


            return response()->json(['message' => 'Variants saved successfully!']);

        } catch (\Exception $e) {
            // Log unexpected runtime errors
            Log::error('Variant store failed', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
                'item_id' => $item->id,
                'variants' => $variants
            ]);

            return response()->json([
                'message' => 'Variant store failed. Check logs.'
            ], 500);
        }
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
}
