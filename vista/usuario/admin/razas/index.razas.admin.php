<!DOCTYPE html>
<html>
	<head>
		<title>iPet</title>
		<link rel="stylesheet" type="text/css" href="vista/css/style.css">
		<link rel="shortcut icon" type="image/x-icon" href="assets/favicon/favicon.ico" />
	</head>

	<body class="admin crud">
		<div class="menu" id="menu">
			<div class="left">
				<a href="index.php">Inicio</a>
				<a href="index.php?mod=home&ope=admin">Administrar</a>
				<a href="index.php?mod=home&ope=admin&view=usuarios">Usuarios</a>
				<a href="index.php?mod=home&ope=admin&view=mascotas">Mascotas</a>
				<a href="index.php?mod=home&ope=admin&view=especies">Especies</a>
				<?php
					if (isset($_GET["ide"]) && !empty($_GET["ide"])) {
						echo "<a href='index.php?mod=home&ope=admin&view=razas' class='active'>Razas</a>";
					} else {
						echo "<a href='#' class='active'>Razas</a>";
					}
				?>
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
				if (isset($_GET["ide"]) && !empty($_GET["ide"])) {
					$e = Especie::getSpecies($_GET["ide"]) ;

					$razas = Raza::getAllRacesFromSpecies($_GET["ide"]) ;

					if (empty($razas)) {
						echo "<h1 class='sin-razas'>La especie ".$e->getNombre()." no tiene razas</h1>" ;
						echo "<div class='add-new'>
				<a href='index.php?mod=home&ope=admin&view=razas&exec=create&ide=".$e->getIdEspecie()."'>Nueva Raza</a>
			</div>";
						echo "<br>";
						echo "<a class='volver' href='index.php?mod=home&ope=admin&view=especies'>Volver</a>";
					} else {
						echo "<h1>Razas de ".$e->getNombre()."</h1>" ;
						echo "<div class='add-new'>
				<a href='index.php?mod=home&ope=admin&view=razas&exec=create&ide=".$e->getIdEspecie()."'>Nueva Raza</a>
			</div>";
					}
					
				} else {
					$razas = Raza::getAllRaces() ;

					if (empty($razas)) {
						echo "<h1 class='sin-razas'>No hay razas</h1>" ;
						echo "<br>";
						echo "<a class='volver' href='index.php?mod=home&ope=admin&view=especies'>Volver</a>";
					} else {
						echo "<h1>Razas</h1>" ;
						echo "<div class='add-new'>
				<a href='index.php?mod=home&ope=admin&view=razas&exec=create'>Nueva Raza</a>
			</div>";
					}
				}

				if (!empty($razas)) {			
			?>
			<br>
			<div class="row">
				<div class="col">
					<table>
						<tr>
							<th>ID</th>
							<th>Especie</th>
							<th>Nombre</th>
							<th>Acciones</th>
						</tr>

						<?php
							foreach ($razas as $raza) {
								$key = array_search($raza, $razas) ;

								echo ($key % 2 == 0) ? "<tr class='lighter'>" : "<tr>" ;

								?>
										<td><?= $raza->getIdRaza() ?></td>
										<td><?= $raza->getEspecie()->getNombre() ?></td>
										<td><?= $raza->getNombre() ?></td>

										<td class="botones-container">
											<a class="boton editar" href="index.php?mod=home&ope=admin&view=razas&exec=update&idr=<?= $raza->getIdRaza() ?>" title="Editar"><img src="assets/img/edit.png"></a>
											<a class="boton borrar" href="index.php?mod=home&ope=admin&view=razas&exec=delete&idr=<?= $raza->getIdRaza() ?>" title="Borrar"><img src="assets/img/delete.png"></a>
										</td>
									</tr>
								<?php
							}
						?>
					</table>
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</body>
</html>