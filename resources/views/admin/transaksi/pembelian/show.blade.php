@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl">Detail Transaksi <strong>{{ $pembelian->id_pembelian }}</strong></h1>
        {{-- <a href="{{ route('pembelian.edit', $pembelian) }}" class="btn btn-light-primary">Edit Pembelian</a> --}}
    </div>
    <div class="card shadow-sm mt-4">
        <div class="card-body text-start">
            <div class="p-4 text-3xl">
                <div class="flex flex-row mb-8 space-x-4">
                    <div class="flex flex-col col-3">
                        <label class="text-gray-700 text-lg">ID : </label>
                        <div class="text-black font-medium">{{ $pembelian->id_pembelian }}</div>
                    </div>
                    <div class="flex flex-col col-3">
                        <label class="text-gray-700 text-lg">Ditambahkan oleh :</label>
                        <div class="text-black font-medium">{{ $pembelian->user->name}}</div>
                    </div>
                    <div class="flex flex-col col-3">
                        <label class="text-gray-700 text-lg">Ditambahkan pada : </label>
                        <div class="text-black font-medium">{{ $pembelian->created_at }}</div>
                    </div>
                    <div class="flex flex-col col-3">
                        <label class="text-gray-700 text-lg">Nama Supplier : </label>
                        <div class="text-black font-medium">{{ $pembelian->supplier->nama_supplier}}</div>
                    </div>
                </div>
                <div class="border-t border-gray-300 my-4"></div>
                <h1 class="text-3xl font-medium mb-4">List Item</h1>
                <table class="table table-striped text-lg">
                    <thead>
                        <tr>
                            <th>Jenis Ikan</th>
                            <th>Jumlah</th>
                            <th>Harga/Satuan</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian->detail_pembelian as $detail )
                        <tr>
                            <td>{{ $detail->ikan->nama }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>Rp {{ number_format(($detail->price/$detail->quantity), 0, ',', '.') }}</td>
                            <td>Rp {{ number_format(($detail->price), 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-end items-center mb-4 me-12">
                    <label class="text-gray-700 text-lg mr-2">Total Transaksi :</label>
                    <div class="text-black font-medium">Rp {{ number_format($pembelian->total_transaksi, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
