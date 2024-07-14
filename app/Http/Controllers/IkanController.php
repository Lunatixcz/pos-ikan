<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Models\Ikan;
use Illuminate\Http\Request;

class IkanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ikans = Ikan::get();
        return view('Ikan.index', compact('ikans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('costumer.create');
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
    public function show(Ikan $ikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ikan $ikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ikan $ikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ikan $ikan)
    {
        //
    }
}
