@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-4xl">Supplier</h1>
        <a href="{{ route('supplier.create') }}" class="btn btn-light-primary">Tambah Supplier</a>
    </div>
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 px-7">
                        <th>Nama Supplier</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Ditambahkan pada</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->nama_supplier }}</td>
                        <td>
                            @if ($supplier->jenis_kelamin == 1)
                                Laki-Laki
                            @else
                                Perempuan
                            @endif
                        </td>
                        <td>{{ $supplier->alamat }}</td>
                        <td>{{ $supplier->email}}</td>
                        <td>{{ $supplier->created_at }}</td>
                        <td>
                            <a href="{{ route('supplier.show', $supplier) }}" class="btn btn-light-primary">Detail</a>
                            <a href="{{ route('supplier.edit', $supplier) }}" class="btn btn-light-warning">Edit</a>
                            <button type="button" class="btn btn-light-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-supplier-id="{{ $supplier->id }}" data-supplier-name="{{ $supplier->nama_supplier }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
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
                    <p>Yakin ingin menghapus <strong id="supplierName"></strong>?</p>
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
                var supplierId = button.data('supplier-id'); // Extract info from data-* attributes
                var supplierName = button.data('supplier-name');

                var modal = $(this);
                modal.find('#supplierName').text(supplierName); // Set the supplier name in the modal
                var action = "{{ route('supplier.destroy', ':id') }}".replace(':id', supplierId); // Set the form action
                modal.find('#deleteForm').attr('action', action);
            });
        });
    </script>
    @endpush
@endsection
