<?php

namespace es\ucm\aw\internprise;
use DateTime;

class Estudiante extends Usuario
{
    /*Atributos*/

    /*INFORMACIÓN PERSONAL*/
    private $dni;
    private $nombre;
    private $apellidos;
    private $grado;
    private $nombre_universidad;
    private $sexo;
    private $nacionalidad;
    private $direccion;
    private $fecha_nacimiento;
    private $cp;
    private $localidad;
    private $provincia;
    private $pais;
    private $telefono_fijo;
    private $telefono_movil;

    /*PERFIL*/
    private $web;
    private $descripcion;
    private $localizacion;
    private $experiencia;
    private $estudios;
    private $idiomas;
    private $cursos;
    private $redesSociales;
    private $avatar;

    private $aptitudes;


    public function __construct($datos) {
        parent::__construct($datos['id_usuario'], $datos['email'],$datos['password']);
        parent::setRol("Estudiante");
        $this->dni = $datos['dni'];
        $this->nombre = $datos['nombre'];
        $this->apellidos = $datos['apellidos'];
        $this->grado = $datos['nombre_grado'];
        $this->nombre_universidad = $datos['nombre_universidad'];
        $this->sexo = $datos['sexo'];
        $this->nacionalidad = $datos['nacionalidad'];
        $this->direccion = $datos['direccion'];
        $this->cp = $datos['cp'];
        $this->fecha_nacimiento = $datos['fecha_nacimiento'];
        $this->localidad = $datos['localidad'];
        $this->provincia = $datos['provincia'];
        $this->pais = $datos['pais'];
        $this->web = $datos['web'];
        $this->telefono_fijo = $datos['telefono_fijo'];
        $this->telefono_movil = $datos['telefono_movil'];
        $this->descripcion = $datos['descripción'];
        $this->localizacion = $datos['localización'];
        $this->experiencia = array(
            array($datos['experiencia_puesto_1'],$datos['experiencia_duracion_1']),
            array(   $datos['experiencia_puesto_2'],$datos['experiencia_duracion_2']),
            array(  $datos['experiencia_puesto_3'],$datos['experiencia_duracion_3']),
            );
        $this->estudios = array(
            array($datos['estudios_titulo_1'],$datos['estudios_centro_1']),
            array(   $datos['estudios_titulo_2'],$datos['estudios_centro_2']),
            array(  $datos['estudios_titulo_3'],$datos['estudios_centro_3']),
        );
        $this->idiomas = array(
            array($datos['idiomas_idioma_1'],$datos['idiomas_nivel_1']),
            array(   $datos['idiomas_idioma_2'],$datos['idiomas_nivel_2']),
            array(  $datos['idiomas_idioma_3'],$datos['idiomas_nivel_3']),
        );
        $this->cursos = array(
            array($datos['cursos_titulo_1'],$datos['cursos_horas_1']),
            array(   $datos['cursos_titulo_2'],$datos['cursos_horas_2']),
            array(  $datos['cursos_titulo_3'],$datos['cursos_horas_3']),
        );
        $this->redesSociales = array(
            $datos['skype'],
            $datos['google_plus'],
            $datos['linkedin'],
            $datos['twitter'],
        );
        $this->avatar = $datos['avatar'];

    }


    public static function register($datos) {
        $datos = self::sanitizeData($datos);
        $result = self::validateData($datos);
        if(!is_array($result)) {
            //Los datos son correctos y han sido sanitizados
            $result = UsuarioDAO::registerEstudiante($datos);
        }
        return $result;
    }

    public static function update($datos)
    {
        $datos = self::sanitizeData($datos);
        $result = self::validateDataUpdate($datos);
        if(!is_array($result)) {
            //Los datos son correctos y han sido sanitizados
            $result = UsuarioDAO::updateEstudiante($datos);
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
        if( (!isset($datos['dni'])) || (!isset($datos['nombre'])) || (!isset($datos['apellidos'])) || (!isset($datos['grado'])) ||
            (!isset($datos['nombre_universidad']))||  (!isset($datos['sexo'])) ||  (!isset($datos['direccion']))
            || (!isset($datos['cp']))
            ||  (!isset($datos['fecha_nacimiento'])) ||  (!isset($datos['localidad']))
            ||  (!isset($datos['provincia'])) ||  (!isset($datos['pais'])) ) {
            $result = array();
            $result[] = 'No se ha introducido un campo obligatorio';
            return $result;
        }

        /*Comprobar fecha de nacimiento*/

        $fechaNacimiento = date_format (new DateTime($datos['fecha_nacimiento']),'Y-m-d');
        if(!$fechaNacimiento) {
            $result[] = 'La fecha de nacimiento introducida no es válida';
            return $result;
        } else {
            $datos['fecha_nacimiento'] = $fechaNacimiento;
        }
        return true;
    }

    private static function validateDataUpdate ($datos) {


        /*Comprobar campos obligatorios*/
        if( ( empty(trim(($datos['dni'])))) || ( empty(trim(($datos['nombre'])))) || ( empty(trim(($datos['apellidos'])))) || ( empty(trim(($datos['grado'])))) ||
            ( empty(trim(($datos['nombre_universidad']))))|| ( empty(trim(($datos['nacionalidad'])))) ||  ( empty(trim(($datos['sexo'])))) ||  ( empty(trim(($datos['direccion']))))
            || ( empty(trim(($datos['cp']))))||  ( empty(trim(($datos['fecha_nacimiento'])))) ||  ( empty(trim(($datos['localidad']))))
            ||  ( empty(trim(($datos['provincia'])))) ||  ( empty(trim(($datos['pais']))))) {
            $result = array();
            $result[] = 'No se ha introducido un campo obligatorio';
            return $result;
        }

        /*Comprobar fecha de nacimiento*/

        $fechaNacimiento = date_format (new DateTime($datos['fecha_nacimiento']),'Y-m-d');
        if(!$fechaNacimiento) {
            $result[] = 'La fecha de nacimiento introducida no es válida';
            return $result;
        } else {
            $datos['fecha_nacimiento'] = $fechaNacimiento;
        }
        return true;
    }

    private static function sanitizeData ($datos) {
        /*INFORMACIÓN PERSONAL*/
        $sanitizedData = [];
        $sanitizedData['email'] = isset($datos['email']) ? filter_var($datos['email'], FILTER_SANITIZE_EMAIL) : null;
        $sanitizedData['password'] = isset($datos['password']) ? filter_var($datos['password'], FILTER_SANITIZE_STRING) : null;
        $sanitizedData['dni'] = isset($datos['dni']) ? str_replace(' ', '', filter_var($datos['dni'], FILTER_SANITIZE_STRING)) : null ;
        $sanitizedData['nombre'] = isset($datos['nombre']) ? filter_var($datos['nombre'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['apellidos'] = isset($datos['apellidos']) ? filter_var($datos['apellidos'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['grado'] = isset($datos['grado']) ? filter_var($datos['grado'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['nombre_universidad'] = isset($datos['nombre_universidad']) ? filter_var($datos['nombre_universidad'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['sexo'] = isset($datos['sexo']) ? filter_var($datos['sexo'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['nacionalidad'] = isset($datos['nacionalidad']) ? filter_var($datos['nacionalidad'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['direccion'] = isset($datos['direccion']) ? filter_var($datos['direccion'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['cp'] = isset($datos['cp']) ? filter_var($datos['cp'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['fecha_nacimiento'] = isset($datos['fecha_nacimiento']) ? filter_var($datos['fecha_nacimiento'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['localidad'] = isset($datos['localidad']) ? filter_var($datos['localidad'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['provincia'] = isset($datos['provincia']) ? filter_var($datos['provincia'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['pais'] = isset($datos['pais']) ? filter_var($datos['pais'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['telefono_fijo'] = isset($datos['telefono_fijo']) ? filter_var($datos['telefono_fijo'], FILTER_SANITIZE_STRING) : null;
        $sanitizedData['telefono_movil'] = isset($datos['telefono_movil']) ? filter_var($datos['telefono_movil'], FILTER_SANITIZE_STRING) : null;

        /*PERFIL*/
        $sanitizedData['web'] = isset($datos['web']) ? filter_var($datos['web'], FILTER_SANITIZE_URL) : null ;
        $sanitizedData['descripción'] = isset($datos['descripcion']) ? filter_var($datos['descripcion'], FILTER_SANITIZE_STRING) : null;
        $sanitizedData['localización'] = isset($datos['localizacion']) ? filter_var($datos['localizacion'], FILTER_SANITIZE_STRING) : null;
        for ($x = 1; $x < 4; $x++) {
            $sanitizedData['experiencia_puesto_'.$x] = isset($datos['experiencia_puesto_'.$x]) ? filter_var($datos['experiencia_puesto_'.$x], FILTER_SANITIZE_STRING) : null;
            $sanitizedData['experiencia_duracion_'.$x] = isset($datos['experiencia_duracion_'.$x]) ? intval($datos['experiencia_duracion_'.$x]) : null;
            $sanitizedData['estudios_titulo_'.$x] = isset($datos['estudios_titulo_'.$x]) ? filter_var($datos['estudios_titulo_'.$x], FILTER_SANITIZE_STRING) : null;
            $sanitizedData['estudios_centro_'.$x] = isset($datos['estudios_centro_'.$x]) ? filter_var($datos['estudios_centro_'.$x], FILTER_SANITIZE_STRING) : null;
            $sanitizedData['idiomas_idioma_'.$x] = isset($datos['idiomas_idioma_'.$x]) ? filter_var($datos['idiomas_idioma_'.$x], FILTER_SANITIZE_STRING) : null;
            $sanitizedData['idiomas_nivel_'.$x] = isset($datos['idiomas_nivel_'.$x]) ? filter_var($datos['idiomas_nivel_'.$x], FILTER_SANITIZE_STRING) : null;
            $sanitizedData['cursos_titulo_'.$x] = isset($datos['cursos_titulo_'.$x]) ? filter_var($datos['cursos_titulo_'.$x], FILTER_SANITIZE_STRING) : null;
            $sanitizedData['cursos_horas_'.$x] = isset($datos['cursos_horas_'.$x]) ? intval($datos['cursos_horas_'.$x]) : null;
        }
        $sanitizedData['skype'] = isset($datos['skype']) ? filter_var($datos['skype'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['google_plus'] = isset($datos['google_plus']) ? filter_var($datos['google_plus'], FILTER_SANITIZE_URL) : null ;
        $sanitizedData['linkedin'] = isset($datos['linkedin']) ? filter_var($datos['linkedin'], FILTER_SANITIZE_URL) : null ;
        $sanitizedData['twitter'] = isset($datos['twitter']) ? filter_var($datos['twitter'], FILTER_SANITIZE_STRING) : null ;

        $sanitizedData['aptitudes'] = array();
        foreach ($datos['aptitudes'] as $aptitud) {
            if(!empty(trim($aptitud))) {
                array_push($sanitizedData['aptitudes'], isset($aptitud) ? filter_var($aptitud, FILTER_SANITIZE_STRING) : null);
            }
        }

        //TODO: Avatar

        $sanitizedData['rol'] = 'Estudiante';

        return $sanitizedData;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @return mixed
     */
    public function getGrado()
    {
        return $this->grado;
    }

    /**
     * @return mixed
     */
    public function getNombreUniversidad()
    {
        return $this->nombre_universidad;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @return mixed
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
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
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
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
    public function getPais()
    {
        return $this->pais;
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
    public function getTelefonoFijo()
    {
        return $this->telefono_fijo;
    }

    /**
     * @return mixed
     */
    public function getTelefonoMovil()
    {
        return $this->telefono_movil;
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
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @return mixed
     */
    public function getLocalizacion()
    {
        return $this->localizacion;
    }

    /**
     * @return array
     */
    public function getExperiencia()
    {
        return $this->experiencia;
    }

    /**
     * @return array
     */
    public function getEstudios()
    {
        return $this->estudios;
    }

    /**
     * @return array
     */
    public function getIdiomas()
    {
        return $this->idiomas;
    }

    /**
     * @return array
     */
    public function getCursos()
    {
        return $this->cursos;
    }

    /**
     * @return array
     */
    public function getRedesSociales()
    {
        return $this->redesSociales;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @return mixed
     */
    public function getAptitudes()
    {
        return $this->aptitudes;
    }

    public function setAptitudes($aptitudes)
    {
        $this->aptitudes = $aptitudes;
    }

}