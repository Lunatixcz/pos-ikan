@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-4xl">Detail Customer <strong>{{ $customer->nama_konsumen }}</strong></h1>
        <a href="{{ route('customer.edit', $customer) }}" class="btn btn-light-primary">Edit Customer</a>
    </div>
    <div class="card shadow-sm mt-4">
        <div class="card-body text-start">
            <div class="p-4 text-3xl">
                <div class="flex flex-col mb-8">
                    <label class="text-gray-700 text-lg">Nama:</label>
                    <div class="text-black font-medium">{{ $customer->nama_konsumen }}</div>
                </div>
                <div class="flex flex-col mb-8">
                    <label class="text-gray-700 text-lg">Jenis Kelamin:</label>
                    <div class="text-black font-medium">
                        @if ($customer->jenis_kelamin == 1)
                            Laki-Laki
                        @else
                            Perempuan
                        @endif
                    </div>
                </div>
                <div class="flex flex-col mb-8">
                    <label class="text-gray-700 text-lg">Alamat:</label>
                    <div class="text-black font-medium">{{ $customer->alamat }}</div>
                </div>
                <div class="flex flex-col mb-8">
                    <label class="text-gray-700 text-lg">E-mail:</label>
                    <div class="text-black font-medium">{{ $customer->email }}</div>
                </div>
                <div class="flex flex-col mb-8">
                    <label class="text-gray-700 text-lg">Total Transaksi: </label>
                    <div class="text-black font-medium">Rp {{ number_format($customer->total_transaksi, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
