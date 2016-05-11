<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content Type" content="text/html; charset=utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<title>Registro</title>
</head>
<body>
	<div id="contenedor">
		<div id="contenido">
			<select id="regSelect">
				<option value="empresa">Empresa</option>
				<option value="estudiante" selected="selected">Estudiante</option>
				<option value="admin">Administrador</option>
			</select>	
			<script>
				$(document).ready(function(){
					$("#regSelect").change(function(){
    					if ($("#regSelect option:selected").val() == "empresa") {
    						$("#formEstudiante").hide();
    						$("#formEmp").show();
    						$("#formAdministrador").hide();
    					}
    					if ($("#regSelect option:selected").val() == "estudiante") {
    						$("#formEstudiante").show();
    						$("#formEmp").hide();
    						$("#formAdministrador").hide();
    					}
    					if ($("#regSelect option:selected").val() == "admin") {
    						$("#formEstudiante").hide();
    						$("#formEmp").hide();
    						$("#formAdministrador").show();
    					}
    				});
    			});
			</script>

			<div id="">
				<form action="formAdministrador">
				 <?php $formLogin = new \es\ucm\aw\internprise\FormularioAdmin(); $formLogin->gestiona(); ?>
				</form>
			</div>

			<div id="formEstudiante">
				<form action="">
				<?php $formLogin = new \es\ucm\aw\internprise\FormularioEstudiante(); $formLogin->gestiona(); ?>
				</form>
			</div>

				<div id="formEmpresa">
				<form action="">
				<?php $formLogin = new \es\ucm\aw\internprise\FormularioEmpresa(); $formLogin->gestiona(); ?>
				</form>
			</div>
		</div>
	</div>
</body>
</html>



