<?php

require_once "Database.php" ;
require_once "Usuario.php" ;

	class Matches implements JsonSerializable
	{
        // Atributos
        private $idMatch ;
		private $idU1 ;
		private $idU2 ;

		// Constructor
		public function __construct()
		{

		}

        // Getter
        public function getIdMatch() { return $this->idMatch ; }
		public function getIdU1() { return $this->idU1 ; }
		public function getIdU2() { return $this->idU2 ; }

		// Setter
        public function setIdU1($id) { $this->idU1 = $id ; }
        public function setIdU2($id) { $this->idU2 = $id ; }

		// Métodos
		// Métodos
		public function jsonSerialize() {
			$u1 = Usuario::getUser($this->idU1) ;
			$u2 = Usuario::getUser($this->idU2) ;
			
			return array(
				'idMatch' => $this->idMatch,
				'usuario1' => $u1,
				'usuario2' => $u2
			);
		}


		public function insert()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("INSERT INTO matches(idU1, idU2) VALUES (:id1, :id2) ;",
                [ ":id1" => $this->idU1,
                  ":id2" => $this->idU2 ]) ;

			$this->idMatch = $bd->getLastId() ;
		}


		public function update()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("UPDATE matches SET idU1=:id1, idU2=:id2 WHERE idMatch=:idm ;",
                [ ":id1" => $this->idU1,
                  ":id2" => $this->idU2,
				  ":idm" => $this->idMatch ]) ;
        }
        
        public function delete()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("DELETE FROM matches WHERE idMatch=:idm ;",
                [ ":idm" => $this->idMatch ]) ;
		}

		public function checkIfExists()
		{
			$bd = Database::getInstance() ;
			return $bd->doQuery("SELECT * FROM matches WHERE idU1=:id1 AND idU2=:id2 ;",
				[ ":id1" => $this->idU1,
				  ":id2" => $this->idU2]) ;
		}


		public static function getAllMatches()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM matches ;") ;

			$matches = [] ;

			while ($match = $bd->getRow("Matches"))
			{
				array_push($matches, $match) ;
			}
			return $matches ;
        }
        
        public static function getAllMatchesFromUser($idu)
		{
			$bd = Database::getInstance() ;
            $bd->doQuery("SELECT * FROM matches WHERE idU1=:id OR idU2=:id ;",
            [ ":id" => $idu ]) ;

			$matches = [] ;

			while ($match = $bd->getRow("Matches"))
			{
				array_push($matches, $match) ;
			}
			return $matches ;
		}



		/*public function __toString()
		{
			return " [ { $this->idMatch, $this->idU1, $this->idU2 } ] " ;
		}*/
	}
?>