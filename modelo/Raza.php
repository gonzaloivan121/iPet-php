<?php

require_once "Database.php" ;

	class Raza
	{
		// Atributos
		private $idRaza  	;
		private $nombre 	;
		private $idEspecie	;

		// Constructor
		public function __construct()
		{

		}

		// Getter
		public function getIdRaza() { return $this->idRaza    ; }
		public function getNombre() { return $this->nombre    ; }
		public function getIdEspecie() { return $this->idEspecie ; }

		// Setter
		public function setNombre($nom) { $this->nombre    = $nom ; }
		public function setIdEspecie($ide) { $this->idEspecie = $ide ; }

		// Métodos
		public function insert()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("INSERT INTO raza(nombre, idEspecie) VALUES (:nom, :ide) ;",
				[ ":nom" => $this->nombre,
				  ":ide" => $this->idEspecie ]) ;

			$this->idRaza = $bd->getLastId() ;
		}


		public function update()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("UPDATE raza SET nombre=:nom WHERE idRaza=:raz ;",
				[ ":nom" => $this->nombre,
				  ":raz" => $this->idRaza ]) ;
		}


		public static function getAllRaces()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM raza ;") ;

			$razas = [] ;

			while ($raz = $bd->getRow("Raza"))
			{
				array_push($razas, $raz) ;
			}
			return $razas ;
		}



		public static function get($id = "") {
			$bd = Database::getInstance() ;

			if (empty($id)) {
				
				$bd->doQuery("SELECT * FROM raza ;") ;

				$razas = [] ;

				while ($raz = $bd->getRow("Raza"))
				{
					array_push($razas, $raz) ;
				}

				return $razas ;

			} else {

				$bd->doQuery("SELECT * FROM raza WHERE idRaza=:idr ;",
					[ ":idr" => $id ]) ;

				return $bd->getRow("Raza") ;
			}
		}



		public static function getAllRacesFromSpecies($spe)
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM raza WHERE idEspecie=:esp ;",
				[ ":esp" => $spe ]) ;

			$razas = [] ;

			while ($r = $bd->getRow("Raza")) {
				array_push($razas, $r) ;
			}

			return $razas ;
		}

		public function getEspecie()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM especie WHERE idEspecie=:ide ;",
				[ ":ide" => $this->idEspecie ]
			) ;

			return $bd->getRow("Especie") ;
		}


		public static function deleteRace($raz)
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("DELETE FROM raza WHERE idRaza=:raz ;",
				[ ":raz" => $raz ]) ;
		}


		public static function getRace($raz) {
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM raza WHERE idRaza=:raz ;",
				[ ":raz" => $raz ]) ;

			return $bd->getRow("Raza") ;
		}


		public function __toString()
		{
			return " [ { $this->idRaza, $this->nombre } ] " ;
		}
	}
?>