<!DOCTYPE html>
<html>
	<head>
		<title>iPet</title>
		<link rel="stylesheet" type="text/css" href="vista/css/style.css">
		<link rel="shortcut icon" type="image/x-icon" href="assets/favicon/favicon.ico" />
	</head>

	<body class="admin">
		<div class="menu" id="menu">
			<div class="left">
				<a href="index.php">Inicio</a>
				<a href="#" class="active">Administrar</a>
				<a href="index.php?mod=home&ope=admin&view=usuarios">Usuarios</a>
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
			<div class="row">
				<div class="col">
					<p>
						<a class="button" href="index.php?mod=home&ope=admin&view=usuarios">Usuarios</a>
						<a class="button" href="index.php?mod=home&ope=admin&view=mascotas">Mascotas</a>
					</p>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<p>
						<a class="button" href="index.php?mod=home&ope=admin&view=especies">Especies</a>
						<a class="button" href="index.php?mod=home&ope=admin&view=razas">Razas</a>
					</p>
				</div>
			</div>
		</div>
	</body>
</html>