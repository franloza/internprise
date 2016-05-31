<?php
//require_once __DIR__.'/includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilo_index.css" />
	<title>Inicio</title>
</head>
<body>
	<main>
		<section id="left"></section>
		<article id="main_login">
			<header id="login">
				<h1>Contact</h1>
				<form class="form" method="post" action="#">
					<p class="name">
						<input name="name" type="text" placeholder="Name" />
					</p>
					  
					<p class="email">
						<input name="email" type="text" placeholder="Email" />
					</p>
					  
					<p class="text">
						<textarea name="text" placeholder="Comment"></textarea>
					</p>
					  
					<div class="submit">
						<button type="submit" class="btn btn-primary btn-block btn-large">Send</button>
						<div class="ease"></div>
					</div>
				</form>
			</header>
		</article>
		<section id="right"></section>
	</main>
	<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="about.php">About us</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="register.php">Register</a></li>
			<li><a href="contact.php">Contact</a></li>
			<li class="slide"></li>
		</ul>
	</nav>
</body>
</html>

