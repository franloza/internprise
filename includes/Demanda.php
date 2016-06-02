<?php

namespace es\ucm\aw\internprise;


class Demanda
{
    /**
     * Atributos
     */
    private $id_demanda;
    private $id_estudiante;
    private $id_oferta;
    private $nombre_estudiante;
    private $puesto;
    private $estado;
    private $comentarios;
    private $fecha_solicitud;

    /**
     * Demanda constructor.
     * @param $id_demanda
     * @param $id_estudiante
     * @param $id_oferta
     */
    public function __construct($id_demanda, $id_estudiante, $id_oferta)
    {
        $this->id_demanda = $id_demanda;
        $this->id_estudiante = $id_estudiante;
        $this->id_oferta = $id_oferta;
    }
    
    /**
     * @return mixed
     */
    public function getIdDemanda()
    {
        return $this->id_demanda;
    }

    /**
     * @param mixed $id_demanda
     */
    public function setIdDemanda($id_demanda)
    {
        $this->id_demanda = $id_demanda;
    }

    /**
     * @return mixed
     */
    public function getIdEstudiante()
    {
        return $this->id_estudiante;
    }

    /**
     * @param mixed $id_estudiante
     */
    public function setIdEstudiante($id_estudiante)
    {
        $this->id_estudiante = $id_estudiante;
    }

    /**
     * @return mixed
     */
    public function getIdOferta()
    {
        return $this->id_oferta;
    }

    /**
     * @param mixed $id_oferta
     */
    public function setIdOferta($id_oferta)
    {
        $this->id_oferta = $id_oferta;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * @param mixed $comentarios
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;
    }

    /**
     * @return mixed
     */
    public function getNombreEstudiante()
    {
        return $this->nombre_estudiante;
    }

    /**
     * @param mixed $nombre_estudiante
     */
    public function setNombreEstudiante($nombre_estudiante)
    {
        $this->nombre_estudiante = $nombre_estudiante;
    }

    /**
     * @return mixed
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * @param mixed $puesto
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;
    }

    /**
     * @return mixed
     */
    public function getFechaSolicitud()
    {
        return $this->fecha_solicitud;
    }

    /**
     * @param mixed $fecha_solicitud
     */
    public function setFechaSolicitud($fecha_solicitud)
    {
        $this->fecha_solicitud = $fecha_solicitud;
    }

}