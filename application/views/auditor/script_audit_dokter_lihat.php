<script>
$(document).ready(function() {
    var table = $('#myTable').DataTable({
        'autoWidth': true,
        'order': [[0, 'desc']],
        "ajax": {
            "url": "<?= base_url('auditor/get_all_rekap_medis_by_id_rekam_medik/'); ?>",
            "method": 'POST',
            "data": {
                "no_kartu": "<?= $no_kartu; ?>",
                "id_pasien": "<?= $id_pasien; ?>",
                "nama_kk": "<?= $nama_kk; ?>",
            },
            "dataSrc": function(result) {
                return result;
            },
        },
        "columns": [
            { "data": "tgl" },
            { "data": "nama_kk" },
            { "data": "kajian" },
            { 
                "data": null,
                "render": function ( data, type, row ) {
                    return '<button class="btn text-bg-primary mr-2" id="data_rekap_detail">Detail</button><button class="btn btn-info text-white mr-2" id="resep_obat">Resep</button>';
                }
            },
        ],
    });

    $('#myTable').on('click', 'button#data_rekap_detail', function() {
        var data = table.row($(this).parents('tr')).data();

        $.redirect("<?= base_url('auditor/detail_rekap_pasien/'); ?>", {
            id: data.id, 
            nama_kk: data.nama_kk, 
            tgl: data.tgl,
            kajian: String(data.kajian),
            anam_pem_fisik: (data.anam_pem_fisik == null) ? "Belum ada Anamnesis (S) & Pemeriksaan Fisik (O)" : data.anam_pem_fisik,
            diagnosis: (data.diagnosis == null) ? "Belum ada Diagnosis (A)" : data.diagnosis,
            terapi: (data.terapi == null) ? "Belum ada Terapi (P)" : data.terapi,
            asuhan: (data.asuhan == null) ? "Belum ada Asuhan Keperawatan / Kebidanan" : data.asuhan,
            icd: (data.icd == null) ? "Belum ada ICD X" : data.icd,
            id_pasien: data.id_pasien,
            id_ruang: data.id_ruang,
            nama_ruang: data.nama_ruang,
            id_rekam_medik: data.id_rekam_medik,
            no_kartu: data.no_kartu,
        });
    });

    $('#myTable').on('click', 'button#resep_obat', function() {
        var data = table.row($(this).parents('tr')).data();

        $("div.modal_crud").remove();
        $.ajax({
            url: '<?= base_url("auditor/modal_body_resep_obat"); ?>',
            success: function(result) {
                $("body").append(result);

                $('input#nama_pasien').val(data.nama_kk);
                $('input#tgl').val(data.tgl);

                $('textarea#resep').summernote("disable");
                $('textarea#resep').summernote({height: 200,});

                $.ajax({
                    url: '<?= base_url("auditor/get_resep_by_id_rms") ?>',
                    data: {id_rms: data.id},
                    method: 'POST',
                    success: function(result) {
                        let len_data = JSON.parse(result).length;
                        if (len_data != 0 ) {
                            let id_ro = JSON.parse(result)[0].id;
                            let resep = JSON.parse(result)[0].resep;
                            $('textarea#resep').summernote("code", resep);
                        } else {
                            $('textarea#resep').summernote("code", "");
                        }

                        $("div#modal_resep_obat").modal("show");
                    },
                });

                $("div#modal_resep_obat").modal("show");
            }
        });
    });

    $("button#kembali_ke_audit_dokter").click(function() {
        $.redirect("<?= base_url('auditor/dokter/'); ?>", {
            "id_rekam_medik": "<?= $id_rekam_medik; ?>",
            "no_kartu": "<?= $no_kartu; ?>",
            "nama_kk": "<?= $nama_kk; ?>",
            "id_pasien": "<?= $id_pasien; ?>",
        });
    });

    $("button#print_data_rekap_pasien").click(function() {
        $.redirect("<?= base_url('auditor/print_data_rekap_pasien'); ?>", {
            "id_pasien": "<?= $id_pasien; ?>",
            "no_kartu": "<?= $no_kartu; ?>",
            "nama_kk": "<?= $nama_kk; ?>",
            "id_rekam_medik": "<?= $id_rekam_medik; ?>",
        }, "POST", "_blank");
    });

});
</script>