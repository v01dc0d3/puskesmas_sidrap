<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $this->session->userdata('nama_kk'); ?></h1>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-6 my-3">
        <button type="button" class="btn btn-success" id="ambil_antrian">
            Ambil Antrian
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