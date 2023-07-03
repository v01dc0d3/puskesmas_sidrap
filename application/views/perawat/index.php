<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
</div>

<?php if ($this->session->userdata('id_role') == "7") : ?>
<div class="row">
    <div class="col-md-6 my-3">
        <button type="button" class="btn btn-danger" id="kembali_ke_auditor">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
    </div>
</div>
<?php endif; ?>

<div class="row">

    <div class="col-md-12">
        <table id="myTable" class="display table">
            <thead>
                <tr>
                    <th>Tgl</th>
                    <th>NIK</th>
                    <th>Nama Pasien</th>
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