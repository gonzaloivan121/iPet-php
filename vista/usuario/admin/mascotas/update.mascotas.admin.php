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
				<a href="index.php?mod=home&ope=admin&view=mascotas" class="active">Mascotas</a>
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
			<?php
				$especies = Especie::getAllSpecies() ;
				$razas = Raza::getAllRaces() ;
				$usuarios = Usuario::getAllUsers() ;
			?>
			<form method="get" action="index.php">
				<input type="hidden" name="mod" value="home" />
				<input type="hidden" name="ope" value="admin" />
				<input type="hidden" name="view" value="mascotas" />
				<input type="hidden" name="exec" value="update" />

				<label for="nombre">Nombre de la Mascota: </label>
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

				<label for="idr">Raza: </label>
				<select name="idr" id="idr" required>
					<option selected disabled value="">Elija una Raza</option>
					<?php
						foreach ($razas as $raza) {
							?>
								<option <?= ($idr == $raza->getIdRaza()) ? "selected" : "" ?> value="<?= $raza->getIdRaza() ?>"><?= $raza->getNombre() ?></option>
							<?php
						}
					?>
				</select>

				<label for="genero">Género: </label>
				<select name="genero" required>
					<option disabled value="">Seleccione un Género</option>
					<option <?= ($gen == "Macho") ? "selected" : "" ?> value="Macho">Macho</option>
					<option  <?= ($gen == "Hembra") ? "selected" : "" ?> value="Hembra">Hembra</option>
				</select>

				<label for="color">Color: </label>
				<input type="text" name="color" id="color" value="<?= $col ?>" required />

				<input type="submit" value="Editar Mascota">
			</form>
		</div>
	</body>
</html>