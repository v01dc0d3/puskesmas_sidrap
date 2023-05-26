<nav class="navbar navbar-expand-lg fixed-top py-sm-3 py-lg-0">
    <div class="container-fluid">
        <a class="navbar-brand px-3" href="<?= base_url('beranda'); ?>"><?= $nama; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ps-2 mb-lg-0 col justify-content-center">
                <li class="nav-item px-3 py-3">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('beranda'); ?>">Home</a>
                </li>
                <li class="nav-item px-3 py-3">
                    <a class="nav-link active" href="<?= base_url('beranda/kontak'); ?>">Kontak</a>
                </li>
                <li class="nav-item px-3 py-3 dropdown active">
                    <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Layanan</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('pasien'); ?>">Ambil Nomor Antrian</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('pasien') ?>">Lihat Rekap Medis</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('pasien') ?>">Lihat Rekam Medik</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= base_url('reister'); ?>">Buat Akun Pasien</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ps-2 mb-2 mb-lg-0 col-1">
                <li class="nav-item px-3 py-3"><a class="nav-link" href="<?= ($this->session->has_userdata("login")) ? base_url( $this->session->userdata('rolename') ) : base_url("login"); ?>"><?= ($this->session->has_userdata("login")) ? ( ($this->session->userdata('full_name') == '') ? 'Pasien' : 'Pegawai' ) : "Login"; ?></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="row jumbotron m-0">
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-lg-6">
            <h1 class="text-white">Selamat Datang di Website Puskesmas Sidrap</h1>
            <p class="text-white text-center mt-5">Website ini merupakan sebuah implementasi dari sistem digitalisasi puskesmas kawasan Sidrap (Sidenreng Rappang). Dengan adanya website ini, diharapkan sistem kerja di puskesmas dapat terleksana dengan lebih baik, cepat dan efisien.</p>
            <button type="button" class="btn btn-info mt-5 w-100 p-3 text-white" id="lihat_layanan">Lihat Layanan</button>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row my-5 d-flex justify-content-center">
        <div class="col-lg-6 mx-5">
            <h2 class="mt-5">Layanan Ambil Antrian Online</h2>
            <p class="mt-5">Ambil antrian anda secara online untuk mendapatkan pengalaman pengambilan antrian tanpa harus mengantri atau datang ke puskesmas, hanya untuk mengambil nomor antrian. Anda akan mendapatkan nomor antrian secara real-time hanya untuk <b>hari yang sama</b>. Jadi, nomor antrian akan selalu direset setiap harinya. Pastikan anda mendapatkan noomor antrian pertama dengan mengambil nomor antrian pada jam-jam pergantian hari. Untuk mengambil nomor antrian, pasien harus melakukan <b>Login</b> terlebih dahulu. Jika belum memiliki akun, pasien harus membuat akun pasiennya di halaman <b>registrasi</b>.</p>
            <a href="<?= base_url('Pasien'); ?>" type="button" class="btn btn-info mt-5 w-100 p-3 text-white">Ambil Antrian Sekarang</a>
        </div>
        <div class="mt-5 col-lg-4 bg-img mx-5">
            <img src="<?= base_url('assets/images/sistem/antrian.png'); ?>" alt="antrian.png">
        </div>
    </div>

    <div class="row my-5 d-flex justify-content-center">
        <div class="mt-5 col-lg-4 bg-img mx-5">
            <img src="<?= base_url('assets/images/sistem/rekap_medis.png'); ?>" alt="antrian.png">
        </div>
        <div class="col-lg-6 mx-5">
            <h2 class="mt-5">Lihat Rekap Medis</h2>
            <p class="mt-5">Ambil antrian anda secara online untuk mendapatkan pengalaman pengambilan antrian tanpa harus mengantri atau datang ke puskesmas, hanya untuk mengambil nomor antrian. Anda akan mendapatkan nomor antrian secara real-time hanya untuk <b>hari yang sama</b>. Jadi, nomor antrian akan selalu direset setiap harinya. Pastikan anda mendapatkan noomor antrian pertama dengan mengambil nomor antrian pada jam-jam pergantian hari. Untuk mengambil nomor antrian, pasien harus melakukan <b>Login</b> terlebih dahulu. Jika belum memiliki akun, pasien harus membuat akun pasiennya di halaman <b>registrasi</b>.</p>
            <a href="<?= base_url('pasien'); ?>" type="button" class="btn btn-info mt-5 w-100 p-3 text-white">Lihat Rekap Medis</a>
        </div>
    </div>
    
    <div class="row my-5 d-flex justify-content-center">
        <div class="col-lg-6 mx-5">
            <h2 class="mt-5">Lihat Rekam Medik</h2>
            <p class="mt-5">Ambil antrian anda secara online untuk mendapatkan pengalaman pengambilan antrian tanpa harus mengantri atau datang ke puskesmas, hanya untuk mengambil nomor antrian. Anda akan mendapatkan nomor antrian secara real-time hanya untuk <b>hari yang sama</b>. Jadi, nomor antrian akan selalu direset setiap harinya. Pastikan anda mendapatkan noomor antrian pertama dengan mengambil nomor antrian pada jam-jam pergantian hari. Untuk mengambil nomor antrian, pasien harus melakukan <b>Login</b> terlebih dahulu. Jika belum memiliki akun, pasien harus membuat akun pasiennya di halaman <b>registrasi</b>.</p>
            <a href="<?= base_url('pasien'); ?>" type="button" class="btn btn-info mt-5 w-100 p-3 text-white">Lihat Rekam Medik</a>
        </div>
        <div class="mt-5 col-lg-4 bg-img mx-5">
            <img src="<?= base_url('assets/images/sistem/rekam_medik.png'); ?>" alt="antrian.png">
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="col-sm-12 mt-5 bg-dark">
    <div class="container py-5 text-white d-flex justify-content-between">
        <div class="d-flex flex-column">
            <h3>Alamat</h3>
            <h6>Puskesmas Pangkajene : Pangkajene, Maritengngae, Sidenreng Rappang, Sulawesi Sel. 91611, Pangkajene, Kec. Maritengngae, Kabupaten Sidenreng Rappang, Sulawesi Selatan 91611</h6>
            <p>Google maps link : https://goo.gl/maps/tJcAu2CT8VYNqv5fA</p>
            <h6>Puskesmas Rappang : 4RX7+W65, JL Aspol, Rappang, Panca Rijang, Pangkajene, Kec. Panca Rijang, Kabupaten Sidenreng Rappang, Sulawesi Selatan 91651</h6>
            <p>Google maps link : https://goo.gl/maps/JtwW7Ko4F7chGoCs6</p>
        </div>
        <div class="vr mx-5"></div>
        <div class="col-sm-6">
            <h3>Website Terkait</h3>
            <p>Website Utama : https://void.rf.gd/</p>

            <h3>FAQ</h3>
            <p>#q1 : Cara untuk mendapatkan antrian online</p>
            <p>#q2 : Apakah ada versi androidnya?</p>
            <p>#q3 : Bagaimana cara untuk membuat akun pasien?</p>
        </div>
        <p class="text-light"></p>
    </div>
    <div class="col-sm-12 text-light text-center p-5">Copyright 2023 Tim Pengembang Aplikasi Website Puskesmas Sidrap</div>
</footer>

</body>
</html>