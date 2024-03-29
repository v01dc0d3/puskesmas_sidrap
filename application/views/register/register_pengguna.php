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
                                <h1 class="h4 text-gray-900 mb-1">Buat Akun Pasien</h1>
                                <h6 class="text-gray-900">Puskesmas Sidrap</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="pt-3 pl-5">
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
                            <div class="form-group">
                                <label for="no_hp">No. HP</label>
                                <input required type="text" class="form-control form-control-user" id="no_hp" aria-describedby="no_hp_help" placeholder="Masukkan no_hp..">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="pt-3 pr-5">
                            <div class="form-group">
                                <label for="nama_kk">Nama Lengkap Sesuai KK</label>
                                <input required type="text" class="form-control form-control-user" id="nama_kk" aria-describedby="nama_kk_help" placeholder="Masukkan nama_kk..">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Konfirmasi Password</label>
                                <div class="input-group mb-3">
                                    <input required id="confirm_password" type="password" class="form-control" placeholder="confirm_password" aria-label="confirm_password" aria-describedby="confirm_password">
                                    <button class="input-group-text" id="show_confirm_password"><i class="fa-solid fa-eye"></i></button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-select" name="role" id="role">
                                    <option selected disabled value="">Pilih Role</option>
                                    <?php foreach($roles as $role) : ?>
                                    <option value="<?= $role['id']; ?>"><?= ucfirst($role['rolename']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="pt-2 px-5 text-center">
                            <button class="form-control btn btn-primary" id="daftar">Daftar</button>
                        </div>
                    </div> 
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="pt-1 pb-4 px-5">
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('admin'); ?>">Kembali ke halaman admin</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

