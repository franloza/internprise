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

        $hChecked = ($sexo == 'Hombre') ? "checked" : "";
        $mChecked = ($sexo == 'Mujer') ? "checked" : "";

      $camposForm=<<<EOF
        <legend>Registro para Administradores</legend>
        <p><label>eMail:</label> <input type="text" name="email" value="$email"/></p>
        <p><label>Password:</label> <input type="password" name="password" value="$password"/><br /></p>
        <p><label>Nombre:</label> <input type="text" name="nombre" value="$nombre"/></p>
        <p><label>Apellidos:</label> <input type="text" name="apellidos" value="$apellidos"/><br /></p>
        <p><label>Universidad:</label> <input type="text" name="nombre_universidad" value="$nombre_universidad"/></p>
        <p><label>Sexo:</label> 
             <input type="radio" name="sexo" value="Hombre" $hChecked >Hombre 
             <input type="radio" name="sexo" value="Mujer" $mChecked > Mujer <br></p>
        <p><label>Direccion:</label> <input type="text" size="50" name="direccion" value=""/>$direccion</p>
        <p><label>Codigo Postal:</label> <input type="text" name="cp" value=""/><br />$cp</p>
        <p><label>Localidad:</label> <input type="text" name="localidad" value=""/>$localidad</p>
        <p><label>Provincia:</label> <input type="text" name="provincia" value=""/><br />$provincia</p>
        <p><label>Pais:</label> <input type="text" name="pais" value=""/>$pais</p>
        <p><label>Web:</label> <input type="text" name="web" value=""/><br />$web</p>
        <p><label>Telefono:</label> <input type="text" name="telefono" value=""/>$telefono</p>
        <button type="submit">Registrarse</button>
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
        <p><label>Email:</label> <input type="text" name="email" value="$email"/><br /></p>
        <p><label>Password:</label> <input type="password" name="password" value="$password"/><br /></p>
        <p><label>DNI:</label> <input type="text" name="dni" value="$dni"/></p>
        <p><label>Nombre:</label> <input type="text" name="nombre" value="$nombre"/></p>
        <p><label>Apellidos:</label> <input type="text" name="apellidos" value="$apellidos"/><br /></p>
        <p><label>Grado:</label> <input type="text" name="grado" value="$grado"/><br/></p>
        <p><label>Universidad:</label> <input type="text" name="nombre_universidad" value="$nombre_universidad"/></p> 
        <p><label>Sexo:</label> 
             <input type="radio" name="sexo" value="Hombre" $hChecked >Hombre 
             <input type="radio" name="sexo" value="Mujer" $mChecked > Mujer <br></p>
        <p><label>Nacionalidad:</label> <input type="text" name="nacionalidad" value="$nacionalidad"/><br /></p>
        <p><label>Direccion:</label> <input type="text" size="50" name="direccion" value="$direccion"/></p>
        <p><label>Fecha Nacimiento:</label> <input type="date" name="fecha_nacimiento" value="$birth"/><br /></p>
        <p><label>Codigo Postal:</label> <input type="text" name="cp" value="$cp"/><br /></p>
        <p><label>Localidad:</label> <input type="text" name="localidad" value="$localidad"/></p>
        <p><label>Provincia:</label> <input type="text" name="provincia" value="$provincia"/><br /></p>
        <p><label>Pais:</label> <input type="text" name="pais" value="$pais"/></p>
        <p><label>Web:</label> <input type="text" name="web" value="$web"/><br /></p>
        <p><label>Telefono:</label> <input type="text" name="telefono" value="$telefono"/></p>
        <button type="submit">Registrarse</button>
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
      <p><label>eMail:</label> <input type="text" name="email" value="$email"/></p>
      <p><label>Password:</label> <input type="password" name="password" value="$password"/><br /></p>
      <p><label>CIF:</label> <input type="text" name="cif" value="$cif"/></p>
      <p><label>Razon Social:</label> <input type="text" name="razonSocial" value="$razonSocial"/><br /></p>
      <p><label>Direccion:</label> <input type="text" size="50" name="direccion" value="$direccion"/></p>
      <p><label>Codigo Postal:</label> <input type="text" name="cp" value="$cp"/><br /></p>
      <p><label>Localidad:</label> <input type="text" name="localidad" value="$localidad"/></p>
      <p><label>Provincia:</label> <input type="text" name="provincia" value=""/><br />$provincia</p>
      <p><label>Pais:</label> <input type="text" name="pais" value=""/>$pais</p>
      <p><label>Web:</label> <input type="text" name="web" value=""/><br />$web</p>
      <p><label>Telefono:</label> <input type="text" name="telefono" value=""/>$telefono</p>
      <button type="submit">Registrarse</button>
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






