<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Z-Techno Boilerplate Landing Page</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?=asset('assets/img/main-logo.png')?>" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="<?=asset('assets/js/plugin/webfont/webfont.min.js')?>"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?=asset('assets/css/fonts.min.css')?>']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?=asset('assets/css/bootstrap.min.css')?>">
    <style>
    .centered {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    </style>
</head>
<body>
    <div class="centered">
        <center>
            <img src="<?=asset('assets/img/main-logo.png')?>" alt="" width="100px">
            <h2>Selamat, Instalasi Z-Techno Boilerplate telah berhasil.</h2>
            <br>
            <a href="<?=routeTo('default/index')?>" class="btn btn-primary">Buka Panel Admin</a>
        </center>
    </div>
</body>
</html>
