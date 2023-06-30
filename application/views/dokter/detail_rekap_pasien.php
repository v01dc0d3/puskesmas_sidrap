<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
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
    <div class="col-md-4">
        <div class="mb-3">
            <label for="kajian_subjektif">Kajian Subjektif</label>
            <textarea class="form-control" placeholder="Kajian Subjektif" id="kajian_subjektif" style="height: 500px" disabled><?= $kajian_subjektif; ?></textarea>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="kajian_objektif">Kajian Objektif</label>
            <textarea class="form-control" placeholder="Kajian Objektif" id="kajian_objektif" style="height: 500px" disabled><?= $kajian_objektif; ?></textarea>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="asuhan">Asuhan</label>
            <textarea class="form-control" placeholder="Diagnosis (A)" id="asuhan" style="height: 500px" disabled><?= $asuhan; ?></textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="paraf_paramedis">Paraf Paramedis</label>
            <select class="form-select" name="paraf_paramedis" id="paraf_paramedis" disabled>
                <option selected disabled value="">Pilih Paraf Medis</option>
                <option disabled value="-">-</option>
                <option value="terima">Terima</option>
                <option value="tolak">Tolak</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="anam_pem_fisik">Anamnesis (S) & Pem. Fisik (O)</label>
            <textarea class="form-control" placeholder="Anamnesis (S) & Pem. Fisik (O)" id="anam_pem_fisik" style="height: 500px" disabled><?= $anam_pem_fisik; ?></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="diagnosis">Diagnosis (A)</label>
            <textarea class="form-control" placeholder="Diagnosis (A)" id="diagnosis" style="height: 500px" disabled><?= $diagnosis; ?></textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="terapi">Terapi (P)</label>
            <textarea class="form-control" placeholder="Terapi (P)" id="terapi" style="height: 500px" disabled><?= $terapi; ?></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="icd">ICD X</label>
            <textarea class="form-control" placeholder="ICD X" id="icd" style="height: 500px" disabled><?= $icd; ?></textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="paraf_medis">Paraf Medis</label>
            <select class="form-select" name="paraf_medis" id="paraf_medis" disabled>
                <option selected disabled value="">Pilih Paraf Medis</option>
                <option disabled value="-">-</option>
                <option value="terima">Terima</option>
                <option value="tolak">Tolak</option>
            </select>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->