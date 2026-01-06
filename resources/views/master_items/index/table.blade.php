<div class="table-responsive">
    <table id="table-master" class="table table-bordered table-hover align-middle w-100">
        <thead class="table-dark text-center">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th class="text-end">Harga Beli</th>
                <th class="text-end">Harga Jual</th>
                <th>Supplier</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($items as $item)
            <tr>
                <td class="text-center fw-semibold">{{ $item->kode }}</td>
                
                <td class="text-center fw-semibold">{{ $item->nama }}</td>

                <td>
                    <span class="badge bg-info text-dark">
                        {{ $item->jenis }}
                    </span>
                </td>

                <td class="text-end">
                    Rp {{ number_format($item->harga_beli, 0, ',', '.') }}
                </td>

                <td class="text-end fw-bold text-success">
                    Rp {{ number_format($item->harga_beli + ($item->harga_beli * $item->laba / 100), 0, ',', '.') }}
                </td>

                <td>{{ $item->supplier }}</td>

                <td class="text-center">
                    <a href="{{ url('master-items/view/'.$item->kode) }}"
                       class="btn btn-outline-primary btn-sm">
                        👁 View
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-4">
                    <i>Tidak ada data master item</i>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
