<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Mascotas - Añadir Nueva Mascota</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="assets/favicon/favicon.ico" />
	</head>
	
	<body>
		<h1>Añadir Nueva Mascota</h1>

		<h3>
			<a href="index.php?mod=mascota&ope=index&usuario=<?=$_GET["usuario"]?>">Volver Atrás</a>
		</h3>


		<form action="/ipet/index.php?mod=mascota&ope=create" method="get" enctype="multipart/form-data">
			<input type="hidden" name="mod" value="<?=$_GET["mod"]?>">
			<input type="hidden" name="ope" value="<?=$_GET["ope"]?>">
			<input type="hidden" name="usuario" value="<?=$_GET["usuario"]?>">
			
			<label for="nombre">*Nombre: </label>
			<input id="nombre" type="text" name="nombre" placeholder="Nombre" required>
			<br>
			<label for="ide">*Especie: </label>
			<select name="ide" id="ide" required>
				<option value="" disabled selected>Especie</option>
				<?php
					foreach ($especies as $especie) {
						echo "<option value=\"".$especie->getIdEspecie()."\">".$especie->getNombre()."</option>" ;
					}
				?>
			</select>
			<br>
			<label for="idr">*Raza: </label>
			<select name="idr" id="idr" required>
				<option value="" disabled selected>Raza</option>
				<?php
					foreach ($razas as $raza) {
						echo "<option value=\"".$raza->getIdRaza()."\">".$raza->getNombre()."</option>" ;
					}
				?>
			</select>
			<br>
			<label for="genero">Género: </label>
			<select name="genero" id="genero">
				<option value="" disabled selected>Género</option>
				<option value="macho">Macho</option>
				<option value="hembra">Hembra</option>
			</select>
			<br>
			<label for="color">Color: </label>
			<input id="color" type="text" name="color">
			<br>
			<br>
			<button type="submit">Añadir Mascota</button>
		</form>

	</body>
</html>