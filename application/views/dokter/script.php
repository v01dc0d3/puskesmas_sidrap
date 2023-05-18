<script>
$(document).ready(function() {

    var table = $('#myTable').DataTable({
        'autoWidth': true,
        "ajax": {
            "url": "<?= base_url('dokter/get_all_rekap_medis_group'); ?>",
            "dataSrc": function(result) {
                return result;
            },
        },
        "columns": [
            { "data": "no_kartu" },
            { "data": "nama_kk" },
            { 
                "data": null,
                "render": function ( data, type, row ) {
                    return '<button class="btn text-bg-primary mr-2" id="data_rekap_detail">Detail</button>';
                }
            },
        ],
    });

    $('#myTable').on('click', 'button#data_rekap_detail', function() {
        var data = table.row($(this).parents('tr')).data();
        $.redirect("<?= base_url('dokter/detail/'); ?>", {
            "id_rekam_medik": data.id_rekam_medik,
            "no_kartu": data.no_kartu,
            "nama_kk": data.nama_kk,
            "id_pasien": data.id_pasien,
        });
    });

});
</script>