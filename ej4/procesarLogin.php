<?php

//Inicio del procesamiento
session_start();

if ($_REQUEST["username"]=="user" && $_REQUEST["password"]=="userpass") {
	$_SESSION["login"] = true;
	$_SESSION["nombre"] = "Usuario";
} else if ($_REQUEST["username"]=="admin" && $_REQUEST["password"]=="adminpass") {
	$_SESSION["login"] = true;
	$_SESSION["nombre"] = "Administrador";
	$_SESSION["esAdmin"] = true;
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
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

	<?php
		if (isset($_SESSION["login"])) {
			echo "<h1>Bienvenido ". $_SESSION['nombre'] . "</h1>";
			echo "<p>Usa el menú de la izquierda para navegar.</p>";
		} else {
			echo "<h1>ERROR</h1>";
			echo "<p>El usuario o contraseña no son válidos.</p>";
		}
	?>

	</div>

<?php
	require("sidebarDer.php");
	require("pie.php");
?>


</div>

</body>
</html>