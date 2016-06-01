<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilo_index.css" />
	<script src="js/jquery-2.2.3.js"></script>
	<title>Inicio</title>
</head>
<body>
	<canvas id="canvas"></canvas>
	<main>
		<section id="left"></section>
		<article id="main">
			<aside id="logo">
				<img src="img/favicon-admin.png" alt="Internprise icon" />
			</aside>
			<header>
				<span>Internprise</span>
				<span>
					Pr&aacute;cticas en empresa 
					<a href="https://www.ucm.es"/>Universidad Complutense Madrid</a>
				</span>
			</header>
		</article>
		<section id="right"></section>
	</main>
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
