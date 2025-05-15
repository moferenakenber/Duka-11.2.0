<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Item::query();

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'sold_asc':
                    $query->orderBy('sold_count', 'asc');
                    break;
                case 'sold_desc':
                    $query->orderBy('sold_count', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('product_name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('product_name', 'desc');
                    break;
            }
        }

        $items = $query->paginate(300); // Add pagination if needed

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
    public function show(Item $item)
    {
        // $item->load([
        //     'variants.itemColor',
        //     'variants.itemSize',
        //     'variants.itemPackagingType',
        //     'variants.owner',
        // ]);

        // Ensure item has variants
        $item->load(['variants']);

        // Add dd() to inspect the data
        //dd($item->variants); // This will dump the variants and stop the execution

        $sellers = User::where('role', 'seller')->get(); // assuming sellers have 'seller' role
        return view('seller.items.show', compact('item', 'sellers'));
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
