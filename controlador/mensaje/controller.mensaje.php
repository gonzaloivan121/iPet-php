<?php

	require_once "modelo/Mensaje.php";

	class controllerMensaje
	{
		// Constructor
		public function __construct() {}

		// Métodos
		
		// Acción por defecto (punto de entrada al controlador).
		// Obtiene un listado completo de los usuarios almacenados en la base de datos,
		// y los muestra por pantalla
		public function index()
		{
            $mensajes = Mensaje::getAllMessages() ;

            for ($i = 0; $i < sizeof($mensajes); $i++) { 
               echo $mensajes[$i]->getTexto() ;
            }
            
			
        }
        
        public function send()
		{
			$idChat = $_POST["idChat"];
			$propietario = $_POST["propietario"];
			$texto = $_POST["texto"];
			$epoch = $_POST["epoch"];

			$mensaje = new Mensaje() ;
			$mensaje->setIdChat($idChat) ;
			$mensaje->setPropietario($propietario) ;
			$mensaje->setTexto($texto) ;
			$mensaje->setEpoch($epoch) ;

			$mensaje->insert() ;

			print_r(json_encode($mensaje)) ;
		}


		public function deshacerMatch()
		{
			if (isset($_POST["u1"]) && isset($_POST["u2"]))
			{
				Mensaje::deleteAllMensajesFromAndForUser($_POST["u1"], $_POST["u2"]) ;
			}
		}

		

		//
		// Si se nos proporciona información sobre el usuario,
		// lo crea e inserta en la base de datos; en otro
		// caso, redirigimos al usuario al formulario de creación
		public function create()
		{
			if (isset($_GET["idEspecie"]))
			{
				$esp = new Especie() ;
				$esp->setNombre($_GET["nombre"]) ;

				$esp->insert() ;
				$this->index() ;
			} else {
				require_once "vista/especie/create.especie.php" ;
			}
		}
		

		public function update()
		{
			$idEspecie = $_GET["idEspecie"] ?? "" ;
			if (!empty($idEspecie))
			{
				$esp = Especie::getSpecies($idEspecie) ;
				if (isset($_GET["nombre"]))
				{
					$esp->setNombre($_GET["nombre"]) ;
					$esp->update() ;
					$this->index() ;
				} else {
					$idEsp = $esp->getIdEspecie() ;
					$nom = $esp->getNombre() ;
					require_once "vista/especie/update.especie.php" ;
				}
			} else {
				$this->index() ;
			}
		}

		// Si se nos proporciona el identificador del tablero,
		// procedemos a su borrado; en otro caso, regresamos
		// al listado de tableros.
		public function delete()
		{
			if (isset($_GET["idEspecie"]))
			{
				$idEspecie = $_GET["idEspecie"] ;
				Especie::deleteSpecies($idEspecie) ;
				$this->index() ;
			} else {
				$this->index() ;
			}
		}
	}