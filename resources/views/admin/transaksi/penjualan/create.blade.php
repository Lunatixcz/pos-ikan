@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-4xl">Penjualan Baru</h1>
</div>
<div class="card shadow-sm mt-4">
    <form class="form" id="penjualanForm" method="POST" action="{{ route('penjualan.store') }}">
        @csrf

        <div class="card-body">
            {{-- customer section --}}
            <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. customer Info:</h3>
            <div class="mb-15">
                <div class="form-group row mb-4">
                    <label class="col-lg-3 col-form-label">Full Name:</label>
                    <div class="col-lg-6">
                        <select name="id_customer" id="id_customer" class="form-control">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->nama_konsumen }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($customers->isEmpty())
                    <div class="col-lg-3">
                        <a href="{{ route('customer.index') }}" class="btn btn-sm btn-primary">Add customer</a>
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
                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary mr-2">Cancel</a>
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
        const customerSelect = document.getElementById('id_customer');
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
            if (!customerSelect.value) {
                alert('Please select a customer first.');
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
                    customerSelect.disabled = false;
                }
            });
        });

        document.getElementById('penjualanForm').addEventListener('submit', function (e) {
            if (items.length === 0) {
                alert('Please add at least one item.');
                e.preventDefault();
                return;
            }

            // Append customer_id to the form before submitting
            const customerId = document.getElementById('id_customer').value;
            const customerIdInput = `<input type="hidden" name="customer_id" value="${customerId}">`;
            this.insertAdjacentHTML('beforeend', customerIdInput);

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
