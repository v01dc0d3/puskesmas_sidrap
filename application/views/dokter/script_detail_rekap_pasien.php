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

    $('textarea#anam_pem_fisik').summernote({height: 200, toolbar: false});
    $('textarea#anam_pem_fisik').summernote("disable");
    $('textarea#anam_pem_fisik').summernote("code", '<?= $anam_pem_fisik; ?>');
    
    $('textarea#diagnosis').summernote({height: 200, toolbar: false});
    $('textarea#diagnosis').summernote("disable");
    $('textarea#diagnosis').summernote("code", '<?= $diagnosis; ?>');

    $('textarea#terapi').summernote({height: 200, toolbar: false});
    $('textarea#terapi').summernote("disable");
    $('textarea#terapi').summernote("code", '<?= $terapi; ?>');

    $('textarea#icd').summernote({height: 200, toolbar: false});
    $('textarea#icd').summernote("disable");
    $('textarea#icd').summernote("code", '<?= $icd; ?>');

    $('select#paraf_paramedis').val('<?= $paraf_paramedis; ?>');
    $('select#paraf_medis').val('<?= $paraf_medis; ?>');

    $("button#kembali_ke_rekap_pasien").click(function() {
        $.redirect("<?= base_url('dokter/detail/'); ?>", {
            "id_rekam_medik": "<?= $id_rekam_medik; ?>",
            "nik": "<?= $nik; ?>",
            "no_kartu": "<?= $no_kartu; ?>",
            "nama_kk": "<?= $nama_kk; ?>",
            "id_pasien": "<?= $id_pasien; ?>",
        });
    });

});
</script>