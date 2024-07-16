@extends('layouts.app')

@section('content')
<div class="flex-grow text-center mb-12">
    <h1 class="text-5xl lg:text-7xl font-bold mb-3">Dashboard</h1>
    <h1 class="text-2xl lg:text-2xl">Welcome to Asna Seafood</h1>
</div>
<div class="card shadow-sm ">
    <div class="card-header">
        <div class="card-title">Jenis-Jenis Ikan</div>
    </div>
    <div class="card-body">
        <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 px-7">
                    <th>Nama Ikan</th>
                    <th>Kuantitas</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($ikans as $ikan)
                <tr>
                    <td>{{ $ikan->nama }}</td>
                    <td>{{ $ikan->jumlah_ikan }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
