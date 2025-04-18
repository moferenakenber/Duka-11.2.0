<?php

namespace App\Http\Controllers\Stockkeeper;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $items = Item::all();
        // return view('stock_keeper.items.index', compact('items'));
        $items = Item::all(); // Fetch all items
        return view('stock_keeper.orders.index', compact('items')); // Pass $items to the view
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
