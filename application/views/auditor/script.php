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
        { "data": "nik" },
        { "data": "nama_kk" },
        { 
            "data": null,
            "render": function ( data, type, row ) {
                return '<button class="btn text-bg-primary mr-2" id="auditor_dokter">Dokter</button><button class="btn text-bg-info text-light mr-2" id="auditor_perawat">Perawat</button><button class="btn text-bg-success mr-2" id="auditor_staf">Staf</button><button class="btn text-bg-warning text-light mr-2" id="auditor_apoteker">Apoteker</button>';
            }
        },
    ],
});

$('#myTable').on('click', 'button#auditor_dokter', function() {
    var data = table.row($(this).parents('tr')).data();
    $.redirect("<?= base_url('auditor/dokter/'); ?>", {
        "id_rekam_medik": data.id_rekam_medik,
        "no_kartu": data.no_kartu,
        "nama_kk": data.nama_kk,
        "id_pasien": data.id_pasien,
    });

});

$('#myTable').on('click', 'button#auditor_perawat', function() {
    var data = table.row($(this).parents('tr')).data();
    $.redirect("<?= base_url('perawat/'); ?>", {
        "id_rekam_medik": data.id_rekam_medik,
        "no_kartu": data.no_kartu,
        "nama_kk": data.nama_kk,
        "id_pasien": data.id_pasien,
    });

});

$('#myTable').on('click', 'button#auditor_staf', function() {
    var data = table.row($(this).parents('tr')).data();
    $.redirect("<?= base_url('auditor/staf/'); ?>", {
        "id_rekam_medik": data.id_rekam_medik,
        "no_kartu": data.no_kartu,
        "nama_kk": data.nama_kk,
        "id_pasien": data.id_pasien,
    });

});

$('#myTable').on('click', 'button#auditor_apoteker', function() {
    var data = table.row($(this).parents('tr')).data();
    $.redirect("<?= base_url('auditor/apoteker/'); ?>", {
        "id_rekam_medik": data.id_rekam_medik,
        "no_kartu": data.no_kartu,
        "nama_kk": data.nama_kk,
        "id_pasien": data.id_pasien,
    });

});

});
</script>