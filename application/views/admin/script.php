<script>
$(document).ready(function() {

    var table = $('#myTable').DataTable({
        'autoWidth': true,
        'order': [[0, 'desc']],
        "ajax": {
            "url": "<?= base_url('admin/get_all_page_access'); ?>",
            "dataSrc": function(result) {
                return result;
            },
        },
        "columns": [
            { "data": "id" },
            { "data": "pagename" },
            { "data": "rolename" },
            { 
                "data": null,
                "render": function ( data, type, row ) {
                    return '<button class="btn text-bg-danger mr-2" id="hapus_akses">Hapus</button>';
                }
            },
        ],
    });

    $('#myTable').on('click', 'button#hapus_akses', function() {
        var data = table.row($(this).parents('tr')).data();

        Swal.fire({
            title: 'Yakin ingin menghapus akses?',
            showDenyButton: true,
            icon: 'info',
            showCancelButton: false,
            confirmButtonText: 'Ya',
            denyButtonText: `Tidak`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url("admin/delete_akses/"); ?>',
                        method: 'POST',
                        data: {id: data.id},
                        success: function(result) {
                            if (result == 1) {
                                Swal.fire({icon: 'success', title: 'Data Akses Halaman Berhasil Terhapus', showConfirmButton: false, timer: 1000});
                            } else {
                                Swal.fire({icon: 'error', title: 'Data Akses Halaman Gagal Terhapus', showConfirmButton: false, timer: 1000});
                            }
                            $('#myTable').DataTable().ajax.reload();
                        },
                    });
                } else if (result.isDenied) {
                    Swal.fire('Data Tidak Berubah', '', 'info');
                }
        });
    });


    $("button#tambah_akses_halaman").click(function(){
        $("div.modal_crud").remove();

        $.ajax({
            url: '<?= base_url("admin/modal_body_tambah_akses_halaman"); ?>',
            success: function(result) {
                $("body").append(result);

                $('select#pilih_halaman').select2({theme: "bootstrap", dropdownParent: $('#modal_tambah_halaman .modal-content'), placeholder: "Nama Halaman"});
                $("select#pilih_halaman").empty();

                $('select#pilih_role').select2({theme: "bootstrap", dropdownParent: $('#modal_tambah_halaman .modal-content'), placeholder: "Nama Role"});
                $("select#pilih_role").empty();

                $.ajax({
                    url: '<?= base_url("admin/get_data_halaman"); ?>',
                    success: function(result) {
                        let data_pasien = JSON.parse(result);
                        $("select#pilih_halaman").append("<option selected value=''>Nama Halaman</option>");
                        $.each(data_pasien, function(index, value) {
                            $("select#pilih_halaman").append("<option value="+ value.id +">"+ value.pagename +"</option>");
                        });
                    }
                });

                $.ajax({
                    url: '<?= base_url("admin/get_data_role"); ?>',
                    success: function(result) {
                        let data_ruang = JSON.parse(result);
                        $("select#pilih_role").append("<option selected value=''>Nama Role</option>");
                        $.each(data_ruang, function(index, value) {
                            $("select#pilih_role").append("<option value="+ value.id +">"+ value.rolename +"</option>");
                        });
                        $("div#modal_tambah_halaman").modal("show");
                    }
                });

                $("button#tombol_tambah_akses_halaman").click(function() {
                    let id_page = $('select#pilih_halaman').val();
                    let id_role = $('select#pilih_role').val();

                    $.ajax({
                        url: '<?= base_url("admin/insert_akses_halaman"); ?>',
                        method: 'POST',
                        data: {
                            'id_page': id_page,
                            'id_role': id_role,
                        },
                        success: function(result) {
                            $("div#modal_tambah_halaman").modal("hide");
                            if (result == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data Akses Halaman Telah Tertambah',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Data Akses Halaman Gagal Tertambah',
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

    $("button#atur_staf").click(function() {
        window.location.replace("<?= base_url('admin/atur_staf') ?>");
    });

    $('button#atur_pengguna').click(function() {
        window.location.replace("<?= base_url('staf/atur_pengguna') ?>");
    });

    $('button#tambah_pasien').click(function() {
        window.location.replace("<?= base_url('register/'); ?>");
    });

});
</script>