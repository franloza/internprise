<?php

//Inicio del procesamiento
session_start();

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
		<h1>Registro de usuario</h1>
		<p> Aquí está el contenido público, visible para todos los usuarios. </p>
	</div>

<?php

	require("sidebarDer.php");
	require("pie.php");

?>


</div>

</body>
</html>