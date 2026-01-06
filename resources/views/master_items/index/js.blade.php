<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script>
let table;
function formatRupiah(angka) {
    return Number(angka || 0).toLocaleString('id-ID');
}

$(document).ready(function () {

    table = $('#table-master').DataTable({
        searching: false,
        ordering: true,
        order: [[0, 'desc']],
        responsive: true,
        columnDefs: [
            { orderable: false, targets: [6] }
        ]
    });

    getData();
});

$(document).on('click', '.btn-get-data', function () {
    getData();
});

function getData() {
    $('#loading-filter').show();

    table.clear().draw();

    $.ajax({
        url: '{{ route("master-items.search") }}',
        type: 'GET',
        dataType: 'json',
        data: {
            kode: $('#filter-kode').val(),
            nama: $('#filter-nama').val(),
            hargamin: $('#filter-harga-min').val(),
            hargamax: $('#filter-harga-max').val()
        },
        success: function (response) {

            if (!response.data || response.data.length === 0) {
                $('#loading-filter').hide();
                return;
            }

            response.data.forEach(function (item) {

                const hargaJual =
                    item.harga_beli + (item.harga_beli * item.laba / 100);

                table.row.add([
                    item.kode ?? '-',
                    item.nama ?? '-',
                    item.jenis ?? '-',
                    formatRupiah(item.harga_beli),
                    formatRupiah(Math.round(hargaJual)),
                    item.supplier ?? '-',
                    `<a href="{{ url('master-items/view') }}/${item.kode}"
                        class="btn btn-sm btn-outline-primary">
                        👁 View
                    </a>`
                ]);
            });

            table.draw();
            $('#loading-filter').hide();
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            alert('Terjadi kesalahan server');
            $('#loading-filter').hide();
        }
    });
}
</script>
