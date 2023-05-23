<script>
$(document).ready(function() {

var table = $('#myTable').DataTable({
    'autoWidth': true,
    'order': [[0, 'desc']],
    "ajax": {
        "url": "<?= base_url('auditor/get_all_rekam_medik_pasien_by_id_pasien'); ?>",
        "method": "POST",
        "data": {
            "id_pasien": "<?= $id_pasien; ?>",
            "no_kartu": "<?= $no_kartu; ?>",
            "nama_kk": "<?= $nama_kk; ?>",
        },
        "dataSrc": function(result) {
            return result;
        },
    },
    "columns": [
        { "data": "tgl" },
        { "data": "no_kartu" },
        { "data": "nama_kk" },
        { 
            "data": null,
            "render": function ( data, type, row ) {
                return '<button class="btn text-bg-primary mr-2" id="data_rekam_detail">Detail</button>';
            }
        },
    ],
});

$('#myTable').on('click', 'button#data_rekam_detail', function() {
    var data = table.row($(this).parents('tr')).data();
    
    $("div.modal_crud").remove();
    $.ajax({
        url: '<?= base_url("auditor/modal_body_detail_rekam"); ?>',
        success: function(result) {
            $("body").append(result);

            $('input#nama_pasien').val(data.nama_kk);
            $('input#tgl').val(data.tgl);

            $('textarea#anamnesa').summernote({height: 200, toolbar: false});
            $('textarea#anamnesa').summernote("disable");
            $('textarea#anamnesa').summernote("code", data.anamnesa);

            $('textarea#saran').summernote({height: 200, toolbar: false});
            $('textarea#saran').summernote("disable");
            $('textarea#saran').summernote("code", data.saran);

            $("div#modal_detail_rekam").modal("show");
        }
    });
});

$("button#kembali_ke_staf").click(function() {
    window.location.replace("<?= base_url('auditor/staf/'); ?>");
});

});
</script>