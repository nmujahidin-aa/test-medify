<div class="table-responsive">
    <table id="table-kategori" class="table table-bordered table-hover align-middle w-100">
        <thead class="table-dark text-center">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($category as $index => $row)
            <tr>
                <td class="text-center fw-semibold">{{ $row->kode }}</td>

                <td class="fw-semibold">{{ $row->nama }}</td>

                <td class="text-center">
                    <a href="{{ url('category-items/view/'.$row->kode) }}"
                       class="btn btn-outline-primary btn-sm">
                        👁 View
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-4">
                    <i>Tidak ada data kategori item</i>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
