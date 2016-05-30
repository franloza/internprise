<?php

//Inicio del procesamiento
session_start();

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<script src="js/jquery-1.9.1.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Portada</title>
</head>

<body>

<div id="contenedor">

<?php
	require("cabecera.php");
	require("sidebarIzq.php");
?>

	<div id="contenido">
		<h1>Acceso al sistema</h1>

		<form action="procesarLogin.php" method="POST">
		<fieldset>
		<legend>Usuario y contraseña</legend>
        <p><label>Email:</label> <input type="text" name="email" id="campoEmail" />
            <img src="img/ok.png" alt ="OK" id = "imgOKEmail">
            <img src="img/no.png" alt ="OK" id = "imgNOEmail"></p>
        <p><label>Name:</label> <input type="text" name="username" id="campoUser" />
            <img src="img/ok.png" alt ="OK" id = "imgOKUser">
            <img src="img/no.png" alt ="OK" id = "imgNOUser"></p></p>
        <p><label>Password:</label> <input type="password" name="password" /><br /></p>
		<button type="submit" action="index.php">Entrar</button>
		</fieldset>


	</div>

<?php
	require("sidebarDer.php");
	require("pie.php");
?>

</div>
<script>
    $("#campoEmail").change(function(){
        var email = $("#campoEmail").val();
        if (email === '') {
            $("#imgOKEmail").hide();
            $("#imgNOEmail").hide();
        } else {
            if (correoValido(email)) {
                $("#imgOKEmail").show();
                $("#imgNOEmail").hide();
            } else {
                $("#imgOKEmail").hide();
                $("#imgNOEmail").show();
            }
        }
    });

    $("#campoUser").change(function(){
        var user = $("#campoUser").val();
        if (user !== '') {
            $("#imgOKUser").hide();
            $("#imgNOUser").hide();
        }
        var	url="comprobarUsuario.php?user="	+ user;
        $.get(url,usuarioExiste);
    });

    $( document ).ready(function() {
        $("#imgOKEmail").hide();
        $("#imgNOEmail").hide();
        $("#imgOKUser").hide();
        $("#imgNOUser").hide();
    });

    function correoValido(email) {
        //Gracias, Stack Overflow :)
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    //Función AJAX
    function usuarioExiste (data,status) {
        var userStatus = JSON.parse(data).userStatus;
        if (userStatus && userStatus === 'disponible') {
            $("#imgOKUser").show();
            $("#imgNOUser").hide();
        } else if  (userStatus === 'existe') {
            alert('El nombre ya está reservado');
            $("#imgOKUser").hide();
            $("#imgNOUser").show();
        }
        else {
            $("#imgOKUser").hide();
            $("#imgNOUser").hide();
        }
    }


</script>

</body>
</html>