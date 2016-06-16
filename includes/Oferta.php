<?php

namespace es\ucm\aw\internprise;


class Oferta
{
    /**
     * Atributos
     */
    private $id_oferta;
    private $empresa;
    private $puesto;
    private $sueldo;
    private $fecha_inicio;
    private $fecha_fin;
    private $horas;
    private $plazas;
    private $descripcion;
    private $aptitudes;
    private $reqMinimos;
    private $idiomas;
    private $reqDeseables;
    private $estado;
    private $diasDesdeCreacion;


    /**
     * Constructor.
     */
    public function __construct($id_oferta,$empresa)
    {
        $this->id_oferta = $id_oferta;
        $this->empresa = $empresa;
    }

    /**
     * Getters & Setters
     */
    public function getIdOferta()
    {
        return $this->id_oferta;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function getPuesto()
    {
        return $this->puesto;
    }

    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;
    }

    public function getSueldo()
    {
        return $this->sueldo;
    }

    public function setSueldo($sueldo)
    {
        $this->sueldo = $sueldo;
    }

    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;
    }

    public function getFechaFin()
    {
        return $this->fecha_fin;
    }

    public function setFechaFin($fecha_fin)
    {
        $this->fecha_fin = $fecha_fin;
    }

    public function getHoras()
    {
        return $this->horas;
    }

    public function setHoras($horas)
    {
        $this->horas = $horas;
    }

    public function getPlazas()
    {
        return $this->plazas;
    }

    public function setPlazas($plazas)
    {
        $this->plazas = $plazas;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getAptitudes()
    {
        return $this->aptitudes;
    }

    public function setAptitudes($aptitudes)
    {
        $this->aptitudes = $aptitudes;
    }

    public function getReqMinimos()
    {
        return $this->reqMinimos;
    }

    public function setReqMinimos($reqMinimos)
    {
        $this->reqMinimos = $reqMinimos;
    }

    public function getIdiomas()
    {
        return $this->idiomas;
    }

    public function setIdiomas($idiomas)
    {
        $this->idiomas = $idiomas;
    }

    public function getReqDeseables()
    {
        return $this->reqDeseables;
    }

    public function setReqDeseables($reqDeseables)
    {
        $this->reqDeseables = $reqDeseables;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getDiasDesdeCreacion()
    {
        return $this->diasDesdeCreacion;
    }

    public function setDiasDesdeCreacion($fechaCreacion)
    {
        $date = date('d', strtotime($fechaCreacion));
        $now = date('d',time());
        $datediff = $now - $date;
        $this->diasDesdeCreacion = $datediff;
    }

    public static function creaOferta($datos){
        $datos = self::sanitizeData($datos);
        $result = self::validateData($datos);
        if(!is_array($result)) {
            //Los datos son correctos y han sido sanitizados
            $result = OfertaDAO::creaOferta($datos);
        }
        return $result;
    }

    private static function validateData ($datos) {

        /*Comprobar campos obligatorios*/
        if( (!isset($datos['puesto'])) || (!isset($datos['sueldo'])) || (!isset($datos['horas'])) || (!isset($datos['plazas'])) ||
            (!isset($datos['fecha_inicio']))||  (!isset($datos['fecha_fin'])) ||  (!isset($datos['descripcion']))) {
            $result[] = 'No se ha introducido un campo obligatorio';
            return $result;
        }
        return true;
    }

    private static function sanitizeData ($datos) {
        $sanitizedData = [];
        $sanitizedData['puesto'] = isset($datos['puesto']) ? filter_var($datos['puesto'], FILTER_SANITIZE_STRING) : null;
        $sanitizedData['sueldo'] = isset($datos['sueldo']) ? filter_var($datos['sueldo'], FILTER_SANITIZE_NUMBER_INT) : null;
        $sanitizedData['horas'] = isset($datos['horas']) ? filter_var($datos['horas'], FILTER_SANITIZE_NUMBER_INT) : null ;
        $sanitizedData['plazas'] = isset($datos['plazas']) ? filter_var($datos['plazas'], FILTER_SANITIZE_NUMBER_INT) : null ;
        $sanitizedData['fecha_inicio'] = isset($datos['fecha_inicio']) ? filter_var($datos['fecha_inicio'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['fecha_fin'] = isset($datos['fecha_fin']) ? filter_var($datos['fecha_fin'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['descripcion'] = isset($datos['descripcion']) ? filter_var($datos['descripcion'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['aptitudes'] = isset($datos['aptitudes']) ? filter_var($datos['aptitudes'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['reqMinimos'] = isset($datos['reqMinimos']) ? filter_var($datos['reqMinimos'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['idiomas'] = isset($datos['idiomas']) ? filter_var($datos['idiomas'], FILTER_SANITIZE_STRING) : null ;
        $sanitizedData['reqDeseables'] = isset($datos['reqDeseables']) ? filter_var($datos['reqDeseables'], FILTER_SANITIZE_STRING) : null ;

        return $sanitizedData;
    }

}