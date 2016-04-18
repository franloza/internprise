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
        <?php 
        $admin = $_SESSION["esAdmin"] ?: null;
        if ($admin) {?>
            <h1> Consola de administración </h1>
            <p>Aquí estarían todos los controles de administración. </p>
      <?php } else { ?>
             <h1>Acceso denegado! </h1>
            <p>No tienes permisos suficientes para administrar la web. </p>
      <?php } ?>
       
	</form>
	</div>
<?php include ("sidebarDer.php") ?>
<?php include ("pie.php") ?>

</div> <!-- Fin del contenedor -->

</body>
</html>