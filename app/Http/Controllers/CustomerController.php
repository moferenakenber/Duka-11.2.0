<?php

namespace App\Http\Controllers;

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
        $customers = Customer::with('user')->get();
        return view('customers.index', [
            'user' => $request->user(),
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
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