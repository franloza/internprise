<?php
	
	if ($_SESSION["rol"] == "admin"){
		$titulo = "Internprise - Portal Administracion";
		$imagen = "img/favicon-admin.png";
	}elseif ($_SESSION["rol"] == "estudiante") {
		$titulo = "Internprise - Portal Estudiante";
		$imagen = "img/favicon-estudiante.png";
	}elseif ($_SESSION["rol"] == "empresa") {
		$titulo = "Internprise - Portal Empresa";
		$imagen = "img/favicon-empresa.png";
	}
?>
<!-- Fragmento para incluir CSS -->
<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?></title>
    <link rel="stylesheet" href="css/menu.css" type="text/css">
    <link rel="stylesheet" href="css/content.css" type="text/css">
    <link rel="stylesheet" href="css/titlebar&footer.css" type="text/css">
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
    <!-- css solo para los colores-->
    <link rel="stylesheet" href="css.php">
    <link rel="icon" type="image/png" href="<?= $imagen ?>">
 </head>