<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i>
        Generate Report
    </a>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-6 my-3">
        <button type="button" class="btn btn-danger" id="kembali_ke_rekap_pasien">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="nama_pasien" class="form-label">Nama Pasien</label>
            <select class="form-select" aria-label="nama_pasien" id="nama_pasien" disabled>
                <option selected value="<?= $id_pasien; ?>"><?= $nama_kk; ?></option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="nama_ruang" class="form-label">Nama Ruang</label>
            <select class="form-select" aria-label="nama_ruang" id="nama_ruang" disabled>
                <option selected value="<?= $id_ruang; ?>"><?= $nama_ruang; ?></option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="kajian">Kajian Paramedis (Data Fokus)</label>
            <textarea class="form-control" placeholder="Kajian Paramedis (Data Fokus)" id="kajian" style="height: 500px" disabled></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="anam_pem_fisik">Anamnesis (S) & Pem. Fisik (O)</label>
            <textarea class="form-control" placeholder="Anamnesis (S) & Pem. Fisik (O)" id="anam_pem_fisik" style="height: 500px" disabled><?= $anam_pem_fisik; ?></textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="diagnosis">Diagnosis (A)</label>
            <textarea class="form-control" placeholder="Diagnosis (A)" id="diagnosis" style="height: 500px" disabled><?= $diagnosis; ?></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="terapi">Terapi (P)</label>
            <textarea class="form-control" placeholder="Terapi (P)" id="terapi" style="height: 500px" disabled><?= $terapi; ?></textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="asuhan">Asuhan Keperawatan / Kebidanan</label>
            <textarea class="form-control" placeholder="Asuhan Keperawatan / Kebidanan" id="asuhan" style="height: 500px" disabled><?= $asuhan; ?></textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="icd">ICD X</label>
            <textarea class="form-control" placeholder="ICD X" id="icd" style="height: 500px" disabled><?= $icd; ?></textarea>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->