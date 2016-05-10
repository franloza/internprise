<?php

require_once __DIR__.'/includes/config.php';
    
?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/login.css') ?>" />
  <title>Login</title>
</head>
<body>
<div id="contenedor">
	<div id="contenido">
		<h1>Acceso al sistema</h1>
    <?php $formLogin = new \es\ucm\aw\internprise\FormularioLogin(); $formLogin->gestiona(); ?>
	</div>
</div>
</body>
</html>