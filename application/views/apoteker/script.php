<script>
$(document).ready(function() {

var table = $('#myTable').DataTable({
    'autoWidth': true,
    'order': [[1, 'desc']],
    "ajax": {
        "url": "<?= base_url('apoteker/get_all_resep_obat'); ?>",
        "dataSrc": function(result) {
            return result;
        },
    },
    "columns": [
        { "data": "tgl" },
        { "data": "status" },
        { "data": "nama_kk" },
        { 
            "data": null,
            "render": function ( data, type, row ) {
                return '<button class="btn text-bg-primary mr-2" id="edit_resep_obat">Edit</button>';
            }
        },
    ],
});

$('#myTable').on('click', 'button#edit_resep_obat', function() {
    var data = table.row($(this).parents('tr')).data();
    
    $("div.modal_crud").remove();
    $.ajax({
        url: '<?= base_url("apoteker/modal_body_edit_resep_obat"); ?>',
        success: function(result) {
            $("body").append(result);

            $('input#nama_pasien').val(data.nama_kk);
            $('input#tgl').val(data.tgl);

            $('textarea#resep').summernote({height: 200, toolbar: false});
            $('textarea#resep').summernote("disable");
            $('textarea#resep').summernote("code", data.resep);

            $('select#status').val(data.status);

            $("div#modal_edit_resep_obat").modal("show");

            $("button#tombol_edit_resep").click(function() {
                let status = $('select#status').val();

                $.ajax({
                    url: '<?= base_url("apoteker/edit_resep_obat_apoteker"); ?>',
                    method: 'POST',
                    data: {id: data.id, status: status},
                    success: function(result) {
                        console.log(result);
                        $("div#modal_edit_resep_obat").modal("hide");
                        if (result == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Rekam Medik Telah Terdit',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Data Rekam Medik Gagal Terdit',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                        $('#myTable').DataTable().ajax.reload();
                    }
                });
            });
        }
    });
});

});
</script>