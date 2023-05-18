<script>
$(document).ready(function() {

    var table = $('#myTable').DataTable({
        'autoWidth': true,
        'order': [[0, 'desc']],
        "ajax": {
            "url": "<?= base_url('auditor/get_all_rekap_medis'); ?>",
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
                    return '<button class="btn text-bg-primary mr-2" id="data_rekap_detail">Detail</button>';
                }
            },
        ],
    });
    
    $('#myTable').on('click', 'button#data_rekap_detail', function() {
        var data = table.row($(this).parents('tr')).data();

        $("div.modal_crud").remove();
        $.ajax({
            url: '<?= base_url("auditor/modal_body_detail_rekap"); ?>',
            success: function(result) {
                $("body").append(result);

                $('select#pilih_pasien').select2({theme: "bootstrap", dropdownParent: $('#modal_detail_rekap .modal-content'), placeholder: "Nama Pasien"});
                $("select#pilih_pasien").empty();

                $('select#pilih_ruang').select2({theme: "bootstrap", dropdownParent: $('#modal_detail_rekap .modal-content'), placeholder: "Nama Ruang"});
                $("select#pilih_ruang").empty();

                $('textarea#kajian').summernote("disable");
                $('textarea#kajian').summernote("code", data.kajian);

                $.ajax({
                    url: '<?= base_url("auditor/get_data_rekam_medik_by_id/"); ?>' + data.id,
                    success: function(result) {
                        var id_pasien = JSON.parse(result)[0].id_pasien;

                        $.ajax({
                            url: '<?= base_url("auditor/get_data_pasien"); ?>',
                            success: function(result) {
                                let data_pasien = JSON.parse(result);
                                $("select#pilih_pasien").append("<option selected value=''>Nama Pasien</option>");
                                $.each(data_pasien, function(index, value) {
                                    if(id_pasien == value.id) {
                                        $("select#pilih_pasien").append("<option selected value="+ value.id +">"+ value.nama_kk +"</option>");
                                    } else {
                                        $("select#pilih_pasien").append("<option value="+ value.id +">"+ value.nama_kk +"</option>");
                                    }

                                    $('select#pilih_pasien').prop('disabled', true);
                                });
                            }
                        });
                    },
                });

                $.ajax({
                    url: '<?= base_url("auditor/get_data_ruang"); ?>',
                    success: function(result) {
                        let data_ruang = JSON.parse(result);
                        $("select#pilih_ruang").append("<option selected value=''>Nama Ruang</option>");
                        $.each(data_ruang, function(index, value) {
                            if(data.id_ruang == value.id) {
                                $("select#pilih_ruang").append("<option selected value="+ value.id +">"+ value.nama +"</option>");
                            } else {
                                $("select#pilih_ruang").append("<option value="+ value.id +">"+ value.nama +"</option>");
                            }

                            $('select#pilih_ruang').prop('disabled', true);
                        });
                        $("div#modal_detail_rekap").modal("show");
                    }
                });
            }
        });
    });

    $("button#kembali_ke_auditor").click(function() {
        window.location.replace("<?= base_url('auditor/'); ?>");
    });

});
</script>