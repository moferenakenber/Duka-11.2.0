<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store;
use Illuminate\Http\Request;

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
        // Return a view showing items in this store
        $items = $store->items; // or whatever relationship you use
        return view('admin.stores.items', compact('store', 'items'));
    }



}
