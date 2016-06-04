<?php

namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class FormularioSettings extends Form{

    const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

    private $tipo;

    public function __construct($tipo) {
        $opciones = array('action'=>'ajaxRequest.php?val=SETTINGS');
        parent::__construct('formSettings'.'_'.$tipo, $opciones);
        $this->tipo = $tipo;
    }

    protected function generaCamposFormulario ($datos) {
        switch ($this->tipo) {
            case 'admin': {return self::generaCamposFormularioAdmin();break;}
            case 'estudiante': {return self::generaCamposFormularioEstudiante();break;}
            case 'empresa': {return self::generaCamposFormularioEmpresa();break;}
        }
    }

    private function generaCamposFormularioAdmin () {

        $app = Aplicacion::getSingleton();
        $id_administrador = $app->idUsuario();
        $user = UsuarioDAO::cargaAdministrador($id_administrador);

        $email = $user->getEmail();
        $password = $user->getPassword();
        $nombre = $user->getNombre();
        $apellidos = $user->getApellidos();
        $nombre_universidad = $user->getNombreUniversidad();
        $sexo = $user->getSexo();
        $direccion = $user->getDireccion();
        $localidad = $user->getLocalidad();
        $provincia = $user->getProvincia();
        $pais = $user->getPais();
        $web = $user->getWeb();
        $telefono = $user->getTelefono();
        $cp = $user->getCp();


        $hChecked = ($sexo == 'Hombre') ? "checked" : "";
        $mChecked = ($sexo == 'Mujer') ? "checked" : "";

        $content = <<<EOF
       <legend id= "formSettings">Cambios en el perfil: </legend>
        <div id = "formSettingsLeft">
        <p><label>eMail:</label> <input type="text" name="email" value="$email" disabled/></p>
        <p><label>Password:</label> <input type="password" name="password" value="$password"/><br /></p>
        <p><label>Nombre:</label> <input type="text" name="nombre" value="$nombre"/></p>
        <p><label>Apellidos:</label> <input type="text" name="apellidos" value="$apellidos"/><br /></p>
        <p><label>Universidad:</label> <input type="text" name="nombre_universidad" value="$nombre_universidad"/></p>
        <p><label>Sexo:</label> 
             <input type="radio" name="sexo" value="Hombre" $hChecked >Hombre 
             <input type="radio" name="sexo" value="Mujer" $mChecked > Mujer <br></p>
        <p><label>Direccion:</label> <input type="text" size="50" name="direccion" value="$direccion"/></p>
        </div>
        <div id = "formSettingsRight">
        <p><label>Codigo Postal:</label> <input type="text" name="cp" value="$cp"/><br /></p>
        <p><label>Localidad:</label> <input type="text" name="localidad" value="$localidad"/></p>
        <p><label>Provincia:</label> <input type="text" name="provincia" value="$provincia"/><br /></p>
        <p><label>Pais:</label> <input type="text" name="pais" value="$pais"/></p>
        <p><label>Web:</label> <input type="text" name="web" value="$web"/><br /></p>
        <p><label>Telefono:</label> <input type="text" name="telefono" value="$telefono"/></p>
        </div>
        <legend id= "formSettingsSubmit">
        <button class="btn btn-default" type="submit" id="formSettingsBotton">Confirmar cambios</button>
        </legend>
        
EOF;
        return $content;
    }

    private function generaCamposFormularioEstudiante () {

        $app = Aplicacion::getSingleton();
        $id_estudiante = $app->idUsuario();
        $user = UsuarioDAO::cargaEstudiante($id_estudiante);
        $email = $user->getEmail();
        $password = $user->getPassword();
        $dni = $user->getDni();
        $nombre = $user->getNombre();
        $apellidos = $user->getApellidos();
        $grado = $user->getGrado();
        $nombre_universidad = $user->getNombreUniversidad();
        $sexo = $user->getSexo();
        $nacionalidad = $user->getNacionalidad();
        $direccion = $user->getDireccion();
        $fecha_nacimiento = $user->getFechaNacimiento();
        $localidad = $user->getLocalidad();
        $provincia = $user->getProvincia();
        $pais = $user->getPais();
        $web = $user->getWeb();
        $telefono = $user->getTelefono();


        $hChecked = ($sexo == 'Hombre') ? "checked" : "";
        $mChecked = ($sexo == 'Mujer') ? "checked" : "";

        $content = <<<EOF
       <legend id= "formSettings">Cambios en el perfil: </legend>
        <div id = "formSettingsLeft">
        <p><label>Email:</label> <input type="text" name="email" value="$email" disabled/><br /></p>
        <p><label>Password:</label> <input type="password" name="password" value="$password"/><br /></p>
        <p><label>DNI:</label> <input type="text" name="dni" value="$dni"/></p>
        <p><label>Nombre:</label> <input type="text" name="nombre" value="$nombre"/></p>
        <p><label>Apellidos:</label> <input type="text" name="apellidos" value="$apellidos"/><br /></p>
        <p><label>Grado:</label> <input type="text" name="grado" value="$grado"/><br/></p>
        <p><label>Universidad:</label> <input type="text" name="nombre_universidad" value="$nombre_universidad"/></p> 
        <p><label>Sexo:</label> 
             <input type="radio" name="sexo" value="Hombre" $hChecked >Hombre 
             <input type="radio" name="sexo" value="Mujer" $mChecked > Mujer <br></p>
        <p><label>Direccion:</label> <input type="text" size="50" name="direccion" value="$direccion"/></p>
        </div>
        <div id = "formSettingsRight">
        <p><label>Nacionalidad:</label> <input type="text" name="nacionalidad" value="$nacionalidad"/><br /></p>
        <p><label>Fecha Nacimiento:</label> <input type="date" name="fecha_nacimiento" value="$fecha_nacimiento"/><br /></p>
        <p><label>Codigo Postal:</label> <input type="text" name="cp" value="TODO:Incluir en BBDD"/><br /></p>
        <p><label>Localidad:</label> <input type="text" name="localidad" value="$localidad"/></p>
        <p><label>Provincia:</label> <input type="text" name="provincia" value="$provincia"/><br /></p>
        <p><label>Pais:</label> <input type="text" name="pais" value="$pais"/></p>
        <p><label>Web:</label> <input type="text" name="web" value="$web"/><br /></p>
        <p><label>Telefono:</label> <input type="text" name="telefono" value="$telefono"/></p>
        </div>
        <legend id= "formSettingsSubmit">
        <button class="btn btn-default" type="submit" id="formSettingsBotton">Confirmar cambios</button>
        </legend>
EOF;
        return $content;
    }

    private function generaCamposFormularioEmpresa () {
        $app = Aplicacion::getSingleton();
        $id_empresa = $app->idUsuario();
        $user = UsuarioDAO::cargaEmpresa($id_empresa);

        $email = $user->getEmail();
        $password = $user->getPassword();
        $cif = $user->getCif();
        $razonSocial = $user->getRazonSocial();
        $direccion = $user->getDireccion();
        $localidad = $user->getLocalidad();
        $provincia = $user->getProvincia();
        $pais = $user->getPais();
        $web = $user->getWeb();
        $telefono = $user->getTelefono();
        $cp = $user->getCp();

        $content = <<<EOF
       <legend id= "formSettings">Cambios en el perfil: </legend>
        <div id = "formSettingsLeft">
      <p><label>eMail:</label> <input type="text" name="email" value="$email" disabled/></p>
      <p><label>Password:</label> <input type="password" name="password" value="$password"/><br /></p>
      <p><label>CIF:</label> <input type="text" name="cif" value="$cif"/></p>
      <p><label>Razon Social:</label> <input type="text" name="razonSocial" value="$razonSocial"/><br /></p>
      <p><label>Direccion:</label> <input type="text" size="50" name="direccion" value="$direccion"/></p>
      </div>
      <div id = "formSettingsRight">
      <p><label>Codigo Postal:</label> <input type="text" name="cp" value="$cp"/><br /></p>
      <p><label>Localidad:</label> <input type="text" name="localidad" value="$localidad"/></p>
      <p><label>Provincia:</label> <input type="text" name="provincia" value="$provincia"/><br /></p>
      <p><label>Pais:</label> <input type="text" name="pais" value="$pais"/></p>
      <p><label>Web:</label> <input type="text" name="web" value="$web"/><br /></p>
      <p><label>Telefono:</label> <input type="text" name="telefono" value="$telefono"/></p>
      </div>
        <legend id= "formSettingsSubmit">
        <button class="btn btn-default" type="submit" id="formSettingsBotton">Confirmar cambios</button>
        </legend>
EOF;
        return $content;
    }

    /**
     * Procesa los datos del formulario.
     */
    protected function procesaFormulario($datos) {

        $opciones = ['cost' => 6,];
        $datos['password'] = password_hash($datos['password'], PASSWORD_BCRYPT, $opciones);
 
        $app = App::getSingleton();
        $rol = $app->rolUsuario();
        $email = $app->emailUsuario();
        $datos['email'] = $email;

        switch ($rol) {
            case 'Admin': {$result = Administrador::update($datos);break;}
            case 'Estudiante': {$result = Estudiante::update($datos);break;}
            case 'Empresa': {$result = Empresa::update($datos);break;}
            default:    $result='Hubo un problema con el envío. Envíe el formulario de nuevo';
        }

        $result = \es\ucm\aw\internprise\Aplicacion::getSingleton()->resuelve('/dashboard.php');

        return $result;
    }
}