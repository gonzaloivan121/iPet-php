<?php

	require_once "modelo/Likes.php";
	require_once "modelo/Matches.php";

	class controllerLikes
	{
		// Constructor
		public function __construct() {}

		// Métodos
		
		// Acción por defecto (punto de entrada al controlador).
		// Obtiene un listado completo de los usuarios almacenados en la base de datos,
		// y los muestra por pantalla
		public function index()
		{
			$usr = $_POST['user'] ;

			$likesFromUser = Likes::getAllLikesFromUser($usr) ;
			$likesToUser = Likes::getAllLikesToUser($usr) ;

			$likes = ["likesFromUser" => $likesFromUser, "likesToUser" => $likesToUser] ;

			echo json_encode($likes) ;
		}
		

        public function like()
		{
            $usuario1 = $_POST['u1'];
			$usuario2 = $_POST['u2'];

            $like = new Likes();
            $like->setIdU1($usuario1);
			$like->setIdU2($usuario2);

			$likesBetween = Likes::checkLikes($usuario1, $usuario2);
			$str = "";

			if ($likesBetween < 2) {
				$like->insert();

				$str .= $usuario1 ;
				$str .= " liked " ;
				$str .= $usuario2 ;
				$str .= "\n" ;
				echo $str ;
			}

			$likesBetween = Likes::checkLikes($usuario1, $usuario2);

			if ($likesBetween == 2) {
				$match = new Matches() ;
				$match->setIdU1($usuario1) ;
				$match->setIdU2($usuario2) ;
				if (!$match->checkIfExists()) {
					$match->insert() ;
					$str .= $usuario1 ;
					$str .= " and " ;
					$str .= $usuario2 ;
					$str .= " liked each other!\n" ;
					echo $str ;
				} else {
					$str .= "Match between " ;
					$str .= $usuario1 ;
					$str .= " and " ;
					$str .= $usuario2 ;
					$str .= " already exists\n" ;
					echo $str ;
				}
				

				
			}
		}

		//SELECT * FROM likes WHERE (idU1='xloxlolex' AND idU2='ApplePie') OR (idU1='ApplePie' AND idU2='xloxlolex') ;
		

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