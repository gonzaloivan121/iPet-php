<?php
	require_once "modelo/Usuario.php";
	require_once "modelo/Especie.php";
	require_once "modelo/Mascota.php";
	require_once "modelo/Raza.php";
	require_once "modelo/Matches.php";
	require_once "modelo/Likes.php";
	require_once "modelo/Chat.php";

	class controllerHome
	{
		// Constructor
		public function __construct() {}

		// Métodos
		
		// Acción por defecto (punto de entrada al controlador).
		// Obtiene un listado completo de los usuarios almacenados en la base de datos,
		// y los muestra por pantalla
		public function index()
		{
			if (!isset($_SESSION)) {
				session_start() ;
			}

			if (isset($_SESSION["sesion"])) {
				$get = explode("@", $_SESSION["sesion"]) ;

				if (!(sizeof($get) > 1)) {
					$usuario = Usuario::getUser($_SESSION["sesion"]) ;
				} else {
					$usuario = Usuario::getUserbyEmail($_SESSION["sesion"]) ;
				}
			}
			
			require_once "vista/home/index.home.php" ;
		}




		public function signup()
		{
			if (isset($_GET["username"]))
			{

			} else {
				require_once "vista/usuario/signup.usuario.php" ;
			}
		}



		public function signin() {
			if (!isset($_SESSION)) {
				session_start() ;
			}
			if (empty($_SESSION["sesion"])) {
			
				if (isset($_GET["usuario"]) && isset($_GET["password"])) {

					$usuario = Usuario::login($_GET["usuario"], $_GET["password"]) ;
					if ($usuario == 0) {

						$error = true ;

						require_once "vista/usuario/signin.usuario.php" ;

					} else {
						// (La función login hace session_start() por lo que aqui no hace falta)
						$this->index() ;
					}
				} else {

					require_once "vista/usuario/signin.usuario.php" ;
				}

			} else {
				// Si ya hay una sesión iniciada, entonces no deberíamos mostrar la vista de iniciar sesión
				// Ni aunque se llame por URL ni aunque se retroceda en el historial al iniciar sesión
				//$this->index() ;
				header("Location: index.php?mod=home&ope=index") ;
			}
		}



		// Si no hay sesión iniciada, o el usuario no es el administradir
		// mostrar mensaje de error, y si es el administrador, enviar al CRUD
		public function admin() {
			session_start() ;
			// Si existe la sesión activa
			if (isset($_SESSION["sesion"])) {
				// Si es el admin
				if (($_SESSION["sesion"] == "admin") || ($_SESSION["sesion"] == "admin@admin.com")) {
					$admin = Usuario::getUser($_SESSION["sesion"]) ;

					// Si obtenemos por $_GET el parámetro "view"
					if (isset($_GET["view"]) && !empty($_GET["view"])) {
						// Si existe la vista de admin pasada por "view"
						if (file_exists("vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php")) {
							// Si existe el método a ejecutar
							if (isset($_GET["exec"]) && !empty($_GET["exec"])) {
								// Mostrar vista requerida
								if (file_exists("vista/usuario/admin/".$_GET["view"]."/".$_GET["exec"].".".$_GET["view"].".admin.php")) {


									switch ($_GET["view"]) {
										case 'usuarios':
											
											if ($_GET["exec"] == "create") {

												if (isset($_GET["usuario"]) && !empty($_GET["usuario"])) {

													$user = new Usuario();
													$user->setUsuario($_GET["usuario"]) ;
													$user->setEmail($_GET["email"]) ;
													$user->setContrasena($_GET["password"]) ;
													$user->setNombre($_GET["nombre"]) ;
													$user->setIdRol($_GET["rol"]) ;
													$user->setEdad($_GET["edad"]) ;
													$user->setGenero($_GET["genero"]) ;
													$user->setImagen("/path/to/image") ;

													$user->insert() ;

													require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;

												} else {
													require_once "vista/usuario/admin/".$_GET["view"]."/".$_GET["exec"].".".$_GET["view"].".admin.php" ;
												}

											} elseif ($_GET["exec"] == "update") {
												
												if (isset($_GET["usuario"]) && !empty($_GET["usuario"])) {

													$user = Usuario::getUser($_GET["usuario"]) ;

													if (isset($_GET["email"]) && !empty($_GET["email"])) {

														$user->setEmail($_GET["email"]) ;
														$user->setContrasena($_GET["password"]) ;
														$user->setNombre($_GET["nombre"]) ;
														$user->setIdRol($_GET["rol"]) ;
														$user->setEdad($_GET["edad"]) ;
														$user->setGenero($_GET["genero"]) ;
														$user->setImagen($_GET["imagen"]) ;

														$user->update() ;

														require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;

													} else {
														$usu = $user->getUsuario() ;
														$ema = $user->getEmail() ;
														$pwd = $user->getContrasena() ;
														$nom = $user->getNombre() ;
														$rol = $user->getIdRol() ;
														$eda = $user->getEdad() ;
														$gen = $user->getGenero() ;
														$ima = $user->getImagen() ;

														require_once "vista/usuario/admin/".$_GET["view"]."/update.".$_GET["view"].".admin.php" ;
													}

												} else {
													require_once "vista/usuario/admin/".$_GET["view"]."/".$_GET["exec"].".".$_GET["view"].".admin.php" ;
												}

											} elseif ($_GET["exec"] == "delete") {

												if (isset($_GET["usuario"]) && !empty($_GET["usuario"])) {

													Usuario::deleteUser($_GET["usuario"]) ;

													require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;

												} else {
													require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;
												}
											}

											break;
										




										case "mascotas":
											

											if ($_GET["exec"] == "create") {

												if (isset($_GET["nombre"]) && !empty($_GET["nombre"])) {

													$pet = new Mascota();
													$pet->setUsuario($_GET["usuario"]) ;
													$pet->setIdEspecie($_GET["ide"]) ;
													$pet->setIdRaza($_GET["idr"]) ;
													$pet->setNombre($_GET["nombre"]) ;
													$pet->setGenero($_GET["genero"]) ;
													$pet->setColor($_GET["color"]) ;

													$pet->insert() ;

													require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;

												} else {

													$user = Usuario::getUser($_GET["usuario"]) ;
													
													require_once "vista/usuario/admin/".$_GET["view"]."/".$_GET["exec"].".".$_GET["view"].".admin.php" ;
												}

											} elseif ($_GET["exec"] == "update") {
												
												if (isset($_GET["idm"]) && !empty($_GET["idm"])) {

													$pet = Mascota::getMascota($_GET["idm"]) ;

													if (isset($_GET["nombre"]) && !empty($_GET["nombre"])) {

														$pet->setIdEspecie($_GET["ide"]) ;
														$pet->setIdRaza($_GET["idr"]) ;
														$pet->setNombre($_GET["nombre"]) ;
														$pet->setGenero($_GET["genero"]) ;
														$pet->setColor($_GET["color"]) ;

														$pet->update() ;

														require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;

													} else {
														$usu = $pet->getUsuario() ;
														$ide = $pet->getIdEspecie() ;
														$idr = $pet->getIdRaza() ;
														$nom = $pet->getNombre() ;
														$gen = $pet->getGenero() ;
														$col = $pet->getColor() ;

														require_once "vista/usuario/admin/".$_GET["view"]."/update.".$_GET["view"].".admin.php" ;
													}

												} else {
													require_once "vista/usuario/admin/".$_GET["view"]."/".$_GET["exec"].".".$_GET["view"].".admin.php" ;
												}

											} elseif ($_GET["exec"] == "delete") {

												if (isset($_GET["idm"]) && !empty($_GET["idm"])) {

													Mascota::deleteMascota($_GET["idm"]) ;

													require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;

												} else {
													require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;
												}
											}

											break;







										case 'especies':
											
											if ($_GET["exec"] == "create") {

												if (isset($_GET["nombre"]) && !empty($_GET["nombre"])) {

													$esp = new Especie();
													$esp->setNombre($_GET["nombre"]) ;

													$esp->insert() ;

													require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;

												} else {

													$user = Usuario::getUser($_GET["usuario"]) ;
													
													require_once "vista/usuario/admin/".$_GET["view"]."/".$_GET["exec"].".".$_GET["view"].".admin.php" ;
												}

											} elseif ($_GET["exec"] == "update") {
												
												if (isset($_GET["ide"]) && !empty($_GET["ide"])) {

													$esp = Especie::getSpecies($_GET["ide"]) ;

													if (isset($_GET["nombre"]) && !empty($_GET["nombre"])) {

														$esp->setNombre($_GET["nombre"]) ;

														$esp->update() ;

														require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;

													} else {
														$nom = $esp->getNombre() ;
														$ide = $esp->getIdEspecie() ;

														require_once "vista/usuario/admin/".$_GET["view"]."/update.".$_GET["view"].".admin.php" ;
													}

												} else {
													require_once "vista/usuario/admin/".$_GET["view"]."/".$_GET["exec"].".".$_GET["view"].".admin.php" ;
												}

											} elseif ($_GET["exec"] == "delete") {

												if (isset($_GET["ide"]) && !empty($_GET["ide"])) {

													Especie::deleteSpecies($_GET["ide"]) ;

													require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;

												} else {
													require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;
												}
											}

											break;

										case 'razas':
											


											if ($_GET["exec"] == "create") {

												if (isset($_GET["nombre"]) && !empty($_GET["nombre"])) {

													$raz = new Raza();
													$raz->setNombre($_GET["nombre"]) ;
													$raz->setIdEspecie($_GET["ide"]) ;

													$raz->insert() ;

													require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;

												} else {

													$specie = Especie::getSpecies($_GET["ide"]) ;
													$especies = Especie::getAllSpecies() ;
													
													require_once "vista/usuario/admin/".$_GET["view"]."/".$_GET["exec"].".".$_GET["view"].".admin.php" ;
												}

											} elseif ($_GET["exec"] == "update") {
												
												if (isset($_GET["idr"]) && !empty($_GET["idr"])) {

													$raz = Raza::getRace($_GET["idr"]) ;

													if (isset($_GET["nombre"]) && !empty($_GET["nombre"])) {

														$raz->setIdEspecie($_GET["ide"]) ;
														$raz->setNombre($_GET["nombre"]) ;

														$raz->update() ;

														require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;

													} else {
														$idr = $raz->getIdRaza() ;
														$ide = $raz->getIdEspecie() ;
														$nom = $raz->getNombre() ;
														$especies = Especie::getAllSpecies() ;

														require_once "vista/usuario/admin/".$_GET["view"]."/update.".$_GET["view"].".admin.php" ;
													}

												} else {
													require_once "vista/usuario/admin/".$_GET["view"]."/".$_GET["exec"].".".$_GET["view"].".admin.php" ;
												}

											} elseif ($_GET["exec"] == "delete") {

												if (isset($_GET["idr"]) && !empty($_GET["idr"])) {

													Raza::deleteRace($_GET["idr"]) ;

													require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;

												} else {
													require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;
												}
											}



											break;
									}

									
								} else {
									require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;
								}
								
							} else {
								// Mostrar vista requerida
								require_once "vista/usuario/admin/".$_GET["view"]."/index.".$_GET["view"].".admin.php" ;
							}
						// Si no existe la vista
						} else {
							// Mostrar el index del admin
							require_once "vista/usuario/admin/index.admin.php" ;
						}
					// Si no obtenemos "view"
					} else {
						// Mostrar el index del admin
						require_once "vista/usuario/admin/index.admin.php" ;
					}
				// Si no es el admin
				} else {
					$usuario = Usuario::getUser($_SESSION["sesion"]) ;
					print_r("<div class='header-error'>Error, el usuario '".$usuario->getUsuario()."' no tiene permisos para ver este contenido.</div>") ;
					require_once "vista/home/403.home.php" ;
				}
			// Si no hay sesión activa
			} else {
				print_r("<div class='header-error'>No tienes permisos para ver este contenido.</div>") ;
				require_once "vista/home/403.home.php" ;
			}
		}



		// Cierra y destruye la sesión
		public function signout() {
			session_start() ;

			if (isset($_SESSION["sesion"])) {
				session_destroy() ;
				$_SESSION = [] ;

				$this->index() ;
			} else {

				$this->index() ;
			}
		}


		public function view() {
			$idMascota = $_GET["idMascota"] ?? "" ;

			if (!empty($idMascota)) {
				$mascota = Mascota::getMascota($idMascota) ;
				$usr = Usuario::getUser($_GET["usuario"]) ;
				
				require_once "vista/mascota/perfil.mascota.php" ;
			} else {

				$this->index() ;
			}
		}

		public function match() {
			if (!empty($_SESSION)) {

				$this->index() ;
			} else {
				session_start() ;
				

				$idu = $_SESSION["sesion"] ?? "" ;
				$u = Usuario::getUser($idu);

				if (!empty($idu)) {
					$usr = Usuario::getUser($idu) ;
					$usrPool = Usuario::getAllUsersMatch($idu, $u->getGenero()) ;

					$r = rand(0, (sizeof($usrPool) - 1));

					$primerUser = $usrPool[$r];

					$matchesFromMe = Matches::getAllMatchesFromUser($idu);
					$messages = Chat::getChatsFromUser($idu);
					
					require_once "vista/match/index.match.php" ;
						
				} else {

					$this->index() ;
				}
				
			}

		}

		public function object_to_array($data) {
			if (is_array($data) || is_object($data)) {
				$result = array();
				foreach($data as $key => $value) {
					$result[$key] = $this->object_to_array($value);
				}
				return $result;
			}
			return $data;
		}

	}