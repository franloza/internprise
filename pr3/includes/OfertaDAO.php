<?php


namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class OfertaDAO
{

    public static function cargaTodasOfertas()
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM internprise.ofertas");
        $rs = $conn->query($query);
        if ($rs) {
            $ofertas = array();
            while ($fila = $rs->fetch_assoc()) {
                $ofertas.array_push($ofertas,self::createOferta($fila)) ;
            }
            $rs->free();
            return $ofertas;
        }
        return false;
    }

    public static function cargaOfertasPorGrado($grado)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT DISTINCT o.* FROM internprise.grados_ofertas go
                          INNER JOIN internprise.ofertas o ON o.id_oferta = go.id_oferta
                          INNER JOIN internprise.grados g ON g.id_grado= go.id_grado
                          WHERE  g.nombre_grado LIKE '%s'", $conn->real_escape_string($grado));
        $rs = $conn->query($query);
        if ($rs) {
            $ofertas = array();
            while ($fila = $rs->fetch_assoc()) {
                $ofertas.array_push($ofertas,self::createOferta($fila)) ;
            }
            $rs->free();
            return $ofertas;
        }
        return false;
    }

    private static function createOferta($fila) {
        $idOferta = $fila['id_oferta'];
        $idEmpresa = $fila['id_empresa'];
        $oferta = new Oferta($idOferta,$idEmpresa);
        $oferta->setEstado($fila['estado']);
        $oferta->setFechaFin($fila['fecha_fin']);
        $oferta->setFechaIncio($fila['fecha_incio']);
        $oferta->setPlazas($fila['plazas']);
        $oferta->setEstado($fila['estado']);
        $oferta->setHoras($fila['horas']);
        $oferta->setSueldo($fila['sueldo']);
        $oferta->setDescripcion($fila['descripcion']);
        return $oferta;
    }



}