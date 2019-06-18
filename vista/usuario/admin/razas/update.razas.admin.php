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
				<a href="index.php?mod=home&ope=admin&view=usuarios">Usuarios</a>
				<a href="index.php?mod=home&ope=admin&view=mascotas">Mascotas</a>
				<a href="index.php?mod=home&ope=admin&view=especies">Especies</a>
				<a href="index.php?mod=home&ope=admin&view=razas" class="active">Razas</a>
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
				<input type="hidden" name="view" value="razas" />
				<input type="hidden" name="exec" value="update" />
				<input type="hidden" name="idr" value="<?= $idr ?>" />

				<label for="nombre">Nombre de la Raza: </label>
				<input type="text" name="nombre" id="nombre" value="<?= $nom ?>" required />

				<label for="ide">Especie: </label>
				<select name="ide" id="ide" required>
					<option selected disabled value="">Elija una Especie</option>
					<?php
						foreach ($especies as $especie) {
							?>
								<option <?= ($ide == $especie->getIdEspecie()) ? "selected" : "" ?> value="<?= $especie->getIdEspecie() ?>"><?= $especie->getNombre() ?></option>
							<?php							
						}
					?>
				</select>

				<input type="submit" value="Editar Raza">
			</form>
		</div>
	</body>
</html>