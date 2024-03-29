<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('laporan'); ?>?from=admin" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-eye fa-sm text-white-50"></i>
        Lihat Laporan
    </a>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-8 my-3">
        <button type="button" class="btn btn-success" id="tambah_akses_halaman">
            Tambah Halaman Baru
        </button>
        <!-- <button type="button" class="btn btn-primary" id="atur_staf">
            Atur Staf
        </button> -->
        <button type="button" class="btn btn-warning text-white" id="atur_pengguna">
            Atur Pengguna
        </button>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
        <table id="myTable" class="display table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Halaman</th>
                    <th>Nama Role</th>
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