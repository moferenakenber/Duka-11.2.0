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
use App\Models\User;
use App\Models\Customer;
use App\Models\StoreVariantSellerPrice;
use App\Models\StoreVariantCustomerPrice;
use App\Models\StoreVariant;



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
        // Eager load necessary relationships
        $variant->load([
            'item.colors',
            'item.sizes',
            'item.packagingTypes',
            'storeVariants.sellerPrices.seller',
            'storeVariants.customerPrices.customer',
            'storeVariants'
        ]);

        // Get the store-specific variant pivot
        $storeVariant = $variant->storeVariants()->where('store_id', $store->id)->first();

        // Sellers associated with this store variant
        $sellersData = $storeVariant
            ? $storeVariant->sellerPrices->map(function ($price) {
                return [
                    'id' => $price->seller->id,
                    'name' => $price->seller->first_name . ' ' . $price->seller->last_name,
                    'price' => $price->price,
                    'discount_price' => $price->discount_price ?? 0,
                    'discount_ends_at' => $price->discount_ends_at
                        ? Carbon::parse($price->discount_ends_at)->format('Y-m-d\TH:i')
                        : null,
                ];
            })->toArray()
            : [];

        // Customers associated with this store variant
        $customersData = $storeVariant
            ? $storeVariant->customerPrices->map(function ($price) {
                return [
                    'id' => $price->customer->id,
                    'name' => $price->customer->first_name . ' ' . $price->customer->last_name,
                    'price' => $price->price,
                    'discount_price' => $price->discount_price ?? 0,
                    'discount_ends_at' => $price->discount_ends_at
                        ? Carbon::parse($price->discount_ends_at)->format('Y-m-d\TH:i')
                        : null,
                ];
            })->toArray()
            : [];

        // Available sellers for adding new ones
        $availableSellers = User::where('role', 'seller')
            ->where('store_id', $store->id)
            ->select('id', 'first_name', 'last_name')
            ->get()
            ->map(fn($u) => [
                'id' => $u->id,
                'name' => trim($u->first_name . ' ' . $u->last_name),
            ])->toArray();

        // Available customers for adding new ones
        $availableCustomers = Customer::where('store_id', $store->id)
            ->select('id', 'first_name', 'last_name')
            ->get()
            ->map(fn($c) => [
                'id' => $c->id,
                'name' => trim($c->first_name . ' ' . $c->last_name),
            ])->toArray();

        // Alpine.js variant data
        $variantData = [
            'store_price' => $storeVariant->price ?? 0,
            'store_discount_price' => $storeVariant->discount_price ?? 0,
            'store_discount_ends_at' => optional($storeVariant->discount_ends_at)?->format('Y-m-d\TH:i'),
            'manual_status' => $storeVariant->manual_status ?? 'auto',
            'forced_status' => $storeVariant->forced_status, // ✅ ADD THIS
            'active' => $storeVariant->active ?? true,
            'sellers' => $sellersData,
            'customers' => $customersData,
            'available_sellers' => $availableSellers,
            'available_customers' => $availableCustomers,
            'packaging_name' => $storeVariant?->itemPackagingType->name ?? $variant->itemPackagingType?->name ?? '—',

        ];

        // Debug log
        \Log::info('Edit Variant Debug', [
            'store_id' => $store->id,
            'variant_id' => $variant->id,
            'storeVariant' => $storeVariant?->toArray(),
            'sellersData' => $sellersData,
            'customersData' => $customersData,
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
    public function updateVariant(
        Request $request,
        Store $store,
        Item $item,
        ItemVariant $variant
    ) {
        Log::info('Variant Update Request', $request->all());

        $data = $request->validate([
            'store_price' => ['required', 'numeric', 'min:0'],

            'store_discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:store_price',
            ],

            'store_discount_ends_at' => [
                'nullable',
                'date',
                function ($attr, $value, $fail) use ($request) {
                    if ($request->store_discount_price > 0 && !$value) {
                        $fail('Discount end date is required when a discount is set.');
                    }
                }
            ],

            'manual_status' => ['required', 'in:auto,forced'],

            'forced_status' => [
                'nullable',
                'in:active,inactive,out_of_stock,unavailable',
                function ($attr, $value, $fail) use ($request) {
                    if ($request->manual_status === 'forced' && !$value) {
                        $fail('Forced status is required when manual mode is forced.');
                    }
                }
            ],
        ]);

        $pivotData = [
            'price' => $data['store_price'],
            'discount_price' => $data['store_discount_price'] ?? null,
            'discount_ends_at' => $data['store_discount_ends_at'] ?? null,

            'manual_status' => $data['manual_status'],
        ];

        if ($data['manual_status'] === 'forced') {
            $pivotData['forced_status'] = $data['forced_status'];
            $pivotData['active'] = $data['forced_status'] !== 'inactive';
        } else {
            // AUTO MODE — clear forced state
            $pivotData['forced_status'] = null;
            $pivotData['active'] = true;
        }

        $store->variants()->syncWithoutDetaching([
            $variant->id => $pivotData,
        ]);

        Log::info('Variant updated', [
            'store_id' => $store->id,
            'variant_id' => $variant->id,
            'manual_status' => $pivotData['manual_status'],
            'forced_status' => $pivotData['forced_status'] ?? null,
        ]);

        return redirect()
            ->route('admin.stores.items.variants', [$store->id, $item->id])
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
        $sellerId = request('seller_id');      // optional
        $customerId = request('customer_id');  // optional

        // 1️⃣ Load item with all variants and relations
        $item = Item::with([
            'variants.itemColor',
            'variants.itemSize',
            'variants.itemPackagingType',
            'variants.storeVariants' // Eloquent relation we'll define below
        ])->findOrFail($itemId);

        $variants = $item->variants;

        // 2️⃣ Load stock for these variants in the store
        $stocks = ItemStock::where('item_inventory_location_id', $store->id)
            ->whereIn('item_variant_id', $variants->pluck('id'))
            ->get()
            ->keyBy('item_variant_id');

        // 3️⃣ Attach store-specific data
        foreach ($variants as $variant) {
            // Stock
            $variant->store_stock = $stocks[$variant->id]->quantity ?? 0;

            // StoreVariant relation for this store
            $storeVariant = $variant->storeVariants
                ->where('store_id', $store->id)
                ->first();

            if ($storeVariant) {
                $variant->store_variant_id = $storeVariant->id;
                $variant->store_price = $storeVariant->price;
                $variant->store_discount_price = $storeVariant->discount_price;
                $variant->discount_ends_at = $storeVariant->discount_ends_at;
                $variant->manual_status = $storeVariant->manual_status ?? 'auto';
                $variant->forced_status = $storeVariant->forced_status;

                // Compute status using model accessor
                $variant->status = $storeVariant->computed_status;
                $variant->store_active = $storeVariant->computed_status === 'active';

                // Price ladder & final price
                $variant->price_ladder = PriceProvider::getPriceLadder(
                    storeVariantId: $storeVariant->id,
                    storeId: $store->id,
                    sellerId: $sellerId,
                    customerId: $customerId
                );
                $variant->final_price = PriceProvider::getFinalPrice($variant->price_ladder);
            } else {
                $variant->manual_status = 'auto';
                $variant->forced_status = null;
                $variant->status = 'inactive';
                $variant->store_active = false;
                $variant->price_ladder = [];
                $variant->final_price = null;
            }
        }

        // 🧾 Log variants
        Log::info('Store Item Variants Loaded', [
            'store' => ['id' => $store->id, 'name' => $store->name],
            'item' => ['id' => $item->id, 'name' => $item->product_name],
            'seller_id' => $sellerId,
            'customer_id' => $customerId,
            'variants' => $variants->map(fn($v) => [
                'id' => $v->id,
                'color' => $v->itemColor->name ?? null,
                'size' => $v->itemSize->name ?? null,
                'packaging' => $v->itemPackagingType->name ?? null,
                'stock' => $v->store_stock,
                'manual_status' => $v->manual_status,
                'forced_status' => $v->forced_status,
                'actual_status' => $v->status,
                'price_ladder' => $v->price_ladder,
                'final_price' => $v->final_price,
            ])->toArray(),
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

    public function updateSellerPrice(
        Request $request,
        Store $store,
        Item $item,
        ItemVariant $variant
    ) {
        $data = $request->validate([
            'seller_id' => 'required|exists:users,id',

            'price' => ['required', 'numeric', 'min:0'],

            'discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:price',
            ],

            'discount_ends_at' => [
                'nullable',
                'date',
                function ($attr, $value, $fail) use ($request) {
                    if ($request->discount_price > 0 && !$value) {
                        $fail('Discount end date is required when a discount is set.');
                    }
                }
            ],
        ]);


        // Get the store_variant row
        $storeVariant = $variant->storeVariants()
            ->where('store_id', $store->id)
            ->firstOrFail();

        StoreVariantSellerPrice::updateOrCreate(
            [
                'store_variant_id' => $storeVariant->id,
                'seller_id' => $data['seller_id'],
            ],
            [
                'price' => $data['price'],
                'discount_price' => $data['discount_price'] > 0 ? $data['discount_price'] : null,
                'discount_ends_at' => $data['discount_price'] > 0 ? $data['discount_ends_at'] : null,
                'active' => true,
            ]
        );


        return back()->with('success', 'Seller price saved successfully.');
    }

    public function updateCustomerPrice(
        Request $request,
        Store $store,
        Item $item,
        ItemVariant $variant
    ) {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',

            'price' => ['required', 'numeric', 'min:0'],

            'discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:price',
            ],

            'discount_ends_at' => [
                'nullable',
                'date',
                function ($attr, $value, $fail) use ($request) {
                    if ($request->discount_price > 0 && !$value) {
                        $fail('Discount end date is required when a discount is set.');
                    }
                }
            ],
        ]);


        // Get the store_variant row
        $storeVariant = $variant->storeVariants()
            ->where('store_id', $store->id)
            ->firstOrFail();

        StoreVariantCustomerPrice::updateOrCreate(
            [
                'store_variant_id' => $storeVariant->id,
                'customer_id' => $data['customer_id'],
            ],
            [
                'price' => $data['price'],
                'discount_price' => $data['discount_price'] > 0 ? $data['discount_price'] : null,
                'discount_ends_at' => $data['discount_price'] > 0 ? $data['discount_ends_at'] : null,
                'active' => true,
            ]
        );


        return back()->with('success', 'Customer price saved successfully.');
    }

}
