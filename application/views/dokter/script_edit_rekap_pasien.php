<script>
$(document).ready(function() {
    $('textarea#kajian_subjektif').summernote({height: 200, toolbar: false});
    $('textarea#kajian_subjektif').summernote("disable");
    $('textarea#kajian_subjektif').summernote("code", '<?= $kajian_subjektif; ?>');

    $('textarea#kajian_objektif').summernote({height: 200, toolbar: false});
    $('textarea#kajian_objektif').summernote("disable");
    $('textarea#kajian_objektif').summernote("code", '<?= $kajian_objektif; ?>');

    $('textarea#asuhan').summernote({height: 200, toolbar: false});
    $('textarea#asuhan').summernote("disable");
    $('textarea#asuhan').summernote("code", '<?= $asuhan; ?>');

    $('textarea#anam_pem_fisik').summernote({height: 200,});
    $('textarea#anam_pem_fisik').summernote("code", '<?= $anam_pem_fisik; ?>');
    
    $('textarea#diagnosis').summernote({height: 200,});
    $('textarea#diagnosis').summernote("code", '<?= $diagnosis; ?>');

    $('textarea#terapi').summernote({height: 200,});
    $('textarea#terapi').summernote("code", '<?= $terapi; ?>');

    $('textarea#icd').summernote({height: 200,});
    $('textarea#icd').summernote("code", '<?= $icd; ?>');

    $('select#paraf_paramedis').val('<?= $paraf_paramedis; ?>');
    $('select#paraf_medis').val('<?= $paraf_medis; ?>');

    $("button#kembali_ke_rekap_pasien").click(function() {
        $.redirect("<?= base_url('dokter/detail/'); ?>", {
            "id_rekam_medik": "<?= $id_rekam_medik; ?>",
            "no_kartu": "<?= $no_kartu; ?>",
            "nik": "<?= $nik; ?>",
            "nama_kk": "<?= $nama_kk; ?>",
            "id_pasien": "<?= $id_pasien; ?>",
        });
    });

    $("button#edit_data_rekap_pasien").click(function() {
        let pasien = $('select#nama_pasien').val();
        let ruang = $('select#nama_ruang').val();
        let kajian_subjektif = $('textarea#kajian_subjektif').val();
        let kajian_objektif = $('textarea#kajian_objektif').val();
        let asuhan = $('textarea#asuhan').val();
        let paraf_medis = $('select#paraf_medis').val();

        $.ajax({
            url: '<?= base_url("dokter/edit_data_rekap_pasien"); ?>',
            method: 'POST',
            data: {
                'id': String("<?= $id; ?>"),
                'id_rekam_medik': String("<?= $id_rekam_medik; ?>"),
                'tgl': String("<?= $tgl; ?>"),
                'id_ruang': ruang,
                'anam_pem_fisik': $('textarea#anam_pem_fisik').val(),
                'diagnosis': $('textarea#diagnosis').val(),
                'terapi': $('textarea#terapi').val(),
                'icd': $('textarea#icd').val(),
                'paraf_medis': paraf_medis,
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
                $('textarea#icd').summernote("code", $('textarea#icd').val());
            }
        });
    });

});
</script>