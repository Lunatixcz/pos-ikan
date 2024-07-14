@extends('layouts.app')

@section('content')
<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-4xl">Create New Fish</h1>
        <a href="{{ route('ikan.index') }}" class="btn btn-light-primary">Back to List</a>
    </div>
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <form action="{{ route('ikan.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="form-label">Nama Ikan</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="harga_ikan" class="form-label">Harga Ikan</label>
                    <input type="number" name="harga_ikan" id="harga_ikan" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="category" class="form-label">Kategori Ikan</label>
                    <input type="text" name="category" id="category" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</x-app-layout>
@endsection
