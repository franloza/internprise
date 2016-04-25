<?php session_start();
  $_SESSION["rol"] = "admin";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Internprise - Login</title>
  <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="css/content.css" type="text/css">
  </head>
  <body>   
  <div id="index-contenedor">      
    <a href="dashboard.php?rol=admin" class="action-button shadow animate green">Internprise Administracion</a>
    <a href="dashboard.php?rol=empresa" class="action-button shadow animate blue">Internprise Empresa</a>
    <a href="dashboard.php?rol=estudiante" class="action-button shadow animate red">Internprise Estudiante</a>
  </div>
  
  </body>
</html>