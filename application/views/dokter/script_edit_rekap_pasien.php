<script>
$(document).ready(function() {
    $('textarea#kajian').summernote({height: 200,});
    $('textarea#kajian').summernote("disable");
    $('textarea#kajian').summernote("code", '<?= $kajian; ?>');

    $('textarea#anam_pem_fisik').summernote({height: 200,});
    $('textarea#anam_pem_fisik').summernote("code", '<?= $anam_pem_fisik; ?>');
    
    $('textarea#diagnosis').summernote({height: 200,});
    $('textarea#diagnosis').summernote("code", '<?= $diagnosis; ?>');

    $('textarea#terapi').summernote({height: 200,});
    $('textarea#terapi').summernote("code", '<?= $terapi; ?>');

    $('textarea#asuhan').summernote({height: 200,});
    $('textarea#asuhan').summernote("code", '<?= $asuhan; ?>');

    $('textarea#icd').summernote({height: 200,});
    $('textarea#icd').summernote("code", '<?= $icd; ?>');

    $("button#kembali_ke_rekap_pasien").click(function() {
        $.redirect("<?= base_url('dokter/detail/'); ?>", {
            "id_rekam_medik": "<?= $id_rekam_medik; ?>",
            "no_kartu": "<?= $no_kartu; ?>",
            "nama_kk": "<?= $nama_kk; ?>",
            "id_pasien": "<?= $id_pasien; ?>",
        });
    });

    $("button#edit_data_rekap_pasien").click(function() {
        let pasien = $('select#nama_pasien').val();
        let ruang = $('select#nama_ruang').val();
        let kajian = $('textarea#kajian').val();

        $.ajax({
            url: '<?= base_url("dokter/edit_data_rekap_pasien"); ?>',
            method: 'POST',
            data: {
                'id': String("<?= $id; ?>"),
                'id_rekam_medik': String("<?= $id_rekam_medik; ?>"),
                'tgl': String("<?= $tgl; ?>"),
                'id_ruang': ruang,
                'kajian': kajian,
                'anam_pem_fisik': $('textarea#anam_pem_fisik').val(),
                'diagnosis': $('textarea#diagnosis').val(),
                'terapi': $('textarea#terapi').val(),
                'asuhan': $('textarea#asuhan').val(),
                'icd': $('textarea#icd').val(),
            },
            success: function(result) {
                console.log(result);
                if (result == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Rekap Medis Pasien Telah Terdit',
                        showConfirmButton: false,
                        timer: 1000
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Data Rekap Medis Pasien Gagal Terdit',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
                $('textarea#anam_pem_fisik').summernote("code", $('textarea#anam_pem_fisik').val());   
                $('textarea#diagnosis').summernote("code", $('textarea#diagnosis').val());
                $('textarea#terapi').summernote("code", $('textarea#terapi').val());
                $('textarea#asuhan').summernote("code", $('textarea#asuhan').val());
                $('textarea#icd').summernote("code", $('textarea#icd').val());
            }
        });
    });

});
</script>