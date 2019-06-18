<!DOCTYPE html>
<html class="profile">
	<head>
		<title>iPet</title>
		<link rel="stylesheet" type="text/css" href="vista/css/style.css">
		<link rel="shortcut icon" type="image/x-icon" href="assets/favicon/favicon.ico" />
		<script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
		<script type="text/javascript" src="assets/js/scrollbot.min.js"></script>
	</head>
	<body class='perfil'>
		<?php
					if (isset($_SESSION["sesion"])) {
						?>
						<div class="menu" id="menu">
							<div class="left">
								<a href="index.php?mod=home&ope=index">Inicio</a>
								<?php
									if (($_SESSION["sesion"] == "admin") || ($_SESSION["sesion"] == "admin@admin.com")) {
										echo '<a href="index.php?mod=home&ope=admin">Administrar</a>' ;
									} else {
										echo '<a href="index.php?mod=home&ope=match">Match</a>' ;
									}
								?>
								<a href="#">News</a>
								<a href="#">Contact</a>
								<a href="#">About</a>
							</div>
							<div class="right">
						<div class="dropdown">
							<button class="dropbtn"><?= $usuario->getUsuario() ?></button>
							<div class="dropdown-content">
								<a href="#">Perfil</a>
								<?php
									if (($_SESSION["sesion"] == "admin") || ($_SESSION["sesion"] == "admin@admin.com")) {
										echo '<a href="index.php?mod=home&ope=admin">Administrar</a>' ;
									}
								?>
								<a href="index.php?mod=home&ope=signout">Cerrar Sesión</a>
							</div>
						</div>
				<?php
					} else { // if
				?>
					<a href="index.php?mod=home&ope=signin">Iniciar Sesión</a>
					<a href="index.php?mod=home&ope=signup">Registrarme</a>
				<?php
					} // if
				?>
			</div>
		</div>

		<div class="container">
			<div class="max-width-container">
				<div id="profile-image-header" style="background-image: url('<?= $usuario->getImagen() ?>');"></div>
				
				<div class="profile-image-container">
					<div class="i-c">
						<a href="#" onclick="" id="edit-img">
							<img src="assets/img/edit-profile.png" class="edit-img">
						</a>
						<div class="image" style="background-image: url('<?= $usuario->getImagen() ?>');"></div>
					</div>
					<h2 class="username"><?= $usuario->getNombre(); ?></h2>
				</div>

				<a href="#" onclick="" class="edit-bio" id="edit-bio">
					<img src="assets/img/edit-profile.png" class="edit-img">
				</a>

				<div class="biografia-container" id="bio-scroll">
					<p class="bio"><?= $usuario->getBio() ?></p>
				</div>

				<h3 class="subtitulo-1">¡Una red social pensada en los animales!</h3>
				<h4 class="subtitulo-2">¿Qué tal el día, <?= $usuario->getNombre() ?>?</h4>

				<a href="#" class="home-button-R"><span>Jugar Match</span></a>

				<h3 class="subtitulo-1">¡Una red social pensada en los animales!</h3>
				<h4 class="subtitulo-2">¿Qué tal el día, <?= $usuario->getNombre() ?>?</h4>

				<a href="#" class="home-button-R"><span>Jugar Match</span></a>

				<h3 class="subtitulo-1">¡Una red social pensada en los animales!</h3>
				<h4 class="subtitulo-2">¿Qué tal el día, <?= $usuario->getNombre() ?>?</h4>

				<br><br><br>
			</div>		  
		</div>

		<!-- START UPLOAD IMAGE MODAL -->
		<div id="uploadModal" class="modal">
			<div class="modal-content">
				<div class="modal-header">
					<h2>Subir Imágen</h2>
					<span class="close" id="close-img-modal"><img src="assets/img/close-profile.png" width="30px" height="30px"></span>
				</div>
				<div class="modal-body">
					<div class="box" id="modal-box">
						<input type="file" name="image" id="image" class="inputfile inputfile-1">
						<label for="image"><img src="assets/img/upload.png" width="20px" height="20px"><span>Elige un archivo…</span></label>
						<p id="box-message"></p>
					</div>

					<div id="myProgress">
						<div id="myBar">0%</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END UPLOAD IMAGE MODAL -->
		
		<!-- START BIO EDIT MODAL -->
		<div id="bioModal" class="modal">
			<div class="modal-content">
				<div class="modal-header">
					<h2>Editar Biografía</h2>
					<span class="close" id="close-bio-modal"><img src="assets/img/close-profile.png" width="30px" height="30px"></span>
				</div>
				<div class="modal-body">
					<div class="box" id="modal-box">
						<textarea name="bio" id="textarea-bio" class="textarea-bio"><?= $usuario->getBio() ?></textarea>
						
						<label for="bio"><img src="assets/img/save.png" width="20px" height="20px"><span>Guardar</span></label>
					</div>
				</div>
			</div>
		</div>
		<!-- END BIO EDIT MODAL -->

		<script>
			/* START SCROLLBOT */
			var customScroll = new Scrollbot("#bio-scroll", 5).setStyle(
				{}, {
					"background-color": "#969696"
				}
			);			
			/* END SCROLLBOT */
					
			// Get the modal
			var modal = document.getElementById("uploadModal");
			var modalBio = document.getElementById("bioModal");

			// Get the button that opens the modal
			var btn = document.getElementById("edit-img");
			var btnBio = document.getElementById("edit-bio");

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks the button, open the modal
			$("#edit-img").click(() => {
				$("#uploadModal").css('display', 'flex');

				$("#uploadModal").animate({
					top: "0",
					opacity: 1
				}, 500);
			});

			$("#edit-bio").click(() => {
				$("#bioModal").css('display', 'flex');

				$("#bioModal").animate({
					top: "0",
					opacity: 1
				}, 500);
			});

			// When the user clicks on <span> (x), close the modal
			$("#close-img-modal").click(() => {
				$("#uploadModal").animate({
					top: "-=500px",
					opacity: 0
				}, 500, () => {
					$("#uploadModal").css('display', 'none');
				});
			});

			$("#close-bio-modal").click(() => {
				$("#bioModal").animate({
					top: "-=500px",
					opacity: 0
				}, 500, () => {
					$("#bioModal").css('display', 'none');
				});
			});

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
				if (event.target == modal) {
					$("#uploadModal").animate({
						top: "-=500px",
						opacity: 0
					}, 500, () => {
						$("#uploadModal").css('display', 'none');
					});
				}

				if (event.target == modalBio) {
					$("#bioModal").animate({
						top: "-=500px",
						opacity: 0
					}, 500, () => {
						$("#bioModal").css('display', 'none');
					});
				}
			}

			$('input[type="file"]#image').change(() => {
				var progressBar = document.getElementById("myProgress");
				var imageFile = document.getElementById("image").files[0];

				progressBar.style.height = "25px";

				uploadPicture(imageFile);
			});
		</script>

		<!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-storage.js"></script>

        <script>
            // Your web app's Firebase configuration
            var firebaseConfig = {
                apiKey: "AIzaSyAl-gc93zDoNupX3KPUKwVfSwepHUseYpc",
                authDomain: "ipet-php.firebaseapp.com",
                databaseURL: "https://ipet-php.firebaseio.com",
                projectId: "ipet-php",
                storageBucket: "ipet-php.appspot.com",
                messagingSenderId: "927718977213",
                appId: "1:927718977213:web:6ae1bafd92188913"
            };
            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);


            function uploadPicture(file) {
                console.log("Proceso de subida iniciado.");
				$("#box-message").html("Proceso de subida iniciado.");
                
                if ((file.type == "image/jpeg") || (file.type == "image/png")) {
                    // Crear datos iniciales
                    var userName = '<?= $usuario->getUsuario() ?>';
                    var fileName = userName + '.jpg';
                    var myNewFile = new File([file], fileName, { type: "image/jpeg" });
                    var imageGK = 'images/'+ userName + '/' + fileName;

                    // Crear una referencia root a Firebase Storage
                    var storage = firebase.storage(); // storage
                    var imageRef = storage.ref(imageGK); // referencia a la imagen
                    var baseRef = storage.ref(); // referencia a la ruta base del storage
                    var uploadTask = imageRef.put(myNewFile); // subir archivo en la carpeta de referencia de la imagen
					var progressElement = document.getElementById("myBar");

                    uploadTask.on('state_changed', function(snapshot) {
                        var progress = ((snapshot.bytesTransferred / snapshot.totalBytes) * 100).toFixed(0);
                        console.log('Proceso de subida: ' + progress + '%');
						$("#box-message").html("Subiendo...");

						updateProgress(progressElement, progress);

                    }, function(error) {

                        console.log('Error en la subida');
                        console.error(error);

                    }, function name(params) {

                        imageRef.put(myNewFile)
                        .then(() => {
                            console.log('Imagen subida con éxito.');
							$("#box-message").html("Imagen subida con éxito.");
                            baseRef.child(imageGK).getDownloadURL().then(function(url) {
                                
                                var newUrl = url.split('&token=')[0];

                                $.post("index.php?mod=usuario&ope=updatePicture",
                                    { user: '<?= $usuario->getUsuario() ?>', imgUrl: newUrl },
                                    function(data) {
                                        var dcd = data.slice(1, data.length);
                                        console.log(dcd);
										$("#box-message").html("Imagen actualizada con éxito.");
										setTimeout(() => {
											$("#uploadModal").animate({
												top: "-=500px",
												opacity: 0
											}, 500, () => {
												$("#uploadModal").css('display', 'none');
												location.reload();
											});
										}, 1000);
                                    }
                                );

                            }).catch(function(error) {
                                console.error(error)
                            });
                        });
                    });
                } else {
                    console.log('Error en la subida.\nEl archivo no tiene un formato admitido');
                }
            }

			function updateProgress(elem, progress) {
				elem.style.width = progress + '%'; 
				elem.innerHTML = progress * 1  + '%';
			}
        </script>
	</body>
</html>