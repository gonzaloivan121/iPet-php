<!DOCTYPE html>
<html>
	<head>
		<title>iPet</title>
		<link rel="stylesheet" type="text/css" href="vista/css/style.css">
		<link rel="shortcut icon" type="image/x-icon" href="assets/favicon/favicon.ico" />
	</head>

	<body class="admin crud create">
		<div class="menu" id="menu">
			<div class="left">
				<a href="index.php">Inicio</a>
				<a href="index.php?mod=home&ope=admin">Administrar</a>
				<a href="index.php?mod=home&ope=admin&view=usuarios" class="active">Usuarios</a>
				<a href="index.php?mod=home&ope=admin&view=mascotas">Mascotas</a>
				<a href="index.php?mod=home&ope=admin&view=especies">Especies</a>
				<a href="index.php?mod=home&ope=admin&view=razas">Razas</a>
			</div>
			<div class="right">
				<div class="dropdown">
					<button class="dropbtn"><?=$admin->getUsuario()?></button>
					<div class="dropdown-content">
						<a href="index.php?mod=usuario&ope=index&usuario=<?=$admin->getUsuario()?>">Perfil</a>
						<a href="index.php?mod=home&ope=admin">Administrar</a>
						<a href="index.php?mod=home&ope=signout">Cerrar Sesión</a>
					</div>
				</div>
			</div>
		</div>

		<div class="contenedor">
			<form method="get" action="index.php">
				<input type="hidden" name="mod" value="home" />
				<input type="hidden" name="ope" value="admin" />
				<input type="hidden" name="view" value="usuarios" />
				<input type="hidden" name="exec" value="update" />
				<input type="hidden" name="usuario" value="<?= $usu ?>" />

				<label for="email">Email: </label>
				<input type="mail" name="email" id="email" value="<?= $ema ?>" required />

				<label for="password">Contraseña: </label>
				<input type="password" name="password" id="password" value="<?= $pwd ?>" required />

				<label for="nombre">Nombre: </label>
				<input type="text" name="nombre" id="nombre" value="<?= $nom ?>" required />

				<label for="rol">Rol: </label>
				<select name="rol">
					<option disabled value="">Seleccione un Rol</option>
					<option value="1" <?= ($rol == 1) ? "selected" : "" ?>>Administrador</option>
					<option value="2" <?= ($rol == 2) ? "selected" : "" ?>>Usuario</option>
				</select>

				<label for="edad">Edad: </label>
				<input type="number" name="edad" id="edad" value="<?= $eda ?>" />

				<label for="genero">Género: </label>
				<select name="genero">
					<option disabled value="">Seleccione un Género</option>
					<option value="masculino" <?= ($gen == 'masculino') ? "selected" : "" ?>>Masculino</option>
					<option value="femenino" <?= ($gen == 'femenino') ? "selected" : "" ?>>Femenino</option>
					<option value="otro" <?= ($gen == 'otro') ? "selected" : "" ?>>Otro</option>
					<option value="ne" <?= ($gen == 'ne') ? "selected" : "" ?>>Prefiero no Especificar</option>
				</select>

				<label for="imagen">Imágen: </label>
				<input type="text" name="imagen" id="imagen" value="<?= $ima ?>" />

				<input type="submit" value="Editar Usuario">
			</form>
		</div>
	</body>
</html>