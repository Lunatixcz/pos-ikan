@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-4xl">Stok Ikan</h1>
        <a href="{{ route('ikan.create') }}" class="btn btn-light-primary">Tambah Ikan Baru</a>
    </div>
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 px-7">
                        <th>Nama Ikan</th>
                        <th>Kuantitas</th>
                        <th>Harga Ikan</th>
                        <th>Kategori Ikan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($ikans as $ikan )
                    <tr>
                        <td>{{ $ikan->nama }}</td>
                        <td>{{ $ikan->jumlah_ikan }}</td>
                        <td>{{ $ikan->harga_ikan }}</td>
                        <td>{{ $ikan->category }}</td>
                        <td>
                            <a href="" class="btn btn-light-warning">Edit</a>
                            <a href="" class="btn btn-light-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#kt_datatable_dom_positioning").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom":
                    "<'row mb-2'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start dt-toolbar'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });
        });
    </script>
@endsection
