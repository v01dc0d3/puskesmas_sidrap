<script>
$(document).ready(function() {
    $('textarea#kajian').summernote({height: 200,});
    $('textarea#kajian').summernote("disable");
    $('textarea#kajian').summernote("code", '<?= $kajian; ?>');

    $('textarea#anam_pem_fisik').summernote({height: 200,});
    $('textarea#anam_pem_fisik').summernote("disable");
    $('textarea#anam_pem_fisik').summernote("code", '<?= $anam_pem_fisik; ?>');
    
    $('textarea#diagnosis').summernote({height: 200,});
    $('textarea#diagnosis').summernote("disable");
    $('textarea#diagnosis').summernote("code", '<?= $diagnosis; ?>');

    $('textarea#terapi').summernote({height: 200,});
    $('textarea#terapi').summernote("disable");
    $('textarea#terapi').summernote("code", '<?= $terapi; ?>');

    $('textarea#asuhan').summernote({height: 200,});
    $('textarea#asuhan').summernote("disable");
    $('textarea#asuhan').summernote("code", '<?= $asuhan; ?>');

    $('textarea#icd').summernote({height: 200,});
    $('textarea#icd').summernote("disable");
    $('textarea#icd').summernote("code", '<?= $icd; ?>');

    $("button#kembali_ke_rekap_pasien").click(function() {
        window.location.replace("<?= base_url('dokter/detail/' . $id_rekam_medik); ?>");
    });

});
</script>