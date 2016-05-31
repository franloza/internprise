<?php
//require_once __DIR__.'/includes/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/estilo_index.css" />
	<title>Internprise</title>
</head>

<body>
	<main>
		<section id="left"></section>
		<article id="main_register">
			<header id="register_fields">
				<h1>Register</h1>
				<select id="regSelect">
					<option placeholder="empresa">Empresa</option>
					<option value="estudiante" selected="selected">Estudiante</option>
					<option value="admin">Administrador</option>
				</select>
				<fieldset id='admin'>
					<legend>Registro para Administradores</legend>
					<input type="text" name="email" placeholder="Email">
					<input type="password" name="password" placeholder="Password"/>
					<input type="text" name="nombre" placeholder="Name"/>
					<input type="text" name="apellidos" placeholder="Surname"/>
					<input type="text" name="nombre_universidad" placeholder="University"/>
					Man <input type="radio" name="sexo" placeholder="Man" checked/>
					Woman <input type="radio" name="sexo" placeholder="Woman"/></br /></br />
					<input type="text" size="50" name="direccion" placeholder="Address"/>
					<input type="text" name="cp" placeholder="CP"/>
					<input type="text" name="localidad" placeholder="City"/>
					<input type="text" name="provincia" placeholder="State"/>
					<input type="text" name="pais" placeholder="Country"/>
					<input type="text" name="web" placeholder="Web"/>
					<input type="text" name="telefono" placeholder="Phone"/>
					<button type="submit" class="btn btn-primary btn-block btn-large">Register</button>
				</fieldset>
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

	<script>
		$(document).ready(function () {
			$("#regSelect").val("estudiante");
			$("input:hidden#rolHidden").val("estudiante");
		});

		$("#regSelect").change(function () {
			var valueSelected = this.value;
			switch (valueSelected) {
				case "empresa":
				{
					$('fieldset#estudiante').hide();
					$('fieldset#empresa').show();
					$("fieldset#admin").hide();
					$("input:hidden#rolHidden").val("empresa");
					break;
				}
				case "estudiante":
				{
					$('fieldset#estudiante').show();
					$('fieldset#empresa').hide();
					$('fieldset#admin').hide();
					$("input:hidden#rolHidden").val("estudiante");
					break;
				}
				case "admin":
				{
					$('fieldset#estudiante').hide();
					$('fieldset#empresa').hide();
					$('fieldset#admin').show();
					$("input:hidden#rolHidden").val("admin");
					break;
				}
			}
		}).change();
	</script>
</body>
</html>
