@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-4xl">Penjualan</h1>
        <a href="{{ route('penjualan.create') }}" class="btn btn-light-primary">Tambah Penjualan</a>
    </div>
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 px-7">
                        <th>ID Penjualan</th>
                        <th>Nama Customer</th>
                        <th>Total Transaksi</th>
                        <th>Ditambahkan pada</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($penjualans as $penjualan)
                    <tr>
                        <td>{{ $penjualan->id_penjualan }}</td>
                        <td>{{ $penjualan->customer->nama_konsumen}}</td>
                        <td>Rp {{ number_format(($penjualan->total_penjualan), 0, ',', '.') }}</td>
                        <td>{{ $penjualan->created_at }}</td>
                        <td>
                            <a href="{{ route('penjualan.show', $penjualan) }}" class="btn btn-light-primary">Detail</a>
                            {{-- <a href="{{ route('penjualan.edit', $penjualan) }}" class="btn btn-light-warning">Edit</a> --}}
                            <button type="button" class="btn btn-light-danger"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    data-penjualan-id="{{ $penjualan->id }}" data-penjualan-name="{{ $penjualan->id_penjualan }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Confirm Deletion</h3>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus <strong id="penjualanName"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
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

            // Handle delete button click
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var penjualanId = button.data('penjualan-id'); // Extract info from data-* attributes
                var penjualanName = button.data('penjualan-name');

                var modal = $(this);
                modal.find('#penjualanName').text(penjualanName); // Set the penjualan name in the modal
                var action = "{{ route('penjualan.destroy', ':id') }}".replace(':id', penjualanId); // Set the form action
                modal.find('#deleteForm').attr('action', action);
            });
        });
    </script>
    @endpush
@endsection
