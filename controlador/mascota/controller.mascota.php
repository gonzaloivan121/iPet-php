<?php

	require_once "modelo/Mascota.php" ;
	require_once "modelo/Raza.php" ;
	require_once "modelo/Especie.php" ;
	require_once "modelo/Usuario.php" ;

	class controllerMascota
	{
		// Constructor
		public function __construct() {}

		// Métodos
		
		// Acción por defecto (punto de entrada al controlador).
		// Obtiene un listado completo de los usuarios almacenados en la base de datos,
		// y los muestra por pantalla
		public function index()
		{
			if (isset($_GET["usuario"]))
			{
				$user = $_GET["usuario"] ;
				$array = [
					"usuario"	=> $user
				];
				$mascotas = Mascota::getAllMascotas($array) ;
			} else {
				$mascotas = Mascota::getAllMascotas() ;
			}
			
			require_once "vista/mascota/index.mascota.php" ;
		}

		//
		// Si se nos proporciona información sobre el usuario,
		// lo crea e inserta en la base de datos; en otro
		// caso, redirigimos al usuario al formulario de creación
		public function create()
		{
			if (isset($_GET["nombre"]))
			{
				$mas = new Mascota() ;
				$mas->setUsuario($_GET["usuario"]) ;
				$mas->setIdEspecie($_GET["ide"]) ;
				$mas->setIdRaza($_GET["idr"]) ;
				$mas->setNombre($_GET["nombre"]) ;
				$mas->setGenero($_GET["genero"]) ;
				$mas->setColor($_GET["color"]) ;
				$mas->setImagen("/path/to/image") ;

				$mas->insert() ;
				$this->index() ;
			} else {
				$razas = Raza::getAllRaces() ;
				$especies = Especie::getAllSpecies() ;
				require_once "vista/mascota/create.mascota.php" ;
			}
		}
		

		public function update()
		{
			$username = $_GET["usuario"] ?? "" ;
			if (!empty($username))
			{
				$usr = Usuario::getUser($username) ;
				if (isset($_GET["email"]))
				{
					$usr->setEmail($_GET["email"]) ;
					$usr->setContrasena($_GET["contrasena"]) ;
					$usr->setNombre($_GET["nombre"]) ;
					$usr->setEdad($_GET["edad"]) ;
					$usr->setGenero($_GET["genero"]) ;
					$usr->setImagen($_GET["imagen"]) ;

					$usr->update() ;
					$this->index() ;
				} else {
					$ema = $usr->getEmail() ;
					$con = $usr->getContrasena() ;
					$nom = $usr->getNombre() ;
					$eda = $usr->getEdad() ;
					$gen = $usr->getGenero() ;
					$ima = $usr->getImagen() ;
					require_once "vista/usuario/update.usuario.php" ;
				}
			} else {
				$this->index() ;
			}
		}

		public function view() {
			$idMascota = $_GET["idMascota"] ?? "" ;

			if (!empty($idMascota)) {
				$mascota = Mascota::getMascota($idMascota) ;
				$usr = Usuario::getUser($_GET["usuario"]) ;
				
				require_once "vista/mascota/perfil.mascota.php" ;
			} else {

				$this->index() ;
			}
		}

		// Si se nos proporciona el identificador del tablero,
		// procedemos a su borrado; en otro caso, regresamos
		// al listado de tableros.
		public function delete()
		{
			if (isset($_GET["usuario"]))
			{
				$username = $_GET["usuario"] ;
				Usuario::deleteUser($username) ;
				$this->index() ;
			} else {
				$this->index() ;
			}
		}

	}