<script>
$(document).ready(function() {
    $("button#show_password").click(function() {
        if( $("input#password").attr("type") == "text" ) {
            $("input#password").attr("type", "password");
        } else {
            $("input#password").attr("type", "text");
        }
    });

    $("button#show_confirm_password").click(function() {
        if( $("input#confirm_password").attr("type") == "text" ) {
            $("input#confirm_password").attr("type", "password");
        } else {
            $("input#confirm_password").attr("type", "text");
        }
    });

    $("button#daftar").click(function() {
        if( $("#email").val() == "" || $("#email").val().length < 20 ) {
            Swal.fire({
                icon: 'warning',
                title: 'Isi data email dengan benar!',
                showConfirmButton: false,
                timer: 1000
            });
        } else if ( $("#password").val() == "" || $("#password").val().length < 8 ) {
            Swal.fire({
                icon: 'warning',
                title: 'Isi data password dengan benar!',
                showConfirmButton: false,
                timer: 1000
            });
        } else if ( $("#confirm_password").val() != $("#password").val() ) {
            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi password salah!',
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
        } else {
            $.ajax({
                "url": "<?= base_url('register/daftar'); ?>",
                "method": 'POST',
                "data": {
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
                    "password": $("#password").val(),
                },
                "success": function(result) {
                    if (result == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Akun Berhasil Terdaftar',
                            showConfirmButton: false,
                            timer: 1000
                        }).then((result) => {
                            window.location.replace("<?= base_url('login'); ?>");
                        });

                        
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Akun Gagal Terdaftar',
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