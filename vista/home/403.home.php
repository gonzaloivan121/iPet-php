<!DOCTYPE html>
<html>
	<head>
		<title>iPet</title>
		<link rel="stylesheet" type="text/css" href="vista/css/style.css">
		<link rel="shortcut icon" type="image/x-icon" href="assets/favicon/favicon.ico" />
	</head>

	<body class="error-page">
		<div class="menu" id="menu">
			<div class="left">
				<a href="index.php">Inicio</a>
				<?php
					if (isset($_SESSION["sesion"])) {

						if (($_SESSION["sesion"] == "admin") || ($_SESSION["sesion"] == "admin@admin.com")) {
							echo '<a href="index.php?mod=home&ope=admin">Administrar</a>' ;
						} else {
							echo '<a href="index.php?mod=home&ope=match">Match</a>' ;
						}
					}
				?>
				<a href="#">News</a>
				<a href="#">Contact</a>
				<a href="#">About</a>
			</div>
			<div class="right">
				<?php
					if (isset($_SESSION["sesion"])) {
						?>
							<div class="dropdown">
								<button class="dropbtn"><?=$usuario->getUsuario()?></button>
								<div class="dropdown-content">
									<a href="index.php?mod=usuario&ope=index&usuario=<?=$usuario->getUsuario()?>">Perfil</a>
									<?php
										if (($_SESSION["sesion"] == "admin") || ($_SESSION["sesion"] == "admin@admin.com")) {
											echo '<a href="index.php?mod=home&ope=admin">Administrar</a>' ;
										}
									?>
									<a href="index.php?mod=home&ope=signout">Cerrar Sesión</a>
								</div>
							</div>
						<?php
					} else {
						?>
							<a href="index.php?mod=home&ope=signin">Iniciar Sesión</a>
							<a href="index.php?mod=home&ope=signup">Registrarme</a>
						<?php
					}
				?>
			</div>
		</div>

		<div class="fondo"></div>
		<div class="contenedor">
			<h1>403</h1>
			<h2>UNAUTHORIZED</h2>
		</div>
	</body>
</html>