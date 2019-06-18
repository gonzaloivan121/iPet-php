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
				<a href="#" class="active">Usuarios</a>
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
			<h1>Usuarios</h1>
			<div class="add-new">
				<a href="index.php?mod=home&ope=admin&view=usuarios&exec=create">Nuevo Usuario</a>
			</div>
			<br>
			<div class="row">
				<div class="col">
					<table>
						<tr>
							<th>Imágen</th>
							<th>Usuario</th>
							<th>Nombre</th>
							<th>Email</th>
							<th>Rol</th>
							<th>Edad</th>
							<th>Género</th>
							<th>Acciones</th>
						</tr>

						<?php
							$usuarios = Usuario::getAllUsers() ;							

							foreach ($usuarios as $user) {
								$key = array_search($user, $usuarios) ;

								echo ($key % 2 == 0) ? "<tr class='lighter'>" : "<tr>";

								?>
										<td>
											<?php
												if ($user->getImagen() == "/path/to/image") {
													?>
														<img src="assets/img/admin/admin_thumb.jpg" width="40px">
													<?php
												} else {
													echo "<img src='".$user->getImagen()."' width='40px'>" ;
												}
											?>
										</td>
										<td><?= $user->getUsuario() ?></td>
										<td><?= $user->getNombre() ?></td>
										<td><?= $user->getEmail() ?></td>
										<td>
											<?php
												if ($user->getIdRol() == 1) {
													echo "Administrador";
												} elseif ($user->getIdRol() == 2) {
													echo "Usuario";
												}
											?>
										</td>
										<td><?= $user->getEdad() ?></td>
										<td><?= $user->getGenero() ?></td>
										<td class="botones-container">
											<a class="boton ver" href="index.php?mod=home&ope=admin&view=mascotas&usr=<?= $user->getUsuario() ?>" title="Ver Mascotas"><img src="assets/img/view.png"></a>
											<a class="boton editar" href="index.php?mod=home&ope=admin&view=usuarios&exec=update&usuario=<?= $user->getUsuario() ?>" title="Editar"><img src="assets/img/edit.png"></a>
											<a class="boton borrar" href="index.php?mod=home&ope=admin&view=usuarios&exec=delete&usuario=<?= $user->getUsuario() ?>" title="Borrar"><img src="assets/img/delete.png"></a>
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