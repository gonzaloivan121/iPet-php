<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Usuarios - Editar Usuario</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="assets/favicon/favicon.ico" />
	</head>
	
	<body>
		<h1>Editar Usuario</h1>

		<h3>
			<a href="index.php">Volver Atrás</a>
		</h3>


		<form action="index.php?mod=usuario&ope=update&usuario=<?= $usrName ?>" method="get">
			<input type="hidden" name="mod" value="<?=$_GET["mod"]?>">
			<input type="hidden" name="ope" value="<?=$_GET["ope"]?>">

			<label for="email">*Email: </label>
			<input id="email" type="email" name="email" autofocus value="<?= $ema ?>" placeholder="Email">
			<br>
			<label for="contrasena">*Contraseña: </label>
			<input id="contrasena" type="password" name="contrasena" value="<?= $con ?>" placeholder="Contraseña">
			<br>
			<label for="nombre">*Nombre: </label>
			<input id="nombre" type="text" name="nombre" value="<?= $nom ?>" placeholder="Nombre">
			<br>
			<label for="edad">Edad: </label>
			<input id="edad" type="number" name="edad" value="<?= $eda ?>" placeholder="Edad">
			<br>
			<label for="genero">Género: </label>
			<input id="genero" type="text" name="genero" value="<?= $gen ?>" placeholder="Género">
			<br>
			<label for="imagen">Imágen de Perfil: </label>
			<input id="imagen" type="file" name="imagen" value="<?= $ima ?>">
			<br>
			<br>
			<button type="submit">Actualizar Usuario</button>
		</form>

	</body>
</html>