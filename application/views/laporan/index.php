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
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Penyakit Perbulan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <ul class="dropdown-menu"></ul>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
<!-- /.container-fluid -->