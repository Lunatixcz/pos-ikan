@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-4xl">Detail Supplier <strong>{{ $supplier->nama_supplier }}</strong></h1>
        <a href="{{ route('supplier.edit', $supplier) }}" class="btn btn-light-primary">Edit Supplier</a>
    </div>
    <div class="card shadow-sm mt-4">
        <div class="card-body text-start">
            <div class="p-4 text-3xl">
                <div class="flex flex-col mb-8">
                    <label class="text-gray-700 text-lg">Nama:</label>
                    <div class="text-black font-medium">{{ $supplier->nama_supplier }}</div>
                </div>
                <div class="flex flex-col mb-8">
                    <label class="text-gray-700 text-lg">Jenis Kelamin:</label>
                    <div class="text-black font-medium">
                        @if ($supplier->jenis_kelamin == 1)
                            Laki-Laki
                        @else
                            Perempuan
                        @endif
                    </div>
                </div>
                <div class="flex flex-col mb-8">
                    <label class="text-gray-700 text-lg">Alamat:</label>
                    <div class="text-black font-medium">{{ $supplier->alamat }}</div>
                </div>
                <div class="flex flex-col mb-8">
                    <label class="text-gray-700 text-lg">E-mail:</label>
                    <div class="text-black font-medium">{{ $supplier->email }}</div>
                </div>
                <div class="flex flex-col mb-8">
                    <label class="text-gray-700 text-lg">Total Transaksi: </label>
                    <div class="text-black font-medium">Rp {{ number_format($supplier->total_transaksi, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
