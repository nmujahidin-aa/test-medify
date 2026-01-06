@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="mb-3">
                <a href="{{ route('category-items.index') }}" class="btn btn-outline-secondary">
                    ← Kembali ke Daftar Item
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Detail Kategori Item</h5>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th width="35%">Kode</th>
                                <td>{{ $data->kode }}</td>
                            </tr>
                            <tr>
                                <th width="35%">Nama</th>
                                <td>{{ $data->nama }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ url('category-items/form/edit/'.$data->id) }}"
                        class="btn btn-warning">
                            ✏️ Edit
                        </a>
                        <a href="{{ route('category-items.print', $data->id) }}" class="btn btn-danger">
                        🧾 Download PDF
                        </a>
                        <form action="{{ url('category-items/delete/'.$data->id) }}"
                            method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                🗑 Delete
                            </button>
                        </form>
                    </div>

                    <hr>
                    <h6 class="mb-3 fw-semibold">Daftar Produk dalam Kategori Ini</h6>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th width="5%">No</th>
                                    <th>Kode Item</th>
                                    <th>Nama Item</th>
                                    <th>Jenis</th>
                                    <th class="text-end">Harga Beli</th>
                                    <th>Supplier</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data->masterItems as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                            <span class="badge bg-info text-dark">
                                                {{ $item->jenis }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            Rp {{ number_format($item->harga_beli, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $item->supplier }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            Tidak ada produk pada kategori ini
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
