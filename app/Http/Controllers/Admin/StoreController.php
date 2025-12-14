<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Item;
use App\Models\ItemVariant;
use App\Models\ItemStock;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    // Display all stores
    public function index()
    {
        $stores = Store::latest()->paginate(20);
        return view('admin.stores.index', compact('stores'));
    }

    // Show form to create a new store
    public function create()
    {
        return view('admin.stores.create');
    }

    // Store a new store
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive',
        ]);

        Store::create($data);

        return redirect()->route('admin.stores.index')->with('success', 'Store created successfully.');
    }

    // Show a single store
    public function show(Store $store)
    {
        return view('admin.stores.show', compact('store'));
    }

    // Edit form
// Show edit form for a specific variant in a store
    public function editVariant(Store $store, Item $item, ItemVariant $variant)
    {
        // Prepare storeData for Alpine.js
        $storeData = [
            'id' => $store->id,
            'name' => $store->name,
            'location' => $store->location,
            'status' => $store->status,
            'store_prices' => [
                [
                    'variant_id' => $variant->id,
                    'item_id' => $variant->item_id,
                    'price' => $variant->store_price ?? $variant->price,
                    'discount_price' => $variant->store_discount_price ?? 0,
                    'stock' => $variant->store_stock ?? 0,
                    'status' => $variant->store_active ? 'active' : 'inactive',
                    'discount_ends_at' => $variant->discount_ends_at?->format('Y-m-d\TH:i') ?? null,
                ]
            ],
        ];

        // Get items linked to this store via store_variant table
        $items = Item::whereHas('variants', function ($q) use ($store) {
            $q->whereIn('id', function ($sub) use ($store) {
                $sub->select('item_variant_id')
                    ->from('store_variant')
                    ->where('store_id', $store->id);
            });
        })->get();

        return view('admin.stores.edit_variant', compact('store', 'item', 'variant', 'storeData', 'items'));
    }



    // Update store-specific variant
    public function updateVariant(Request $request, Store $store, Item $item, ItemVariant $variant)
    {
        $data = $request->validate([
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'discount_ends_at' => 'nullable|date',
        ]);

        // Update or insert store-variant pivot
        $store->variants()->syncWithoutDetaching([
            $variant->id => [
                'price' => $data['price'],
                'discount_price' => $data['discount_price'] ?? null,
                'stock' => $data['stock'] ?? 0,
                'active' => $data['status'] === 'active',
                'discount_ends_at' => $data['discount_ends_at'] ?? null,
            ]
        ]);

        return redirect()->route('stores.items.variants', [$store->id, $item->id])
            ->with('success', 'Variant updated successfully for this store.');
    }


    // Delete store
    public function destroy(Store $store)
    {
        $store->delete();
        return redirect()->route('admin.stores.index')->with('success', 'Store deleted successfully.');
    }

    // List all items that have variants in this store
    public function items(Store $store)
    {
        $items = Item::whereHas('variants.storeVariants', function ($q) use ($store) {
            $q->where('store_id', $store->id);
        })->get();

        return view('admin.stores.items', compact('store', 'items'));
    }

    // Show variants of a specific item in this store
    public function itemVariants(Store $store, $itemId)
    {
        // 1️⃣ Load all variants of the item
        $variants = ItemVariant::where('item_id', $itemId)
            ->with(['itemColor', 'itemSize', 'itemPackagingType'])
            ->get();

        $variantIds = $variants->pluck('id');

        // 2️⃣ Load stock in this store
        $stocks = ItemStock::where('item_inventory_location_id', $store->id)
            ->whereIn('item_variant_id', $variantIds)
            ->get()
            ->keyBy('item_variant_id');

        // 3️⃣ Load store-specific variant data
        $storeVariants = DB::table('store_variant')
            ->where('store_id', $store->id)
            ->whereIn('item_variant_id', $variantIds)
            ->get()
            ->keyBy('item_variant_id');

        // 4️⃣ Attach store-specific data to each variant
        foreach ($variants as $variant) {
            $variant->store_stock = $stocks[$variant->id]->quantity ?? 0;

            $storeVariant = $storeVariants[$variant->id] ?? null;

            $variant->store_price = $storeVariant?->price ?? $variant->price;
            $variant->store_discount_price = $storeVariant?->discount_price ?? 0;
            $variant->store_active = $storeVariant?->active ?? false;
        }

        $item = Item::findOrFail($itemId);

        return view('admin.stores.item_variants', compact('store', 'item', 'variants'));
    }

    // Update store-specific variant status
    public function updateVariantStatus(Request $request, Store $store, $variantId)
    {
        $request->validate([
            'active' => 'required|boolean',
            'price' => 'nullable|numeric',
            'discount_price' => 'nullable|numeric',
        ]);

        $data = [
            'active' => $request->active,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
        ];

        DB::table('store_variant')->updateOrInsert(
            [
                'store_id' => $store->id,
                'item_variant_id' => $variantId
            ],
            $data
        );

        return back()->with('success', 'Variant updated successfully for this store.');
    }
}
