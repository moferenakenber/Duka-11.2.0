<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Log;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Models\ItemVariant;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $storeId = Auth::user()->store?->id;
        Log::info('Seller Store ID: ' . $storeId);

        // Fetch items that have at least one variant in this seller's store
        $items = Item::with([
            'variants.storeVariants' => function ($q) use ($storeId) {
                $q->where('store_id', $storeId);
            }
        ])
            ->whereHas('variants.storeVariants', function ($q) use ($storeId) {
                $q->where('store_id', $storeId);
            })
            ->where('status', 'active') // item itself must be active
            ->get(); // use get() for now to debug

        Log::info('Fetched Items Count: ' . $items->count());
        foreach ($items as $item) {
            $variantIds = $item->variants->pluck('id');
            $storeVariantIds = $item->variants->flatMap(fn($v) => $v->storeVariants)->pluck('id');
            Log::info("Item {$item->id} - {$item->product_name} | Variants: " . $variantIds . " | Store Variants: " . $storeVariantIds);
        }

        return view('seller.items.index', compact('items'));

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
