<script>
$(document).ready(function() {
    $("button#show_password").click(function() {
        if( $("input#password").attr("type") == "text" ) {
            $("input#password").attr("type", "password");
        } else {
            $("input#password").attr("type", "text");
        }
    });

    $("button#login").click(function() {
        if( $("#email").val() == "" ) {
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
        } else {
            $.ajax({
                "url": "<?= base_url('login/cek_akun'); ?>",
                "method": 'POST',
                "data": {
                    "email": $("#email").val(),
                    "password": $("#password").val(),
                },
                "success": function(result) {
                    var data = JSON.parse(result);
                    if (data.login == "true") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Login',
                            showConfirmButton: false,
                            timer: 1000
                        }).then((result) => {
                            window.location.replace("<?= base_url(); ?>" + data.rolename);
                        }); 
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Login',
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