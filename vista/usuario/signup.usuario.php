<!DOCTYPE html>
<html>
	<head>
		<title>iPet - Registro</title>
		<link rel="stylesheet" type="text/css" href="vista/css/style.css">
		<link rel="shortcut icon" type="image/x-icon" href="assets/favicon/favicon.ico" />
	</head>
	<body>
		<div class="menu" id="menu">
			<div class="left">
				<a href="index.php">Inicio</a>
				<a href="#">News</a>
				<a href="#">Contact</a>
				<a href="#">About</a>
			</div>
			<div class="right">
				<a href="index.php?mod=home&ope=signin">Iniciar Sesión</a>
				<a href="#" class="active">Registrarme</a>
			</div>
		</div>

		<div class="container-form">
			<div id="signup">
				<h3>Registro</h3>
				<form method="get" action="index.php" name="signup">
					<input type="hidden" name="mod" value="usuario">
					<input type="hidden" name="ope" value="create">

					<label for="usuario">*Nombre de Usuario</label>
					<input type="text" name="usuario" id="usuario" />

					<label for="email">*Email</label>
					<input type="mail" name="email" id="email" />

					<label>*Nombre</label>
					<input type="text" name="nombre" />

					<label>Edad</label>
					<input type="number" name="edad" />

					<label for="genero">Género: </label>
					<select name="genero" id="genero">
						<option value="" disabled selected>Género</option>
						<option value="masculino">Masculino</option>
						<option value="femenino">Femenino</option>
						<option value="otro">Otro</option>
						<option value="0">Prefiero no especificar</option>
					</select>

					<label for="contrasena">*Contraseña</label>
					<input type="password" name="contrasena" id="contrasena" />

					<label>*Confirmar Contraseña</label>
					<input type="password" name="confirmPassword"  />
					<input type="submit" class="button" value="Registro">
				</form>
			</div>
		</div>		
	</body>
</html>