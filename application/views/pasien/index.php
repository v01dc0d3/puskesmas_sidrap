<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $nama_kk; ?></h1>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-6 my-3">
        <button type="button" class="btn btn-danger" id="kembali_ke_data_staf">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button type="button" class="btn btn-info" id="print_data_rekap_pasien">
            <i class="fa-solid fa-print"></i>
        </button>
    </div>
</div>

<div class="row">
    <label class="h4" for="tabel_rekap_medis">Rekap Medis</label>
    <div class="col-md-12">
        <table id="tabel_rekap_medis" class="display table">
            <thead>
                <tr>
                    <th>Tgl</th>
                    <th>Anamnesa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</div>

<div class="row mt-3 py-5">
    <label class="h4" for="tabel_rekap_medis">Rekap Medis</label>
    <div class="col-md-12">
        <table id="tabel_rekam_medik" class="display table">
            <thead>
                <tr>
                    <th>Tgl</th>
                    <th>Anamnesa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</div>

</div>
<!-- /.container-fluid -->