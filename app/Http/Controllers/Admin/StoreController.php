<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\ItemVariant;
use App\Models\ItemStock;

class StoreController extends Controller
{
    // Display a listing of the stores
    public function index()
    {
        $stores = Store::latest()->paginate(20); // or all() if you prefer
        return view('admin.stores.index', compact('stores'));
    }

    // Show the form for creating a new store
    public function create()
    {
        return view('admin.stores.create');
    }

    // Store a newly created store in storage
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

    // Show the specified store
    public function show(Store $store)
    {
        return view('admin.stores.show', compact('store'));
    }

    // Show the form for editing the store
    public function edit(Store $store)
    {
        return view('admin.stores.edit', compact('store'));
    }

    // Update the specified store
    public function update(Request $request, Store $store)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive',
        ]);

        $store->update($data);

        return redirect()->route('admin.stores.index')->with('success', 'Store updated successfully.');
    }

    // Remove the specified store
    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->route('admin.stores.index')->with('success', 'Store deleted successfully.');
    }

    public function items(Store $store)
    {
        // Get all items that have at least one variant in this store
        $items = \App\Models\Item::whereHas('variants.storeVariants', function ($q) use ($store) {
            $q->where('store_id', $store->id);
        })->get();

        return view('admin.stores.items', compact('store', 'items'));
    }



    public function itemVariants(Store $store, $itemId)
    {
        $variants = \App\Models\ItemVariant::where('item_id', $itemId)
            ->with([
                'item',
                'itemColor',
                'itemSize',
                'itemPackagingType',
                'stores' => function ($q) use ($store) {
                    $q->where('store_id', $store->id);
                },
            ])
            ->get();

        $item = \App\Models\Item::findOrFail($itemId);

        return view('admin.stores.item_variants', compact('store', 'item', 'variants'));
    }




}
