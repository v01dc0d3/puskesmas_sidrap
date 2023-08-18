<script>
$(document).ready(function() {
    $("select#jenis_kelamin").val("<?= $data_pasien["jenis_kelamin"]; ?>");
    $("select#agama").val("<?= $data_pasien["agama"]; ?>");

    $("button#edit").click(function() {
        if( $("#email").val() == "" || $("#email").val().length < 20 ) {
            Swal.fire({
                icon: 'warning',
                title: 'Isi data email dengan benar!',
                showConfirmButton: false,
                timer: 1000
            });
        } else if ( $("#nama_kk").val() == "" || $("#nama").val() == "" || $("#tanggal_lahir").val() == "" || $("#alamat").val() == "" || $("#jenis_kelamin").val() == "" || $("#pekerjaan").val() == "" || $("#agama").val() == "" || $("#umur").val() == "" ) {
            Swal.fire({
                icon: 'warning',
                title: 'Data belum lengkap!',
                showConfirmButton: false,
                timer: 1000
            });
        } else if ( $("#no_hp").val() == "" || $("#no_hp").val().length < 10 ) {
            Swal.fire({
                icon: 'warning',
                title: 'Isi no hp dengan benar!',
                showConfirmButton: false,
                timer: 1000
            });
        } else if ( $("#nik").val() == "" || $("#nik").val().length < 16 || $("#nik").val().length > 16 ) {
            Swal.fire({
                icon: 'warning',
                title: 'Isi no nik dengan benar!',
                showConfirmButton: false,
                timer: 1000
            });
        } else {
            $.ajax({
                "url": "<?= base_url('staf/edit_data_pasien'); ?>",
                "method": 'POST',
                "data": {
                    "id_pasien": "<?= $id_pasien; ?>",
                    "email": $("#email").val(),
                    "nama_kk": $("#nama_kk").val(),
                    "nama": $("#nama").val(),
                    "tanggal_lahir": $("#tanggal_lahir").val(),
                    "alamat": $("#alamat").val(),
                    "jenis_kelamin": $("#jenis_kelamin").val(),
                    "pekerjaan": $("#pekerjaan").val(),
                    "agama": $("#agama").val(),
                    "no_hp": $("#no_hp").val(),
                    "umur": $("#umur").val(),
                    "no_kartu": $("#no_kartu").val(),
                    "password": "12345678",
                    "nik": $("#nik").val(),
                },
                "success": function(result) {
                    if (result == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Pasien Berhasil Diubah',
                            showConfirmButton: false,
                            timer: 1000
                        }).then((result) => {
                            window.location.replace("<?= base_url('staf'); ?>");
                        });

                        
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data Pasien Gagal Diubah',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                }
            });
        }
    });
});
</script>