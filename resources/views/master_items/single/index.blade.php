@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="mb-3">
                <a href="{{ url('master-items') }}" class="btn btn-outline-secondary">
                    ← Kembali ke Daftar Item
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Detail Master Item</h5>
                </div>

                <div class="card-body">

                    <div class="text-center mb-4">
                        @if(!empty($data->images))
                            <img src="{{ asset('storage/'.$data->images) }}"
                                 alt="Foto {{ $data->nama }}"
                                 class="img-fluid rounded shadow"
                                 style="max-height: 250px;">
                        @else
                            <div class="text-muted fst-italic">
                                Tidak ada foto produk
                            </div>
                        @endif
                    </div>

                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th width="35%">Nama</th>
                                <td>{{ $data->nama }}</td>
                            </tr>
                            <tr>
                                <th>Harga Beli</th>
                                <td>Rp {{ number_format($data->harga_beli, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Laba</th>
                                <td>{{ $data->laba }} %</td>
                            </tr>
                            <tr>
                                <th>Harga Jual</th>
                                <td class="fw-bold text-success">
                                    Rp {{ number_format($data->harga_beli + ($data->harga_beli * $data->laba / 100), 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Supplier</th>
                                <td>{{ $data->supplier }}</td>
                            </tr>
                            <tr>
                                <th>Jenis</th>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $data->jenis }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ url('master-items/form/edit/'.$data->id) }}"
                        class="btn btn-warning">
                            ✏️ Edit
                        </a>
                        <form action="{{ url('master-items/delete/'.$data->id) }}"
                            method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                🗑 Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
