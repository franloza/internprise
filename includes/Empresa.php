<?php


namespace es\ucm\aw\internprise;
use DateTime;

class Empresa extends Usuario
{

    /*Atributos*/
    private $cif;
    private $razon_social;
    private $direccion;
    private $localidad;
    private $provincia;
    private $cp;
    private $pais;
    private $telefono;
    private $web;

    public function __construct($datos) {
        parent::__construct(null, $datos['email'],$datos['password']);
        parent::setRol("Empresa");
        $this->cif = $datos['cif'];
        $this->razon_social = $datos['razon_social'];
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
            $result = UsuarioDAO::registerEmpresa($datos);
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
        if((!isset($datos['cif']))|| (!isset($datos['razon_social']))  ||  (!isset($datos['direccion'])) ||  (!isset($datos['cp'])) ||  (!isset($datos['localidad']))
            ||  (!isset($datos['provincia'])) ||  (!isset($datos['pais'])) ) {
            $result = array();
            $result[] = 'No se ha introducido un campo obligatorio';
            return $result;
        }

        return true;
    }

    private static function sanitizeData ($datos) {
        $sanitizedData = [];
        $sanitizedData['email'] = isset($datos['email']) ? filter_var($datos['email'], FILTER_SANITIZE_EMAIL) : null;
        $sanitizedData['password'] = isset($datos['password']) ? filter_var($datos['password'], FILTER_SANITIZE_STRING) : null;
        $sanitizedData['cif'] = isset($datos['cif']) ? str_replace(' ', '', filter_var($datos['cif'], FILTER_SANITIZE_STRING)) : null ;
        $sanitizedData['razon_social'] = isset($datos['razon_social']) ? filter_var($datos['razon_social'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['direccion'] = isset($datos['direccion']) ? filter_var($datos['direccion'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['cp'] = isset($datos['cp']) ? intval($datos['cp']) : null ;
        $sanitizedData['localidad'] = isset($datos['localidad']) ? filter_var($datos['localidad'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['provincia'] = isset($datos['provincia']) ? filter_var($datos['provincia'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['pais'] = isset($datos['pais']) ? filter_var($datos['pais'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['web'] = isset($datos['web']) ? filter_var($datos['web'], FILTER_SANITIZE_URL) : null ;
        $sanitizedData['telefono'] = isset($datos['telefono']) ? filter_var($datos['telefono'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['rol'] = 'Empresa';
        return $sanitizedData;
    }


    
}