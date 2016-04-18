<div id="cabecera">
	<h1>Mi gran página web</h1>
	<div class="saludo">
		<?php 
		if(!isset($_SESSION['nombre'])){
			$_SESSION['nombre'] = "desconocido";
		}
        if(!isset($_SESSION['login'])){
			$_SESSION['login'] = false;
		}
        if(!isset($_SESSION['esAdmin'])){
			$_SESSION['esAdmin'] = false;
		}
	echo "Usuario " . $_SESSION['nombre'].". " ;
    if ($_SESSION['login']) {
        echo "<a href='logout.php'>(Salir)</a></div>";
    }
    else {
         echo "<a href='login.php'>Login</a></div>";
    }
    ?>
</div>

