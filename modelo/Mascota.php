<?php

require_once "Database.php" ;

	class Mascota
	{
		// Atributos
		private $idMascota 	;
		private $usuario   	;
		private $idEspecie 	;
		private $idRaza    	;
		private $nombre 	;
		private $genero 	;
		private $color 		;
		private $imagen 	= "/path/to/image" ;

		// Constructor
		public function __construct() {}

		// Getter
		public function getIdMascota() 	{ return $this->idMascota 	; }
		public function getUsuario() 	{ return $this->usuario 	; }
		public function getIdEspecie() 	{ return $this->idEspecie 	; }
		public function getIdRaza() 	{ return $this->idRaza 		; }
		public function getNombre() 	{ return $this->nombre 		; }
		public function getGenero() 	{ return $this->genero 		; }
		public function getColor() 		{ return $this->color 		; }
		public function getImagen() 	{ return $this->imagen 		; }

		// Setter
		public function setUsuario($usu) 	{ $this->usuario 	= $usu 	; }
		public function setIdEspecie($ide) 	{ $this->idEspecie 	= $ide 	; }
		public function setIdRaza($idr) 	{ $this->idRaza 	= $idr	; }
		public function setNombre($nom) 	{ $this->nombre 	= $nom	; }
		public function setGenero($gen) 	{ $this->genero 	= $gen	; }
		public function setColor($col) 		{ $this->color 		= $col	; }
		public function setImagen($ima) 	{ $this->imagen 	= $ima	; }

		// Métodos
		public function insert()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("INSERT INTO mascota(nombre, idEspecie, idRaza, genero, color, imagen, usuario) VALUES (:nom, :ide, :idr, :gen, :col, :ima, :usu) ;",
				[ ":nom" => $this->nombre,
				  ":ide" => $this->idEspecie,
				  ":idr" => $this->idRaza,
				  ":gen" => $this->genero,
				  ":col" => $this->color,
				  ":ima" => $this->imagen,
				  ":usu" => $this->usuario ]) ;

			$this->idMascota = $bd->getLastId() ;
		}

		public function update()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("UPDATE mascota SET nombre=:nom, idEspecie=:ide, idRaza=:idr, genero=:gen, color=:col, imagen=:ima, usuario=:usu WHERE idMascota=:idm ;",
				[ ":nom" => $this->nombre,
				  ":ide" => $this->idEspecie,
				  ":idr" => $this->idRaza,
				  ":gen" => $this->genero,
				  ":col" => $this->color,
				  ":ima" => $this->imagen,
				  ":usu" => $this->usuario,
				  ":idm" => $this->idMascota ]) ;
		}

		public function delete()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("DELETE FROM mascota WHERE idMascota=:idm ;",
				[ ":idm" => $this->idMascota ]) ;
		}

		// Obtener todas las mascotas de un usuario, raza y/o especie dadas
		public static function getAllMascotas($params = [])
		{
			$bd = Database::getInstance() ;
			$query = "SELECT * FROM mascota" ;

			if (!empty($params)) {
				$query .= " WHERE";
				foreach ($params as $key => $value) {
					$query .= " $key='$value' AND";
				}
				$query = rtrim($query, 'AND');
			}
			$bd->doQuery($query);

			$mascotas = [] ;

			while ($mas = $bd->getRow("Mascota"))
			{
				array_push($mascotas, $mas) ;
			}

			return $mascotas ;
		}


		public static function deleteMascota($idm)
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("DELETE FROM mascota WHERE idMascota=:idm ;",
				[ ":idm" => $idm ]) ;
		}


		public static function getMascota($idm)
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM mascota WHERE idMascota=:idm ;",
				[ ":idm" => $idm ]
			) ;

			return $bd->getRow("Mascota") ;
		}



		public static function get($id = "") {
			$bd = Database::getInstance() ;

			if (empty($id)) {
				$bd->doQuery("SELECT * FROM mascota ;") ;

				$mascotas = [] ;

				while ($mas = $bd->getRow("Mascota"))
				{
					array_push($mascotas, $mas) ;
				}

				return $mascotas ;

			} else {
				$bd->doQuery("SELECT * FROM mascota WHERE idMascota=:idm ;",
					[ ":idm" => $id ]) ;

				return $bd->getRow("Mascota") ;
			}
		}




		public function getEspecie()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM especie WHERE idEspecie=:ide ;",
				[ ":ide" => $this->idEspecie ]
			) ;

			return $bd->getRow("Especie") ;
		}

		public function getRaza()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM raza WHERE idRaza=:idr ;",
				[ ":idr" => $this->idRaza ]
			) ;

			return $bd->getRow("Raza") ;
		}


		public static function getAllMascotasFromUser($usr)
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM mascota WHERE usuario=:usr ;",
				[ ":usr" => $usr ]
			) ;

			$mascotas = [] ;

			while ($mas = $bd->getRow("Mascota"))
			{
				array_push($mascotas, $mas) ;
			}

			return $mascotas ;
		}


		public function __toString()
		{
			return " [ { idMascota: $this->idMascota, usuario: $this->usuario, idEspecie: $this->idEspecie, idRaza: $this->idRaza, nombre: $this->nombre, genero: $this->genero, color: $this->color, imagen: $this->imagen } ] " ;
		}
	}
?>