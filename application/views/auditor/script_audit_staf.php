<script>
$(document).ready(function() {

var table = $('#myTable').DataTable({
    'autoWidth': true,
    "ajax": {
        "url": "<?= base_url('auditor/get_all_last_rekam_medik_pasien'); ?>",
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
                return '<button class="btn text-bg-primary mr-2" id="data_rekam_lihat">Lihat</button>';
            }
        },
    ],
});

$('#myTable').on('click', 'button#data_rekam_lihat', function() {
    var data = table.row($(this).parents('tr')).data();

    $.redirect("<?= base_url('auditor/staf_lihat/'); ?>", {
        id_pasien: data.id_pasien,
        no_kartu: data.no_kartu,
        nama_kk: data.nama_kk,
        no: data.no,
    });

});

$("button#kembali_ke_auditor").click(function() {
    window.location.replace("<?= base_url('auditor/'); ?>");
});

});
</script>