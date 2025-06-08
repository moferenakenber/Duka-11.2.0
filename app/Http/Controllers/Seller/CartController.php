<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Admin\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemVariant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use App\Models\User;
use Illuminate\Support\Facades\DB;




// HTTP Verb	URI	                    Action	  Route Name

// GET	        /carts	                index	  carts.index
// GET	        /carts/create        	create	  carts.create
// POST	        /carts	                store	  carts.store
// GET	        /carts/{cart}	        show	  carts.show
// GET	        /carts/{cart}/edit	    edit	  carts.edit
// PUT/PATCH	/carts/{cart}	        update	  carts.update
// DELETE	    /carts/{carts}	        destroy   carts.destroy


class CartController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all carts for the authenticated user
        // $carts = auth()->user()->carts; // assuming relationship is defined in User model
        // Fetch all carts along with their associated customer
        // Check if the authenticated user is an admin


        // if (auth()->user()->role === 'admin') {
        //     // If the user is an admin, fetch all carts for all users
        //     $carts = Cart::with('customer')->get(); // Assuming Cart has a relationship with Customer
        // } else {
        //     // If the user is not an admin, fetch only the carts of the authenticated user
        //     $carts = auth()->user()->carts()->with('customer')->get();
        // }

        // $carts = Cart::with('customer')->get();
        // $carts = auth()->user()->carts()->with('customer')->get();
        if (auth()->user()->role === 'admin') {
            $carts = Cart::with('customer')->get(); // all carts
            return view('admin.carts.index', compact('carts'));
        } else {
            $carts = auth()->user()->carts()->with('customer')->get(); // only current user's carts
            return view('seller.carts.index', compact('carts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all(); // Get all customers
        $sellers = User::where('role', 'seller')->get(); // assuming sellers have 'seller' role
        return view('seller.carts.create', compact('customers', 'sellers'));

    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // Validate input
    //     $request->validate([
    //         'customer_id' => 'nullable|exists:customers,id', // Ensure customer_id is valid if provided
    //     ]);

    //     // Create the cart
    //     $cart = Cart::create([
    //         'user_id' => auth()->id(), // Ensure the cart is created by the authenticated user
    //         'customer_id' => $request->customer_id, // Store the customer_id if selected, otherwise it will be null
    //     ]);

    //     // Redirect to the created cart's details page with success message
    //     return redirect()->route('admin.carts.show', $cart->id)
    //                      ->with('success', 'Cart created successfully!');
    // }
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'customer_id' => 'required|exists:customers,id', // Ensure customer_id is provided and valid
            //'seller_id'=> 'required|exists:sellers,id',
            'seller_id' => 'required|exists:users,id,role,seller', // Ensure seller_id is valid and belongs to a seller
        ]);

        // Create the cart
        $cart = Cart::create([
            'user_id' => auth()->id(), // Ensure the cart is created by the authenticated user
            'customer_id' => $request->customer_id, // Set customer_id if provided
            'seller_id' => $request->seller_id, // Set seller_id if provided
        ]);

        // Redirect to the created cart's details page with success message
        // return redirect()->route('admin.carts.show', $cart->id)
        //                  ->with('success', 'Cart created successfully!');
        // Redirect or return response
        //return redirect()->route('admin.carts.index')->with('success', 'Cart created successfully!');
        // Redirect to the cart's detail page with a success message
        return redirect()->route('seller.carts.index')->with('success', 'Cart created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        // Ensure the authenticated user owns the cart
        $this->authorize('view', $cart);

        // Eager load the items related to this cart
        $cart->load('items');

        return view('seller.carts.show', compact('cart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        // Ensure the authenticated user owns the cart
        $this->authorize('update', $cart);

        return view('seller.carts.edit', compact('cart'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Cart $cart)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'status' => 'required|in:pending,completed,canceled',
    //     ]);

    //     // Update the cart details
    //     $cart->update([
    //         'name' => $request->name,
    //         'status' => $request->status,
    //     ]);

    //     // Redirect back to the cart index page with a success message
    //     return redirect()->route('admin.carts.index')->with('success', 'Cart updated successfully!');
    // }

    public function update(Request $request, Cart $cart)
    {
        // Validate input
        $request->validate([
            'customer_id' => 'required|exists:customers,id', // Ensure customer_id is provided and valid
        ]);

        // Update the cart
        $cart->update([
            'customer_id' => $request->customer_id, // Update the customer_id
        ]);

        // Redirect to the updated cart's details page with success message
        return redirect()->route('seller.carts.show', $cart->id)
            ->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        // Ensure the authenticated user owns the cart
        $this->authorize('delete', $cart);

        // Delete the cart
        $cart->delete();

        // Redirect back to the cart index page with a success message
        return redirect()->route('admin.seller.index')->with('success', 'Cart deleted successfully!');
    }


    // Method to create a new cart or add an item to an existing cart
    public function addItem(Request $request, $itemId)
    {
        $item = Item::findOrFail($itemId);

        // Check if the user selected an existing cart or want to create a new one
        if ($request->filled('cart_id')) {
            // Add item to an existing cart
            $cart = Cart::findOrFail($request->input('cart_id'));
        } else {
            // If no cart selected, create a new cart
            $cart = Cart::create([
                'user_id' => auth()->id(),
            ]);
        }

        // Add the item to the cart (using the pivot table)
        $cart->items()->attach($item->id, [
            'quantity' => $request->input('quantity'),
            'price' => $item->price,
        ]);

        // Optionally, log the action
        Log::info('Item added to cart', [
            'cart_id' => $cart->id,
            'item_id' => $item->id,
            'quantity' => $request->input('quantity'),
        ]);

        // Redirect back to the cart or item list
        return redirect()->route('admin.carts.show', $cart->id)->with('success', 'Item added to cart!');
    }
    // Store an item in the cart
    public function storeItem(Request $request, Cart $cart)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the item
        $item = Item::findOrFail($request->item_id);

        // Add the item to the cart with its quantity and price
        $cart->items()->attach($item->id, [
            'quantity' => $request->quantity,
            'price' => $item->price, // Store the price of the item in the pivot table
        ]);

        // Redirect back to the cart show page with a success message
        return redirect()->route('seller.carts.show', $cart->id)->with('success', 'Item added to cart!');
    }

    // public function add(Request $request)
    // {


    //     $request->validate([
    //         'variant_id' => 'required|exists:item_variants,id',
    //         'quantity' => 'required|integer|min:1',
    //         'size' => 'nullable|string', // optional
    //     ]);

    //     $cart = auth()->user()->currentCart(); // however you get the current cart

    //     $variant = ItemVariant::findOrFail($request->variant_id);

    //     $cart->items()->create([
    //         // 'item_id' => $request->item_id,
    //         // 'quantity' => $request->quantity,
    //         // 'price' => Item::find($request->item_id)->price,
    //         // 'options' => json_encode([
    //         //     'size' => $request->size,
    //         // ]),
    //         'item_variant_id' => $variant->id],
    //     [
    //         'quantity' => \DB::raw("quantity + {$request->quantity}"),
    //         'price' => $variant->price,

    //     ]);

    //     return redirect()->back()->with('success', 'Item added to cart!');
    // }

    public function add(Request $request)
    {
        Log::info('Add method called', ['request' => $request->all()]);

        $request->validate([
            'variant_id' => 'required|exists:item_variants,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
        ]);

        $cart = auth()->user()->currentCart();

        Log::info('Current cart retrieved', ['cart_id' => $cart->id ?? null]);

        $variantId = $request->variant_id;
        $quantityToAdd = $request->quantity;

        $variant = ItemVariant::findOrFail($variantId);
        Log::info('Variant found', ['variant_id' => $variant->id, 'price' => $variant->price]);

        $existing = $cart->items()->wherePivot('item_variant_id', $variantId)->first();

        if ($existing) {
            $currentQuantity = $existing->pivot->quantity;
            Log::info('Variant already in cart, updating quantity', [
                'variant_id' => $variantId,
                'old_quantity' => $currentQuantity,
                'added_quantity' => $quantityToAdd,
            ]);
            $cart->items()->updateExistingPivot($variantId, [
                'quantity' => $currentQuantity + $quantityToAdd,
                'price' => $variant->price,
            ]);
        } else {
            Log::info('Attaching new variant to cart', [
                'variant_id' => $variantId,
                'quantity' => $quantityToAdd,
                'price' => $variant->price,
            ]);
            $cart->items()->attach($variantId, [
                'quantity' => $quantityToAdd,
                'price' => $variant->price,
            ]);
        }

        Log::info('Add method completed successfully');

        return redirect()->back()->with('success', 'Item added to cart!');
    }


}
