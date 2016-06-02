<?php
  require_once __DIR__.'/includes/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<script src="js/jquery-2.2.3.js"></script>
	<link rel="stylesheet" type="text/css" href="css/estilo_index.css" />
	<title>Internprise</title>
</head>
<body>
	<canvas id="canvas"></canvas>
	<main>
		<section id="left"></section>
		<article id="main_login">
			<header id="login">
				<h1>Login</h1>
				<?php $formLogin = new \es\ucm\aw\internprise\FormularioLogin(); $formLogin->gestiona(); ?>
			</header>
		</article>
		<section id="right"></section>
	</main>
	</section>
	<nav>
		<ul>
			<li onclick="location.href='index.php';"><a href="index.php">Home</a></li>
			<li onclick="location.href='about.php';"><a href="about.php">About us</a></li>
			<li onclick="location.href='login.php';"<a href="login.php">Login</a></li>
			<li onclick="location.href='register.php';"<a href="register.php">Register</a></li>
			<li onclick="location.href='contact.php';"<a href="contact.php">Contact</a></li>
			<li class="slide"></li>
		</ul>
	</nav>
</body>
<script src="js/bckgEffect.js"></script>
</html>
