<?php

namespace es\ucm\aw\internprise;


class Oferta
{
    /**
     * Atributos
     */
    private $id_oferta;
    private $id_empresa;
    private $puesto;
    private $sueldo;
    private $fecha_incio;
    private $fecha_fin;
    private $horas;
    private $plazas;
    private $descripcion;
    private $estado;
    private $diasDesdeCreacion;


    /**
     * Constructor.
     */
    public function __construct($id_oferta,$id_empresa)
    {
        $this->id_oferta = $id_oferta;
        $this->id_empresa = $id_empresa;
    }

    /**
     * Getters & Setters
     */
    public function getIdOferta()
    {
        return $this->id_oferta;
    }

    public function getIdEmpresa()
    {
        return $this->id_empresa;
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

    public function getFechaIncio()
    {
        return $this->fecha_incio;
    }

    public function setFechaIncio($fecha_incio)
    {
        $this->fecha_incio = $fecha_incio;
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
        $date = date('M j Y g:i A', strtotime($fechaCreacion));
        $now = time();
        $datediff = $now - $date;
        $this->diasDesdeCreacion = floor($datediff/(60*60*24));
    }
}