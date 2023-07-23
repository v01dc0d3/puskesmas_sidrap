<script>
$(document).ready(function() {
    var table = $('#myTable').DataTable({
        'autoWidth': true,
        'order': [[0, 'desc']],
        "ajax": {
            "url": "<?= base_url('dokter/get_all_rekap_medis_by_id_rekam_medik/'); ?>",
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
            { "data": "kajian_subjektif" },
            { "data": "kajian_objektif" },
            { "data": "asuhan" },
            { 
                "data": null,
                "render": function ( data, type, row ) {
                    return '<button class="btn text-bg-primary mr-2" id="data_rekap_detail">Detail</button><button class="btn text-bg-success mr-2" id="data_rekap_update">Update</button><button class="btn text-bg-danger mr-2" id="data_rekap_hapus">Hapus</button><button class="btn btn-info text-white mr-2" id="resep_obat">Resep</button>';
                }
            },
        ],
    });

    $('#myTable').on('click', 'button#data_rekap_detail', function() {
        var data = table.row($(this).parents('tr')).data();

        $.redirect("<?= base_url('dokter/detail_rekap_pasien/'); ?>", {
            id: data.id, 
            nik: data.nik,
            nama_kk: data.nama_kk, 
            tgl: data.tgl,
            kajian_subjektif: (data.kajian_subjektif == null) ? "Belum ada Kajian Subjektif" : data.kajian_subjektif,
            kajian_objektif: (data.kajian_objektif == null) ? "Belum ada Kajian Objektif" : data.kajian_objektif,
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
            paraf_medis: (data.paraf_medis == null) ? "-" : data.paraf_medis,
            paraf_paramedis: (data.paraf_paramedis == null) ? "-" : data.paraf_paramedis,
        });
    });

    $('#myTable').on('click', 'button#data_rekap_update', function() {
        var data = table.row($(this).parents('tr')).data();
        console.log(data);

        $.redirect("<?= base_url('dokter/edit_rekap_pasien/'); ?>", {
            id: data.id, 
            nik: data.nik, 
            nama_kk: data.nama_kk, 
            tgl: String(data.tgl),
            kajian_subjektif: (data.kajian_subjektif == null) ? "Belum ada Kajian Subjektif" : data.kajian_subjektif,
            kajian_objektif: (data.kajian_objektif == null) ? "Belum ada Kajian Objektif" : data.kajian_objektif,
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
            paraf_medis: (data.paraf_medis == null) ? "-" : data.paraf_medis,
            paraf_paramedis: (data.paraf_paramedis == null) ? "-" : data.paraf_paramedis,
        });
    });

    $('#myTable').on('click', 'button#data_rekap_hapus', function() {
        var data = table.row($(this).parents('tr')).data();

        Swal.fire({
            title: 'Yakin Menghapus Data?',
            showDenyButton: true,
            icon: 'info',
            showCancelButton: false,
            confirmButtonText: 'Ya',
            denyButtonText: `Tidak`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url("dokter/delete_data_rekap_by_id/"); ?>' + data.id,
                    success: function(result) {
                        if (result == 1) {
                            Swal.fire({icon: 'success', title: 'Data Rekap Medis Pasien Berhasil Terhapus', showConfirmButton: false, timer: 1000});
                        } else {
                            Swal.fire({icon: 'error', title: 'Data Rekap Medis Pasien Gagal Terhapus', showConfirmButton: false, timer: 1000});
                        }
                        $('#myTable').DataTable().ajax.reload();
                    },
                });
            } else if (result.isDenied) {
                Swal.fire('Data Tidak Berubah', '', 'info');
            }
        });
    });

    $('#myTable').on('click', 'button#resep_obat', function() {
        var data = table.row($(this).parents('tr')).data();

        $("div.modal_crud").remove();
        $.ajax({
            url: '<?= base_url("dokter/modal_body_resep_obat"); ?>',
            success: function(result) {
                $("body").append(result);

                $('input#nama_pasien').val(data.nama_kk);
                $('input#tgl').val(data.tgl);

                $('textarea#resep').summernote({height: 200,});

                $.ajax({
                    url: '<?= base_url("dokter/get_resep_by_id_rms") ?>',
                    data: {id_rms: data.id},
                    method: 'POST',
                    success: function(result) {
                        let tgl = new Date();
                        tgl = tgl.getDate() + "/" + ( tgl.getMonth() + 1 ) + "/" + tgl.getFullYear();

                        if (result == "[]") {

                            $("button#tombol_ajukan_obat").click(function() {
                                let resep = $('textarea#resep').val();

                                $.ajax({
                                    url: '<?= base_url("dokter/tambah_resep_obat"); ?>',
                                    method: 'POST',
                                    data: {id_rms: data.id, resep: resep, tgl: tgl},
                                    success: function(result) {
                                        $("div#modal_resep_obat").modal("hide");
                                        if (result == 1) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Resep Obat Telah Diajukan',
                                                showConfirmButton: false,
                                                timer: 1000
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Resep Obat Gagal Diajukan',
                                                showConfirmButton: false,
                                                timer: 1000
                                            });
                                        }
                                        $('#myTable').DataTable().ajax.reload();
                                    }
                                });
                            });
                        } else {
                            let id_ro = JSON.parse(result)[0].id;
                            let resep = JSON.parse(result)[0].resep;
                            $('textarea#resep').summernote("code", resep);
                            
                            $("button#tombol_ajukan_obat").click(function() {
                                let resep = $('textarea#resep').val();

                                $.ajax({
                                    url: '<?= base_url("dokter/edit_resep_obat"); ?>',
                                    method: 'POST',
                                    data: {id_ro: id_ro, id_rms: data.id, resep: resep, tgl: tgl},
                                    success: function(result) {
                                        $("div#modal_resep_obat").modal("hide");
                                        if (result == 1) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Resep Obat Telah Diajukan',
                                                showConfirmButton: false,
                                                timer: 1000
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Resep Obat Gagal Diajukan',
                                                showConfirmButton: false,
                                                timer: 1000
                                            });
                                        }
                                        $('#myTable').DataTable().ajax.reload();
                                    }
                                });
                            });
                        }

                        $("div#modal_resep_obat").modal("show");
                    },
                });
            }
        });
    });

    $("button#kembali_ke_data_rekap").click(function() {
        window.location.replace("<?= base_url('dokter/'); ?>");
    });

    $("button#print_data_rekap_pasien").click(function() {
        $.redirect("<?= base_url('dokter/print_data_rekap_pasien'); ?>", {
            "id_pasien": "<?= $id_pasien; ?>",
            "nik": "<?= $nik; ?>",
            "no_kartu": "<?= $no_kartu; ?>",
            "nama_kk": "<?= $nama_kk; ?>",
            "id_rekam_medik": "<?= $id_rekam_medik; ?>",
        }, "POST", "_blank");
    });

});
</script>