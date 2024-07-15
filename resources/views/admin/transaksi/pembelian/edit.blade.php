@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-4xl">Edit Pembelian</h1>
</div>
<div class="card shadow-sm mt-4">
    <form class="form" id="pembelianForm" method="POST" action="{{ route('pembelian.update', $pembelian->id) }}">
        @csrf
        @method('PUT')

        <div class="card-body">
            {{-- Supplier section --}}
            <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Supplier Info:</h3>
            <div class="mb-15">
                <div class="form-group row mb-4">
                    <label class="col-lg-3 col-form-label">Full Name:</label>
                    <div class="col-lg-6">
                        <select name="id_supplier" id="id_supplier" class="form-control">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ $supplier->id == $pembelian->id_supplier ? 'selected' : '' }}>
                                    {{ $supplier->nama_supplier }}
                                </option>
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

            {{-- Item section --}}
            <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. List Barang</h3>
            <div class="mb-3">
                <div class="form-group row mb-4">
                    <label class="col-lg-3 col-form-label">Jenis Ikan</label>
                    <div class="col-lg-6">
                        <select name="items[0][id_ikan]" id="id_ikan" class="form-control">
                            <option value="">Choose Ikan...</option>
                            @foreach ($ikans as $ikan)
                                <option value="{{ $ikan->id }}">{{ $ikan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-lg-3 col-form-label">Jumlah</label>
                    <div class="col-lg-6">
                        <input type="number" class="form-control form-control-solid" name="items[0][quantity]">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-lg-3 col-form-label">Harga</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control form-control-solid price-input" name="items[0][price]" placeholder="Harga/Satuan">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-lg-9 text-right">
                        <button type="button" id="add-item-btn" class="btn btn-sm btn-primary">Add Item</button>
                    </div>
                </div>
            </div>

            {{-- Table section --}}
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
                        @foreach ($pembelian->detail_pembelian as $detail)
                            <tr>
                                <td>{{ $detail->ikan->nama }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>Rp{{ number_format($detail->price/$detail->quantity, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($detail->price, 0, ',', '.') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger remove-item-btn">Remove</button>
                                    <input type="hidden" name="items[{{ $detail->id }}][id_detail_pembelian]" value="{{ $detail->id }}">
                                    <input type="hidden" name="items[{{ $detail->id }}][delete]" value="1">
                                </td>
                            </tr>
                        @endforeach
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
        const addItemBtn = document.getElementById('add-item-btn');
        const itemsTableBody = document.getElementById('items-table-body');
        let itemCount = {{ count($pembelian->detail_pembelian) }};

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
            const ikanSelect = document.getElementById('id_ikan');
            const quantityInput = document.querySelector('input[name="items[0][quantity]"]');
            const priceInput = document.querySelector('input[name="items[0][price]"]');

            if (!ikanSelect.value || !quantityInput.value || !priceInput.value) {
                alert('Please fill out all item fields.');
                return;
            }

            const itemRow = document.createElement('tr');
            const total = parseInt(quantityInput.value) * parseInt(priceInput.value.replace(/\./g, ''));

            itemRow.innerHTML = `
                <td>${ikanSelect.options[ikanSelect.selectedIndex].text}</td>
                <td>${quantityInput.value}</td>
                <td>Rp${priceInput.value}</td>
                <td>Rp${total.toLocaleString()}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger remove-item-btn">Remove</button>
                    <input type="hidden" name="items[new_${itemCount}][id_ikan]" value="${ikanSelect.value}">
                    <input type="hidden" name="items[new_${itemCount}][quantity]" value="${quantityInput.value}">
                    <input type="hidden" name="items[new_${itemCount}][price]" value="${priceInput.value.replace(/\./g, '')}">
                </td>
            `;

            itemsTableBody.appendChild(itemRow);
            itemCount++;

            ikanSelect.value = '';
            quantityInput.value = '';
            priceInput.value = '';

            itemRow.querySelector('.remove-item-btn').addEventListener('click', function () {
                itemRow.remove();
            });
        });
    });
</script>
@endpush
@endsection
