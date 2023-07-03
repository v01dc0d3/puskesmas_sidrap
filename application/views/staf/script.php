<script>
$(document).ready(function() {

var table = $('#myTable').DataTable({
    'autoWidth': true,
    "ajax": {
        "url": "<?= base_url('staf/get_all_last_rekam_medik_pasien'); ?>",
        "dataSrc": function(result) {
            return result;
        },
    },
    "columns": [
        { "data": "no_kartu" },
        { "data": "nik" },
        { "data": "nama_kk" },
        { 
            "data": null,
            "render": function ( data, type, row ) {
                return '<button class="btn text-bg-primary mr-2" id="data_rekam_atur">Atur</button><button class="btn text-bg-success mr-2" id="cetak_no_rekam_medik">Cetak Nomor Rekam Medik</button>';
            }
        },
    ],
});

$('#myTable').on('click', 'button#data_rekam_atur', function() {
    var data = table.row($(this).parents('tr')).data();

    $.redirect("<?= base_url('pasien/'); ?>", {
        nama_kk: data.nama_kk,
        nik: data.nik,
        id_pasien: data.id_pasien,
    });

});

$('#myTable').on('click', 'button#cetak_no_rekam_medik', function() {
    var data = table.row($(this).parents('tr')).data();

    Swal.fire({
        icon: 'info',
        title: 'Nomor rekam medik: ' + data.no_kartu,
    });
});

$('button#tambah_pasien').click(function() {
    window.location.replace("<?= base_url('register/'); ?>");
});

$('button#atur_pengguna').click(function() {
    window.location.replace("<?= base_url('staf/atur_pengguna') ?>");
});

$('button#ambil_antrian').click(function() {
    var tgl = new Date();
    tgl = tgl.getFullYear() + "-" + "0" + (tgl.getMonth() + 1) + "-" + tgl.getDate();

    $.ajax({
        url: "<?= base_url('staf/cek_tgl_antrian'); ?>",
        success: function(result) {
            var tgl_tb = JSON.parse(result);
            if (tgl_tb.length != 0) {
                tgl_tb = tgl_tb[0].tgl;
                if (tgl == tgl_tb) {
                    $.ajax({
                        url: "<?= base_url('staf/create_antrian'); ?>",
                        data: {tgl: tgl},
                        method: 'POST',
                        success: function(result) {
                            var no_antrian = JSON.parse(result)[0].no_antrian;
                            Swal.fire({
                                icon: 'info',
                                title: 'Antrian ke-' + no_antrian,
                            });
                        }
                    });
                } else {
                    $.ajax({
                        url: "<?= base_url('staf/delete_all_antrian'); ?>",
                        success: function() {
                            $.ajax({
                                url: "<?= base_url('staf/create_antrian'); ?>",
                                data: {tgl: tgl},
                                method: 'POST',
                                success: function(result) {
                                    var no_antrian = JSON.parse(result)[0].no_antrian;
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Antrian ke-' + no_antrian,
                                    });
                                }
                            });
                        }
                    });
                }
            } else {
                $.ajax({
                    url: "<?= base_url('staf/create_antrian'); ?>",
                    data: {tgl: tgl},
                    method: 'POST',
                    success: function(result) {
                        if (result == 1) {
                            $.ajax({
                                url: "<?= base_url('staf/read_antrian_from_id_user'); ?>",
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

});
</script>