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
    private $descripcion;

    public function __construct($datos) {
        parent::__construct($datos['id_usuario'], $datos['email'],$datos['password']);
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
        $this->descripcion = $datos['descripcion'];
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

    public static function update($datos)
    {
        $datos = self::sanitizeData($datos);
        $result = self::validateData($datos);
        if(!is_array($result)) {
            //Los datos son correctos y han sido sanitizados
            $result = UsuarioDAO::updateEmpresa($datos);
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
        if((!isset($datos['cif']))|| (!isset($datos['razonSocial']))  ||  (!isset($datos['direccion'])) ||  (!isset($datos['cp'])) ||  (!isset($datos['localidad']))
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
        $sanitizedData['razonSocial'] = isset($datos['razonSocial']) ? filter_var($datos['razonSocial'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['direccion'] = isset($datos['direccion']) ? filter_var($datos['direccion'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['cp'] = isset($datos['cp']) ? intval($datos['cp']) : null ;
        $sanitizedData['localidad'] = isset($datos['localidad']) ? filter_var($datos['localidad'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['provincia'] = isset($datos['provincia']) ? filter_var($datos['provincia'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['pais'] = isset($datos['pais']) ? filter_var($datos['pais'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['web'] = isset($datos['web']) ? filter_var($datos['web'], FILTER_SANITIZE_URL) : null ;
        $sanitizedData['telefono'] = isset($datos['telefono']) ? filter_var($datos['telefono'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['descripcion'] = isset($datos['descripcion']) ? filter_var($datos['descripcion'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['rol'] = 'Empresa';
        return $sanitizedData;
    }

    /**
     * @return mixed
     */
    public function getCif()
    {
        return $this->cif;
    }

    /**
     * @return mixed
     */
    public function getRazonSocial()
    {
        return $this->razon_social;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @return mixed
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * @return mixed
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @return mixed
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @return mixed
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
}