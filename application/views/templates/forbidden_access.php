<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- bootstrap 5 -->
    <link href="<?= base_url(); ?>assets/bootstrap5/css/bootstrap.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/bootstrap5/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <title>Terlarang</title>
</head>
<body>
    <div class="container pt-5 mt-5">
        <div class="row justify-content-center text-center align-items-center pt-5 mt-5">
            <div class="col-md-6 align-self-center pt-5 mt-5">
                <h1>403</h1>
                <h2>Anda Dilarang Mengakses Halaman Ini!</h2>
                <a class="btn btn-primary" href="<?= base_url('beranda'); ?>">Kembali Ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>