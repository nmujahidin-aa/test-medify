<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Kategori</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            background: #f0f0f0;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>

<body>

<h2>DETAIL MASTER KATEGORI</h2>

<p>
    <strong>Nama Kategori:</strong> {{ $category->nama }} <br>
    <strong>Kode Kategori:</strong> {{ $category->kode }}
</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Item</th>
            <th>Nama Item</th>
            <th>Jenis</th>
            <th>Harga Beli</th>
            <th>Supplier</th>
        </tr>
    </thead>
    <tbody>
        @forelse($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jenis }}</td>
                <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                <td>{{ $item->supplier }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" align="center">
                    Tidak ada item pada kategori ini
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<footer>
    Dicetak pada: {{ $printed_at }}
</footer>

</body>
</html>
