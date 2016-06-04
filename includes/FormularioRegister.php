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
			<input type="text" name="email" placeholder="Email">
			<input type="password" name="password" placeholder="Password"/>
			<input type="text" name="nombre" placeholder="Nombre"/>
			<input type="text" name="apellidos" placeholder="Apellidos"/>
			<input type="text" name="nombre_universidad" placeholder="Universidad"/>
			Man <input type="radio" name="sexo" placeholder="Hombre" checked/>
			Woman <input type="radio" name="sexo" placeholder="Mujer"/></br /></br />
			<input type="text" size="50" name="direccion" placeholder="Direccion"/>
			<input type="text" name="cp" placeholder="Codigo Postal"/>
			<input type="text" name="localidad" placeholder="Localidad"/>
			<input type="text" name="provincia" placeholder="Provincia"/>
			<input type="text" name="pais" placeholder="Pais"/>
			<input type="text" name="web" placeholder="Web"/>
			<input type="text" name="telefono" placeholder="Telefono"/>
			<button type="submit" class="btn btn-primary btn-block btn-large">Registrarse</button>
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
			<input type="text" name="email" placeholder="Email">
			<input type="password" name="password" placeholder="Password"/>
			<input type="text" name="dni" placeholder="DNI"/>
			<input type="text" name="nombre" placeholder="Nombre"/>
			<input type="text" name="apellidos" placeholder="Apellidos"/>
			<input type="text" name="grado" placeholder="Grado"/>
			<input type="text" name="nombre_universidad" placeholder="Universidad"/>
			Man <input type="radio" name="sexo" placeholder="Hombre" checked/>
			Woman <input type="radio" name="sexo" placeholder="Mujer"/></br /></br />
			<input type="text" name="nacionalidad" placeholder="Nacionalidad"/>
			<input type="text" size="50" name="direccion" placeholder="Direccion"/>
			<input type="date" name="fecha_nacimiento" value="Fecha nacimiento"/>
			<input type="text" name="cp" placeholder="Codigo Postal"/>
			<input type="text" name="localidad" placeholder="Ciudad"/>
			<input type="text" name="provincia" placeholder="Provincia"/>
			<input type="text" name="pais" placeholder="Country"/>
			<input type="text" name="web" placeholder="Web"/>
			<input type="text" name="telefono" placeholder="Telefono"/>
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
		<input type="text" name="email" placeholder"Email"/></p>
		<input type="password" name="password" placeholder="Password"/>
		<input type="text" name="cif" placeholder="CIF"/>
		<input type="text" name="razonSocial" placeholder="Razon social"/>
		<input type="text" size="50" name="direccion" placeholder="Direccion"/>
		<input type="text" name="cp" placeholder="Codigo postal"/>
		<input type="text" name="localidad" placeholder="Localidad"/>
		<input type="text" name="provincia" placeholder="Provincia"/>
		<input type="text" name="pais" placeholder="Pais"/>
		<input type="text" name="web" placeholder="Web"/>
		<input type="text" name="telefono" placeholder="Telefono"/>
		<button type="submit" class="btn btn-primary btn-block btn-large">Registrarse</button>
EOF;
		return $camposForm;
    }

    /**
     * Procesa los datos del formulario.
     */
    protected function procesaFormulario($datos) {

        $opciones = ['cost' => 6,];
        $datos['password'] = password_hash($datos['password'], PASSWORD_BCRYPT, $opciones);
       

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






