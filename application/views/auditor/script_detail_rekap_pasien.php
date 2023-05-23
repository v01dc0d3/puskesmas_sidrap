<script>
$(document).ready(function() {
    $('textarea#kajian').summernote({height: 200, toolbar: false});
    $('textarea#kajian').summernote("disable");
    $('textarea#kajian').summernote("code", '<?= $kajian; ?>');

    $('textarea#anam_pem_fisik').summernote({height: 200, toolbar: false});
    $('textarea#anam_pem_fisik').summernote("disable");
    $('textarea#anam_pem_fisik').summernote("code", '<?= $anam_pem_fisik; ?>');
    
    $('textarea#diagnosis').summernote({height: 200, toolbar: false});
    $('textarea#diagnosis').summernote("disable");
    $('textarea#diagnosis').summernote("code", '<?= $diagnosis; ?>');

    $('textarea#terapi').summernote({height: 200, toolbar: false});
    $('textarea#terapi').summernote("disable");
    $('textarea#terapi').summernote("code", '<?= $terapi; ?>');

    $('textarea#asuhan').summernote({height: 200, toolbar: false});
    $('textarea#asuhan').summernote("disable");
    $('textarea#asuhan').summernote("code", '<?= $asuhan; ?>');

    $('textarea#icd').summernote({height: 200, toolbar: false});
    $('textarea#icd').summernote("disable");
    $('textarea#icd').summernote("code", '<?= $icd; ?>');

    $("button#kembali_ke_rekap_pasien").click(function() {
        $.redirect("<?= base_url('auditor/dokter_lihat/'); ?>", {
            "id_rekam_medik": "<?= $id_rekam_medik; ?>",
            "no_kartu": "<?= $no_kartu; ?>",
            "nama_kk": "<?= $nama_kk; ?>",
            "id_pasien": "<?= $id_pasien; ?>",
        });
    });

});
</script>