<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use App\Models\Ikan;
use App\Models\Pembelian;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelians = Pembelian::with('supplier')->get();
        return view('admin.transaksi.pembelian.index', compact('pembelians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::get();
        $ikans = Ikan::get();
        return view('admin.transaksi.pembelian.create', compact('suppliers', 'ikans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create Pembelian record
        $pembelian = Pembelian::create([
            'id_pembelian' => $this->generateIdPembelian(),
            'id_supplier' => $request->input('id_supplier'),
            'total_transaksi' => 0,
            'id_admin' => auth()->id(),
        ]);

        $totalTransaksi = 0;

        // Process each item in the transaction
        foreach ($request->input('items') as $item) {
            // Calculate total price for the item
            $totalPrice = $item['quantity'] * $item['price'];

            // Create DetailPembelian record
            DetailPembelian::create([
                'id_pembelian' => $pembelian->id,
                'id_ikan' => $item['id_ikan'],
                'quantity' => $item['quantity'],
                'price' => $totalPrice,
            ]);

            // Update stock quantity of the Ikan
            $ikan = Ikan::findOrFail($item['id_ikan']);
            $ikan->increment('jumlah_ikan', $item['quantity']);

            // Accumulate total transaction amount
            $totalTransaksi += $totalPrice;
        }

        // Update total_transaksi in Pembelian record
        $pembelian->update(['total_transaksi' => $totalTransaksi]);

        return redirect()->route('pembelian.index')->with('success', 'Pembelian created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembelian $pembelian)
    {
        return view('admin.transaksi.pembelian.show', compact('pembelian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {
    //     $pembelian = Pembelian::with('detail_pembelian')->findOrFail($id);
    //     $suppliers = Supplier::all(); // Assuming Supplier model exists
    //     $ikans = Ikan::all(); // Assuming Ikan model exists

    //     return view('admin.transaksi.pembelian.edit', compact('pembelian', 'suppliers', 'ikans'));
    // }

    // public function update(Request $request, $id)
    // {
    //     // Validate request
    //     $request->validate([
    //         'id_supplier' => 'required|exists:suppliers,id',
    //         'items' => 'required|array',
    //         'items.*.id_ikan' => 'required|exists:ikans,id',
    //         'items.*.quantity' => 'required|integer|min:1',
    //     ]);

    //     // Update Pembelian
    //     $pembelian = Pembelian::findOrFail($id);
    //     $pembelian->update([
    //         'id_supplier' => $request->input('id_supplier'),
    //     ]);

    //     // Process items
    //     foreach ($request->input('items') as $item) {
    //         if (isset($item['delete']) && $item['delete']) {
    //             // Delete item and deduct stock
    //             $this->deleteItemAndDeductStock($item['id_detail_pembelian'], $item['id_ikan'], $item['quantity']);
    //         } elseif (isset($item['id_detail_pembelian'])) {
    //             // Update existing item
    //             $this->updateItem($item['id_detail_pembelian'], $item['id_ikan'], $item['quantity']);
    //         } else {
    //             // Insert new item
    //             $this->insertNewItem($pembelian->id, $item['id_ikan'], $item['quantity']);
    //         }
    //     }

    //     return redirect()->route('pembelian.index')->with('success', 'Pembelian updated successfully.');
    // }

    // private function deleteItemAndDeductStock($idDetailPembelian, $idIkan, $quantity)
    // {
    //     // Delete DetailPembelian
    //     DetailPembelian::findOrFail($idDetailPembelian)->delete();

    //     // Deduct stock from Ikan
    //     $ikan = Ikan::findOrFail($idIkan);
    //     $ikan->decrement('jumlah_ikan', $quantity);
    // }

    // private function updateItem($idDetailPembelian, $idIkan, $quantity)
    // {
    //     // Update DetailPembelian (if needed)
    //     DetailPembelian::findOrFail($idDetailPembelian)->update([
    //         'id_ikan' => $idIkan,
    //         'quantity' => $quantity,
    //         // Update other fields as needed
    //     ]);

    //     // Update stock (if needed)
    //     // You might choose to handle stock updates differently here
    // }

    // private function insertNewItem($idPembelian, $idIkan, $quantity)
    // {
    //     // Insert new DetailPembelian
    //     DetailPembelian::create([
    //         'id_pembelian' => $idPembelian,
    //         'id_ikan' => $idIkan,
    //         'quantity' => $quantity,
    //         // Add other fields as needed
    //     ]);

    //     // Update stock of Ikan
    //     $ikan = Ikan::findOrFail($idIkan);
    //     $ikan->increment('jumlah_ikan', $quantity);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembelian = Pembelian::findOrFail($id);

        foreach ($pembelian->detail_pembelian as $detail) {
            $ikan = Ikan::findOrFail($detail->id_ikan);
            $ikan->jumlah_ikan -= $detail->quantity;
            $ikan->save();
        }

        $pembelian->detail_pembelian()->delete();

        $pembelian->delete();

        return redirect()->route('pembelian.index')->with('success');
    }

    private function generateIdPembelian()
    {
        $date = now();
        $formattedDate = $date->format('ymd');
        $count = Pembelian::whereDate('created_at', $date)->count() + 1;
        return "PB/{$formattedDate}-{$count}";
    }
}
