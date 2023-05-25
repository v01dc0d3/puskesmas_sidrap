<script>
$(document).ready(function() {
    $("#jenis_kelamin").val("<?= $data_pasien[0]['jenis_kelamin']; ?>");
    $("#agama").val("<?= $data_pasien[0]['agama']; ?>");

    $("button#simpan_profil").click(function() {
        if( $("#email").val() == "" || $("#email").val().length < 10 ) {
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
        } else {
            $.ajax({
                url: "<?= base_url('templates/update_profil_pasien'); ?>",
                data: {
                    id_user: "<?= $this->session->userdata('id_user'); ?>", 
                    id_pasien: "<?= $this->session->userdata('id_pasien'); ?>",
                    email: $("#email").val(),
                    nama: $("#nama").val(),
                    alamat: $("#alamat").val(),
                    pekerjaan: $("#pekerjaan").val(),
                    no_hp: $("#no_hp").val(),
                    nama_kk: $("#nama_kk").val(),
                    tanggal_lahir: $("#tanggal_lahir").val(),
                    jenis_kelamin: $("#jenis_kelamin").val(),
                    agama: $("#agama").val(),
                    umur: $("#umur").val(),
                },
                method: "POST",
                success: function(result) {
                    if (result == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Perubahan Profil Tersimpan',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Perubahan Profil Tidak Tersimpan',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                    window.location.replace("<?= base_url('pasien'); ?>");
                }
            });
        }
    });
});
</script>