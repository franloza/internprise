<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Portada</title>
</head>

<body>

<div id="contenedor">
<?php include ("cabecera.php") ?>
	
<?php include ("sidebarIzq.php") ?>


	<div id="contenido">
		<h1>Página principal</h1>
		<p> Aquí está el contenido público, visible para todos los usuarios. </p>
	</div>

<?php include ("sidebarDer.php") ?>
<?php include ("pie.php") ?>




</div> <!-- Fin del contenedor -->

</body>
</html>