<?php session_start(); ?>

<div id="cabecera">
	<h1>Mi gran página web</h1>
	<div class="saludo">
		<?php 
		if(!isset($_SESSION['nombre'])){
			$_SESSION['nombre'] = "desconocido";
		}
	echo "Usuario " . $_SESSION['nombre'].". " ?><a href='login.php'>Login</a>	</div>


</div>

