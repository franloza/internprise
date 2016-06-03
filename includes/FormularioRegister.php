<?php

namespace es\ucm\aw\internprise;

class FormularioRegister extends Form{

    const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

    private $tipo;

    public function __construct($tipo) {
      parent::__construct('formRegister'.'_'.$tipo);
      $this->tipo = $tipo;
    }

    protected function generaCamposFormulario ($datos) {
        $campos = '<input id="rolHidden" type="hidden" name="rol">';
        switch ($this->tipo) {
            case 'admin': {$campos .= self::generaCamposFormularioAdmin($datos);break;}
            case 'estudiante': {$campos .= self::generaCamposFormularioEstudiante($datos);break;}
            case 'empresa': {$campos .= self::generaCamposFormularioEmpresa($datos);break;}
        }
        return $campos;
    }

    private function generaCamposFormularioAdmin ($datos) {
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

        $hChecked = (isset($sexo) == 'Hombre') ? "checked" : "";
        $mChecked = (isset($sexo) == 'Mujer') ? "checked" : "";

      $camposForm=<<<EOF
			<legend>Registro para Administradores</legend>
			<p class="star">*</p><input class="i_reg" type="text" name="email" onblur="validate('email')" placeholder="Email">
			<p class="star">*</p><input class="i_reg" type="password" name="password" placeholder="Password"/>
			<p class="star">*</p><input class="i_reg" type="text" name="nombre" placeholder="Nombre"/>
			<p class="star">*</p><input class="i_reg" type="text" name="apellidos" placeholder="Apellidos"/>
			<p class="star">*</p><input class="i_reg" type="text" name="nombre_universidad" placeholder="Universidad"/><br />
			<p class="star"></p>Man <input type="radio" name="sexo" placeholder="Hombre" checked/>
			<p class="star"></p>Woman <input type="radio" name="sexo" placeholder="Mujer"/></br /></br />
			<p class="star">*</p><input class="i_reg" type="text" size="50" name="direccion" placeholder="Direccion"/>
			<p class="star">*</p><input class="i_reg" type="text" name="cp" placeholder="Codigo Postal"/>
			<p class="star">*</p><input class="i_reg" type="text" name="localidad" placeholder="Localidad"/>
			<p class="star">*</p><input class="i_reg" type="text" name="provincia" placeholder="Provincia"/>
			<p class="star">*</p><input class="i_reg" type="text" name="pais" placeholder="Pais"/>
			<p class="starnone">*</p><input class="i_reg" type="text" name="web" placeholder="Web"/>
			<p class="starnone">*</p><input type="text" class="i_reg" name="telefono" placeholder="Telefono"/>
			<button type="submit" class ="btn btn-primary btn-block btn-large">Registrarse</button>
EOF;
      return $camposForm;               
    }

    private function generaCamposFormularioEstudiante ($datos) {

        $email = '';
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
            $email = isset($datos['email']) ? $datos['email'] : $email;
            $dni = isset($datos['dni']) ? $datos['dni'] : $dni;
            $password = isset($datos['password']) ? $datos['password'] : $password;
            $nombre = isset($datos['nombre']) ? $datos['nombre'] : $nombre;
            $apellidos = isset($datos['apellidos']) ? $datos['apellidos'] : $apellidos;
            $grado = isset($datos['grado']) ? $datos['grado'] : $grado;
            $nombre_universidad = isset($datos['nombre_universidad']) ? $datos['nombre_universidad'] : $nombre_universidad;
            $sexo = isset($datos['sexo']) ? $datos['sexo'] : $sexo;
            $nacionalidad = isset($datos['nacionalidad']) ? $datos['nacionalidad'] : $nacionalidad;
            $direccion = isset($datos['direccion']) ? $datos['direccion'] : $direccion;
            $fecha_nacimiento = isset($datos['fecha_nacimiento']) ? $datos['fecha_nacimiento'] : $fecha_nacimiento;
            $cp = isset($datos['cp']) ? $datos['cp'] : $cp;
            $localidad = isset($datos['localidad']) ? $datos['localidad'] : $localidad;
            $provincia = isset($datos['provincia']) ? $datos['provincia'] : $provincia;
            $pais = isset($datos['pais']) ? $datos['pais'] : $pais;
            $web = isset($datos['web']) ? $datos['web'] : $web;
            $telefono = isset($datos['telefono']) ? $datos['telefono'] : $telefono;
        }

        $hChecked = (isset($sexo) == 'Hombre') ? "checked" : "";
        $mChecked = (isset($sexo) == 'Mujer') ? "checked" : "";
        $birth = (isset($fecha_nacimiento)) ? date($fecha_nacimiento) : "";

      $camposForm=<<<EOF
			<legend>Registro para Estudiantes</legend>
			<p class="star">*</p><input class="i_reg" type="text" name="email" onblur="validate('email', this)" size="100" placeholder="Email">
			<p class="star">*</p><input class="i_reg" type="password" onblur="validate('password', this)" name="password" size="50" placeholder="Password"/>
			<p class="star">*</p><input class="i_reg" type="text" onblur="validate('dni', this)" name="dni" size="9" placeholder="DNI"/>
			<p class="star">*</p><input class="i_reg" type="text" onblur="validate('nombre', this)" name="nombre" size="50" placeholder="Nombre"/>
			<p class="star">*</p><input class="i_reg" type="text" onblur="validate('apellidos', this)" name="apellidos" size="100" placeholder="Apellidos"/>
			<p class="star">*</p><input class="i_reg" type="text" onblur="validate('grado', this)" name="grado" size="150" placeholder="Grado"/>
			<p class="star">*</p><input class="i_reg" type="text" onblur="validate('universidad, this')" name="nombre_universidad" size="150" placeholder="Universidad"/>
			Man <input type="radio" name="sexo" placeholder="Hombre" checked/>
			Woman <input type="radio" name="sexo" placeholder="Mujer"/></br /></br />
			<p class="star">*</p><input class="i_reg" type="text" name="nacionalidad" size="50" placeholder="Nacionalidad"/>
			<p class="star">*</p><input class="i_reg" type="text" onblur="validate('direccion', this)" size="50" name="direccion" placeholder="Direccion"/>
			<p class="star">*</p><input class="i_reg" type="date" onblur="validate('vacio', this, this)" name="fecha_nacimiento" value="Fecha nacimiento"/>
			<p class="star">*</p><input class="i_reg" type="text" onblur="validate('cp', this)" size="5" name="cp" placeholder="Codigo Postal"/>
			<p class="star">*</p><input class="i_reg" type="text" name="localidad" size="50" placeholder="Ciudad"/>
			<p class="star">*</p><input class="i_reg" type="text" name="provincia" size="50" placeholder="Provincia"/>
			<p class="star">*</p><input class="i_reg" type="text" name="pais" size="50" placeholder="Country"/>
			<p class="starnone">*</p><input class="i_reg" type="text" size="100" name="web" placeholder="Web"/>
			<p class="starnone">*</p><input class="i_reg" type="text" size="9" name="telefono" placeholder="Telefono"/>
			<button type="submit" class="btn btn-primary btn-block btn-large">Registrarse</button>
EOF;

      return $camposForm;
   }

    private function generaCamposFormularioEmpresa ($datos) {
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
		<legend>Registro para Empresa</legend>
		<p class="star">*</p><input class="i_reg" type="text" name="email" placeholder="Email"/>
		<p class="star">*</p><input class="i_reg" type="password" name="password" placeholder="Password"/>
		<p class="star">*</p><input class="i_reg" type="text" name="cif" placeholder="CIF"/>
		<p class="star">*</p><input class="i_reg" type="text" name="razonSocial" placeholder="Razon social"/>
		<p class="star">*</p><input class="i_reg" type="text" size="50" name="direccion" placeholder="Direccion"/>
		<p class="star">*</p><input class="i_reg" type="text" name="cp" placeholder="Codigo postal"/>
		<p class="star">*</p><input class="i_reg" type="text" name="localidad" placeholder="Localidad"/>
		<p class="star">*</p><input class="i_reg" type="text" name="provincia" placeholder="Provincia"/>
		<p class="star">*</p><input class="i_reg" type="text" name="pais" placeholder="Pais"/>
		<p class="starnone">*</p><input class="i_reg" type="text" name="web" placeholder="Web"/>
		<p class="starnone">*</p><input class="i_reg" type="text" name="telefono" placeholder="Telefono"/>
		<button type="submit" class="btn btn-primary btn-block btn-large">Registrarse</button>
EOF;
		return $camposForm;
    }

    /**
     * Procesa los datos del formulario.
     */
    protected function procesaFormulario($datos) {

        switch ($datos['rol']) {
            case 'admin': {$result = Administrador::register($datos);break;}
            case 'estudiante': {$result = Estudiante::register($datos);break;}
            case 'empresa': {$result = Empresa::register($datos);break;}
            default:    $result='Hubo un problema con el envío. Envíe el formulario de nuevo';
        }
        if (!is_array($result)) {
            // SEGURIDAD: Forzamos que se genere una nueva cookie de sesión por si la han capturado antes de hacer login
            $user = Usuario::login($datos['email'], $datos['password']);
            session_regenerate_id(true);
            $result = \es\ucm\aw\internprise\Aplicacion::getSingleton()->resuelve('/login.php');
        }
        return $result;
    }
}






