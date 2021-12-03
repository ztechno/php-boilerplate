<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Buat Pengguna Baru</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data pengguna</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="index.php?r=users/index" class="btn btn-warning btn-round">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="users[name]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="users[username]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Kata Sandi</label>
                                    <input type="password" name="users[password]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>