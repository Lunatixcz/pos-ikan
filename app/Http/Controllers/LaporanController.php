<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function generatePDF(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:pembelian,penjualan',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($type === 'pembelian') {
            $data = Pembelian::whereBetween('created_at', [$startDate, $endDate])->with('detail_pembelian.ikan', 'user', 'supplier')->get();
        } else {
            $data = Penjualan::whereBetween('created_at', [$startDate, $endDate])->with('detail_penjualan.ikan', 'user', 'customer')->get();
        }

        if ($data->isEmpty()) {
            return back()->with('error', 'No data found for the selected date range.');
        }

        $pdf = Pdf::loadView('pdf.report', compact('data', 'type', 'startDate', 'endDate'));

        return $pdf->download('report.pdf');
    }
}
