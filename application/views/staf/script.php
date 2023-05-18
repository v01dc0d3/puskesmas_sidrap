<script>
$(document).ready(function() {

var table = $('#myTable').DataTable({
    'autoWidth': true,
    "ajax": {
        "url": "<?= base_url('staf/get_all_last_rekam_medik_pasien'); ?>",
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
                return '<button class="btn text-bg-primary mr-2" id="data_rekam_atur">Atur</button>';
            }
        },
    ],
});

$('#myTable').on('click', 'button#data_rekam_atur', function() {
    var data = table.row($(this).parents('tr')).data();

    $.redirect("<?= base_url('staf/atur/'); ?>", {
        id_pasien: data.id_pasien,
        no_kartu: data.no_kartu,
        nama_kk: data.nama_kk,
        no: data.no,
    });

});

});
</script>