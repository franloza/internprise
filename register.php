<?php
	require_once __DIR__.'/includes/config.php';
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
				<select id="regSelect">
					<option value="empresa">Empresa</option>
					<option value="estudiante" selected="selected">Estudiante</option>
					<option value="admin">Administrador</option>
				</select>

				<div id="formAdmin">
					<?php 
						$formAdmin =  new \es\ucm\aw\internprise\FormularioRegister('admin');
						$formAdmin->gestiona(); 
					?>
				</div>
				<div id="formEstudiante">
					<?php 
						$formEstudiante =  new \es\ucm\aw\internprise\FormularioRegister('estudiante')
						;$formEstudiante->gestiona(); 
					?>
				</div>
				<div id="formEmpresa">
					<?php 
						$formEmpresa =  new \es\ucm\aw\internprise\FormularioRegister('empresa');
						$formEmpresa->gestiona(); 
					?>
				</div>
			</header>
		</article>
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

	<script>
		$(document).ready(function () {
			$("#regSelect").val("estudiante");
			$( "#formEstudiante").find("input:hidden#rolHidden").val("estudiante");
		});
		$( "#regSelect").change(function () {
			var valueSelected = this.value;
			switch (valueSelected) {
				case "empresa":
				{
					$('#formEstudiante').hide();
					$('#formEmpresa').show();
					$("#formAdmin").hide();
					$("#formEmpresa").find("input:hidden#rolHidden").val("empresa");
					break;
				}
				case "estudiante":
				{
					$('#formEstudiante').show();
					$('#formEmpresa').hide();
					$('#formAdmin').hide();
					$("#formEstudiante").find("input:hidden#rolHidden").val("estudiante");
					break;
				}
				case "admin":
				{
					$('#formEstudiante').hide();
					$('#formEmpresa').hide();
					$('#formAdmin').show();
					$("#formAdmin").find("input:hidden#rolHidden").val("admin");
					break;
				}
			}
		}).change();
	</script>
</body>
</html>
