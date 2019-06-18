<?php

spl_autoload_register("uno");

function uno($className) {
	require_once "modelo/$className.php" ;
}

$mascotas = Mascota::getAllMascotas() ;

print_r($mascotas) ;