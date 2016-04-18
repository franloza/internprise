<?php
session_start(); 
if ( isset($_POST['form']) ) {
    $usuario = $_POST["usuario"] ?: null;
    $contraseña = $_POST["contraseña"] ?: null;

    if ($usuario  && $usuario =="admin" && $contraseña =="adminpass"){
        $_SESSION['nombre'] = "Admin";  
        $_SESSION['login'] = true;
        $_SESSION['esAdmin'] = true;
    }elseif ( $usuario  && $usuario =="user" && $contraseña =="userpass") {
        $_SESSION['nombre'] = "Juan";
        $_SESSION['login'] = true;
        $_SESSION['esAdmin'] = false;
    }else{
        echo 'ei';
        $subtitulo = "Debes iniciar sesión para ver el contenido";
        $_SESSION['nombre'] = "desconocido";
        $_SESSION['login'] = false;
        $_SESSION['esAdmin'] = false;
    }  
} else {
    ('Location: form1.php');
}

if ($_SESSION['login']) {
            $titulo = "Bienvenido " .  $_SESSION['nombre'];
            $subtitulo = "Usa el menú de la izquierda para navegar";
            session_regenerate_id(true);
        }
        else {
           $titulo = "Usuario no registrado!";
           $subtitulo = "Usa el menú de la izquierda para navegar";
        }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Login</title>
</head>

<body>

<div id="contenedor">
<?php
 include ("cabecera.php"); 
 include ("sidebarIzq.php"); 
?>
    <div id="contenido">
        <h1> <?php echo $titulo; ?> </h1>
        <p> <?php echo $subtitulo; ?> </p>	
	</div>
<?php 
include ("sidebarDer.php");
include ("pie.php") 
?>
</div> <!-- Fin del contenedor -->

</body>


