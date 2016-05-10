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
				 
				 <?php
				 class FormularioAdmin extends Form{

				 	const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

				 	public function __contruct() {
				 		parent::__contruct('formAdmin');
				 	}

				 	protected function generaCamposFormulario ($datos) {
				 		$email = '';
				 		$password = '';
				 		$nombre = '';
				 		$apellidos = '';
				 		$nombre_universidad = '';
				 		$sexo = '';
				 		$direccion = '';
				 		$cp = '';
				 		$localidad = '';
				 		$provincia = '';
				 		$pais = '';
				 		$web = '';
				 		$telefono = '';

				 		if($datos){
				 			$email = isset($datos['email']) ? $datos['email'] : $email;
				 			$password = isset($datos['password']) ? $datos['password'] : $password;
				 			$nombre = isset($datos['nombre']) ? $datos['nombre'] : $nombre;
				 			$apellidos = isset($datos['apellidos']) ? $datos['apellidos'] : $apellidos;
				 			$nombre_universidad = isset($datos['nombre_universidad']) ? $datos['nombre_universidad'] : $nombre_universidad;
				 			$sexo = isset($datos['sexo']) ? $datos['sexo'] : $sexo;
				 			$direccion = isset($datos['direccion']) ? $datos['direccion'] : $direccion;
				 			$cp = isset($datos['cp']) ? $datos['cp'] : $cp;
				 			$localidad = isset($datos['localidad']) ? $datos['localidad'] : $localidad;
				 			$provincia = isset($datos['provincia']) ? $datos['provincia'] : $provincia;
				 			$pais = isset($datos['pais']) ? $datos['pais'] : $pais;
				 			$web = isset($datos['web']) ? $datos['web'] : $web;
				 			$telefono = isset($datos['telefono']) ? $datos['telefono'] : $telefono;
				 		}

				 		$camposForm=<<<EOF
				 		<fieldset>
						  <legend>Registro para Administradores</legend>
						  <p><label>eMail:</label> <input type="text" name="email" value=""/></p>
						  <p><label>Password:</label> <input type="password" name="password" value="$password"/><br /></p>
						  <p><label>Nombre:</label> <input type="text" name="nombre" value=""/></p>
						  <p><label>Apellidos:</label> <input type="text" name="apellidos" value=""/><br /></p>
						  <p><label>Universidad:</label> <input type="text" name="nombre_universidad" value=""/></p>
						  <p><label>Sexo:</label> <input type="radio" name="sexo" value="hombre"/>Hombre<input type="radio" name="sexo" value="mujer"/>Mujer<br /></p>
						  <p><label>Direccion:</label> <input type="text" size="50" name="direccion" value=""/></p>
						  <p><label>Codigo Postal:</label> <input type="text" name="cp" value=""/><br /></p>
						  <p><label>Localidad:</label> <input type="text" name="localidad" value=""/></p>
						  <p><label>Provincia:</label> <input type="text" name="provincia" value=""/><br /></p>
						  <p><label>Pais:</label> <input type="text" name="pais" value=""/></p>
						  <p><label>Web:</label> <input type="text" name="web" value=""/><br /></p>
						  <p><label>Telefono:</label> <input type="text" name="telefono" value=""/></p>
						  <button type="submit">Entrar</button>
						</fieldset>

EOF;

						return $camposForm;

					}


				 }


				 ?>


				</form>
			</div>

			<div id="formEstudiante">
				<form action="">
				 
				 <?php
				 class FormularioEstudiante extends Form{

				 	const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

				 	public function __contruct() {
				 		parent::__contruct('formEst');
				 	}

				 	protected function generaCamposFormulario ($datos) {
				 		$dni = '';
				 		$password = '';
				 		$nombre = '';
				 		$apellidos = '';
				 		$grado = '';
				 		$nombre_universidad = '';
				 		$sexo = '';
				 		$nacionalidad = '';
				 		$direccion = '';
				 		$fecha_nacimiento = '';
				 		$cp = '';
				 		$localidad = '';
				 		$provincia = '';
				 		$pais = '';
				 		$web = '';
				 		$telefono = '';

				 		if($datos){
				 			$dni = isset($datos['dni']) ? $datos['dni'] : $dni;
				 			$password = isset($datos['password']) ? $datos['password'] : $password;
				 			$nombre = isset($datos['nombre']) ? $datos['nombre'] : $nombre;
				 			$apellidos = isset($datos['apellidos']) ? $datos['apellidos'] : $apellidos;
				 			$grado = isset($datos['grado']) ? $datos['grado'] : $grado;
				 			$nombre_universidad = isset($datos['nombre_universidad']) ? $datos['nombre_universidad'] : $nombre_universidad;
				 			$sexo = isset($datos['sexo']) ? $datos['sexo'] : $sexo;
				 			$nacionalidad = isset($datos['nacionalidad']) ? $datos['nacionalidad'] : $nacionalidad;
				 			$direccion = isset($datos['direccion']) ? $datos['direccion'] : $direccion;
				 			$apellidos = isset($datos['fecha_nacimiento']) ? $datos['fecha_nacimiento'] : $fecha_nacimiento;
				 			$cp = isset($datos['cp']) ? $datos['cp'] : $cp;
				 			$localidad = isset($datos['localidad']) ? $datos['localidad'] : $localidad;
				 			$provincia = isset($datos['provincia']) ? $datos['provincia'] : $provincia;
				 			$pais = isset($datos['pais']) ? $datos['pais'] : $pais;
				 			$web = isset($datos['web']) ? $datos['web'] : $web;
				 			$telefono = isset($datos['telefono']) ? $datos['telefono'] : $telefono;
				 		}

				 		$camposForm=<<<EOF
				 		<fieldset>
						  <legend>Registro para Administradores</legend>
						  <p><label>DNI:</label> <input type="text" name="dni" value=""/></p>
						  <p><label>Password:</label> <input type="password" name="password" value="$password"/><br /></p>
						  <p><label>Nombre:</label> <input type="text" name="nombre" value=""/></p>
						  <p><label>Apellidos:</label> <input type="text" name="apellidos" value=""/><br /></p>
						  <p><label>Grado:</label> <input type="text" name="grado" value=""/><br /></p>
						  <p><label>Universidad:</label> <input type="text" name="nombre_universidad" value=""/></p>
						  <p><label>Sexo:</label> <input type="radio" name="sexo" value="hombre"/>Hombre<input type="radio" name="sexo" value="mujer"/>Mujer<br /></p>
						  <p><label>Nacionalidad:</label> <input type="text" name="nacionalidad" value=""/><br /></p>
						  <p><label>Direccion:</label> <input type="text" size="50" name="direccion" value=""/></p>
						  <p><label>Fecha Nacimiento:</label> <input type="date" name="fecha_nacimiento" value=""/><br /></p>
						  <p><label>Codigo Postal:</label> <input type="text" name="cp" value=""/><br /></p>
						  <p><label>Localidad:</label> <input type="text" name="localidad" value=""/></p>
						  <p><label>Provincia:</label> <input type="text" name="provincia" value=""/><br /></p>
						  <p><label>Pais:</label> <input type="text" name="pais" value=""/></p>
						  <p><label>Web:</label> <input type="text" name="web" value=""/><br /></p>
						  <p><label>Telefono:</label> <input type="text" name="telefono" value=""/></p>
						  <button type="submit">Entrar</button>
						</fieldset>

EOF;

						return $camposForm;

					}


				 }


				 ?>
				 </form>

			</div>

				<div id="formEmpresa">
				<form action="">
				  <?php
				 class FormularioEmpresa extends Form{

				 	const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

				 	public function __contruct() {
				 		parent::__contruct('formEmpresa');
				 	}

				 	protected function generaCamposFormulario ($datos) {
				 		$email = '';
				 		$password = '';
				 		$cif = '';
				 		$razonSocial= '';
				 		$direccion = '';
				 		$cp = '';
				 		$localidad = '';
				 		$provincia = '';
				 		$pais = '';
				 		$web = '';
				 		$telefono = '';


				 		if($datos){
				 			$email = isset($datos['email']) ? $datos['email'] : $email;
				 			$password = isset($datos['password']) ? $datos['password'] : $password;
				 			$cif = isset($datos['cif']) ? $datos['cif'] : $cif;
				 			$razonSocial = isset($datos['razonSocial']) ? $datos['razonSocial'] : $razonSocial;
				 			$direccion = isset($datos['direccion']) ? $datos['direccion'] : $direccion;
				 			$cp = isset($datos['cp']) ? $datos['cp'] : $cp;
				 			$localidad = isset($datos['localidad']) ? $datos['localidad'] : $localidad;
				 			$provincia = isset($datos['provincia']) ? $datos['provincia'] : $provincia;
				 			$pais = isset($datos['pais']) ? $datos['pais'] : $pais;
				 			$web = isset($datos['web']) ? $datos['web'] : $web;
				 			$telefono = isset($datos['telefono']) ? $datos['telefono'] : $telefono;
				 		}

				 		$camposForm=<<<EOF
				 		<fieldset>
						  <legend>Registro para Administradores</legend>
						  <p><label>eMail:</label> <input type="text" name="email" value=""/></p>
						  <p><label>Password:</label> <input type="password" name="password" value="$password"/><br /></p>
						  <p><label>CIF:</label> <input type="text" name="cif" value=""/></p>
						  <p><label>Razon Social:</label> <input type="text" name="razonSocial" value=""/><br /></p>
						  <p><label>Direccion:</label> <input type="text" size="50" name="direccion" value=""/></p>
						  <p><label>Codigo Postal:</label> <input type="text" name="cp" value=""/><br /></p>
						  <p><label>Localidad:</label> <input type="text" name="localidad" value=""/></p>
						  <p><label>Provincia:</label> <input type="text" name="provincia" value=""/><br /></p>
						  <p><label>Pais:</label> <input type="text" name="pais" value=""/></p>
						  <p><label>Web:</label> <input type="text" name="web" value=""/><br /></p>
						  <p><label>Telefono:</label> <input type="text" name="telefono" value=""/></p>
						  <button type="submit">Entrar</button>
						</fieldset>

EOF;

						return $camposForm;

					}


				 }


				 ?>

				</form>
				

			</div>


		</div>



	</div>

</body>
</html>



