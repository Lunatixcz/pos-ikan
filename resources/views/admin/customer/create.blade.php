@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-4xl">Tambah Customer</h1>s
    </div>
    <div class="card shadow-sm mt-4">
        <form class="form" method="POST" action="{{ route('customer.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label text-right">Nama Customer</label>
                    <div class="col-lg-6">
                        <input type="text" name="nama_konsumen" class="form-control form-control-solid" placeholder="Masukkan nama konsumen..."/ required>
                    </div>
                </div>
                <div class="form-group row mt-12">
                    <label class="col-lg-3 col-form-label text-right">Jenis Kelamin</label>
                    <div class="col-lg-6">
                        <select class="form-select form-select-solid" aria-label="Select example" name="jenis_kelamin" required>
                            <option value="1">Laki-Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mt-12">
                    <label class="col-lg-3 col-form-label text-right">Alamat</label>
                    <div class="col-lg-6">
                        <textarea name="alamat" class="form-control form-control-solid" data-kt-autsize="true"></textarea>
                    </div>
                </div>
                <div class="form-group row mt-8">
                    <label class="col-lg-3 col-form-label text-right">E-mail</label>
                    <div class="col-lg-6">
                        <input type="email" name="email" class="form-control form-control-solid" placeholder="Masukkan alamat e-mail..."/ required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                        <a href="{{ route('customer.index') }}" class="btn btn-secondary mr-2">cancel</a>
                    </div>
                    <div class="col-lg-6 text-lg-right">
                        <button type="reset" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
