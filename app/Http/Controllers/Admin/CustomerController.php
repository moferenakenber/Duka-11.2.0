<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;


//         GET /customers – index (list all customers)
//         GET /customers/create – create (show form to create a new customer)
//         POST /customers – store (save new customer)
//         GET /customers/{customer} – show (show a single customer)
//         GET /customers/{customer}/edit – edit (show form to edit a customer)
//         PUT/PATCH /customers/{customer} – update (update an existing customer)
//         DELETE /customers/{customer} – destroy (delete a customer)




class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$customers = Customer::with('user')->get();
        $customers = Customer::with('user')->get(); // Fetch all customers and eager load the 'user' relationship
        //$customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = new Customer();

        $validatedCustomer =$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone_number' => 'required|string|regex:/^[0-9]{10}$/|unique:users,phone_number',
            'city' => 'nullable|string',
        ]);

        // dd($request->all()); // Check if form data is being received

        $customer = Customer::create([
            'name' => $validatedCustomer['name'],
            'email' => $validatedCustomer['email'],
            'phone_number' => $validatedCustomer['phone_number'],
            'city' => $validatedCustomer['city'],
            'created_by' => auth()->id(), // Set the authenticated user's ID
        ]);

        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully.');
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
