<!DOCTYPE html>
<html>
	<head>
		<title>iPet - Inicio de Sesión</title>
		<link rel="stylesheet" type="text/css" href="vista/css/style.css">
		<link rel="shortcut icon" type="image/x-icon" href="assets/favicon/favicon.ico" />
	</head>
	<body class="formulario">
		<div class="menu" id="menu">
			<div class="left">
				<a href="index.php">Inicio</a>
				<a href="#">News</a>
				<a href="#">Contact</a>
				<a href="#">About</a>
			</div>
			<div class="right">
				<a href="#" class="active">Iniciar Sesión</a>
				<a href="index.php?mod=home&ope=signup">Registrarme</a>
			</div>
		</div>
		
		<div class="container-form">
			<div id="login">
				<h3>Iniciar Sesión</h3>
				
				<form method="get" action="index.php" name="login">
					<input type="hidden" name="mod" value="home">
					<input type="hidden" name="ope" value="signin">

					<label for="usuario">*Usuario o Email</label>
					<input type="text" name="usuario" id="usuario-login" />

					<label for="password">*Contraseña</label>
					<input type="password" name="password" id="password" />

					<input type="submit" class="button" value="Iniciar">
				</form>
				<?php
					if (!empty($error)) {
						echo '<div class="error-login"><p>Parece que tu nombre de usuario o email y/o contraseña son incorrectos. Inténtalo de nuevo</p></div>';
					}
				?>
			</div>
		</div>
	</body>
</html>