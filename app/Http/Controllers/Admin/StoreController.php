<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Item;
use App\Models\ItemVariant;
use App\Models\ItemStock;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\PriceProvider;

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
        $variant->load(
            'item.colors',
            'item.sizes',
            'item.packagingTypes',
            'storeVariants.sellerPrices',
            'storeVariants.customerPrices',
            'storeVariants'
        );

        $storeVariant = $variant->storeVariants()->where('store_id', $store->id)->first();
        $storeSellers = $store->sellers ?? collect();
        $storeCustomers = $store->customers ?? collect();

        // Prepare sellers data
        $sellersData = $storeSellers->map(function ($seller) use ($storeVariant) {
            $price = $storeVariant?->sellerPrices?->firstWhere('seller_id', $seller->id);
            return [
                'id' => $seller->id,
                'name' => $seller->name,
                'price' => $price->price ?? 0,
                'discount_price' => $price->discount_price ?? 0,
                'discount_ends_at' => $price?->discount_ends_at
                    ? Carbon::parse($price->discount_ends_at)->format('Y-m-d\TH:i')
                    : null,
            ];
        });

        // Prepare customers data
        $customersData = $storeCustomers->map(function ($customer) use ($storeVariant) {
            $price = $storeVariant?->customerPrices?->firstWhere('customer_id', $customer->id);
            return [
                'id' => $customer->id,
                'name' => $customer->first_name . ' ' . $customer->last_name,
                'price' => $price->price ?? 0,
                'discount_price' => $price->discount_price ?? 0,
                'discount_ends_at' => $price?->discount_ends_at
                    ? Carbon::parse($price->discount_ends_at)->format('Y-m-d\TH:i')
                    : null,
            ];
        });

        // Variant data for Alpine.js
        $variantData = [
            'store_price' => $storeVariant?->price ?? $variant->price,
            'store_discount_price' => $storeVariant?->discount_price ?? 0,
            'store_discount_ends_at' => $storeVariant?->discount_ends_at
                ? Carbon::parse($storeVariant->discount_ends_at)->format('Y-m-d\TH:i')
                : null,
            'status' => $storeVariant?->status ?? 'inactive',
            'sellers' => $sellersData,
            'customers' => $customersData,
        ];

        // CENTRAL LOG
        \Log::info('Edit Variant Debug', [
            'store_id' => $store->id,
            'variant_id' => $variant->id,
            'storeVariant' => $storeVariant?->toArray(),
            'sellersData' => $sellersData->toArray(),
            'customersData' => $customersData->toArray(),
            'variantData' => $variantData,
        ]);


        return view('admin.stores.edit_variant', compact(
            'store',
            'item',
            'variant',
            'variantData'
        ));
    }




    // Update store-specific variant
    public function updateVariant(Request $request, Store $store, Item $item, ItemVariant $variant)
    {
        $data = $request->validate([
            'store_price' => 'required|numeric|min:0',
            'store_discount_price' => 'nullable|numeric|min:0',
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
                'discount_price' => $data['discount_price'] !== '' ? $data['discount_price'] : null,
                'active' => $data['status'] === 'active',
                'discount_ends_at' => $data['discount_ends_at'] ?? null,
            ]
        ]);

        return redirect()->route('admin.stores.items.variants', [$store->id, $item->id])
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

        // Optional: get seller and customer IDs from request or context
        $sellerId = request('seller_id');      // nullable
        $customerId = request('customer_id');  // nullable

        // 4️⃣ Attach stock and price ladder to each variant
        foreach ($variants as $variant) {
            $variant->store_stock = $stocks[$variant->id]->quantity ?? 0;

            $storeVariant = $storeVariants[$variant->id] ?? null;

            if ($storeVariant) {
                // Use PriceProvider to get full ladder
                $variant->price_ladder = PriceProvider::getPriceLadder(
                    storeVariantId: $storeVariant->id,
                    storeId: $store->id,
                    sellerId: $sellerId,
                    customerId: $customerId
                );

                // Get the final price
                $variant->final_price = PriceProvider::getFinalPrice($variant->price_ladder);
            } else {
                // No store variant exists
                $variant->price_ladder = [];
                $variant->final_price = null;
            }
        }

        $item = Item::findOrFail($itemId);

        // 🧾 ✅ SINGLE LOG ENTRY (everything in one place)
        // 🧾 ✅ SINGLE LOG ENTRY
        Log::info('Store Item Variants Loaded', [
            'store' => [
                'id' => $store->id,
                'name' => $store->name,
            ],
            'item' => [
                'id' => $item->id,
                'name' => $item->product_name,
            ],
            'seller_id' => $sellerId,
            'customer_id' => $customerId,
            'variants' => $variants->map(function ($v) {
                return [
                    'id' => $v->id,
                    'color' => $v->itemColor->name ?? null,
                    'size' => $v->itemSize->name ?? null,
                    'packaging' => $v->itemPackagingType->name ?? null,
                    'stock' => $v->store_stock,
                    'price_ladder' => $v->price_ladder,
                    'final_price' => $v->final_price,
                ];
            })->toArray(),
        ]);

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
