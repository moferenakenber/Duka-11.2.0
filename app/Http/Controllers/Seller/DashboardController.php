<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Log;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Models\ItemVariant;
use App\Services\PriceProvider;
// Models
use App\Models\Item;
use App\Models\ItemStock;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $store = Auth::user()->store;
        $storeId = $store?->id;
        Log::info('Seller Store ID: ' . $storeId);

        $sellerId = request('seller_id');      // optional
        $customerId = request('customer_id');  // optional

        // 1️⃣ Load items with their variants and all needed relations
        $items = Item::with([
            'variants.itemColor',
            'variants.itemSize',
            'variants.itemPackagingType',
            'variants.storeVariants'
        ])
            ->where('status', 'active') // Only active items
            ->whereHas('variants.storeVariants', function ($q) use ($storeId) {
                $q->where('store_id', $storeId);
            })
            ->get();

        // 2️⃣ Load stock for all variants in this store at once
        $variantIds = $items->flatMap(fn($item) => $item->variants->pluck('id'))->unique();
        $stocks = ItemStock::where('item_inventory_location_id', $storeId)
            ->whereIn('item_variant_id', $variantIds)
            ->get()
            ->keyBy('item_variant_id');

        // 3️⃣ Attach store-specific data to each variant
        foreach ($items as $item) {
            foreach ($item->variants as $variant) {
                $variant->store_stock = $stocks[$variant->id]->quantity ?? 0;

                $storeVariant = $variant->storeVariants->where('store_id', $storeId)->first();

                if ($storeVariant) {
                    $variant->store_variant_id = $storeVariant->id;
                    $variant->store_price = $storeVariant->price;
                    $variant->store_discount_price = $storeVariant->discount_price;
                    $variant->discount_ends_at = $storeVariant->discount_ends_at;
                    $variant->manual_status = $storeVariant->manual_status ?? 'auto';
                    $variant->forced_status = $storeVariant->forced_status;

                    $variant->status = $storeVariant->computed_status;
                    $variant->store_active = $storeVariant->computed_status === 'active';

                    $variant->price_ladder = PriceProvider::getPriceLadder(
                        storeVariantId: $storeVariant->id,
                        storeId: $storeId,
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
        }

        Log::info('Seller Items Loaded', [
            'store_id' => $storeId,
            'items_count' => $items->count(),
            'variants_count' => $items->sum(fn($i) => $i->variants->count()),
        ]);

        return view('seller.items.index', compact('items', 'store'));
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
    public function store(Request $request)
    {
        //
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
