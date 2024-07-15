@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-4xl">Pembelian Baru</h1>
</div>
<div class="card shadow-sm mt-4">
    <form class="form" id="pembelianForm" method="POST" action="{{ route('pembelian.store') }}">
        @csrf

        <div class="card-body">
            {{-- supplier section --}}
            <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Supplier Info:</h3>
            <div class="mb-15">
                <div class="form-group row mb-4">
                    <label class="col-lg-3 col-form-label">Full Name:</label>
                    <div class="col-lg-6">
                        <select name="id_supplier" id="id_supplier" class="form-control">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($suppliers->isEmpty())
                    <div class="col-lg-3">
                        <a href="{{ route('supplier.index') }}" class="btn btn-sm btn-primary">Add Supplier</a>
                    </div>
                    @endif
                </div>
            </div>
            {{-- item section --}}
            <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. List Barang</h3>
            <div class="mb-3">
                <div class="form-group row mb-4">
                    <label class="col-lg-3 col-form-label">Jenis Ikan</label>
                    <div class="col-lg-6">
                        <select name="id_ikan" id="id_ikan" class="form-control">
                            @foreach ($ikans as $ikan)
                                <option value="{{ $ikan->id }}">{{ $ikan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-lg-3 col-form-label">Jumlah</label>
                    <div class="col-lg-6">
                        <input type="number" class="form-control form-control-solid" name="quantity[]">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-lg-3 col-form-label">Harga</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control form-control-solid price-input" name="price[]" placeholder="Harga/Satuan">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-lg-9 text-right">
                        <button type="button" id="add-item-btn" class="btn btn-sm btn-primary">Add Item</button>
                    </div>
                </div>
            </div>
            {{-- table section --}}
            <div class="mb-15">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Jenis Ikan</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="items-table-body">
                        <!-- Items will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <a href="{{ route('pembelian.index') }}" class="btn btn-secondary mr-2">Cancel</a>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <button type="reset" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const supplierSelect = document.getElementById('id_supplier');
        const addItemBtn = document.getElementById('add-item-btn');
        const itemsTableBody = document.getElementById('items-table-body');
        let items = [];

        function formatRupiah(angka) {
            let numberString = angka.replace(/[^,\d]/g, '').toString();
            let split = numberString.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah;
        }

        document.querySelectorAll('.price-input').forEach(function (input) {
            input.addEventListener('input', function (e) {
                this.value = formatRupiah(this.value);
            });
        });

        addItemBtn.addEventListener('click', function () {
            if (!supplierSelect.value) {
                alert('Please select a supplier first.');
                return;
            }

            const ikanSelect = document.getElementById('id_ikan');
            const quantityInput = document.querySelector('input[name="quantity[]"]');
            const priceInput = document.querySelector('input[name="price[]"]');

            if (!ikanSelect.value || !quantityInput.value || !priceInput.value) {
                alert('Please fill out all item fields.');
                return;
            }

            const itemRow = document.createElement('tr');
            const total = (parseInt(quantityInput.value) * parseInt(priceInput.value.replace(/\./g, ''))).toFixed(0);

            // Get the selected jenis ikan ID directly
            const ikanId = ikanSelect.value;

            itemRow.innerHTML = `
                <td data-ikan-id="${ikanId}">${ikanSelect.options[ikanSelect.selectedIndex].text}</td>
                <td>${quantityInput.value}</td>
                <td>Rp${priceInput.value}</td>
                <td>Rp${total.replace(/\B(?=(\d{3})+(?!\d))/g, '.')}</td>
                <td><button type="button" class="btn btn-sm btn-danger remove-item-btn">Remove</button></td>
            `;

            itemsTableBody.appendChild(itemRow);
            items.push(itemRow);

            ikanSelect.value = '';
            quantityInput.value = '';
            priceInput.value = '';

            itemRow.querySelector('.remove-item-btn').addEventListener('click', function () {
                itemRow.remove();
                items = items.filter(i => i !== itemRow);
                if (items.length === 0) {
                    supplierSelect.disabled = false;
                }
            });
        });

        document.getElementById('pembelianForm').addEventListener('submit', function (e) {
            if (items.length === 0) {
                alert('Please add at least one item.');
                e.preventDefault();
                return;
            }

            // Append supplier_id to the form before submitting
            const supplierId = document.getElementById('id_supplier').value;
            const supplierIdInput = `<input type="hidden" name="supplier_id" value="${supplierId}">`;
            this.insertAdjacentHTML('beforeend', supplierIdInput);

            items.forEach((itemRow, index) => {
                const cells = itemRow.querySelectorAll('td');
                const ikanId = cells[0].getAttribute('data-ikan-id'); // Get the data-ikan-id attribute

                const quantity = cells[1].innerText;
                const price = cells[2].innerText.replace(/[^0-9]/g, '');

                console.log(ikanId);

                const itemData = `
                    <input type="hidden" name="items[${index}][id_ikan]" value="${ikanId}">
                    <input type="hidden" name="items[${index}][quantity]" value="${quantity}">
                    <input type="hidden" name="items[${index}][price]" value="${price}">
                `;
                this.insertAdjacentHTML('beforeend', itemData);
            });
        });
    });
</script>
@endpush
@endsection
