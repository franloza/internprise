<?php
/**
 * Created by IntelliJ IDEA.
 * User: Fran Lozano
 * Date: 31/05/2016
 * Time: 17:45
 */

namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class DemandaDAO
{
    /*FUNCIONES PARA ADMINISTRADOR*/

    /*
     * Función que carga todas últimas demandas clasificadas (Aceptadas o rechazadas) de la BBDD.
     * Permite filtrar por grado. (Por defecto: TODOS)
     * Ordena por fecha de creación (Por defecto: 20)
     */
    public static function cargaDemandasClasificadas($numDemandas,$grado)
    {
        $numDemandas = isset($numDemandas)? $numDemandas : 20;
        $whereGrado = isset($grado)? 'WHERE nombre_grado LIKE $grado AND ' : 'WHERE ';

        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT DISTINCT d.*, e.nombre + ' ' + e.apellidos as nombre_Estudiante, o.puesto 
                            FROM demandas d
                              INNER JOIN estudiantes e ON d.id_estudiante = e.id_usuario
                              INNER JOIN ofertas o ON d.id_oferta = o.id_oferta $whereGrado estado NOT LIKE('Pendiente de Universidad');
                              ORDER BY d.fecha_creacion DESC LIMIT $numDemandas");
        $rs = $conn->query($query);
        if ($rs) {
            $demandas =  array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($demandas,self::constructDemanda($fila));
            }
            $rs->free();
            return $demandas;
        }
        return false;
    }

    /*
     * Función que carga todas últimas demandas no clasificadas (Aceptadas o rechazadas) de la BBDD.
     * Permite filtrar por grado. (Por defecto: TODOS)
     * Ordena por fecha de creación (Por defecto: 20)
     */
    public static function cargaDemandasNoClasificadas($numDemandas,$grado)
    {
        $numDemandas = isset($numDemandas)? $numDemandas : 20;
        $whereGrado = isset($grado)? 'WHERE nombre_grado LIKE $grado AND ' : 'WHERE ';

        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT DISTINCT d.*, e.nombre + ' ' + e.apellidos as nombre_Estudiante, o.puesto 
                            FROM demandas d
                              INNER JOIN estudiantes e ON d.id_estudiante = e.id_usuario
                              INNER JOIN ofertas o ON d.id_oferta = o.id_oferta $whereGrado estado LIKE 'Pendiente de Universidad'
                              ORDER BY d.fecha_creacion DESC LIMIT $numDemandas");
        $rs = $conn->query($query);
        if ($rs) {
            $demandas =  array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($demandas,self::constructDemanda($fila));
            }
            $rs->free();
            return $demandas;
        }
        return false;
    }

    public static function creaDemanda($datos){
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $id_estudiante = $app->idUsuario();
        $id_oferta  = $datos['id_oferta'];
        $estado = 'Pendiente de Universidad';

        $stmt = $conn->prepare('INSERT INTO ofertas (id_oferta,id_estudiante,estado) VALUES (?,?,?)');
        $stmt->bind_param("iis", $id_estudiante, $id_oferta, $estado);

        if (!$stmt->execute()) {
            $result [] = $stmt->error;
            return $result;
        }
        return true;
    }

    private static function constructDemanda($fila) {
        $id_demanda = $fila['id_demanda'];
        $id_estudiante = $fila['id_estudiante'];
        $id_oferta = $fila['id_oferta'];
        $demanda = new Demanda($id_demanda,$id_estudiante,$id_oferta);
        $demanda->setNombreEstudiante($fila['nombre_estudiante']);
        $demanda->setPuesto($fila['puesto']);
        $demanda->setEstado($fila['estado']);
        $demanda->setComentarios($fila['comentarios']);
        $demanda->setFechaSolicitud($fila['fecha_solicitud']);
        return $demanda;
    }
    
}