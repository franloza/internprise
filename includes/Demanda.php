<?php

namespace es\ucm\aw\internprise;


class Demanda
{
    /**
     * Atributos
     */
    private $id_demanda;
    private $oferta;
    private $estudiante;
    private $estado; /*Aceptada, Rechazada, Pendiente de Universidad, Pendiente de Empresa,Rechazada por Universidad, Rechazada por Empresa*/
    private $comentarios;
    private $diasDesdeCreacion;

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
    public function getOferta()
    {
        return $this->oferta;
    }

    /**
     * @param mixed $oferta
     */
    public function setOferta($oferta)
    {
        $this->oferta = $oferta;
    }

    /**
     * @return mixed
     */
    public function getEstudiante()
    {
        return $this->estudiante;
    }

    /**
     * @param mixed $estudiante
     */
    public function setEstudiante($estudiante)
    {
        $this->estudiante = $estudiante;
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
    public function getDiasDesdeCreacion()
    {
        return $this->diasDesdeCreacion;
    }

    /**
     * @param mixed $fecha_solicitud
     */
    public function setDiasDesdeCreacion($fechaCreacion)
    {
        $date = date('d', strtotime($fechaCreacion));
        $now = date('d',time());
        $datediff = $now - $date;
        $this->diasDesdeCreacion = $datediff;
    }

    /**
     * Demanda constructor.
     * @param $id_demanda
     * @param $id_estudiante
     * @param $id_oferta
     */
    public function __construct($id_demanda)
    {
        $this->id_demanda = $id_demanda;
    }
    

    
}