<form method="POST" enctype="multipart/form-data">
    @csrf
    @if($method == 'edit')
    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text" class="form-control" name="kode_barang" required readonly value="{{$item->kode ?? ''}}">
    </div>
    @endif


    <div class="form-group">
        <label>Foto</label>
        <input type="file" class="form-control" name="images" accept="image/*">
        @if(!empty($item->images))
            <img src="{{ asset('storage/'.$item->images) }}"
                alt="Foto Barang"
                style="max-width: 200px; margin-top: 10px;">
        @endif
    </div>

    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" required  value="{{$item->nama ?? ''}}">
    </div>

    <div class="form-group">
        <label>Harga Beli</label>
        <input type="number" class="form-control" name="harga_beli" required  value="{{$item->harga_beli ?? ''}}">
    </div>

    <div class="form-group">
        <label>Laba (dalam persen)</label>
        <input type="number" class="form-control" name="laba" required  value="{{$item->laba ?? ''}}">
    </div>

    @php $supplier = old('supplier', $item->supplier ?? ''); @endphp
    <div class="form-group">
        <label>Supplier</label>
        <select class="form-control" required name="supplier">
            <option>=== Pilih ===</option>
            @foreach(['Tokopaedi', 'Bukulapuk', 'TokoBagas', 'E Commurz', 'Blublu'] as $s)
                <option value="{{ $s }}" @selected($supplier == $s)>{{ $s }}</option>
            @endforeach
        </select>
    </div>

    @php $jenis = old('jenis', $item->jenis ?? ''); @endphp
    <div class="form-group">
        <label>Jenis</label>
        <select class="form-control" required name="jenis">
            <option>=== Pilih ===</option>
            @foreach(['Obat', 'Alkes', 'Matkes', 'Umum', 'ATK'] as $j)
                <option value="{{ $j }}" @selected($jenis == $j)>{{ $j }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Kategori</label>
        @php
            $selectedKategori = old(
                'kategori_id',
                $item->category?->pluck('id')->toArray() ?? []
            );
        @endphp

        <select name="kategori_id[]" class="form-control" multiple>
            @foreach($category as $cat)
                <option value="{{ $cat->id }}"
                    @selected(in_array($cat->id, $selectedKategori))>
                    {{ $cat->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary mt-3">Submit</button>

</form>