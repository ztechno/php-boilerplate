<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Edit Profil</h2>
                        <h5 class="text-white op-7 mb-2">Edit profil berupa nama, username dan password</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if($success_msg): ?>
                            <div class="alert alert-success"><?=$success_msg?></div>
                            <?php endif ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="users[name]" class="form-control" value="<?=$data->name?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="users[username]" class="form-control" value="<?=$data->username?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Kata Sandi</label>
                                    <input type="password" name="users[password]" class="form-control">
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