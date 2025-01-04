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
        //$customers = Customer::with('user')->get(); // Fetch all customers and eager load the 'user' relationship

        // Eager load the 'user' relationship
        $customers = Customer::with('creator')->get();
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
        $validatedCustomer = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone_number' => 'required|string|regex:/^[0-9]{10}$/|unique:users,phone_number',
            'city' => 'nullable|string',
        ]);

        // Check if the current authenticated user ID is set
        //dd(auth()->id());  // This should show the ID of the logged-in user

        // Manually add the created_by field with the authenticated user's ID
        $validatedCustomer['created_by'] = auth()->id();

        // Capitalize the first letter of each word in the city (if provided)
        if (!empty($validatedCustomer['city'])) {
            $validatedCustomer['city'] = \Illuminate\Support\Str::title($validatedCustomer['city']);
        }


        // Create the customer record using the validated data
        Customer::create($validatedCustomer);

        // Customer::create([
        //     'name' => $validatedCustomer['name'],
        //     'email' => $validatedCustomer['email'],
        //     'phone_number' => $validatedCustomer['phone_number'],
        //     'city' => $validatedCustomer['city'],
        //     'created_by' => auth()->id(),
        // ]);

        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //$customers = Customer::with('user')->get(); // Retrieve all customers with the 'user' relationship
        //$customer = Customer::with('user')->findOrFail($id); // Load a single customer with the 'user' relationship
        $customers = Customer::with('creator')->get();

        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'city' => 'required|string|max:255',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($validated);

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);

        // Optional: Check if the customer has associated data that needs cleanup
        // For example:
        // if ($customer->orders()->exists()) {
        //     return redirect()->back()->with('error', 'Cannot delete a customer with existing orders.');
        // }

        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully.');
    }
}
