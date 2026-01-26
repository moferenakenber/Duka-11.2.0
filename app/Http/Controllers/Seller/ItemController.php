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

use App\Services\PriceProvider;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // // ✅ Only show active items
        // $query = Item::with('categories')
        //     ->where('status', 'active');

        // // ✅ Search logic (product name)
        // if ($request->filled('search')) {
        //     $query->where('product_name', 'LIKE', '%' . $request->search . '%');
        // }

        // // ✅ Sorting
        // if ($request->has('sort')) {
        //     switch ($request->sort) {
        //         case 'price_asc':
        //             $query->orderBy('price', 'asc');
        //             break;
        //         case 'price_desc':
        //             $query->orderBy('price', 'desc');
        //             break;
        //         case 'sold_asc':
        //             $query->orderBy('sold_count', 'asc');
        //             break;
        //         case 'sold_desc':
        //             $query->orderBy('sold_count', 'desc');
        //             break;
        //         case 'name_asc':
        //             $query->orderBy('product_name', 'asc');
        //             break;
        //         case 'name_desc':
        //             $query->orderBy('product_name', 'desc');
        //             break;
        //     }
        // }

        // // ✅ Paginate results
        // $items = $query->paginate(300);

        // return view('seller.items.index', compact('items'));



        $storeId = Auth::user()->store?->id;
        Log::info('Seller Store ID: ' . $storeId);

        $items = Item::where('status', 'active')
            ->with('variants.storeVariants')
            ->get();

        foreach ($items as $item) {
            $variants = $item->variants;
            foreach ($variants as $variant) {
                $storeVariants = $variant->storeVariants;
                Log::info("Item {$item->id} - Variant {$variant->id} | Store Variants: " . $storeVariants->count());
            }
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
    // public function show(Item $item)
    // {
    //     $item->load([
    //         'variants.itemColor',
    //         'variants.itemSize',
    //         'variants.itemPackagingType',
    //         // 'variants.itemPackagingTypeitem',
    //         'variants.owner',
    //     ]);

    //     $itemArray = $item->toArray();
    //     Log::info('Item: ' . print_r($itemArray, true));


    //     // Ensure item has variants
    //     // $item->load(['variants']);

    //     // Add dd() to inspect the data
    //     //dd($item->variants); // This will dump the variants and stop the execution
    //     // 🔹 Build image collections here (same logic as in your Blade file)
    //     $itemImages = collect();
    //     if ($item->product_images) {
    //         $decodedImages = json_decode($item->product_images, true);
    //         if (is_array($decodedImages)) {
    //             $itemImages = collect($decodedImages)
    //                 ->filter(fn($img) => !empty($img)) // remove empty entries
    //                 ->map(fn($img) => asset($img));
    //         }
    //     }

    //     $variantColorImages = $item->variants
    //         ->map(fn($variant) => $variant->itemColor?->image_path ? asset($variant->itemColor->image_path) : null)
    //         ->filter(fn($img) => !empty($img) && $img !== url('/')) // remove empty / root
    //         ->unique();

    //     $sizeImages = $item->variants
    //         ->map(fn($variant) => optional($variant->itemSize)->image_path ? asset($variant->itemSize->image_path) : null)
    //         ->filter(fn($img) => !empty($img) && $img !== url('/'))
    //         ->unique();

    //     $packagingImages = $item->variants
    //         ->map(fn($variant) => optional($variant->itemPackagingType)->image_path ? asset($variant->itemPackagingType->image_path) : null)
    //         ->filter(fn($img) => !empty($img) && $img !== url('/'))
    //         ->unique();


    //     $allImages = $itemImages
    //         ->merge($variantColorImages)
    //         ->merge($sizeImages)
    //         ->merge($packagingImages)
    //         ->filter(fn($img) => !empty($img)) // ✅ remove empty entries
    //         ->unique()
    //         ->values();


    //     // 🔹 Build variant data array
    //     $variantData = $item->variants->map(function ($variant) {

    //         // Decode images safely
    //         $rawImages = $variant->images;
    //         if (is_string($rawImages)) {
    //             $decoded = json_decode($rawImages, true);
    //             $rawImages = is_array($decoded) ? $decoded : [];
    //         }
    //         if (!is_array($rawImages)) {
    //             $rawImages = [];
    //         }

    //         $variantImages = collect($rawImages)->map(function ($img) {
    //             // If it's already a full URL, use it
    //             if (str_starts_with($img, 'http')) {
    //                 return $img;
    //             }
    //             // Otherwise, prefix with asset() pointing to public
    //             return asset($img); // <- not storage
    //         });


    //         return [
    //             'id' => $variant->id,
    //             'color' => $variant->itemColor?->name,
    //             'img' => $variantImages->first() ?: ($variant->itemColor ? asset('storage/' . $variant->itemColor->image_path) : '/img/default.jpg'),
    //             'size' => $variant->itemSize?->name,
    //             'packaging' => $variant->itemPackagingType?->name,
    //             'price' => $variant->price,
    //             'stock' => $variant->stock,
    //             'images' => $variantImages->toArray(), // ✅ now this is a real array
    //             'quantity' => $variant->calculateTotalPieces(),
    //         ];
    //     });






    //     $sellers = User::where('role', 'seller')->get(); // assuming sellers have 'seller' role

    //     // All carts created by this seller (auth user) that belong to a customer
    //     // $carts = Cart::with('customer')
    //     //     ->where('user_id', auth()->id())
    //     //     ->whereNotNull('customer_id')
    //     //     ->get();

    //     $customersWithOpenCarts = Customer::whereHas('carts', function ($query) {
    //         $query->where('status', 'open');
    //     })->get();

    //     // 🔹 Now your logs will actually have data
    //     // Log::info('Item images:', $itemImages->toArray());
    //     // Log::info('Color images:', $variantColorImages->toArray());
    //     // Log::info('Size images:', $sizeImages->toArray());
    //     // Log::info('Packaging images:', $packagingImages->toArray());
    //     // Log::info('All images merged:', $allImages->toArray());
    //     // Log::info('Variant data:', $variantData->toArray());
    //     // Log::info('Item variants:', $item->variants->toArray());
    //     // Log::info('cart data:', Cart::where('user_id', auth()->id())->whereNotNull('customer_id')->get()->toArray());
    //     // Log::info('Sellers data:', $sellers->toArray());


    //     // dd($item->variants->pluck('image_path'));

    //     return view('seller.items.show', compact(

    //         'item',
    //         'sellers',
    //         'customersWithOpenCarts',
    //         'allImages',
    //         'variantData'
    //     ));
    // }

    public function show(Item $item)
    {
        $store = Auth::user()->store;
        $storeId = $store?->id;

        $sellerId = request('seller_id');      // optional
        $customerId = request('customer_id');  // optional

        // Load variants with all needed relations
        $item->load([
            'variants.itemColor',
            'variants.itemSize',
            'variants.itemPackagingType',
            'variants.storeVariants', // store-specific data
            'variants.owner',
        ]);

        Log::info('Loaded variants relations', [
            'variants' => $item->variants->toArray(),
        ]);

        $storeVariants = $item->variants
            ->flatMap(fn($v) => $v->storeVariants); // only one per variant now

        $minStoreVariant = $storeVariants
            ->filter(fn($sv) => $sv->computed_status === 'active')
            ->sortBy(fn($sv) => $sv->discount_price ?? $sv->price)
            ->first();



        // 🔹 Build item images
        $itemImages = collect();
        if ($item->product_images) {
            $decodedImages = json_decode($item->product_images, true);
            if (is_array($decodedImages)) {
                $itemImages = collect($decodedImages)
                    ->filter(fn($img) => !empty($img))
                    ->map(fn($img) => asset($img));
            }
        }

        $variantColorImages = $item->variants
            ->map(fn($v) => $v->itemColor?->image_path ? asset($v->itemColor->image_path) : null)
            ->filter(fn($img) => !empty($img) && $img !== url('/'))
            ->unique();

        $sizeImages = $item->variants
            ->map(fn($v) => $v->itemSize?->image_path ? asset($v->itemSize->image_path) : null)
            ->filter(fn($img) => !empty($img) && $img !== url('/'))
            ->unique();

        $packagingImages = $item->variants
            ->map(fn($v) => $v->itemPackagingType?->image_path ? asset($v->itemPackagingType->image_path) : null)
            ->filter(fn($img) => !empty($img) && $img !== url('/'))
            ->unique();

        $allImages = $itemImages
            ->merge($variantColorImages)
            ->merge($sizeImages)
            ->merge($packagingImages)
            ->filter(fn($img) => !empty($img))
            ->unique()
            ->values();

        // 🔹 Build enriched variant data using StoreVariant
        $variantData = $item->variants->map(function ($variant) use ($storeId, $sellerId, $customerId) {

            // XXXXXXXXX not first
            // Get the store-specific variant
            $storeVariant = $variant->storeVariants->where('store_id', $storeId)->first();

            // Stock, price, discount, status
            // XXXXXXXXX not .$storeVariant?->stock ?? 0; stock is in its on table
            $store_stock = $storeVariant?->stock ?? 0;
            // XXXXXXXXX not $variant->price; seller or customer ->>>>>> we have a price service
            $price = $storeVariant?->price ?? $variant->price;
            $discount_price = $storeVariant?->discount_price;
            // XXXXXXXXX not what is computed_status
            $status = $storeVariant?->computed_status ?? 'inactive';
            $store_active = $status === 'active';

            // Price ladder & final price
            $price_ladder = $storeVariant
                ? PriceProvider::getPriceLadder(
                        storeVariantId: $storeVariant->id,
                        storeId: $storeId,
                        sellerId: $sellerId,
                        customerId: $customerId
                    )
                : [];
            $final_price = $storeVariant ? PriceProvider::getFinalPrice($price_ladder) : null;

            // Decode variant images
            $rawImages = $variant->images;
            if (is_string($rawImages)) {
                $decoded = json_decode($rawImages, true);
                $rawImages = is_array($decoded) ? $decoded : [];
            }
            $variantImages = collect($rawImages)->map(fn($img) => str_starts_with($img, 'http') ? $img : asset($img));

            return [
                'id' => $variant->id,
                'color' => $variant->itemColor?->name,
                'img' => $variantImages->first() ?: ($variant->itemColor ? asset($variant->itemColor->image_path) : '/img/default.jpg'),
                'size' => $variant->itemSize?->name,
                'packaging' => $variant->itemPackagingType?->name,
                //use service provider
                'price' => $price,
                'discount_price' => $discount_price,
                'stock' => $store_stock,
                'status' => $status,
                'store_active' => $store_active,
                'images' => $variantImages->toArray(),
                'quantity' => $variant->calculateTotalPieces(),
                'price_ladder' => $price_ladder,
                'final_price' => $final_price,
            ];
        });

        // 🔹 Sellers and customers with open carts
        $sellers = User::where('role', 'seller')->get();
        $customersWithOpenCarts = Customer::whereHas('carts', fn($q) => $q->where('status', 'open'))->get();

        // 🔹 Return view with everything ready
        return view('seller.items.show', compact(
            'item',
            'sellers',
            'customersWithOpenCarts',
            'allImages',
            'variantData',
            'minStoreVariant'
        ));
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
