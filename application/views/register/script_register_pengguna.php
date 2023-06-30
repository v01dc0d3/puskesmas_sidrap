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
        } else if ( $("#nama_kk").val() == "" ) {
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
                url: "<?= base_url('register/read_email_by_email'); ?>",
                data: {email: $("#email").val()},
                method: 'POST',
                success: function(result) {
                    var data_email = JSON.parse(result);
                    if (data_email.length == 0) {
                        $.ajax({
                            "url": "<?= base_url('register/daftar_pengguna'); ?>",
                            "method": 'POST',
                            "data": {
                                "role": $("#role").val(),
                                "email": $("#email").val(),
                                "password": $("#password").val(),
                                "full_name": $("#nama_kk").val(),
                                "no_hp": $("#no_hp").val(),
                            },
                            "success": function(result) {
                                if (result == 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Pengguna Berhasil Terdaftar',
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then((result) => {
                                        window.location.replace("<?= base_url($back_to); ?>");
                                    });

                                    
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Pengguna Gagal Terdaftar',
                                        showConfirmButton: false,
                                        timer: 1000
                                    });
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Email sudah terdaftar!',
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