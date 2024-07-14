<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Models\Ikan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class IkanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ikans = Ikan::get();
        return view('admin.Ikan.index', compact('ikans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryTypes = CategoryType::cases();
        return view('admin.Ikan.create', compact('categoryTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_ikan' => 'required|string|max:255',
            'category_ikan' => ['required', new Enum(CategoryType::class)],
            'harga_ikan' => 'required|numeric',
            'jumlah_ikan' => 'required|integer',
        ]);

        $ikan = new Ikan();
        $ikan->nama = $validatedData['nama_ikan'];
        $ikan->category = $validatedData['category_ikan'];
        $ikan->harga_ikan = $validatedData['harga_ikan'];
        $ikan->jumlah_ikan = $validatedData['jumlah_ikan'];
        $ikan->save();

        // Redirect to the ikan index page
        return redirect()->route('ikan.index')->with('success', 'Ikan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ikan $ikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ikan $ikan)
    {
        $categoryTypes = CategoryType::cases();
        return view('admin.Ikan.edit', compact('ikan', 'categoryTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ikan $ikan)
    {
        $ikan->nama = $request->input('nama_ikan');
        $ikan->category = $request->input('category_ikan');
        $ikan->harga_ikan = $request->input('harga_ikan');
        $ikan->jumlah_ikan = $request->input('jumlah_ikan');
        $ikan->save();

        return redirect()->route('ikan.index')->with('success', 'Ikan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ikan $ikan)
    {
        $ikan->delete();

        return redirect()->route('ikan.index')->with('success', 'Ikan berhasil dihapus!');
    }
}
