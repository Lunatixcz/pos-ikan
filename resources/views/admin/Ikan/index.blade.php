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
                @foreach ($ikans as $ikan)
                    <tr>
                        <td>{{ $ikan->nama }}</td>
                        <td>{{ $ikan->jumlah_ikan }}</td>
                        <td>{{ $ikan->harga_ikan }}</td>
                        <td>{{ \App\Enums\CategoryType::from($ikan->category)->name }}</td>
                        <td>
                            <a href="{{ route('ikan.edit', $ikan) }}" class="btn btn-light-warning">Edit</a>
                            <button type="button" class="btn btn-light-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-ikan-id="{{ $ikan->id }}" data-ikan-name="{{ $ikan->nama }}">
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
                    <p>Yakin ingin menghapus <strong id="ikanName"></strong>?</p>
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
                var ikanId = button.data('ikan-id'); // Extract info from data-* attributes
                var ikanName = button.data('ikan-name');

                var modal = $(this);
                modal.find('#ikanName').text(ikanName); // Set the fish name in the modal
                var action = "{{ route('ikan.destroy', ':id') }}".replace(':id', ikanId); // Set the form action
                modal.find('#deleteForm').attr('action', action);
            });
        });
    </script>
    @endpush
@endsection
