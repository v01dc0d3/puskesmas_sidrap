<script>
$(document).ready(function() {
    var tabel_rekap_medis = $('#tabel_rekap_medis').DataTable({
        'autoWidth': true,
        'order': [[0, 'desc']],
        'pageLength': 3,
        'lengthMenu': [[3, 5, 10, 20, -1], [3, 5, 10, 20]],
        "ajax": {
            "url": "<?= base_url('pasien/get_all_rekap_medis_by_id_pasien'); ?>",
            "method": 'POST',
            "data": {"id_pasien": "<?= $id_pasien; ?>"},
            "dataSrc": function(result) {
                return result;
            },
        },
        "columns": [
            { "data": "tgl" },
            { "data": "anam_pem_fisik" },
            {
                "data": null,
                "render": function ( data, type, row ) {
                    return '<button class="btn text-bg-primary mr-2" id="detail_rekap">Detail</button>';
                }
            },
        ],
    });

    var tabel_rekam_medik = $('#tabel_rekam_medik').DataTable({
        'autoWidth': true,
        'order': [[0, 'desc']],
        'pageLength': 3,
        'lengthMenu': [[3, 5, 10, 20, -1], [3, 5, 10, 20]],
        "ajax": {
            "url": "<?= base_url('pasien/get_all_rekam_medik_by_id_pasien'); ?>",
            "method": 'POST',
            "data": {"id_pasien": "<?= $id_pasien; ?>"},
            "dataSrc": function(result) {
                return result;
            },
        },
        "columns": [
            { "data": "tgl" },
            { "data": "anamnesa" },
            { 
                "data": null,
                "render": function ( data, type, row ) {
                    return '<button class="btn text-bg-primary mr-2" id="detail_rekam">Detail</button>';
                }
            },
        ],
    });

    
    $('#tabel_rekap_medis').on('click', 'button#detail_rekap', function() {
        var data = tabel_rekap_medis.row($(this).parents('tr')).data();

        $.redirect("<?= base_url('pasien/detail_rekap_pasien/'); ?>", {
            id: data.id, 
            nama_kk: data.nama_kk, 
            nik: data.nik,
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

    $('#tabel_rekam_medik').on('click', 'button#detail_rekam', function() {
        var data = tabel_rekam_medik.row($(this).parents('tr')).data();

        $("div.modal_crud").remove();
        $.ajax({
            url: '<?= base_url("pasien/modal_body_detail_rekam"); ?>',
            success: function(result) {
                $("body").append(result);

                $('input#nama_pasien').val(data.nama_kk);
                $('input#tgl').val(data.tgl);

                $('textarea#anamnesa').summernote({height: 200, toolbar: false});
                $('textarea#anamnesa').summernote("disable");
                $('textarea#anamnesa').summernote("code", data.anamnesa);

                $('textarea#saran').summernote({height: 200, toolbar: false});
                $('textarea#saran').summernote("disable");
                $('textarea#saran').summernote("code", data.saran);

                $("div#modal_detail_rekam").modal("show");
            }
        });
    });

    $('button#ambil_antrian').click(function() {
        var tgl = new Date();
        tgl = tgl.getFullYear() + "-" + "0" + (tgl.getMonth() + 1) + "-" + tgl.getDate();

        $.ajax({
            url: "<?= base_url('pasien/cek_tgl_antrian'); ?>",
            success: function(result) {
                var tgl_tb = JSON.parse(result);
                if (tgl_tb.length != 0) {
                    tgl_tb = tgl_tb[0].tgl;
                    if (tgl == tgl_tb) {
                        $.ajax({
                            url: "<?= base_url('pasien/read_antrian_from_id_user'); ?>",
                            data: {id_user: "<?= $this->session->userdata('id_user'); ?>",},
                            method: 'POST',
                            success: function(result) {
                                var no_antrian = JSON.parse(result);
                                if (no_antrian.length != 0) {
                                    $.ajax({
                                        url: "<?= base_url('pasien/read_antrian_from_id_user'); ?>",
                                        data: {id_user: "<?= $this->session->userdata('id_user'); ?>",},
                                        method: 'POST',
                                        success: function(result) {
                                            var no_antrian = JSON.parse(result)[0].id;
                                            Swal.fire({
                                                icon: 'info',
                                                title: 'Antrian ke-' + no_antrian,
                                            });
                                        }
                                    });
                                } else {
                                    $.ajax({
                                        url: "<?= base_url('pasien/create_antrian'); ?>",
                                        data: {tgl: tgl},
                                        method: 'POST',
                                        success: function(result) {
                                            if (result == 1) {
                                                $.ajax({
                                                    url: "<?= base_url('pasien/read_antrian_from_id_user'); ?>",
                                                    data: {id_user: "<?= $this->session->userdata('id_user'); ?>",},
                                                    method: 'POST',
                                                    success: function(result) {
                                                        var no_antrian = JSON.parse(result)[0].id;
                                                        Swal.fire({
                                                            icon: 'info',
                                                            title: 'Antrian ke-' + no_antrian,
                                                        });
                                                    }
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Gagal mengambil no antrian',
                                                });
                                            }
                                        }
                                    });
                                }
                            }
                        });
                    } else {
                        $.ajax({
                            url: "<?= base_url('pasien/delete_all_antrian'); ?>",
                            success: function() {
                                $.ajax({
                                    url: "<?= base_url('pasien/create_antrian'); ?>",
                                    data: {tgl: tgl},
                                    method: 'POST',
                                    success: function(result) {
                                        if (result == 1) {
                                            $.ajax({
                                                url: "<?= base_url('pasien/read_antrian_from_id_user'); ?>",
                                                data: {id_user: "<?= $this->session->userdata('id_user'); ?>",},
                                                method: 'POST',
                                                success: function(result) {
                                                    var no_antrian = JSON.parse(result)[0].id;
                                                    Swal.fire({
                                                        icon: 'info',
                                                        title: 'Antrian ke-' + no_antrian,
                                                    });
                                                }
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal mengambil no antrian',
                                            });
                                        }
                                    }
                                });
                            }
                        });
                    }
                } else {
                    $.ajax({
                        url: "<?= base_url('pasien/create_antrian'); ?>",
                        data: {tgl: tgl},
                        method: 'POST',
                        success: function(result) {
                            if (result == 1) {
                                $.ajax({
                                    url: "<?= base_url('pasien/read_antrian_from_id_user'); ?>",
                                    data: {id_user: "<?= $this->session->userdata('id_user'); ?>",},
                                    method: 'POST',
                                    success: function(result) {
                                        var no_antrian = JSON.parse(result)[0].id;
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Antrian ke-' + no_antrian,
                                        });
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal mengambil no antrian',
                                });
                            }
                        }
                    });
                }
            }
        });

    });

    $("button#print_data_rekap_pasien").click(function() {
        var data = $('#tabel_rekap_medis').DataTable().rows( { selected: true } ).data().toArray()[0];
        $.redirect("<?= base_url('pasien/print_data_rekap_pasien'); ?>", {
            "id_pasien": data.id_pasien,
            "no_kartu": data.no_kartu,
            "nik": data.nik,
            "nama_kk": data.nama_kk,
            "id_rekam_medik": data.id_rekam_medik,
        }, "POST", "_blank");
        
    });

    $("button#kembali_ke_data_staf").click(function() {
        window.location.replace("<?= base_url('staf/'); ?>");
    });

});
</script>