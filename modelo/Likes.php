<?php

require_once "Database.php" ;
require_once "Usuario.php"  ;

	class Likes implements JsonSerializable
	{
        // Atributos
        private $idLike ;
		private $idU1 ;
		private $idU2 ;

		// Constructor
		public function __construct()
		{

		}

        // Getter
        public function getIdLike() { return $this->idLike ; }
		public function getIdU1() { return $this->idU1 ; }
		public function getIdU2() { return $this->idU2 ; }

		// Setter
        public function setIdU1($id) { $this->idU1 = $id ; }
        public function setIdU2($id) { $this->idU2 = $id ; }

		// Métodos
		public function jsonSerialize() {
			$u1 = Usuario::getUser($this->idU1) ;
			$u2 = Usuario::getUser($this->idU2) ;

			return array(
				'idLike' => $this->idLike,
				'usuario1' => $u1,
				'usuario2' => $u2
			);
		}


		public function insert()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("INSERT INTO likes(idU1, idU2) VALUES (:id1, :id2) ;",
                [ ":id1" => $this->idU1,
                  ":id2" => $this->idU2 ]) ;

			$this->idLike = $bd->getLastId() ;
		}


		public function update()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("UPDATE likes SET idU1=:id1, idU2=:id2 WHERE idLike=:idl ;",
                [ ":id1" => $this->idU1,
                  ":id2" => $this->idU2,
				  ":idl" => $this->idLike ]) ;
        }
        
        public function delete()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("DELETE FROM likes WHERE idLike=:idl ;",
                [ ":idl" => $this->idLike ]) ;
		}


		public static function getAllLikes()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM likes ;") ;

			$likes = [] ;

			while ($like = $bd->getRow("Likes"))
			{
				array_push($likes, $like) ;
			}
			return $likes ;
        }
        
        public static function getAllLikesFromUser($idu)
		{
			$bd = Database::getInstance() ;
            $bd->doQuery("SELECT * FROM likes WHERE idU1=:id ORDER BY idLike DESC ;",
            [ ":id" => $idu ]) ;

			$likes = [] ;

			while ($like = $bd->getRow("Likes"))
			{
				array_push($likes, $like) ;
			}
			return $likes ;
        }
        
        public static function getAllLikesToUser($idu)
		{
			$bd = Database::getInstance() ;
            $bd->doQuery("SELECT * FROM likes WHERE idU2=:id ORDER BY idLike DESC ;",
            [ ":id" => $idu ]) ;

			$likes = [] ;

			while ($like = $bd->getRow("Likes"))
			{
				array_push($likes, $like) ;
			}
			return $likes ;
		}

		public static function checkLikes($idu1, $idu2)
		{
			$bd = Database::getInstance() ;
            $bd->doQuery("SELECT * FROM likes WHERE (idU1='$idu1' AND idU2='$idu2') OR (idU1='$idu2' AND idU2='$idu1') ;",
            [ ":idu1" => $idu1 ]) ;

			$likes = [] ;

			while ($like = $bd->getRow("Likes"))
			{
				array_push($likes, $like) ;
			}
			
			return sizeof($likes) ;
		}



		public function __toString()
		{
			return " [ { $this->idLike, $this->idU1, $this->idU2 } ] " ;
		}
	}
?>