<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Usuarios - Crear Nuevo Usuario</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="assets/favicon/favicon.ico" />
	</head>
	
	<body>
		<h1>Crear Nuevo Usuario</h1>

		<h3>
			<a href="index.php">Volver Atrás</a>
		</h3>


		<form action="index.php?mod=usuario&ope=create" method="get" enctype="multipart/form-data">
			<input type="hidden" name="mod" value="<?=$_GET["mod"]?>">
			<input type="hidden" name="ope" value="<?=$_GET["ope"]?>">
			
			<label for="usuario">*Nombre de Usuario: </label>
			<input id="usuario" type="text" name="usuario" autofocus placeholder="Nombre de Usuario" required>
			<br>
			<label for="email">*Email: </label>
			<input id="email" type="email" name="email" placeholder="Correo Electrónico" required>
			<br>
			<label for="contrasena">*Contraseña: </label>
			<input id="contrasena" type="password" name="contrasena" placeholder="Contraseña" required>
			<br>
			<label for="nombre">*Nombre: </label>
			<input id="nombre" type="text" name="nombre" placeholder="Nombre" required>
			<br>
			<label for="edad">Edad: </label>
			<input id="edad" type="number" name="edad" placeholder="Edad">
			<br>
			<label for="genero">Género: </label>
			<select name="genero" id="genero">
				<option value="" disabled selected>Género</option>
				<option value="masculino">Masculino</option>
				<option value="femenino">Femenino</option>
				<option value="otro">Otro</option>
				<option value="0">Prefiero no especificar</option>
			</select>
			<br>
			<label for="imagen">Foto de Perfil: </label>
			<input id="imagen" type="file" name="imagen">
			<br>
			<br>
			<button type="submit">Crear Usuario</button>
		</form>

	</body>
</html>