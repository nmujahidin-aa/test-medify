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

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
