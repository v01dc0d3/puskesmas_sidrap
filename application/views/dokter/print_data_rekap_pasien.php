<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Rekap Pasien</title>
    <style type="text/css">
        table {
            width: 100%;
            font-family: Arial;
            table-layout: fixed;
        }
        td {
            text-align: left;
            vertical-align: middle;
        }
        .tab {
            display: inline-block;
            margin-left: 4em;
        }
        .judul {
            text-align: right;
        }

        .table_rekap {
            table-layout: fixed;
        }
        
        .table_rekap, .table_rekap th, .table_rekap td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        .table_rekap th{
            word-wrap:break-word;
        }
        .table_rekap th, td {
            word-wrap: break-word;
            max-width: 150px;
        }
    </style>
    <style type="text/css" media="print">
        @page { size: landscape; }
        
        .table_rekap th, td {
            word-wrap: break-word;
            max-width: 150px;
        }
    </style>
</head>
<body>
    <table>
        <tr><th colspan="4">PEMERINTAH KABUPATEN SIDENRENG RAPPANG</th></tr>
        <tr><th colspan="4">DINAS KESEHATAN</th></tr>
        <tr><th colspan="4">PENGENDALIAN PENDUDUK DAN KB</th></tr>
        <tr><th colspan="4"><b>UPT PUSKESMAS TANRUTEDONG</b></th></tr>
        <tr><td colspan="4" style="text-align:center;"><small>Jl. Andi Cammi No. 8 Tanrutedong, Kec. Dua Pitue Kab. Sidrap Telp. (0421) 721 009 Kode Pos 91681</small></td></tr>
        <tr><td colspan="4" style="text-align:center;"><small>e-mail: puskesmas_tanrutedong@yahoo.com</small></td></tr>
        <tr>
            <td class="judul">No. Identitas<span class="tab"></span></td>
            <td>:<u><?= $data_identitas[0]["no"]; ?></u></td>
            <td class="judul">No. Rekam Medik<span class="tab"></span></td>
            <td>:<u><?= $data_identitas[0]["no_kartu"]; ?></u></td>
        </tr>
        <tr>
            <td class="judul">Nama KK<span class="tab"></span></td>
            <td>:<u><?= $data_identitas[0]["nama_kk"]; ?></u></td>
            <td class="judul">Jenis Kelamin<span class="tab"></span></td>
            <td>:<u><?= $data_identitas[0]["jenis_kelamin"]; ?></u></td>
        </tr>
        <tr>
            <td class="judul">Nama Pasien<span class="tab"></span></td>
            <td>:<u><?= $data_identitas[0]["nama"]; ?></u></td>
            <td class="judul">Pekerjaan<span class="tab"></span></td>
            <td>:<u><?= $data_identitas[0]["pekerjaan"]; ?></u></td>
        </tr>
        <tr>
            <td class="judul">Tanggal Lahir<span class="tab"></span></td>
            <td>:<u><?= $data_identitas[0]["tanggal_lahir"]; ?></u></td>
            <td class="judul">Agama<span class="tab"></span></td>
            <td>:<u><?= $data_identitas[0]["agama"]; ?></u></td>
        </tr>
        <tr>
            <td class="judul">Alamat<span class="tab"></span></td>
            <td>:<u><?= $data_identitas[0]["alamat"]; ?></u></td>
            <td class="judul">No. Hp<span class="tab"></span></td>
            <td>:<u><?= $data_identitas[0]["no_hp"]; ?></u></td>
        </tr>
    </table>
    
    <br><br>
    <table class="table_rekap" border=1>
        <tr>
            <th rowspan="2">TGL</th>
            <th rowspan="2">Umur</th>
            <th rowspan="2">Ruang</th>
            <th rowspan="1" colspan="2">Kajian Paramedis (Data Fokus)</th>
            <th rowspan="1" colspan="3">Kajian Medis</th>
            <th rowspan="2">Asuhan Keperawatan / Kebidanana</th>
            <th rowspan="2">ICD X</th>
            <th rowspan="1" colspan="2">Paraf</th>
        </tr>
        <tr>
            <th>Data Subjektif (DS)</th>
            <th>Data Objektif (DO)</th>
            <th>Anamnesis (S) & Pem. Fisik (O)</th>
            <th>Diagnosis (A)</th>
            <th>Terapi (P)</th>
            <th>Medis</th>
            <th>Paramedis</th>
        </tr>
        <?php foreach($data_rekap_pasien as $drp) : ?>
        <tr>
            <td><?= $drp['tgl']; ?></td>
            <td><?= $drp['umur']; ?></td>
            <td><?= $drp['nama_ruang']; ?></td>
            <td><?= $drp['kajian_subjektif']; ?></td>
            <td><?= $drp['kajian_objektif']; ?></td>
            <td><?php echo (empty($drp['anam_pem_fisik'])) ? "" : $drp['anam_pem_fisik']; ?></td>
            <td><?php echo (empty($drp['diagnosis'])) ? "" : $drp['diagnosis']; ?></td>
            <td><?php echo (empty($drp['terapi'])) ? "" : $drp['terapi']; ?></td>
            <td><?php echo (empty($drp['asuhan'])) ? "" : $drp['asuhan']; ?></td>
            <td><?php echo (empty($drp['icd'])) ? "" : $drp['icd']; ?></td>
            <td><?= $drp['paraf_medis']; ?></td>
            <td><?= $drp['paraf_paramedis']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

<script>
    window.print();
</script>
</body>
</html>