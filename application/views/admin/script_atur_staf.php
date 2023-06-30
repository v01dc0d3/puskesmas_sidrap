<script>
$(document).ready(function() {

var table = $('#myTable').DataTable({
    'autoWidth': true,
    "ajax": {
        "url": "<?= base_url('admin/get_all_role_full_name_for_admin'); ?>",
        "dataSrc": function(result) {
            return result;
        },
    },
    "columns": [
        { "data": "full_name" },
        { "data": "email" },
        { "data": "no_hp" },
        { "data": "rolename" },
        { 
            "data": null,
            "render": function ( data, type, row ) {
                return '<button class="btn text-bg-warning text-light mr-2" id="edit_staf">Edit</button><button class="btn text-bg-danger mr-2" id="hapus_staf">Hapus</button>';
            }
        },
    ],
});

$('#myTable').on('click', 'button#edit_staf', function() {
    var data = table.row($(this).parents('tr')).data();

    $("div.modal_crud").remove();
    $.ajax({
        url: '<?= base_url("admin/modal_body_edit_staf"); ?>',
        success: function(result) {
            $("body").append(result);

            $('input#full_name').val(data.full_name);
            $('input#email').val(data.email);
            $('input#no_hp').val(data.no_hp);
            $('select#role').val(data.id_role);

            $("div#modal_edit_staf").modal("show");

            $("button#tombol_edit_staf").click(function() {
                $.ajax({
                    url: '<?= base_url("admin/update_staf_for_admin"); ?>',
                    method: 'POST',
                    data: {
                        "id": data.id,
                        "id_role": $("select#role").val(),
                        "email": $("input#email").val(),
                        "full_name": $("input#full_name").val(),
                        "no_hp": $("input#no_hp").val(),
                    },
                    success: function(result) {
                        if (result == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Pengguna Telah Terdit',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Data Pengguna Gagal Terdit',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }

                        $('#myTable').DataTable().ajax.reload();

                        $("div#modal_edit_staf").modal("hide");
                        $("div.modal_crud").remove();
                    },
                });
            });
        }
    });
});

$('#myTable').on('click', 'button#hapus_staf', function() {
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
                    url: '<?= base_url("admin/delete_pengguna_for_admin/"); ?>' + data.id,
                    success: function(result) {
                        if (result == 1) {
                            Swal.fire({icon: 'success', title: 'Data Pengguna Berhasil Terhapus', showConfirmButton: false, timer: 1000});
                        } else {
                            Swal.fire({icon: 'error', title: 'Data Pengguna Gagal Terhapus', showConfirmButton: false, timer: 1000});
                        }
                        $('#myTable').DataTable().ajax.reload();
                    },
                });
            } else if (result.isDenied) {
                Swal.fire('Data Tidak Berubah', '', 'info');
            }
    });
});

$('button#tambah_staf').click(function() {
    window.location.replace("<?= base_url('register/tambah_staf'); ?>");
});

$("button#kembali_ke_admin").click(function() {
    window.location.replace("<?= base_url('admin'); ?>");
});

});
</script>