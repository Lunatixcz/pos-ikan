<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::get();
        return view('admin.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'email' => 'required|email|',
        ]);

        $supplier = new Supplier();
        $supplier->nama_supplier = $validatedData['nama_supplier'];
        $supplier->jenis_kelamin = $validatedData['jenis_kelamin'];
        $supplier->alamat = $validatedData['alamat'];
        $supplier->email = $validatedData['email'];

        $supplier->save();

        return redirect()->route('supplier.index')->with('success', 'Supplier added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('admin.supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validatedData = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'email' => 'required|email|',
        ]);

        $supplier->nama_supplier = $validatedData['nama_supplier'];
        $supplier->jenis_kelamin = $validatedData['jenis_kelamin'];
        $supplier->alamat = $validatedData['alamat'];
        $supplier->email = $validatedData['email'];

        $supplier->save();

        // Redirect to the index or another relevant page with a success message
        return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('supplier.index')->with('succcess', 'Supplier Deleted Successfully');
    }
}
