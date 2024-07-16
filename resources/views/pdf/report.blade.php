<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2, h3 {
            margin-bottom: 0.5em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1em;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h1>Report from {{ $startDate }} to {{ $endDate }}</h1>

    @if($type === 'pembelian')
        <h2>Pembelian</h2>
        @foreach($data as $pembelian)
            <h3>Transaksi {{ $pembelian->id_pembelian }}</h3>
            <p>Ditambahkan oleh: {{ $pembelian->user->name }}</p>
            <p>Ditambahkan pada: {{ $pembelian->created_at }}</p>
            <p>Nama Supplier: {{ $pembelian->supplier->nama_supplier }}</p>
            <table>
                <thead>
                    <tr>
                        <th>Jenis Ikan</th>
                        <th>Jumlah</th>
                        <th>Harga/Satuan</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembelian->detail_pembelian as $detail)
                        <tr>
                            <td>{{ $detail->ikan->nama }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>Rp {{ number_format(($detail->price / $detail->quantity), 0, ',', '.') }}</td>
                            <td>Rp {{ number_format(($detail->price), 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p>Total Transaksi: Rp {{ number_format($pembelian->total_transaksi, 0, ',', '.') }}</p>
            <hr>
        @endforeach
    @elseif($type === 'penjualan')
        <h2>Penjualan</h2>
        @foreach($data as $penjualan)
            <h3>Transaksi {{ $penjualan->id_penjualan }}</h3>
            <p>Ditambahkan oleh: {{ $penjualan->user->name }}</p>
            <p>Ditambahkan pada: {{ $penjualan->created_at }}</p>
            <p>Nama Customer: {{ $penjualan->customer->nama_konsumen }}</p>
            <table>
                <thead>
                    <tr>
                        <th>Jenis Ikan</th>
                        <th>Jumlah</th>
                        <th>Harga/Satuan</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan->detail_penjualan as $detail )
                    <tr>
                        <td>{{ $detail->ikan->nama }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>Rp {{ number_format(($detail->price/$detail->quantity), 0, ',', '.') }}</td>
                        <td>Rp {{ number_format(($detail->price), 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p>Total Transaksi: Rp {{ number_format($penjualan->total_penjualan, 0, ',', '.') }}</p>
            <hr>
        @endforeach
    @endif
</body>
</html>
