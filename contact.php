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
				<form class="form" method="post" action="mailto:admin@internprise.com?subject=ContactUs">
					<p class="name">
						<input type="text" placeholder="Name" />
					</p>
					  
					<p class="email">
						<input type="text" placeholder="Email" />
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
			<li onclick="location.href='index.php';"><a href="index.php">Home</a></li>
			<li onclick="location.href='about.php';"><a href="about.php">About us</a></li>
			<li onclick="location.href='login.php';"><a href="login.php">Login</a></li>
			<li onclick="location.href='register.php';"><a href="register.php">Register</a></li>
			<li onclick="location.href='contact.php';"><a href="contact.php">Contact</a></li>
			<li class="slide"></li>
		</ul>
	</nav>
</body>
</html>
