<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="default.css" media="screen" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Mi primera web</title>
	</head>
	<body>
		<?php
			$num = $_GET['num'];
			echo "<h1>Me has pedido que te salude " .$num ." veces.</h1>";
			if ($num == 42) {
				echo '<p>En realidad, esa es la respuesta final sobre la vida, el universo y todo lo demás</p>';
			}
			else {
				for ($i = 0; $i <= $num; $i++) {
				    echo "<p>$i - ¡Hola Mundo!</p>";
				}
			}
		?>
	</body>
</html>