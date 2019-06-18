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
				<?php
					if (isset($_GET["usr"]) && !empty($_GET["usr"])) {
						echo "<a href='index.php?mod=home&ope=admin&view=mascotas' class='active'>Mascotas</a>";
					} else {
						echo "<a href='#' class='active'>Mascotas</a>";
					}
				?>
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
				if (isset($_GET["usr"]) && !empty($_GET["usr"])) {
					$u = Usuario::getUser($_GET["usr"]) ;
					$mascotas = Mascota::getAllMascotasFromUser($_GET["usr"]) ;

					if (empty($mascotas)) {
						echo "<h1 class='sin-mascotas'>El usuario ".$u->getUsuario()." no tiene mascotas</h1>" ;
						echo "<div class='add-new'>
				<a href='index.php?mod=home&ope=admin&view=mascotas&exec=create&usuario=".$u->getUsuario()."'>Nueva Mascota</a>
			</div>";
						echo "<br>";
						echo "<a class='volver' href='index.php?mod=home&ope=admin&view=usuarios'>Volver</a>";
					} else {
						echo "<h1>Mascotas de ".$u->getNombre()."</h1>" ;
						echo "<div class='add-new'>
				<a href='index.php?mod=home&ope=admin&view=mascotas&exec=create&usuario=".$u->getUsuario()."'>Nueva Mascota</a>
			</div>";
					}
					
				} else {
					$mascotas = Mascota::getAllMascotas() ;
					if (empty($mascotas)) {
						echo "<h1 class='sin-mascotas'>No hay mascotas</h1>" ;
						echo "<br>";
						echo "<a class='volver' href='index.php?mod=home&ope=admin&view=usuarios'>Volver</a>";
					} else {
						echo "<h1>Mascotas</h1>" ;
						echo "<div class='add-new'>
				<a href='index.php?mod=home&ope=admin&view=mascotas&exec=create'>Nueva Mascota</a>
			</div>";
					}
				}

				if (!empty($mascotas)) {			
			?>
			<br>
			<div class="row">
				<div class="col">
					<table>
						<tr>
							<th>Imágen</th>
							<th>Usuario</th>
							<th>Nombre</th>
							<th>Especie</th>
							<th>Raza</th>
							<th>Género</th>
							<th>Color</th>
							<th>Acciones</th>
						</tr>

						<?php
							if (!empty($mascotas)) {
							
								foreach ($mascotas as $mascota) {
									$key = array_search($mascota, $mascotas) ;

									echo ($key % 2 == 0) ? "<tr class='lighter'>" : "<tr>" ;

										?>
											<td>
												<?php
													if ($mascota->getImagen() == "/path/to/image") {
														?>
															<img src="assets/img/admin/admin_thumb.jpg" width="40px">
														<?php
													} else {
														if (file_exists($mascota->getImagen())) {
															echo "<img src='".$mascota->getImagen()."' width='40px'>" ;
														} else {
															?>
																<img src="assets/img/admin/admin_thumb.jpg" width="40px">
															<?php
														}
														
													}
												?>
											</td>
											<td><?= $mascota->getUsuario() ?></td>
											<td><?= $mascota->getNombre() ?></td>
											<td><?= $mascota->getEspecie()->getNombre() ?></td>
											<td><?= $mascota->getRaza()->getNombre() ?></td>
											<td><?= $mascota->getGenero() ?></td>
											<td><?= $mascota->getColor() ?></td>
											<td class="botones-container">
												<a class="boton editar" href="index.php?mod=home&ope=admin&view=mascotas&exec=update&idm=<?= $mascota->getIdMascota() ?>" title="Editar"><img src="assets/img/edit.png"></a>
												<a class="boton borrar" href="index.php?mod=home&ope=admin&view=mascotas&exec=delete&idm=<?= $mascota->getIdMascota() ?>" title="Borrar"><img src="assets/img/delete.png"></a>
											</td>
										</tr>
									<?php
								}
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