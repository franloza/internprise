<?php


namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class OfertaDAO
{

    /**
     * Función que carga todas las ofertas de la BBDD
     * */
    public static function cargaTodasOfertas()
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT o.*,em.razon_social as empresa
                          FROM internprise.ofertas o 
                          INNER JOIN internprise.empresas em ON o.id_empresa = em.id_usuario");
        $rs = $conn->query($query);
        if ($rs) {
            $ofertas =  array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($ofertas,self::createOferta($fila));
            }
            $rs->free();
            return $ofertas;
        }
        return false;
    }

    /**
     * Función que permite filtrar las ofertas por grado
     * */
    public static function cargaOfertasPorGrado($grado)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT DISTINCT o.*,em.razon_social as empresa FROM internprise.grados_ofertas go
                          INNER JOIN internprise.empresas em ON o.id_empresa = em.id_usuario
                          INNER JOIN internprise.ofertas o ON o.id_oferta = go.id_oferta
                          INNER JOIN internprise.grados g ON g.id_grado= go.id_grado
                          WHERE  g.nombre_grado LIKE '%s'", $conn->real_escape_string($grado));
        $rs = $conn->query($query);
        if ($rs) {
            $ofertas = array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($ofertas,self::createOferta($fila)) ;
            }
            $rs->free();
            return $ofertas;
        }
        return false;
    }

    /**
     * Función que recupera el número de últimas ofertas aceptadas indicado
     */
    public static function cargaUltimasOfertas($numOfertas)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT o.*,em.razon_social as empresa FROM internprise.ofertas o
        INNER JOIN internprise.empresas em ON o.id_empresa = em.id_usuario
        ORDER BY fecha_creacion DESC LIMIT $numOfertas");
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


    /**
     * Función que recupera el número de últimas ofertas aceptadas indicado dirigidas al grado del Estudiante
     */
    public static function cargaUltimasOfertasEstudiante($numOfertas)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $id_usuario = $app->idUsuario();
        $query = sprintf("SELECT o.*,em.razon_social as empresa FROM internprise.ofertas o
                          INNER JOIN internprise.grados_ofertas go ON o.id_oferta = go.id_oferta
                          INNER JOIN internprise.empresas em ON o.id_empresa = em.id_usuario
                          INNER JOIN internprise.estudiantes e ON e.id_grado = go.id_grado
                          WHERE id_usuario = $id_usuario 
                          ORDER BY fecha_creacion DESC LIMIT $numOfertas");
        $rs = $conn->query($query);
        if ($rs) {
            $ofertas = array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($ofertas,self::createOferta($fila));
            }
            $rs->free();
            return $ofertas;
        }
        return false;
    }

    /**
     * Función que recupera las ofertas activas de una empresa
     */

    public static function cargaOfertasPorEstado($numOfertas, $estado){
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $id_usuario = $app->idUsuario();
        $query = sprintf("SELECT o.*,em.razon_social as empresa FROM internprise.ofertas o
                          INNER JOIN internprise.grados_ofertas go ON o.id_oferta = go.id_oferta
                          INNER JOIN internprise.empresas em ON o.id_empresa = em.id_usuario
                          WHERE id_usuario = $id_usuario AND estado = $estado
                          ORDER BY fecha_creacion DESC LIMIT $numOfertas");
        $rs = $conn->query($query);
        if ($rs) {
            $ofertas = array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($ofertas,self::createOferta($fila));
            }
            $rs->free();
            return $ofertas;
        }
        return false;
    }

    private static function createOferta($fila) {
        $idOferta = $fila['id_oferta'];
        $empresa = $fila['empresa'];
        $oferta = new Oferta($idOferta,$empresa);
        $oferta->setEstado($fila['estado']);
        $oferta->setFechaFin($fila['fecha_fin']);
        $oferta->setFechaIncio($fila['fecha_incio']);
        $oferta->setPlazas($fila['plazas']);
        $oferta->setEstado($fila['estado']);
        $oferta->setPuesto($fila['puesto']);
        $oferta->setHoras($fila['horas']);
        $oferta->setSueldo($fila['sueldo']);
        $oferta->setDescripcion($fila['descripcion']);
        $oferta->setDiasDesdeCreacion($fila['fecha_creacion']);
        return $oferta;
    }



}