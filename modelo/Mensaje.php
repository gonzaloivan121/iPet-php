<?php

require_once "Database.php" ;
require_once "Usuario.php" ;

	class Mensaje implements JsonSerializable
	{
        // Atributos
        private $idMensaje ;
        private $idChat    ;
        private $propietario    ;
		private $texto     ;
		private $epoch     ;

		// Constructor
		public function __construct()
		{

		}

        // Getter
        public function getIdMensaje() { return $this->idMensaje ; }
        public function getIdChat() { return $this->idChat ; }
        public function getPropietario() { return $this->propietario     ; }
		public function getTexto() { return $this->texto     ; }
		public function getEpoch() { return $this->epoch     ; }

        // Setter
        public function setIdChat($id) { $this->idChat = $id     ; }
        public function setPropietario($usu) { $this->propietario = $usu     ; }
        public function setTexto($txt) { $this->texto = $txt     ; }
        public function setEpoch($epo) { $this->epoch = $epo     ; }

		// Métodos
		public function jsonSerialize() {
			$propie = Usuario::getUser($this->propietario) ;

			return array(
				'idMensaje' => $this->idMensaje,
				'idChat' => $this->idChat,
				'propietario' => $propie,
				'texto' => $this->texto,
				'epoch' => $this->epoch
			);
		}


		public function insert()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("INSERT INTO mensaje(idChat, propietario, texto, epoch) VALUES (:idc, :usu, :txt, :epo) ;",
                [ ":idc" => $this->idChat,
                  ":usu" => $this->propietario,
                  ":txt" => $this->texto,
                  ":epo" => $this->epoch ]) ;

			$this->idMensaje = $bd->getLastId() ;
		}


        public function update()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("UPDATE mensaje SET texto=:txt WHERE idMatch=:idm ;",
                [ ":txt" => $this->texto,
				  ":idm" => $this->idMensaje]) ;
        }
        
        
        public function delete()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("DELETE FROM mensaje WHERE idMensaje=:idm ;",
                [ ":idm" => $this->idMensaje ]) ;
		}

		public function deleteAllMensajesFromAndForUser($u1, $u2)
		{
			$bd = Database::getInstance() ;
			/*$bd->doQuery("DELETE FROM mensaje WHERE  ;",
				[ ":idm" => $this->idMensaje ]) ;
			$bd->doQuery("DELETE FROM mensaje WHERE propietario='$u1' ;") ;*/
		}

		public static function getAllMessages()
		{
			$bd = Database::getInstance() ;
			$bd->doQuery("SELECT * FROM mensaje ORDER BY idMensaje DESC ;") ;

			$mensajes = [] ;

			while ($mj = $bd->getRow("Mensaje"))
			{
				array_push($mensajes, $mj) ;
			}
			return $mensajes ;
        }
        
        public static function getMessagesFromChat($idc)
		{
			$bd = Database::getInstance() ;
            $bd->doQuery("SELECT * FROM mensaje WHERE idChat=:idc ORDER BY idMensaje DESC ;",
            [ ":idc" => $idc ]) ;

			$mensajes = [] ;

			while ($mj = $bd->getRow("Mensaje"))
			{
				array_push($mensajes, $mj) ;
			}
			return $mensajes ;
		}
		
		public static function getNewMessagesFromChat($idc, $idm = 0)
		{
			if ($idm > 0) {
				$bd = Database::getInstance() ;
				$bd->doQuery("SELECT * FROM mensaje WHERE idChat='$idc' AND idMensaje>'$idm' ORDER BY idMensaje ASC ;") ;

				$mensajes = [] ;

				while ($mj = $bd->getRow("Mensaje"))
				{
					array_push($mensajes, $mj) ;
				}
				return $mensajes ;
			} else {
				return 0 ;
			}
			
        }



		public function __toString()
		{
			return " [ { $this->idMensaje, $this->idChat, $this->texto, $this->epoch } ] " ;
		}
	}
?>