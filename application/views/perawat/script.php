<script>
$(document).ready(function() {

    var table = $('#myTable').DataTable({
        'autoWidth': true,
        'order': [[0, 'desc']],
        "ajax": {
            "url": "<?= base_url('perawat/get_all_rekap_medis_group'); ?>",
            "dataSrc": function(result) {
                return result;
            },
        },
        "columns": [
            { "data": "tgl" },
            { "data": "nama_kk" },
            { 
                "data": null,
                "render": function ( data, type, row ) {
                    return '<button class="btn text-bg-primary mr-2" id="data_rekap_lihat">Lihat</button>';
                }
            },
        ],
    });

    $('#myTable').on('click', 'button#data_rekap_lihat', function() {
        var data = table.row($(this).parents('tr')).data();
        $.redirect("<?= base_url('perawat/detail/'); ?>", {
            "id_rekam_medik": data.id_rekam_medik,
            "no_kartu": data.no_kartu,
            "nama_kk": data.nama_kk,
            "id_pasien": data.id_pasien,
        });
    });

    if ("<?= $this->session->userdata('id_role'); ?>" == "7") {
        $("button#kembali_ke_auditor").click(function() {
            window.location.replace("<?= base_url('auditor/'); ?>");
        });
    }

});
</script>