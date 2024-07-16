@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl">Cetak Laporan</h1>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('generate.pdf') }}" method="GET">
            @csrf
            <div class="form-group row mb-4">
                <label class="col-lg-3 col-form-label" for="type">Select Type:</label>
                <div class="col-lg-6">
                    <select id="type" name="type" required class="form-control form-control-solid">
                        <option value="pembelian">Pembelian</option>
                        <option value="penjualan">Penjualan</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-4">
                <label class="col-lg-3 col-form-label" for="start_date">Start Date:</label>
                <div class="col-lg-6">
                    <input class="form-control form-control-solid" type="date" id="start_date" name="start_date" required>
                </div>
            </div>

            <div class="form-group row mb-4">
                <label class="col-lg-3 col-form-label" for="end_date">End Date:</label>
                <div class="col-lg-6">
                    <input class="form-control form-control-solid" type="date" id="end_date" name="end_date" required>
                </div>
            </div>

            <div class="form-group row mb-4">
                <div class="col-lg-9 text-right">
                    <button type="submit" class="btn btn-primary">Generate PDF</button>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection
