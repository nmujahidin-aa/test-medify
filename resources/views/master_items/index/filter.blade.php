<div id="filter-container">
    <h4>Filter</h4>
    <div class="row">
        <div class="col-3">
            <div class="form-group" id="filter-container">
                <label>Kode</label>
                <input type="text" class="form-control" id="filter-kode" name="kode">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group" id="filter-container">
                <label>Nama</label>
                <input type="text" class="form-control" id="filter-nama" name="nama">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group" id="filter-container">
                <label>Harga Min</label>
                <input type="number" class="form-control" id="filter-harga-min" name="hargamin">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group" id="filter-container">
                <label>Harga Max</label>
                <input type="number" class="form-control" id="filter-harga-max" name="hargamax">
            </div>
        </div>

        <div class="col-2">
            <label>Kategori</label>
            <select name="kategori_id" id="filter-kategori" class="form-control">
                <option>Pilih</option>
                @foreach($category as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button class="btn btn-primary mt-1 btn-get-data">Filter</button>
    <span id="loading-filter" style="display: none;">Loading...</span>
</div>