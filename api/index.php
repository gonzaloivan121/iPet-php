<?php
	require_once "../modelo/Database.php" ;

	// recibimos por método get (URL) el modelo y la operación a pedir
	$tab = $_GET["tab"] ?? "" ; // tabla
	$id  = $_GET["id"]  ?? "" ; // id
	$objs = [];

	// importar el modelo
	if (!empty($tab)) {
		if (fileExists("../modelo/$tab.php", false)) {

			$tab[0] = strtoupper($tab[0]);
			require_once "../modelo/$tab.php" ;

			if ($objs = $tab::get($id)) {
				$array = [] ;

				http_response_code(200) ;

				switch ($tab) {
					case 'Usuario':
						if (empty($id)) {
							foreach ($objs as $obj) {
								$array[] = array(
									"usuario" => $obj->getUsuario(),
									"email" => $obj->getEmail(),
									"contrasena" => $obj->getContrasena(),
									"nombre" => $obj->getNombre(),
									"idRol" => $obj->getIdRol(),
									"edad" => $obj->getEdad() ?? null,
									"genero" => $obj->getGenero() ?? null,
									"imagen" => $obj->getImagen()
								) ;
							}
						} else {
							$array[] = array(
								"usuario" => $objs->getUsuario(),
								"email" => $objs->getEmail(),
								"contrasena" => $objs->getContrasena(),
								"nombre" => $objs->getNombre(),
								"idRol" => $objs->getIdRol(),
								"edad" => $objs->getEdad() ?? null,
								"genero" => $objs->getGenero() ?? null,
								"imagen" => $objs->getImagen()
							) ;
						}
					break ;

					case 'Mascota':
						if (empty($id)) {
							foreach ($objs as $obj) {
								$array[] = array(
									"idMascota" => $obj->getIdMascota(),
									"usuario" => $obj->getUsuario(),
									"idEspecie" => $obj->getIdEspecie(),
									"idRaza" => $obj->getIdRaza(),
									"nombre" => $obj->getNombre(),
									"genero" => $obj->getGenero(),
									"color" => $obj->getColor(),
									"imagen" => $obj->getImagen()
								) ;
							}
						} else {
							$array[] = array(
								"idMascota" => $objs->getIdMascota(),
								"usuario" => $objs->getUsuario(),
								"idEspecie" => $objs->getIdEspecie(),
								"idRaza" => $objs->getIdRaza(),
								"nombre" => $objs->getNombre(),
								"genero" => $objs->getGenero(),
								"color" => $objs->getColor(),
								"imagen" => $objs->getImagen()
							) ;
						}
					break ;

					case 'Especie':
						if (empty($id)) {
							foreach ($objs as $obj) {
								$array[] = array(
									"idEspecie" => $obj->getIdEspecie(),
									"nombre" => $obj->getNombre()
								) ;
							}
						} else {
							$array[] = array(
								"idEspecie" => $objs->getIdEspecie(),
								"nombre" => $objs->getNombre()
							) ;
						}
					break ;

					case 'Raza':
						if (empty($id)) {
							foreach ($objs as $obj) {
								$array[] = array(
									"idRaza" => $obj->getIdRaza(),
									"nombre" => $obj->getNombre(),
									"idEspecie" => $obj->getIdEspecie()
								) ;
							}
						} else {
							$array[] = array(
								"idRaza" => $objs->getIdRaza(),
								"nombre" => $objs->getNombre(),
								"idEspecie" => $objs->getIdEspecie()
							) ;
						}
					break ;
				}
				
				$AUTH_USER = "admin" ;
				$AUTH_PASS = "admin" ;

				header('Cache-Control: no-cache, must-revalidate, max-age=0') ;
				header('Access-Control-Allow-Origin: *') ;
				header('Access-Control-Allow-Methods: GET, OPTIONS') ;
				header('Access-Control-Allow-Headers: Content-Type, Authorization, Accept') ;
				header('Content-type: application/json') ;
				
				header('Access-Control-Allow-Credentials: true') ;
				
				$has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW'])) ;
				$is_not_authenticated = (
					!$has_supplied_credentials ||
					$_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
					$_SERVER['PHP_AUTH_PW']   != $AUTH_PASS
				);
				if ($is_not_authenticated) {
					header('HTTP/1.1 401 Authorization Required');
					header('WWW-Authenticate: Basic realm="Access denied"');
					print_r(json_encode(
						array(
							"message" => "No está autorizado.",
							"advice" => "Comprueba que la autorización sea correcta.",
							"status" => "UNAUTHORIZED",
							"code" => 401
						), JSON_UNESCAPED_UNICODE
					)) ;
					exit;
				} else {
					
					print_r(json_encode($array, JSON_UNESCAPED_UNICODE)) ;
				}
				
			} else {
				http_response_code(404) ;
				header('Content-type: application/json');
				echo json_encode(
					array(
						"message" => "No existe el objeto especificado en esta tabla.",
						"advice" => "Comprueba que el ID del objeto sea correcto.",
						"status" => "NOT_FOUND",
						"code" => 404
					)
				) ;
			}

		} else {
			http_response_code(404) ;
			echo json_encode(
				array(
					"message" => "No existe el objeto especificado.",
					"advice" => "Comprueba que el nombre de la tabla sea correcto.",
					"status" => "NOT_FOUND",
					"code" => 404
				)
			) ;
		}
	} else {
		die("***ERROR: Se debe indicar el modelo.") ;
	}
	

	function fileExists($fileName, $caseSensitive = true) {

		if (file_exists($fileName)) {
			return $fileName ;
		}

		if ($caseSensitive) {
			return false ;
		}

		// Handle case insensitive requests
		$directoryName = dirname($fileName) ;
		$fileArray = glob($directoryName . '/*', GLOB_NOSORT) ;
		$fileNameLowerCase = strtolower($fileName) ;
		foreach ($fileArray as $file) {
			if (strtolower($file) == $fileNameLowerCase) {
				return $file ;
			}
		}
		return false;
	}

?>