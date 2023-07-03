<script>
$(document).ready(function() {
    var table = $('#myTable').DataTable({
        'autoWidth': true,
        'order': [[0, 'desc']],
        "ajax": {
            "url": "<?= base_url('perawat/get_all_rekap_medis_by_id_rekam_medik/'); ?>",
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
            { "data": "nik" },
            { "data": "nama_kk" },
            { 
                "data": null,
                "render": function ( data, type, row ) {
                    if ("<?= $this->session->userdata('id_role'); ?>" == "7") {
                        return '<button class="btn text-bg-primary mr-2" id="data_rekap_detail">Detail</button>';
                    }
                    return '<button class="btn text-bg-primary mr-2" id="data_rekap_detail">Detail</button><button class="btn text-bg-success mr-2" id="data_rekap_update">Update</button><button class="btn text-bg-danger mr-2" id="data_rekap_hapus">Hapus</button>';
                }
            },
        ],
    });

    $('#myTable').on('click', 'button#data_rekap_update', function() {
        var data = table.row($(this).parents('tr')).data();
        $("div.modal_crud").remove();

        $.ajax({
            url: '<?= base_url("perawat/modal_body_edit_rekap"); ?>',
            success: function(result) {
                $("body").append(result);

                $('select#pilih_pasien').select2({theme: "bootstrap", dropdownParent: $('#modal_edit_rekap .modal-content'), placeholder: "Nama Pasien"});
                $("select#pilih_pasien").empty();

                $('select#pilih_ruang').select2({theme: "bootstrap", dropdownParent: $('#modal_edit_rekap .modal-content'), placeholder: "Nama Ruang"});
                $("select#pilih_ruang").empty();

                $('textarea#kajian_subjektif').summernote("code", data.kajian_subjektif);
                $('textarea#kajian_objektif').summernote("code", data.kajian_objektif);
                $('textarea#asuhan').summernote("code", data.asuhan);

                $("select#paraf_paramedis").val(data.paraf_paramedis);

                $.ajax({
                    url: '<?= base_url("perawat/get_data_rekam_medik_by_id/") ?>' + data.id,
                    success: function(result) {
                        var id_pasien = JSON.parse(result)[0].id_pasien;

                        $.ajax({
                            url: '<?= base_url("perawat/get_data_pasien") ?>',
                            success: function(result) {
                                let data_pasien = JSON.parse(result);
                                $("select#pilih_pasien").append("<option selected value=''>Nama Pasien</option>");
                                $.each(data_pasien, function(index, value) {
                                    if(id_pasien == value.id) {
                                        $("select#pilih_pasien").append("<option selected value="+ value.id +">"+ value.nama_kk +"</option>");
                                    } else {
                                        $("select#pilih_pasien").append("<option value="+ value.id +">"+ value.nama_kk +"</option>");
                                    }
                                    $("select#pilih_pasien").attr("disabled", "true");
                                });
                            }
                        });
                    },
                });

                $.ajax({
                    url: '<?= base_url("perawat/get_data_ruang"); ?>',
                    success: function(result) {
                        let data_ruang = JSON.parse(result);
                        $("select#pilih_ruang").append("<option selected value=''>Nama Ruang</option>");
                        $.each(data_ruang, function(index, value) {
                            if(data.id_ruang == value.id) {
                                $("select#pilih_ruang").append("<option selected value="+ value.id +">"+ value.nama +"</option>");
                            } else {
                                $("select#pilih_ruang").append("<option value="+ value.id +">"+ value.nama +"</option>");
                            }
                        });
                        $("div#modal_edit_rekap").modal("show");
                    }
                });

                $("button#tombol_edit_rekap").click(function() {
                    let pasien = $('select#pilih_pasien').val();
                    let ruang = $('select#pilih_ruang').val();
                    let kajian_subjektif = $('textarea#kajian_subjektif').val();
                    let kajian_objektif = $('textarea#kajian_objektif').val();
                    let asuhan = $('textarea#asuhan').val();
                    let paraf_paramedis = $('select#paraf_paramedis').val();

                    let tgl = new Date();
                    tgl = tgl.getDate() + "/" + tgl.getMonth() + "/" + tgl.getFullYear();

                    $.ajax({
                        url: '<?= base_url("perawat/edit_data_rekap/") ?>' + data.id,
                        method: 'POST',
                        data: {
                            'id_ruang': ruang,
                            'kajian_subjektif': kajian_subjektif,
                            'kajian_objektif': kajian_objektif,
                            'asuhan': asuhan,
                            'paraf_paramedis': paraf_paramedis,
                            'tgl': tgl,
                        },
                        success: function(result) {
                            $("div#modal_edit_rekap").modal("hide");
                            if (result == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data Rekap Medis Telah Terdit',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Data Rekap Medis Gagal Terdit',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            }
                            $('#myTable').DataTable().ajax.reload();
                        }
                    });
                });
            }
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
                        url: '<?= base_url("perawat/delete_data_rekap_by_id/"); ?>' + data.id,
                        success: function(result) {
                            if (result == 1) {
                                Swal.fire({icon: 'success', title: 'Data Rekap Medis Berhasil Terhapus', showConfirmButton: false, timer: 1000});
                            } else {
                                Swal.fire({icon: 'error', title: 'Data Rekap Medis Gagal Terhapus', showConfirmButton: false, timer: 1000});
                            }
                            $('#myTable').DataTable().ajax.reload();
                        },
                    });
                } else if (result.isDenied) {
                    Swal.fire('Data Tidak Berubah', '', 'info');
                }
        });
    });

    
    $('#myTable').on('click', 'button#data_rekap_detail', function() {
        var data = table.row($(this).parents('tr')).data();

        $("div.modal_crud").remove();
        $.ajax({
            url: '<?= base_url("perawat/modal_body_detail_rekap"); ?>',
            success: function(result) {
                $("body").append(result);

                $('select#pilih_pasien').select2({theme: "bootstrap", dropdownParent: $('#modal_detail_rekap .modal-content'), placeholder: "Nama Pasien"});
                $("select#pilih_pasien").empty();

                $('select#pilih_ruang').select2({theme: "bootstrap", dropdownParent: $('#modal_detail_rekap .modal-content'), placeholder: "Nama Ruang"});
                $("select#pilih_ruang").empty();

                $('textarea#kajian_subjektif').summernote({height: 200, toolbar: false});
                $('textarea#kajian_subjektif').summernote("disable");
                $('textarea#kajian_subjektif').summernote("code", data.kajian_subjektif);

                $('textarea#kajian_objektif').summernote({height: 200, toolbar: false});
                $('textarea#kajian_objektif').summernote("disable");
                $('textarea#kajian_objektif').summernote("code", data.kajian_objektif);

                $('textarea#asuhan').summernote({height: 200, toolbar: false});
                $('textarea#asuhan').summernote("disable");
                $('textarea#asuhan').summernote("code", data.asuhan);

                $("select#paraf_paramedis").val(data.paraf_paramedis);

                $.ajax({
                    url: '<?= base_url("perawat/get_data_rekam_medik_by_id/"); ?>' + data.id,
                    success: function(result) {
                        var id_pasien = JSON.parse(result)[0].id_pasien;

                        $.ajax({
                            url: '<?= base_url("perawat/get_data_pasien"); ?>',
                            success: function(result) {
                                let data_pasien = JSON.parse(result);
                                $("select#pilih_pasien").append("<option selected value=''>Nama Pasien</option>");
                                $.each(data_pasien, function(index, value) {
                                    if(id_pasien == value.id) {
                                        $("select#pilih_pasien").append("<option selected value="+ value.id +">"+ value.nama_kk +"</option>");
                                    } else {
                                        $("select#pilih_pasien").append("<option value="+ value.id +">"+ value.nama_kk +"</option>");
                                    }
                                });
                            }
                        });
                    },
                });

                $.ajax({
                    url: '<?= base_url("perawat/get_data_ruang"); ?>',
                    success: function(result) {
                        let data_ruang = JSON.parse(result);
                        $("select#pilih_ruang").append("<option selected value=''>Nama Ruang</option>");
                        $.each(data_ruang, function(index, value) {
                            if(data.id_ruang == value.id) {
                                $("select#pilih_ruang").append("<option selected value="+ value.id +">"+ value.nama +"</option>");
                            } else {
                                $("select#pilih_ruang").append("<option value="+ value.id +">"+ value.nama +"</option>");
                            }
                        });
                        $("div#modal_detail_rekap").modal("show");
                    }
                });
            }
        });
    });


    $("button#tambah_rekap").click(function(){
        $("div.modal_crud").remove();

        $.ajax({
            url: '<?= base_url("perawat/modal_body_tambah_rekap"); ?>',
            success: function(result) {
                $("body").append(result);

                $('select#pilih_pasien').select2({theme: "bootstrap", dropdownParent: $('#modal_tambah_rekap .modal-content'), placeholder: "Nama Pasien"});
                $("select#pilih_pasien").empty();

                $('select#pilih_ruang').select2({theme: "bootstrap", dropdownParent: $('#modal_tambah_rekap .modal-content'), placeholder: "Nama Ruang"});
                $("select#pilih_ruang").empty();

                $('textarea#kajian_subjektif').summernote();
                $('textarea#kajian_objektif').summernote();
                $('textarea#asuhan').summernote();

                $.ajax({
                    url: '<?= base_url("perawat/get_data_pasien"); ?>',
                    success: function(result) {
                        let data_pasien = JSON.parse(result);
                        $("select#pilih_pasien").append("<option selected value=''>Nama Pasien</option>");
                        $.each(data_pasien, function(index, value) {
                            if ("<?= $id_pasien; ?>" == value.id) {
                                $("select#pilih_pasien").append("<option selected value="+ value.id +">"+ value.nama_kk +"</option>");
                            } else {
                                $("select#pilih_pasien").append("<option value="+ value.id +">"+ value.nama_kk +"</option>");
                            }
                            $("select#pilih_pasien").attr("disabled", "true");
                        });
                    }
                });

                $.ajax({
                    url: '<?= base_url("perawat/get_data_ruang"); ?>',
                    success: function(result) {
                        let data_ruang = JSON.parse(result);
                        $("select#pilih_ruang").append("<option selected value=''>Nama Ruang</option>");
                        $.each(data_ruang, function(index, value) {
                            $("select#pilih_ruang").append("<option value="+ value.id +">"+ value.nama +"</option>");
                        });
                        $("div#modal_tambah_rekap").modal("show");
                    }
                });

                $("button#tombol_tambah_rekap").click(function() {
                    let pasien = $('select#pilih_pasien').val();
                    let ruang = $('select#pilih_ruang').val();
                    let kajian_subjektif = $('textarea#kajian_subjektif').val();
                    let kajian_objektif = $('textarea#kajian_objektif').val();
                    let asuhan = $('textarea#asuhan').val();
                    let paraf_paramedis = $('select#paraf_paramedis').val();

                    console.log("asdadsa");

                    $.ajax({
                        url: '<?= base_url("perawat/get_id_rekam_medik_by_pasien"); ?>',
                        method: 'POST',
                        data: {'id_pasien': pasien,},
                        success: function(result) {
                            let data = JSON.parse(result);
                            let id_rekam_medik = data[0].id;

                            let tgl = new Date();
                            tgl = tgl.getDate() + "/" + tgl.getMonth() + "/" + tgl.getFullYear();

                            $.ajax({
                                url: '<?= base_url("perawat/insert_data_rekap"); ?>',
                                method: 'POST',
                                data: {
                                    'id_rekam_medik': id_rekam_medik,
                                    'id_ruang': ruang,
                                    'kajian_subjektif': kajian_subjektif,
                                    'kajian_objektif': kajian_objektif,
                                    'asuhan': asuhan,
                                    'paraf_paramedis': paraf_paramedis,
                                    'tgl': tgl,
                                },
                                success: function(result) {
                                    $("div#modal_tambah_rekap").modal("hide");
                                    if (result == 1) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Data Rekap Medis Telah Tertambah',
                                            showConfirmButton: false,
                                            timer: 1000
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Data Rekap Medis Gagal Tertambah',
                                            showConfirmButton: false,
                                            timer: 1000
                                        });
                                    }
                                    $('#myTable').DataTable().ajax.reload();
                                }
                            });
                        }
                    });
                });
            }
        });
    });

    $("button#kembali_ke_data_rekap").click(function() {
        $.redirect("<?= base_url('perawat'); ?>");
    });

    $("button#print_data_rekap_pasien").click(function() {
        $.redirect("<?= base_url('perawat/print_data_rekap_pasien'); ?>", {
            "id_pasien": "<?= $id_pasien; ?>",
            "no_kartu": "<?= $no_kartu; ?>",
            "nama_kk": "<?= $nama_kk; ?>",
            "id_rekam_medik": "<?= $id_rekam_medik; ?>",
        }, "POST", "_blank");
    });

});
</script>