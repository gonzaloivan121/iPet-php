<?php

require_once "Database.php" ;

	class Especie
	{
		// Atributos
		private $idEspecie  	;
		private $nombre 		;

		// Constructor
		public function __construct()
		{

		}

		// Getter
		public function getIdEspecie() { return $this->idEspecie; }
		public function getNombre() { return $this->nombre; }

		// Setter
		public function setNombre($nom) { $this->nombre = $nom; }

		// Métodos
		public function insert()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("INSERT INTO especie(nombre) VALUES (:nom) ;",
				[ ":nom" => $this->nombre ]) ;

			$this->idEspecie = $bd->getLastId() ;
		}


		public function update()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("UPDATE especie SET nombre=:nom WHERE idEspecie=:esp ;",
				[ ":nom" => $this->nombre,
				  ":esp" => $this->idEspecie ]) ;
		}


		public static function getAllSpecies()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM especie ;") ;

			$especies = [] ;

			while ($esp = $bd->getRow("Especie"))
			{
				array_push($especies, $esp) ;
			}
			return $especies ;
		}



		public static function get($id = "") {
			$bd = Database::getInstance() ;

			if (empty($id)) {
				
				$bd->doQuery("SELECT * FROM especie ;") ;

				$especies = [] ;

				while ($esp = $bd->getRow("Especie"))
				{
					array_push($especies, $esp) ;
				}

				return $especies ;

			} else {

				$bd->doQuery("SELECT * FROM especie WHERE idEspecie=:ide ;",
					[ ":ide" => $id ]) ;

				return $bd->getRow("Especie") ;
			}
		}



		public static function deleteSpecies($esp)
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("DELETE FROM especie WHERE idEspecie=:esp ;",
				[ ":esp" => $esp ]) ;
		}


		public static function getSpecies($esp) {
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM especie WHERE idEspecie=:esp ;",
				[ ":esp" => $esp ]) ;

			return $bd->getRow("Especie") ;
		}



		public function __toString()
		{
			return " [ { $this->idEspecie, $this->nombre } ] " ;
		}
	}
?>