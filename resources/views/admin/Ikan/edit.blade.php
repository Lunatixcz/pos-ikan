@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-4xl">Edit Ikan <strong>{{ $ikan->nama }}</strong></h1>
    </div>
    <div class="card shadow-sm mt-4">
        <form class="form" method="POST" action="{{ route('ikan.update', $ikan) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label text-right">Nama Ikan</label>
                    <div class="col-lg-6">
                        <input type="text" name="nama_ikan" class="form-control form-control-solid" value="{{ $ikan->nama }}" required>
                    </div>
                </div>
                <div class="form-group row mt-12">
                    <label class="col-lg-3 col-form-label text-right">Category</label>
                    <div class="col-lg-6">
                        <select class="form-select form-select-solid" aria-label="Select example" name="category_ikan" required>
                            <option value="{{ $ikan->category }}">{{ \App\Enums\CategoryType::from($ikan->category)->name }}</option>
                            @foreach ($categoryTypes as $categoryType)
                                <option value="{{ $categoryType->value }}">{{ $categoryType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mt-12">
                    <label class="col-lg-3 col-form-label text-right">Harga Ikan</label>
                    <div class="col-lg-6">
                        <div class="input-group input-group-solid mb-5">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"/ name="harga_ikan" required>
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-8">
                    <label class="col-lg-3 col-form-label text-right">Jumlah Ikan</label>
                    <div class="col-lg-6">
                        <input type="number" name="jumlah_ikan" class="form-control form-control-solid" placeholder="Masukkan stock sekarang"/ required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                        <a href="{{ route('ikan.index') }}" class="btn btn-secondary mr-2">cancel</a>
                    </div>
                    <div class="col-lg-6 text-lg-right">
                        <button type="reset" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
