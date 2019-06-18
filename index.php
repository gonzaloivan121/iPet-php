<?php
	// recibimos por método get (URL) el modelo y la operación a pedir
	$mod = $_GET["mod"] ?? "home" ; // modelo
	$ope = $_GET["ope"] ?? "index" 	; // operación (método del modelo)

	// importar la sesión
	require_once "./Session.php" ;

	// importar el controlador
	require_once "controlador/$mod/controller.$mod.php" ;

	//
	$nme = "controller$mod" ;

	// crear el controlador
	$cont = new $nme() ;

	// llamamos al método correspondiente
	if (method_exists($cont, $ope)) {
		$cont->$ope() ;
	} else {
		session_start();

		require_once "vista/home/404.home.php" ;
		//die("***ERROR: Se ha producido un error en la Aplicación.") ;
	}