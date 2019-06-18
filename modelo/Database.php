<?php
	class Database
	{
		// Atributos

		//be11166e5732ac:33c7823a@eu-cdbr-west-02.cleardb.net/heroku_618b704f5a7b41e?reconnect=true
		/*private $dbHost = "eu-cdbr-west-02.cleardb.net" ;
		private $dbUser = "be11166e5732ac"	  	 		;
		private $dbPass = "33c7823a"		  	 		;
		private $dbPort = "3306"  		 				;
		private $dbName = "heroku_618b704f5a7b41e"		;*/

		private $dbHost = "localhost" 	 ;
		private $dbUser = "root"	  	 ;
		private $dbPass = ""		  	 ;
		private $dbPort = "3306"  		 ;
		private $dbName = "ipet"		 ;

		//
		private static $prp = null	  	 ;
		private static $pdo = null 		 ;

		//
		private static $instancia = null ;

		// Constructor
		public function __construct() { $this->connect() ; }

		//
		private function __clone() {}

		//
		// Obtener Instancia
	    public static function getInstance()
	    {
	    	if (is_null(self::$instancia)) {
	    		self::$instancia = new Database() ;
	    	}
	    	return self::$instancia ;
	    }

	    //
	    // Conectar a BBDD
		public function connect()
		{
			try {
				self::$pdo = new PDO("mysql:host={$this->dbHost};port={$this->dbPort};dbname={$this->dbName};charset=utf8mb4;",
				$this->dbUser,
				$this->dbPass) ;
			} catch (Exception $e) {
				die("Error en conectar la BBDD; ".$e) ;
			}
		}

		//
		// Realizar consulta a la BBDD
		public function doQuery($sql, $params = [])
		{
			self::$prp = self::$pdo->prepare($sql) ;
			$flg = self::$prp->execute($params) ;
			if ( ($flg) && (self::$prp->rowCount() > 0) ) {
				return true  ;
			} else {
				return false ;
			}
		}

		//
		// Obtener nueva entrada de la BBDD de la clase dada (Por defecto será la StdClass si no se especifica otra)
		public function getRow($class="StdClass")
		{
			if (self::$prp) {
				return self::$prp->fetchObject($class) ;
			}
		}

		//
		// Obtener el ID de la última entrada de la BBDD
		public function getLastId()
		{
			return self::$pdo->lastInsertId() ;
		}

	}
?>	