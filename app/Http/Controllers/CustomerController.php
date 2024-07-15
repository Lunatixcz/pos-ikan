<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::get();
        return view('admin.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'email' => 'required|email|',
        ]);

        $customer = new Customer();
        $customer->nama_konsumen = $validatedData['nama_konsumen'];
        $customer->jenis_kelamin = $validatedData['jenis_kelamin'];
        $customer->alamat = $validatedData['alamat'];
        $customer->email = $validatedData['email'];

        $customer->save();

        return redirect()->route('customer.index')->with('success', 'konsumen added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('admin.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('admin.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validatedData = $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'email' => 'required|email|',
        ]);

        $customer->nama_konsumen = $validatedData['nama_konsumen'];
        $customer->jenis_kelamin = $validatedData['jenis_kelamin'];
        $customer->alamat = $validatedData['alamat'];
        $customer->email = $validatedData['email'];

        $customer->save();

        // Redirect to the index or another relevant page with a success message
        return redirect()->route('customer.index')->with('success', 'konsumen updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customer.index')->with('succcess', 'konsumen Deleted Successfully');
    }
}
