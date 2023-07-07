<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
</div>

<div class="row">
    <div class="col-md-6 my-3">
        <!-- <button type="button" class="btn btn-success" id="tambah_pasien">
            Tambah Pasien
        </button> -->
        <!-- <button type="button" class="btn btn-warning text-white" id="atur_pengguna">
            Atur Pengguna
        </button> -->
        <!-- <button type="button" class="btn btn-primary" id="ambil_antrian">
            Ambil Antrian
        </button> -->
    </div>
</div>

<div class="row">

    <div class="col-md-12">
        <table id="myTable" class="display table">
            <thead>
                <tr>
                    <th>No Kartu</th>
                    <th>NIK</th>
                    <th>Nama Pasien</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</div>

</div>
<!-- /.container-fluid -->