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
				<input type="hidden" name="exec" value="create" />
				
				<label for="usuario">Usuario: </label>
				<select name="usuario" id="usuario" required>
					<?php
						if (!empty($user)) {
							echo "<option disabled value=''>Elija un Usuario</option>" ;
						} else {
							echo "<option selected disabled value=''>Elija un Usuario</option>" ;
						}

						foreach ($usuarios as $usuario) {
							if (!empty($user)) {
								if ($usuario->getUsuario() == $user->getUsuario()) {
									
									echo "<option selected value='".$usuario->getUsuario()."'>".$usuario->getNombre()." (".$usuario->getUsuario().")</option>" ;

								} else {
									echo "<option value='".$usuario->getUsuario()."'>".$usuario->getNombre()." (".$usuario->getUsuario().")</option>" ;
								}

							} else {
									
								echo "<option value='".$usuario->getUsuario()."'>".$usuario->getNombre()." (".$usuario->getUsuario().")</option>" ;
							}
						}
					?>
				</select>

				<label for="nombre">Nombre de la Mascota: </label>
				<input type="text" name="nombre" id="nombre" required />

				<label for="ide">Especie: </label>
				<select name="ide" id="ide" required>
					<option selected disabled value="">Elija una Especie</option>
					<?php
						foreach ($especies as $especie) {
							echo "<option value='".$especie->getIdEspecie()."'>".$especie->getNombre()."</option>";
						}
					?>
				</select>

				<label for="idr">Raza: </label>
				<select name="idr" id="idr" required>
					<option selected disabled value="">Elija una Raza</option>
					<?php
						foreach ($razas as $raza) {
							echo "<option value='".$raza->getIdRaza()."'>".$raza->getNombre()."</option>";
						}
					?>
				</select>

				<label for="genero">Género: </label>
				<select name="genero" required>
					<option selected disabled value="">Seleccione un Género</option>
					<option value="Macho">Macho</option>
					<option value="Hembra">Hembra</option>
				</select>

				<label for="color">Color: </label>
				<input type="text" name="color" id="color" required />

				<input type="submit" value="Crear Mascota">
			</form>
		</div>
	</body>
</html>