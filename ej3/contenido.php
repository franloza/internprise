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
         $login = $_SESSION["login"] ?: null;
        if ($login) {?>
            <h1> Texto del contenido principal para usuarios </h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Ipsam natus magnam, libero ut quod explicabo corrupti deleniti nihil 
            dolores nostrum molestiae non sapiente inventore perferendis cum 
            ipsa eius doloremque, eum. </p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Ipsam natus magnam, libero ut quod explicabo corrupti deleniti nihil 
            dolores nostrum molestiae non sapiente inventore perferendis cum 
            ipsa eius doloremque, eum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Ipsam natus magnam, libero ut quod explicabo corrupti deleniti nihil 
            dolores nostrum molestiae non sapiente inventore perferendis cum 
            ipsa eius doloremque, eum.</p>
      <?php } else { ?>
             <h1> Usuario no registrado! </h1>
            <p>Debes iniciar sesión para ver el contenido. </p>
      <?php } ?>
	</form>
	</div>
<?php include ("sidebarDer.php") ?>
<?php include ("pie.php") ?>

</div> <!-- Fin del contenedor -->

</body>
</html>