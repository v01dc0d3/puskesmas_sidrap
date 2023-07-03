<script>
$(document).ready(function() {

var table = $('#myTable').DataTable({
    'autoWidth': true,
    'order': [[0, 'desc']],
    "ajax": {
        "url": "<?= base_url('staf/get_all_rekam_medik_pasien_by_id_pasien'); ?>",
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
        { "data": "nik" },
        { "data": "nama_kk" },
        { 
            "data": null,
            "render": function ( data, type, row ) {
                return '<button class="btn text-bg-primary mr-2" id="data_rekam_detail">Detail</button><button class="btn text-bg-success mr-2" id="data_rekam_edit">Edit</button><button class="btn text-bg-danger mr-2" id="data_rekam_hapus">Hapus</button>';
            }
        },
    ],
});

$('button#tambah_rekam').click(function() {
    $("div.modal_crud").remove();

    $.ajax({
        url: '<?= base_url("staf/modal_body_tambah_rekam"); ?>',
        method: 'POST',
        data: {nama_kk: "<?= $nama_kk ?>"},
        success: function(result) {
            $("body").append(result);

            $('textarea#anamnesa').summernote({height: 200,});
            $('textarea#saran').summernote({height: 200,});

            $("div#modal_tambah_rekam").modal("show");

            $("button#tombol_tambah_rekam").click(function() {
                let anamnesa = $('textarea#anamnesa').val();
                let saran = $('textarea#saran').val();

                let tgl = new Date();
                tgl = tgl.getDate() + "/" + ( tgl.getMonth() + 1 ) + "/" + tgl.getFullYear();

                $.ajax({
                    url: '<?= base_url("staf/insert_data_rekam"); ?>',
                    method: 'POST',
                    data: {
                        'id_pasien': "<?= $id_pasien; ?>",
                        'no_kartu': "<?= $no_kartu; ?>",
                        'no': String(parseInt("<?= $no; ?>") + 1),
                        'tgl': tgl,
                        'anamnesa': anamnesa,
                        'saran': saran,
                    },
                    success: function(result) {
                        $("div#modal_tambah_rekam").modal("hide");
                        if (result == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Rekam Medik Telah Tertambah',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Data Rekam Medik Gagal Tertambah',
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

$('#myTable').on('click', 'button#data_rekam_hapus', function() {
    var data = table.row($(this).parents('tr')).data();
    
    Swal.fire({
        title: 'Yakin Menghapus Data?',
        showDenyButton: true,
        icon: 'info',
        showCancelButton: false,
        confirmButtonText: 'Ya',
        denyButtonText: `Tidak`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url("staf/delete_data_rekam_by_id/"); ?>',
                method: 'POST',
                data: {id_rmk: data.id_rmk},
                success: function(result) {
                    if (result == 1) {
                        Swal.fire({icon: 'success', title: 'Data Rekam Medik Pasien Berhasil Terhapus', showConfirmButton: false, timer: 1000});
                    } else {
                        Swal.fire({icon: 'error', title: 'Data Rekam Medik Pasien Gagal Terhapus', showConfirmButton: false, timer: 1000});
                    }
                    $('#myTable').DataTable().ajax.reload();
                },
            });
        } else if (result.isDenied) {
            Swal.fire('Data Tidak Berubah', '', 'info');
        }
    });
});

$('#myTable').on('click', 'button#data_rekam_detail', function() {
    var data = table.row($(this).parents('tr')).data();
    
    $("div.modal_crud").remove();
    $.ajax({
        url: '<?= base_url("staf/modal_body_detail_rekam"); ?>',
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

$('#myTable').on('click', 'button#data_rekam_edit', function() {
    var data = table.row($(this).parents('tr')).data();
    
    $("div.modal_crud").remove();
    $.ajax({
        url: '<?= base_url("staf/modal_body_edit_rekam"); ?>',
        success: function(result) {
            $("body").append(result);

            $('input#nama_pasien').val(data.nama_kk);
            $('input#tgl').val(data.tgl);

            $('textarea#anamnesa').summernote({height: 200,});
            $('textarea#anamnesa').summernote("code", data.anamnesa);

            $('textarea#saran').summernote({height: 200,});
            $('textarea#saran').summernote("code", data.saran);

            $("div#modal_edit_rekam").modal("show");

            $("button#tombol_edit_rekam").click(function() {
                let anamnesa = $('textarea#anamnesa').val();
                let saran = $('textarea#saran').val();

                $.ajax({
                    url: '<?= base_url("staf/edit_data_rekam"); ?>',
                    method: 'POST',
                    data: {
                        'id_rmk': data.id_rmk,
                        'id_pasien': data.id_pasien,
                        'no_kartu': data.no_kartu,
                        'no': data.no,
                        'tgl': data.tgl,
                        'anamnesa': anamnesa,
                        'saran': saran,
                    },
                    success: function(result) {
                        console.log(result);
                        $("div#modal_edit_rekam").modal("hide");
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

$("button#kembali_ke_staf").click(function() {
    window.location.replace("<?= base_url('staf/'); ?>");
});

});
</script>