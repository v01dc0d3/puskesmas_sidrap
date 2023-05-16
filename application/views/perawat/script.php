<script>
$(document).ready(function() {

    var table = $('#myTable').DataTable({
        'autoWidth': true,
        "ajax": {
            "url": "get_all_rekap_medis",
            "dataSrc": function(result) {
                return result;
            },
        },
        "columns": [
            { "data": "tgl" },
            { "data": "nama_kk" },
            { 
                "data": null,
                "render": function ( data, type, row ) {
                    return '<button class="btn text-bg-primary mr-2" id="data_rekap_detail">Detail</button><button class="btn text-bg-success mr-2" id="data_rekap_update">Update</button><button class="btn text-bg-danger mr-2" id="data_rekap_hapus">Hapus</button>';
                }
            },
        ],
    });

    $('#myTable').on('click', 'button#data_rekap_update', function() {
        var data = table.row($(this).parents('tr')).data();
        $("div.modal_crud").remove();

        $.ajax({
            url: 'modal_body_edit_rekap',
            success: function(result) {
                $("body").append(result);

                $('select#pilih_pasien').select2({theme: "bootstrap", dropdownParent: $('#modal_edit_rekap .modal-content'), placeholder: "Nama Pasien"});
                $("select#pilih_pasien").empty();

                $('select#pilih_ruang').select2({theme: "bootstrap", dropdownParent: $('#modal_edit_rekap .modal-content'), placeholder: "Nama Ruang"});
                $("select#pilih_ruang").empty();

                $('textarea#kajian').summernote("code", data.kajian);

                $.ajax({
                    url: 'get_data_rekam_medik_by_id/' + data.id,
                    success: function(result) {
                        var id_pasien = JSON.parse(result)[0].id_pasien;

                        $.ajax({
                            url: 'get_data_pasien',
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
                    url: 'get_data_ruang',
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
                    let kajian = $('textarea#kajian').val();

                    let tgl = new Date();
                    tgl = tgl.getDate() + "/" + tgl.getMonth() + "/" + tgl.getFullYear();

                    $.ajax({
                        url: 'edit_data_rekap/' + data.id,
                        method: 'POST',
                        data: {
                            'id_ruang': ruang,
                            'kajian': kajian,
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
                        url: 'delete_data_rekap_by_id/' + data.id,
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


    $("button#tambah_rekap").click(function(){
        $("div.modal_crud").remove();

        $.ajax({
            url: 'modal_body_tambah_rekap',
            success: function(result) {
                $("body").append(result);

                $('select#pilih_pasien').select2({theme: "bootstrap", dropdownParent: $('#modal_tambah_rekap .modal-content'), placeholder: "Nama Pasien"});
                $("select#pilih_pasien").empty();

                $('select#pilih_ruang').select2({theme: "bootstrap", dropdownParent: $('#modal_tambah_rekap .modal-content'), placeholder: "Nama Ruang"});
                $("select#pilih_ruang").empty();

                $('textarea#kajian').summernote();

                $.ajax({
                    url: 'get_data_pasien',
                    success: function(result) {
                        let data_pasien = JSON.parse(result);
                        $("select#pilih_pasien").append("<option selected value=''>Nama Pasien</option>");
                        $.each(data_pasien, function(index, value) {
                            $("select#pilih_pasien").append("<option value="+ value.id +">"+ value.nama_kk +"</option>");
                        });
                    }
                });

                $.ajax({
                    url: 'get_data_ruang',
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
                    let kajian = $('textarea#kajian').val();

                    console.log("asdadsa");

                    $.ajax({
                        url: 'get_id_rekam_medik_by_pasien',
                        method: 'POST',
                        data: {'id_pasien': pasien,},
                        success: function(result) {
                            let data = JSON.parse(result);
                            let id_rekam_medik = data[0].id;

                            let tgl = new Date();
                            tgl = tgl.getDate() + "/" + tgl.getMonth() + "/" + tgl.getFullYear();

                            $.ajax({
                                url: 'insert_data_rekap',
                                method: 'POST',
                                data: {
                                    'id_rekam_medik': id_rekam_medik,
                                    'id_ruang': ruang,
                                    'kajian': kajian,
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

});
</script>