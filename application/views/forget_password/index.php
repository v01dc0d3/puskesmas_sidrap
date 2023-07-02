<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row my-0 mh-100">
                    <div class="col-lg-12">
                        <div class="pt-4 px-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-1">Login</h1>
                                <h6 class="text-gray-900">Puskesmas Sidrap</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="pt-3 px-5">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input required type="email" class="form-control form-control-user" id="email" aria-describedby="email_help" placeholder="Masukkan email..">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group mb-3">
                                    <input required id="password" type="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="password">
                                    <button class="input-group-text" id="show_password"><i class="fa-solid fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="pt-2 px-5 text-center">
                            <button class="form-control btn btn-primary" id="kirim">Kirim</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="pt-1 pb-4 px-5">
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('login'); ?>">Sudah punya akun?</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

