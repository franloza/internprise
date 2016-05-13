<?php


namespace es\ucm\aw\internprise;


class Administrador extends Usuario
{
    /*Atributos*/
    private $nombre;
    private $apellidos;
    private $nombre_universidad;
    private $sexo;
    private $direccion;
    private $cp;
    private $localidad;
    private $provincia;
    private $pais;
    private $web;
    private $telefono;

    public function __construct($datos) {
        parent::__construct(null, $datos['email'],$datos['password']);
        parent::setRol("Admin");
        $this->nombre = $datos['nombre'];
        $this->apellidos = $datos['apellidos'];
        $this->nombre_universidad = $datos['nombre_universidad'];
        $this->sexo = $datos['sexo'];
        $this->direccion = $datos['direccion'];
        $this->cp = $datos['cp'];
        $this->localidad = $datos['localidad'];
        $this->provincia = $datos['provincia'];
        $this->pais = $datos['pais'];
        $this->web = $datos['web'];
        $this->telefono = $datos['telefono'];
    }

    
    public static function register($datos) {
        $datos = self::sanitizeData($datos);
        $result = self::validateData($datos);
        if(!is_array($result)) {
            //Los datos son correctos y han sido sanitizados
            $result = UsuarioDAO::registerAdministrador($user);
        }
        return $result;
    }

    private static function validateData ($datos) {

        /*Comprobar usuario y contraseña*/
        $result = parent::validateUsuario($datos);
        if(is_array($result)){
            //Error en la validación del usuario o la contraseña
            return $result;

        }

        /*Comprobar campos obligatorios*/
        if( (!isset($datos['nombre'])) || (!isset($datos['apellidos'])) ||  (!isset($datos['nombre_universidad']))
            ||  (!isset($datos['sexo'])) ||  (!isset($datos['direccion'])) ||  (!isset($datos['cp'])) ||  (!isset($datos['localidad']))
            ||  (!isset($datos['provincia'])) ||  (!isset($datos['pais'])) ) {
            $result[] = 'No se ha introducido un campo obligatorio';
            return $result;
        }

        return true;
    }

    private static function sanitizeData ($datos) {
        $sanitizedData = [];
        $sanitizedData['email'] = isset($datos['email']) ? filter_var($datos['email'], FILTER_SANITIZE_EMAIL) : null;
        $sanitizedData['password'] = isset($datos['password']) ? filter_var($datos['password'], FILTER_SANITIZE_STRING) : null;
        $sanitizedData['nombre'] = isset($datos['nombre']) ? filter_var($datos['nombre'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['apellidos'] = isset($datos['apellidos']) ? filter_var($datos['apellidos'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['nombre_universidad'] = isset($datos['nombre_universidad']) ? filter_var($datos['nombre_universidad'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['sexo'] = isset($datos['sexo']) ? filter_var($datos['sexo'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['direccion'] = isset($datos['direccion']) ? filter_var($datos['direccion'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['cp'] = isset($datos['cp']) ? filter_var($datos['cp'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['localidad'] = isset($datos['localidad']) ? filter_var($datos['localidad'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['provincia'] = isset($datos['provincia']) ? filter_var($datos['provincia'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['pais'] = isset($datos['pais']) ? filter_var($datos['pais'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['web'] = isset($datos['web']) ? filter_var($datos['web'], FILTER_SANITIZE_URL) : null ;
        $sanitizedData['telefono'] = isset($datos['telefono']) ? filter_var($datos['telefono'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['rol'] = 'Admin';
        return $sanitizedData;
    }

    
}