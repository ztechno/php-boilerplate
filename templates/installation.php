<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Installasi</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/main-logo.png" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/atlantis.min.css">
</head>
<body style="min-height:auto;">
	<div class="container">
        <div class="row mt-4">
            <div class="col-sm-12 col-md-6 mx-auto" style="max-width:450px">
                <div class="card full-height">
                    <div class="card-body">
                        <center>
                            <img src="assets/img/main-logo.png" width="150px" height="100px" alt="logo" style="object-fit:contain;">
                        </center>
                        <div class="card-title text-center">Form Instalasi</div>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="">Nama Aplikasi</label>
                                <input type="text" name="app[name]" id="" required class="form-control mb-2" placeholder="Nama Aplikasi Disini...">
                                <label for="">Alamat</label>
                                <textarea name="app[address]" id="" required class="form-control mb-2" placeholder="Alamat Disini..."></textarea>
                                <label for="">Telepon / HP</label>
                                <input type="tel" name="app[phone]" id="" required class="form-control mb-2" placeholder="Telepon / HP Disini...">
                                <label for="">E-Mail</label>
                                <input type="text" name="app[email]" id="" required class="form-control mb-2" placeholder="E-Mail Disini...">
                                <label for="">Nama Pengguna</label>
                                <input type="text" name="users[username]" id="" required class="form-control mb-2" placeholder="Nama Pengguna Disini...">
                                <label for="">Kata Sandi</label>
                                <input type="password" name="users[password]" id="" required class="form-control mb-2" placeholder="Kata Sandi Disini...">
                                <button class="btn btn-primary btn-block btn-round">Lakukan Pemasangan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>