<!DOCTYPE html>
<html>
	<head>
		<title>iPet</title>
        <link rel="stylesheet" type="text/css" href="vista/css/style.css">
        <link rel="shortcut icon" type="image/x-icon" href="assets/favicon/favicon.ico" />
        <script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript">

            function updateMessages() {
                $.post("index.php?mod=mensaje&ope=index",
                    {},
                    function(data) {
                        $("#screen").val(data);
                    }
                );
                setTimeout('updateMessages()', 5000);
            }

            function like(idPareja, element) {

                $.post("index.php?mod=likes&ope=like",
                    { u1: '<?= $usr->getUsuario() ?>', u2: idPareja },
                    function(data) {
                        console.log(data.slice(1, data.length))
                        var cardID = element.parentNode.parentNode.id;
                        var $newMatchCard = $("#" + cardID), degree = 0, timer;

                        rotate();
                        function rotate() {
                            $newMatchCard.css({ WebkitTransform: 'rotate(' + degree + 'deg)'});  
                            $newMatchCard.css({ '-moz-transform': 'rotate(' + degree + 'deg)'});                      
                            timer = setTimeout(function() {
                                ++degree; rotate();
                            }, 15);
                        }                

                        $("#" + cardID).animate({
                            opacity: 0.5,
                            left: "+=700px"
                        }, 300, () => { // on animation finished
                            $("#" + cardID).remove();
                        });
                    }
                );
            }

            function dislike(element) {
                var cardID = element.parentNode.parentNode.id;
                var $newMatchCard = $("#" + cardID), degree = 0, timer;

                rotate();
                function rotate() {
                    $newMatchCard.css({ WebkitTransform: 'rotate(' + degree + 'deg)'});  
                    $newMatchCard.css({ '-moz-transform': 'rotate(' + degree + 'deg)'});                      
                    timer = setTimeout(function() {
                        --degree; rotate();
                    }, 15);
                }                

                $("#" + cardID).animate({
                    opacity: 0.5,
                    left: "-=700px"
                }, 300, () => { // on animation finished
                    $("#" + cardID).remove();
                });
            }
            
            var lastMaxMessagesForChat = [];

            function updateMatches() {
                $.ajax({
                    type: 'POST',
                    url: 'index.php?mod=matches&ope=index',
                    data: { user: '<?= $usr->getUsuario() ?>' },

                    success: function(response) {
                        window.localStorage.setItem("matches", response);
                        var gotMatches = JSON.parse(response);
                        if (gotMatches.length == 0) {
                            /*******/
                            $("#tabs-matches").append('<div class="no-chats-container">' +
                                '<div class="title">' +
                                    '<h2>Sin Matches</h2>' +
                                '</div>' +
                                '<div class="no-chats-message">' +
                                    '<p>Parece que aún no has conectado con nadie, ¡Desliza para encontrar gente!</p>' +
                                '</div>' +
                            '</div>');
                            /*******/
                        } else {
                            /*******/
                            gotMatches.forEach(match => {
                                var pareja = (match.usuario1.usuario == '<?= $usr->getUsuario() ?>') ? match.usuario2 : match.usuario1;

                                var matchName = pareja.nombre.split(' ')[0];

                                if (pareja.nombre.split(' ')[1] != undefined) {
                                    matchName = matchName + ' ' + pareja.nombre.split(' ')[1];
                                }

                                var imgUrl = (pareja.imagen == "/path/to/image") ? "assets/img/background.jpg" : pareja.imagen ;

                                $("#tabs-matches").append('<a style="background: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0), rgba(0,0,0,.75)), url('+ imgUrl +');" href="#" class="match-card" onclick="showDropdown(\''+pareja.usuario+'\', this)">' +
                                    '<div class="match-card-container">' +
                                        '<p>' + matchName + '</p>' +
                                    '</div>' +
                                '</a>');
                            });
                            /*******/
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }

            function updateLikes() {
                $.ajax({
                    type: 'POST',
                    url: 'index.php?mod=likes&ope=index',
                    data: { user: '<?= $usr->getUsuario() ?>' },

                    success: function(response) {
                        var gotLikes = JSON.parse(response);
                        if (gotLikes.likesToUser.length == 0) {
                            console.log("Sin likes")
                            /*******/
                            $("#tabs-likes").append('<div class="no-chats-container">' +
                                '<div class="title">' +
                                    '<h2>Sin Likes</h2>' +
                                '</div>' +
                                '<div class="no-chats-message">' +
                                    '<p>Parece que aún no le has gustado a nadie, ¿Por qué no añades más información a tu perfil?</p>' +
                                '</div>' +
                            '</div>');
                            /*******/
                        } else {
                            /*******/
                            gotLikes.likesToUser.forEach(like => {
                                var pareja = (like.usuario1.usuario == '<?= $usr->getUsuario() ?>') ? like.usuario2 : like.usuario1;

                                var matchName = pareja.nombre.split(' ')[0];

                                if (pareja.nombre.split(' ')[1] != undefined) {
                                    matchName = matchName + ' ' + pareja.nombre.split(' ')[1];
                                }

                                var imgUrl = (pareja.imagen == "/path/to/image") ? "assets/img/background.jpg" : pareja.imagen ;

                                $("#tabs-likes").append('<a style="background: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0), rgba(0,0,0,.75)), url('+ imgUrl +'); background-position: 50% 50%; background-size: auto 100%;" href="#" class="match-card" onclick="console.log(\''+pareja.nombre+'\')">' +
                                    '<div class="match-card-container">' +
                                        '<p>' + matchName + '</p>' +
                                    '</div>' +
                                '</a>');
                            });
                            /*******/
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }

            var chatsAnterior;

            function updateChats() {
                
                $.ajax({
                    type: 'POST',
                    url: 'index.php?mod=chat&ope=index',
                    data: { user: '<?= $usr->getUsuario() ?>' },

                    success: function (response) {
                        
                        chats = JSON.parse(response);
                        chatsAnterior = chats;

                        if (chats.length == 0) {
                            console.log("Sin chats");
                            $(".messages").append('<div class="no-chats-container">' +
                                '<div class="title">' +
                                    '<h2>Sin Chats</h2>' +
                                '</div>' +
                                '<div class="no-chats-message">' +
                                    '<p>Parece que aún no has hablado con nadie, ¿por qué no comienzas una conversación?</p>' +
                                '</div>' +
                            '</div>');
                        } else {

                            if (chatsAnterior == chats) {
                                chats.forEach(chat => {
                                    window.localStorage.setItem('chat-' + chat.idChat, JSON.stringify(chat));
                                    var pareja;
                                    var imgDiv = (chat.mensajes[0].propietario.usuario == "<?= $usr->getUsuario() ?>") ? '<img src="assets/img/respuesta.png" height="10px" width="10px">' : "";                                

                                    if (chat.usuario1.usuario == "<?= $usr->getUsuario() ?>") {
                                        pareja = chat.usuario2;
                                    } else {
                                        pareja = chat.usuario1;
                                    }

                                    var str = chat.mensajes[0].texto;
                                    var strLength = str.length;
                                    var maxLength = 25;
                                    if (str.length >= maxLength) {
                                        str = str.slice(0, maxLength);
                                        str += "...";
                                    }

                                    var matchName = pareja.nombre.split(' ')[0];

                                    if (pareja.nombre.split(' ')[1] != undefined) {
                                        matchName = matchName + ' ' + pareja.nombre.split(' ')[1];
                                    }

                                    var imgUrl = (pareja.imagen == "/path/to/image") ? "assets/img/background.jpg" : pareja.imagen ;

                                    if ($('#chat-id-' + chat.idChat).length) {
                                        
                                        $('#chat-id-' + chat.idChat).html('<a href="#" onclick="goToChat('+ chat.idChat +', { nombre: \''+pareja.nombre+'\', edad: \''+pareja.edad+'\', genero: \''+pareja.genero+'\', imagen: \''+pareja.imagen+'\', usuario: \''+pareja.usuario+'\' }, \'\')" id="chat-id-'+ chat.idChat +'">' +
                                            '<div class="chat">' +
                                                '<div class="chat-container">' +
                                                    '<div class="match-picture" style="background-image: url('+ imgUrl +');"></div>' +
                                                    '<div>' +
                                                        '<h3 class="match-name">' + matchName + '</h3>' +
                                                        '<p class="chat-message-text">' +
                                                            imgDiv +
                                                            ' ' + str +
                                                        '</p>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</a>');

                                    } else {
                                        $(".messages").append('<a href="#" onclick="goToChat('+ chat.idChat +', { nombre: \''+pareja.nombre+'\', edad: \''+pareja.edad+'\', genero: \''+pareja.genero+'\', imagen: \''+pareja.imagen+'\', usuario: \''+pareja.usuario+'\' }, \'\')" id="chat-id-'+ chat.idChat +'">' +
                                            '<div class="chat">' +
                                                '<div class="chat-container">' +
                                                    '<div class="match-picture" style="background-image: url('+ imgUrl +');"></div>' +
                                                    '<div>' +
                                                        '<h3 class="match-name">' + matchName + '</h3>' +
                                                        '<p class="chat-message-text">' +
                                                            imgDiv +
                                                            ' ' + str +
                                                        '</p>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</a>');
                                    }
                                });

                            }
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
                setTimeout('updateChats()', 5000);
            }
        
            $(document).ready(
        
                function() {
                    updateMessages();
                    updateChats();
                    updateMatches();
                    updateLikes();
                
                    $("#button").click(
                        function() {

                            $.post("index.php?mod=mensaje&ope=send",
                                { message: $("#message").val() },
                                function(data) {
                                    console.log(data);
                                    $("#screen").val(data); 
                                    $("#message").val("");
                                }
                            );
                        }
                    );

                    $("#like").click(
                        function() {
                            
                        }
                    );
                }
            );
            var matchElement;
            function showDropdown(idPareja, element) {
                matchElement = element;
                element.classList.add("active");
                var ePos = element.getBoundingClientRect();
                $("#tabs-matches").append(
                    '<div id="matchDropdown" class="matchDropdown-content" style="opacity: 0; position: absolute; display: inline-block; top: ' + (ePos.y + 35) + 'px; left: ' + ePos.x + 'px;">' +
                        '<a href="#" onclick="openProfile(\'' + idPareja + '\')"><img src="assets/img/perfil.png" width="20px" height="20px"><p>Ver perfil</p></a>' +
                        '<a href="#" onclick="openChat(\'' + idPareja + '\')"><img src="assets/img/mensaje.png" width="20px" height="20px"><p>Abrir chat</p></a>' +
                        '<a href="#" onclick="undoMatch(\'' + idPareja + '\')"><img src="assets/img/deshacer-match.png" width="20px" height="20px"><p>Deshacer match</p></a>' +
                    '</div>'
                );

                $("#matchDropdown").animate({
                    opacity: 1
                }, 200, () => { // on animation finished
                    
                });
            }

            window.onclick = function(event) {
                if (matchElement) {
                    if ((!event.target.matches('#matchDropdown')) && (!event.target.matches('.match-card'))) {
                        $("#matchDropdown").animate({
                            opacity: 0
                        }, 200, () => { // on animation finished
                            $("#matchDropdown").remove();
                            matchElement.classList.remove("active");
                        });
                    }
                }
            }

            function openProfile(idPareja) {
                console.log("Ver perfil de " + idPareja)
                var actualMatch;
                var couples = JSON.parse(window.localStorage.getItem("matches"));

                couples.forEach((couple) => {
                    if (couple.usuario1.usuario == idPareja) {
                        actualMatch = couple.usuario1;
                    } else if (couple.usuario2.usuario == idPareja) {
                        actualMatch = couple.usuario2;
                    }
                });

                var educacion = "";
                var trabajo = "";

                if (actualMatch.educacion != null) {
                    educacion = '<div class="educacion">' +
                                    '<img src="assets/img/education.png" width="15px" height="15px">' +
                                    '<p>'+actualMatch.educacion+'</p>' +
                                '</div>';
                }

                if (actualMatch.trabajo != null) {
                    trabajo = '<div class="trabajo">' +
                                    '<img src="assets/img/work.png" width="14px" height="14px">' +
                                    '<p>'+actualMatch.trabajo+'</p>' +
                                '</div>';
                }

                $(".card-container").append(
                    '<div class="card" id="card-'+idPareja+'" style="opacity: 0; margin-top: 500px;">' +
                        '<div class="image" id="profile-image" style="background-image: url('+actualMatch.imagen+');">' +
                            '<div class="close-button-container">' +
                                '<a href="#" onclick="closeProfile(\''+idPareja+'\')">' +
                                    '<img src="assets/img/close-profile.png" width="40px" height="40px">' +
                                '</a>' +
                            '</div>' +
                        '</div>' +

                        '<a href="#" onclick="profileInfo(\''+idPareja+'\')" class="info-link">' +
                            '<div class="info-img-container">' +
                                '<img src="assets/img/info.png" width="35px" height="35px">' +
                            '</div>' +
                        '</a>' +

                        '<div class="info" id="info">' +
                            '<h3 class="name">'+actualMatch.nombre+'</h3>' +
                            '<p  class="edad">'+actualMatch.edad+'</p>' +
                        '</div>' +

                        '<div class="biografia" style="padding-left: 30px; padding-right: 30px;">' +
                            educacion +
                            trabajo +
                            '<p class="test">'+actualMatch.bio+'</p>' +
                        '</div>' +
                    '</div>'
                );

                $( "#card-"+idPareja ).animate({
                    opacity: 1,
                    marginTop: 0
                }, 300);
            }

            function closeProfile(idPareja) {
                $( "#card-"+idPareja ).animate({
                    opacity: 0,
                    marginTop: 500,
                }, 300, () => { // on animation finished
                    $("#card-" + idPareja).remove();
                });
            }

            function openChat(idPareja) {
                var pareja;
                var couples = JSON.parse(window.localStorage.getItem("matches"));

                couples.forEach((couple) => {
                    if (couple.usuario1.usuario == idPareja) {
                        pareja = couple.usuario1;
                    } else if (couple.usuario2.usuario == idPareja) {
                        pareja = couple.usuario2;
                    }
                });

                $.post("index.php?mod=chat&ope=indexChats",
                    { u1: '<?= $usr->getUsuario() ?>', u2: idPareja },
                    function(data) {
                        var chat = JSON.parse(data);
                        if (chat.length == 0) {

                            $.post("index.php?mod=chat&ope=create",
                                { u1: '<?= $usr->getUsuario() ?>', u2: idPareja },
                                function(data) {
                                    var newIdChat = data.slice(1, data.length);

                                    console.log(newIdChat)
                                    if (newIdChat == "Error") {
                                        alert("Error al crear chat.");
                                    } else {

                                        $.post("index.php?mod=mensaje&ope=send",
                                            { idChat: newIdChat , propietario: '<?= $usr->getUsuario() ?>', texto: "Solicitud para charlar.", epoch: (new Date()).getTime() },
                                            function(data) {
                                                $.post("index.php?mod=chat&ope=indexFromId",
                                                    { idChat: newIdChat },
                                                    function(data) { 
                                                        var newChat = JSON.parse(data)

                                                        goToChat(newChat.idChat, pareja, newChat);
                                                        $(".no-chats-container").remove();
                                                    }
                                                )
                                            }
                                            
                                        );
                                    }
                                }
                            )
                    
                        } else {
                            goToChat(chat[0].idChat, pareja, chat[0]);
                        }
                    }
                );
                

            }

            function undoMatch(idPareja) {
                $(".pareja-user").html(idPareja);
                console.log("Deshacer match con " + idPareja)

                $("#acceptModal").css('display', 'flex');

				$("#acceptModal").animate({
					top: "0",
					opacity: 1
				}, 500);

                $("#close-accept-modal").click(() => {
                    $("#acceptModal").animate({
                        top: "-=500px",
                        opacity: 0
                    }, 500, () => {
                        $("#acceptModal").css('display', 'none');
                    });
                });

                window.onclick = function(event) {
                    if (event.target == document.getElementById("acceptModal")) {
                        $("#acceptModal").animate({
                            top: "-=500px",
                            opacity: 0
                        }, 500, () => {
                            $("#acceptModal").css('display', 'none');
                        });
                    }
                }
            }
        
        </script>
        <style>
            body.match #matchDropdown {

            }
        </style>
	</head>
	<body class="match">
		<div class="menu" id="menu">
			<div class="left">
				<a href="index.php?mod=home&ope=index">Inicio</a>
                <a href="index.php?mod=home&ope=match" class="active">Match</a>
				<a href="#">News</a>
				<a href="#">Contact</a>
				<a href="#">About</a>
			</div>
			<div class="right">
                <div class="dropdown">
                    <button class="dropbtn"><?= $usr->getUsuario() ?></button>
                    <div class="dropdown-content">
                        <a href="index.php?mod=usuario&ope=index&usuario=<?= $usr->getUsuario() ?>">Perfil</a>
                        <a href="index.php?mod=home&ope=signout">Cerrar Sesión</a>
                    </div>
                </div>
			</div>
		</div>

		<div class="container">
            <div class="messages-chat-container" id="messages-chat-container">
                <div class="inner-container">

                    <div class="chat-header">
                        <div class="back-button-container">
                            <a href="#" onclick="closeChat()">
                                <img src="assets/img/back.png" width="20px" height="20px">
                            </a>
                        </div>

                        <a href="#" class="view-profile">
                            <div class="match-profile-image">
                                <!-- INSERT IMG VIA JS -->
                            </div>
                            <div class="chat-name" id="chat-name"></div>
                        </a>

                        <textarea id="screen" cols="40" rows="40" style="height: 65vh; display: none;"></textarea>
                        <input id="message" size="40" style="display: none;">
                        <button id="button" style="display: none;">Send</button>
                        
                    </div>

                    <div class="chatting-container">
                        <div class="chatting" id="chat-contenedor">
                            <script>
                                
                            </script>
                            <div class="contenedor">
                                <ul class="msjs"></ul>
                            </div>
                        </div>

                        <div class="input-panel">
                            <div class="buttons-left">
                                <a href="#" class="left-button" onclick="console.log('left button clicked')">
                                    <div class="left-button-container">
                                        <img src="assets/img/view.png" width="25px">
                                    </div>
                                </a>
                            </div>

                            <div class="msj-rta macro">
                                <div class="text text-r">
                                    <textarea class="mytext" placeholder="Escribe un mensaje..." id="text-message"></textarea>
                                    <script>
                                        $(function() {
                                            $("textarea#text-message").keypress(function(e) {
                                                if (e.which == 13) {
                                                    sendMessage() ;
                                                    e.preventDefault();
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="button-right">
                                <a href="#" class="send-button disabled" onclick="sendMessage()">
                                <script>
                                    $('textarea#text-message').bind('input propertychange', function() {
                                        if ($('textarea#text-message').val() != "") {
                                            $(".send-button").removeClass('disabled');
                                        } else {
                                            $(".send-button").addClass('disabled');
                                        }
                                    });

                                    function formatAMPM(epoch) {
                                        var date = new Date();
                                        date.setTime(epoch * 1000);

                                        var hours = date.getHours();
                                        var minutes = date.getMinutes();
                                        var ampm = hours >= 12 ? 'PM' : 'AM';
                                        hours = hours % 12;
                                        hours = hours ? hours : 12; // las 0 deben ser las 12
                                        minutes = minutes < 10 ? '0'+minutes : minutes;
                                        var strTime = hours + ':' + minutes + ' ' + ampm;
                                        return strTime;
                                    }
                                    
                                    function sendMessage() {
                                        var myDiv = document.getElementById("chat-contenedor");

                                        $("#chat-contenedor").animate({
                                            scrollTop: myDiv.scrollHeight
                                        }, 1000);

                                        var mensaje = $('textarea#text-message').val();
                                        var propietario = '<?=$usr->getUsuario()?>';

                                        var idChat = window.localStorage.getItem("idChat");
                                        var epoch = Math.floor(new Date().getTime() / 1000.0);

                                        if (mensaje != "")  {
                                            $.post("index.php?mod=mensaje&ope=send",
                                                { idChat: idChat, propietario: propietario, texto: mensaje, epoch: epoch },
                                                function(data) {
                                                    var newMsg = JSON.parse(data);
                                                    console.log(newMsg)

                                                    $(".msjs").append('<li style="width: 100%;">' +
                                                        '<div class="msj-r macro">' +
                                                            '<div class="text text-r">' +
                                                                '<p>' + newMsg.texto + '</p>' +
                                                                '<p><small>' + formatAMPM(newMsg.epoch) + '</small></p>' +
                                                            '</div>' +
                                                            '<div class="avatar">' +
                                                                //'<img class="img-circle" width="50px" height="50px" src="<?= ($usr->getImagen() != "/path/to/image" ? $usr->getImagen() : "assets/img/background_thumb.jpg") ?>">' +
                                                                '<div class="img-circle" style="width: 50px; height: 50px; background-image: url(<?= ($usr->getImagen() != "/path/to/image" ? $usr->getImagen() : "assets/img/background_thumb.jpg") ?>);"></div>' +
                                                            '</div>' +
                                                        '</div>' +
                                                    '</li>');
                                                }
                                            );

                                            $('textarea#text-message').val('');
                                            $(".send-button").addClass('disabled');
                                        }    

                                    }
                                </script>
                                <div class="send-button-image-container">
                                    <img src="assets/img/send.png" width="20px">
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="info-container">
                <div class="buttons-match-messages">
                    <div class="underline-container">
                    <ul>
                        <li class="mensajes active"><a onclick="swipeToTab('mensajes')" href="#">Mensajes</a></li>
                        <li class="matches"        ><a onclick="swipeToTab('matches')"  href="#">Matches</a></li>
                        <hr id="line" class="" />
                    </ul>
                    </div>
                </div>


                <div class="tabs" id="tabs">

                
                    <div class="messages active" id="tabs-messages">

                        <script>
                            var chat;

                            function goToChat(idChat, pareja, chat) {

                                window.localStorage.setItem("idChat", idChat);
                                if (chat == "") {
                                    chat = window.localStorage.getItem("chat-" + idChat);
                                    chat = JSON.parse(chat);
                                }

                                console.log(chat)
                                

                                var myDiv = document.getElementById("chat-contenedor");

                                if (chat.mensajes.length > 3) {
                                    setTimeout(() => {
                                        myDiv.scrollTop = myDiv.scrollHeight;
                                    }, 200);
                                }

                                var imgUrl = (pareja.imagen == "/path/to/image") ? "assets/img/background.jpg" : pareja.imagen ;
                                
                                if ($(".match-profile-image-img").length) {
                                    $(".match-profile-image-img").html('<div class="match-profile-image-img" style="background-image: url('+ imgUrl +');"></div>');


                                   
                                } else {
                                    console.log(pareja)
                                    $(".view-profile").html(
                                        '<a href="#" onclick="openProfile(\''+pareja.usuario+'\')" class="view-profile">' +
                                            '<div class="match-profile-image"></div>' +
                                            '<div class="chat-name" id="chat-name"></div>' +
                                        '</a>'
                                    );   
                                    $(".match-profile-image").append('<div class="match-profile-image-img" style="background-image: url('+ imgUrl +');"></div>');
                                }                                

                                for (let i = chat.mensajes.length - 1; i >= 0; i--) {
                                    if (chat.mensajes[i].propietario.usuario == '<?= $usr->getUsuario() ?>') {
                                        var imgPropietario = (chat.mensajes[i].propietario.imagen == "/path/to/image") ? "assets/img/background.jpg" : chat.mensajes[i].propietario.imagen ;

                                        if ($('#id-mensaje-' + chat.mensajes[i].idMensaje).length) {
                                            $('#id-mensaje-' + chat.mensajes[i].idMensaje).html('<li style="width: 100%;" id="id-mensaje-'+chat.mensajes[i].idMensaje+'">' +
                                                '<div class="msj-r macro">' +
                                                    '<div class="text text-r">' +
                                                        '<p>' + chat.mensajes[i].texto + '</p>' +
                                                        '<p><small>' + formatAMPM(chat.mensajes[i].epoch) + '</small></p>' +
                                                    '</div>' +
                                                    '<div class="avatar">' +
                                                        '<div class="img-circle" style="width: 50px; height: 50px; background-image: url('+ imgPropietario +');"></div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</li>');
                                        } else {
                                            $(".msjs").append('<li style="width: 100%;" id="id-mensaje-'+chat.mensajes[i].idMensaje+'">' +
                                                '<div class="msj-r macro">' +
                                                    '<div class="text text-r">' +
                                                        '<p>' + chat.mensajes[i].texto + '</p>' +
                                                        '<p><small>' + formatAMPM(chat.mensajes[i].epoch) + '</small></p>' +
                                                    '</div>' +
                                                    '<div class="avatar">' +
                                                        '<div class="img-circle" style="width: 50px; height: 50px; background-image: url('+ imgPropietario +');"></div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</li>');
                                        }                                       

                                    } else {

                                        if ($('#id-mensaje-' + chat.mensajes[i].idMensaje).length) {
                                            $('#id-mensaje-' + chat.mensajes[i].idMensaje).html('<li style="width: 100%;" id="id-mensaje-'+chat.mensajes[i].idMensaje+'">' +
                                                '<div class="msj macro">' +
                                                    '<div class="avatar">' +
                                                        '<div class="img-circle" style="width: 50px; height: 50px; background-image: url('+ imgUrl +');"></div>' +
                                                    '</div>' +
                                                    '<div class="text text-l">' +
                                                        '<p>' + chat.mensajes[i].texto + '</p>' +
                                                        '<p><small>' + formatAMPM(chat.mensajes[i].epoch) + '</small></p>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</li>');
                                        } else {
                                            $(".msjs").append('<li style="width: 100%;" id="id-mensaje-'+chat.mensajes[i].idMensaje+'">' +
                                                '<div class="msj macro">' +
                                                    '<div class="avatar">' +
                                                        '<div class="img-circle" style="width: 50px; height: 50px; background-image: url('+ imgUrl +');"></div>' +
                                                    '</div>' +
                                                    '<div class="text text-l">' +
                                                        '<p>' + chat.mensajes[i].texto + '</p>' +
                                                        '<p><small>' + formatAMPM(chat.mensajes[i].epoch) + '</small></p>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</li>');
                                        }
                                    }
                                }
                                
                                var chatElement = document.getElementById("messages-chat-container");

                                chatElement.className = "messages-chat-container active";

                                var matchName = pareja.nombre.split(' ')[0];

                                if (pareja.nombre.split(' ')[1] != undefined) {
                                    matchName = matchName + ' ' + pareja.nombre.split(' ')[1];
                                }

                                $("#chat-name").html('<h3 class="name" id="chat-match-name" style="margin-top: 0; margin-bottom: 0;">'+ matchName +'</h3>') ;
                            }

                            function closeChat() {
                                chatElement = document.getElementById("messages-chat-container");

                                chatElement.className = "messages-chat-container";

                                setTimeout(() => {
                                    $(".msj").remove();
                                    $(".msj-r").remove();
                                    $("div.match-profile-image-img").remove();
                                }, 200);

                                var myDiv = document.getElementById("chat-contenedor");

                                setTimeout(() => {
                                    myDiv.scrollTop = 0;
                                }, 500);
                            }
                        </script>

                        <!-- CHATS GO HERE -->

                    </div>

                    <div class="matches-container" id="matches-container">
                        <div class="matches" id="tabs-matches">

                        </div>
                    </div>

                    <div class="likes-container" id="likes-container">
                        <div class="likes" id="tabs-likes">

                        </div>
                    </div>



                </div>

            </div>



            <div class="swipe-container">
                <div class="card-container">
                    <script>
                        function info(idCard) {
                            profileImage = document.getElementById("profile-image");
                            card = document.getElementById("card-id-" + idCard);
                            information = document.getElementById("info");

                            imageHeight = profileImage.clientHeight;

                            scrollTo(card, imageHeight);
                        }

                        function profileInfo(idPareja) {
                            profileImage = document.getElementById("profile-image");
                            card = document.getElementById("card-" + idPareja);
                            information = document.getElementById("info");

                            imageHeight = profileImage.clientHeight;

                            scrollTo(card, imageHeight);
                        }

                        function scrollTo(elem, pos) {
                            var y = elem.scrollTop;
                            y += Math.round((pos - y) * 0.2);

                            if (Math.abs(y - pos) <= 2) {
                                elem.scrollTop = pos;
                                return;
                            }
                            elem.scrollTop = y;
                            setTimeout(scrollTo, 10, elem, pos);
                        }
                    </script>
                    <?php
                        require_once "noMoreFound.php" ;
                        require_once "cards.php" ;
                    ?>
                </div>
            </div>
        </div>
        <script>
            var mensajes = document.getElementById("tabs-messages");
            var matches = document.getElementById("tabs-matches");
            
            line = document.getElementById("line");
            matchesContainer = document.getElementById("matches-container");

            active = "";

            function swipeToTab(tab) {
                if (tab == "mensajes") {
                    if (mensajes.className != "messages active") {
                        mensajes.style.transform = "translate(0)";
                        matches.style.transform = "translate(100%)";
                        mensajes.className = "messages active";
                        matches.className = "matches";
                        matches.style.visibility = "hidden";

                        matches.style.overflow = "hidden";
                        matchesContainer.style.overflow = "hidden";

                        active = "mensajes";

                        setTimeout(() => {
                            matchesContainer.style.zIndex = "-1";
                        }, 200);
                    } else {
                        console.log("messages is active");
                    }
                }

                if (tab == "matches") {
                    if (matches.className != "matches active" ) {
                        matches.style.transform = "translate(0)";
                        mensajes.style.transform = "translate(-100%)";
                        mensajes.className = "messages";
                        matches.className = "matches active";
                        matches.style.visibility = "visible";

                        setTimeout(function(){
                            matches.style.overflow = "visible";
                            matchesContainer.style.overflow = "visible";
                        }, 500);

                        active = "matches";

                        matchesContainer.style.zIndex = "0";
                    } else {
                        console.log("matches is active");
                    }
                }

                if (active == "matches") {
                    line.className = "active";
                } else {
                    line.className = "";
                }
                
            }

            function deshacerMatch(pareja) {
                $.post(
                    "index.php?mod=mensaje&ope=deshacerMatch",
                    { u1: '<?= $usr->getUsuario() ?>', u2: pareja },
                    function(data) {
                        
                    }
                );
            }
        </script>

        <!-- START ACCEPT MODAL -->
		<div id="acceptModal" class="modal">
			<div class="modal-content">
				<div class="modal-header">
					<h2>¿Desea deshacer el Match?</h2>
					<span class="close" id="close-accept-modal"><img src="assets/img/close-profile.png" width="30px" height="30px"></span>
				</div>
				<div class="modal-body">
					<div class="box" id="modal-box">

                        <p class="pareja-user" style="display: none;"></p>

                        <a href="#" onclick="deshacerMatch(document.getElementsByClassName('pareja-user').item(0).textContent)">Aceptar</a>
                        <a href="#" onclick="">Cancelar</a>
                        
					</div>
				</div>
			</div>
		</div>
		<!-- END ACCEPT MODAL -->
	</body>
</html>