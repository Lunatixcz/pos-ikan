<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DetailPenjualan;
use App\Models\Ikan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualans = Penjualan::with('customer')->get();
        return view('admin.transaksi.penjualan.index', compact('penjualans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::get();
        $ikans = Ikan::get();
        return view('admin.transaksi.penjualan.create', compact('customers', 'ikans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $penjualan = Penjualan::create([
            'id_penjualan' => $this->generateIdPembelian(),
            'id_customer' => $request->input('id_customer'),
            'total_penjualan' => 0,
            'id_admin' => auth()->id(),
        ]);

        $totalPenjualan = 0;

        // Process each item in the transaction
        foreach ($request->input('items') as $item) {
            // Calculate total price for the item
            $totalPrice = $item['quantity'] * $item['price'];

            // Create DetailPembelian record
            DetailPenjualan::create([
                'id_penjualan' => $penjualan->id,
                'id_ikan' => $item['id_ikan'],
                'quantity' => $item['quantity'],
                'price' => $totalPrice,
            ]);

            // Update stock quantity of the Ikan
            $ikan = Ikan::findOrFail($item['id_ikan']);
            $ikan->decrement('jumlah_ikan', $item['quantity']);

            // Accumulate total transaction amount
            $totalPenjualan += $totalPrice;
        }

        // Update total_transaksi in Pembelian record
        $penjualan->update(['total_penjualan' => $totalPenjualan]);

        $customers = Customer::findOrFail($request->input('id_supplier'));
        $customers->increment('total_transaksi', $totalPrice);

        return redirect()->route('penjualan.index')->with('success', 'Penjualan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        return view('admin.transaksi.penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        foreach ($penjualan->detail_pembelian as $detail) {
            $ikan = Ikan::findOrFail($detail->id_ikan);
            $ikan->jumlah_ikan += $detail->quantity;
            $ikan->save();
        }

        $penjualan->detail_penjualan()->delete();

        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success');
    }

    private function generateIdPembelian()
    {
        $date = now();
        $formattedDate = $date->format('ymd');
        $count = Penjualan::whereDate('created_at', $date)->count() + 1;
        return "PJ/{$formattedDate}-{$count}";
    }
}
