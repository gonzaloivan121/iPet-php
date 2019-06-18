<?php

	require_once "modelo/Chat.php";

	class controllerChat
	{
		// Constructor
		public function __construct() {}

		// Métodos
		
		// Acción por defecto (punto de entrada al controlador).
		// Obtiene un listado completo de los usuarios almacenados en la base de datos,
		// y los muestra por pantalla
		public function index()
		{
			$chats = Chat::getChatsFromUser($_POST["user"]) ;

			print_r(json_encode($chats)) ;
		}

		public function indexFromId()
		{
			$chat = Chat::getChatFromId($_POST["idChat"]) ;

			print_r(json_encode($chat)) ;
		}

		public function indexChats()
		{
			$chats = Chat::getChatsFromTwoUsers($_POST["u1"], $_POST["u2"]) ;

			print_r(json_encode($chats)) ;
		}

		//
		// Si se nos proporciona información sobre el usuario,
		// lo crea e inserta en la base de datos; en otro
		// caso, redirigimos al usuario al formulario de creación
		public function create()
		{
			if (isset($_POST["u1"]) && isset($_POST["u2"]))
			{
				$cht = new Chat() ;
				$cht->setIdU1($_POST["u1"]) ;
				$cht->setIdU2($_POST["u2"]) ;

				$cht->insert() ;
				print_r($cht->getIdChat()) ;
			} else {
				print_r("Error") ;
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