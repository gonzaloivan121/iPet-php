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
				<a href="#" class="active">Especies</a>
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
			<h1>Especies</h1>
			<div class="add-new">
				<a href="index.php?mod=home&ope=admin&view=especies&exec=create">Nueva Especie</a>
			</div>
			<br>
			<div class="row">
				<div class="col">
					<table>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Acciones</th>
						</tr>

						<?php
							$especies = Especie::getAllSpecies() ;

							foreach ($especies as $especie) {
								$key = array_search($especie, $especies) ;

								echo ($key % 2 == 0) ? "<tr class='lighter'>" : "<tr>";

								?>
										<td><?= $especie->getIdEspecie() ?></td>
										<td><?= $especie->getNombre() ?></td>
										<td class="botones-container">
											<a class="boton ver" href="index.php?mod=home&ope=admin&view=razas&ide=<?= $especie->getIdEspecie() ?>" title="Ver Razas"><img src="assets/img/view.png"></a>
											<a class="boton editar" href="index.php?mod=home&ope=admin&view=especies&exec=update&ide=<?= $especie->getIdEspecie() ?>" title="Editar"><img src="assets/img/edit.png"></a>
											<a class="boton borrar" href="index.php?mod=home&ope=admin&view=especies&exec=delete&ide=<?= $especie->getIdEspecie() ?>" title="Borrar"><img src="assets/img/delete.png"></a>
										</td>
									</tr>
								<?php
							}
						?>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>