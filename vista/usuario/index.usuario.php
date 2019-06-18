<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Usuarios - Listado de Usuarios</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="assets/favicon/favicon.ico" />
	</head>
	
	<body>
		<h1>Listado de Usuarios</h1>

		<h3>
			<a href="index.php?mod=usuario&ope=create">Crear nuevo Usuario</a>
		</h3>

		<ul>
			<?php
				if (empty($usuarios)) {
					echo "<h3>No hay ningún usuario</h3>" ;
				}
				foreach ($usuarios as $user):
			?>
				<li>
					<?= $user->getNombre() ; ?> - [
					<a href="index.php?mod=mascota&ope=index&usuario=<?=$user->getUsuario()?>">ver mascotas</a> |
					<a href="index.php?mod=usuario&ope=update&usuario=<?=$user->getUsuario()?>">editar</a> |
					<a href="index.php?mod=usuario&ope=delete&usuario=<?=$user->getUsuario()?>">borrar</a> ]
				</li>
			<?php		
				endforeach ;
			?>
		</ul>

		<h3>
			<a href="index.php?mod=mascota&ope=index">Ver todas las Mascotas</a>
		</h3>

	</body>
</html>