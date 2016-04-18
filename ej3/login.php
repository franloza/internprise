<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Login</title>
</head>

<body>

<div id="contenedor">
<?php include ("cabecera.php") ?>
<?php include ("sidebarIzq.php") ?>


	<div id="contenido">
		<h1>Acceso al sistema</h1>
		<form method ="post" action ="procesarLogin.php">
		<fieldset>
		<legend>Usuario y contraseña</legend>
		<p>
		<label for ="usuario">Usuario: </label>
		<input name = "usuario" type = "text" ></input></br>
		</p>
		<p>
		<label for ="contraseña">Contraseña: </label>
		<input name = "contraseña" type = "password" ></input></br>
		</p>
		<input type = "submit" name = "form" value = "Aceptar"></input>
		</fieldset>	
	</form>
	</div>

<?php include ("sidebarDer.php") ?>
<?php include ("pie.php") ?>




</div> <!-- Fin del contenedor -->

</body>
</html>
