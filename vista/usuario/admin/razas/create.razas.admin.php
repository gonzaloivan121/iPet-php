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
				<input type="hidden" name="exec" value="create" />

				<label for="nombre">Nombre de la Raza: </label>
				<input type="text" name="nombre" id="nombre" required />

				<label for="ide">Especie: </label>
				<select name="ide" id="ide" required>
					<?php
						if (!empty($specie)) {
							echo "<option disabled value=''>Elija una Especie</option>" ;
						} else {
							echo "<option selected disabled value=''>Elija una Especie</option>" ;
						}
					
						foreach ($especies as $espe) {
							if (!empty($specie)) {
								if ($espe->getIdEspecie() == $specie->getIdEspecie()) {
									
									echo "<option selected value='".$espe->getIdEspecie()."'>".$espe->getNombre()."</option>" ;

								} else {
									echo "<option value='".$espe->getIdEspecie()."'>".$espe->getNombre()."</option>" ;
								}

							} else {
									
								echo "<option value='".$espe->getIdEspecie()."'>".$espe->getNombre()."</option>" ;
							}
						}
					?>
				</select>

				<input type="submit" value="Crear Raza">
			</form>
		</div>
	</body>
</html>