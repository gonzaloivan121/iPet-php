<?php
	if ($ope == "signin" && isset($_GET["usuario"]) && isset($_GET["password"])) {
		if (!empty($_GET["usuario"]) && !empty($_GET["password"])) {
			session_start();
			$_SESSION["sesion"] = $_GET["usuario"] ;
		} else {
			require_once "vista/usuario/signin.usuario.php" ;
		}
	}
?>