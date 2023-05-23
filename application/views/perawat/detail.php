<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
</div>

<!-- Content Row -->
<div class="row my-3">
    <div class="col-md-6 ">
        <button type="button" class="btn btn-danger" id="kembali_ke_data_rekap">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button type="button" class="btn btn-success" id="tambah_rekap">
            <i class="fa-solid fa-plus"></i>
        </button>
        <button type="button" class="btn btn-info" id="print_data_rekap_pasien">
            <i class="fa-solid fa-print"></i>
        </button>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
        <table id="myTable" class="display table">
            <thead>
                <tr>
                    <th>Tgl</th>
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