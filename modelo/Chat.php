<?php

require_once "Database.php" ;
require_once "Mensaje.php"  ;
require_once "Usuario.php"  ;

	class Chat implements JsonSerializable
	{
        // Atributos
        private $idChat ;
		private $idU1   ;
		private $idU2   ;

		// Constructor
		public function __construct()
		{

		}

        // Getter
        public function getIdChat() { return $this->idChat ; }
		public function getIdU1() { return $this->idU1     ; }
		public function getIdU2() { return $this->idU2     ; }

        // Setter
        public function setIdU1($id) { $this->idU1 = $id     ; }
        public function setIdU2($id) { $this->idU2 = $id     ; }

		// Métodos
		public function jsonSerialize() {
			$mensajes = Mensaje::getMessagesFromChat($this->idChat) ;
			$u1 = Usuario::getUser($this->idU1) ;
			$u2 = Usuario::getUser($this->idU2) ;
			
			return array(
				'idChat' => $this->idChat,
				'usuario1' => $u1,
				'usuario2' => $u2,
				'mensajes' => $mensajes
			);
		}


		public function insert()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("INSERT INTO chat(idU1, idU2) VALUES (:id1, :id2) ;",
                [ ":id1" => $this->idU1,
                  ":id2" => $this->idU2 ]) ;

			$this->idChat = $bd->getLastId() ;
        }
        
        
        public function delete()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("DELETE FROM chat WHERE idChat=:idc ;",
                [ ":idc" => $this->idChat ]) ;
		}


		public static function getChat($idc)
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM chat WHERE idChat=:idc ;",
				[ ":idc" => $this->idChat ]) ;

			return $bd->getRow("Chat") ;
        }		


		public static function getChats()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM chat ;") ;

			$chats = [] ;

			while ($ch = $bd->getRow("Chat"))
			{
				array_push($chats, $ch) ;
			}
			return $chats ;
		}
        
        public static function getChatsFromUser($idu)
		{
			$bd = Database::getInstance() ;
            $bd->doQuery("SELECT * FROM chat WHERE idU1='$idu' OR idU2='$idu' ;") ;

			$chats = [] ;

			while ($ch = $bd->getRow("Chat"))
			{
				array_push($chats, $ch) ;
			}
			return $chats ;
		}

		public static function getChatFromId($idc)
		{
			$bd = Database::getInstance() ;
            $bd->doQuery("SELECT * FROM chat WHERE idChat='$idc' ;") ;

			return $bd->getRow("Chat") ;
		}

		public static function getChatsFromTwoUsers($u1, $u2)
		{
			$bd = Database::getInstance() ;
            $bd->doQuery("SELECT * FROM chat WHERE ((idU1='$u1' AND idU2='$u2') OR (idU1='$u2' AND idU2='$u1')) ;") ;

			$chats = [] ;

			while ($ch = $bd->getRow("Chat"))
			{
				array_push($chats, $ch) ;
			}
			return $chats ;
		}



		/*public function __toString()
		{
			return " [ { $this->idChat, $this->idU1, $this->idU2 } ] " ;
		}*/
	}
?>