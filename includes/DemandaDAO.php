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

    /*FUNCIONES PARA ESTUDIANTE*/
    public static function cargaDemandasEstudiante($idEstudiante)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM demandas d WHERE id_estudiante = '%d' ORDER BY d.fecha_solicitud DESC",intval($idEstudiante));
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

    /*FUNCIONES PARA EMPRESA*/
    /*
     * Función que carga todas últimas demandas clasificadas (Aceptadas o rechazadas) de una empresa.
     * Permite filtrar por grado. (Por defecto: TODOS)
     * Ordena por fecha de creación (Por defecto: 20)
     */
    public static function cargaDemandasClasificadasEmpresa($numDemandas,$id_empresa)
    {
        $numDemandas = isset($numDemandas)? intval($numDemandas) : 20;

        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT d.* 
                          FROM demandas d
                          INNER JOIN ofertas o ON d.id_oferta = o.id_oferta WHERE d.estado NOT LIKE('Pendiente de Empresa')
                          AND o.id_empresa = '%d'
                          ORDER BY d.fecha_solicitud DESC LIMIT $numDemandas",intval($id_empresa));
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
     * Función que carga todas últimas demandas clasificadas (Aceptadas o rechazadas) de una empresa.
     * Permite filtrar por grado. (Por defecto: TODOS)
     * Ordena por fecha de creación (Por defecto: 20)
     */
    public static function cargaDemandasNoClasificadasEmpresa($numDemandas,$id_empresa)
    {
        $numDemandas = isset($numDemandas)? intval($numDemandas) : 20;

        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT d.* 
                          FROM demandas d
                          INNER JOIN ofertas o ON d.id_oferta = o.id_oferta WHERE d.estado LIKE('Pendiente de Empresa')
                          AND o.id_empresa = '%d'
                          ORDER BY d.fecha_solicitud DESC LIMIT $numDemandas",intval($id_empresa));
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

    /*FUNCIONES PARA ADMINISTRADOR*/

    /*
     * Función que carga todas últimas demandas clasificadas (Aceptadas o rechazadas) de la BBDD.
     * Permite filtrar por grado. (Por defecto: TODOS)
     * Ordena por fecha de creación (Por defecto: 20)
     */
    public static function cargaDemandasClasificadas($numDemandas,$grado)
    {
        $numDemandas = isset($numDemandas)? intval($numDemandas) : 20;
        $whereGrado = isset($grado)? 'WHERE nombre_grado LIKE $grado AND ' : 'WHERE ';

        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT d.* 
                          FROM demandas d
                          INNER JOIN ofertas o ON d.id_oferta = o.id_oferta $whereGrado d.estado NOT LIKE('Pendiente de Universidad');
                          ORDER BY d.fecha_solicitud DESC LIMIT $numDemandas");
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
        $numDemandas = isset($numDemandas)? intval($numDemandas) : 20;
        $whereGrado = isset($grado)? 'WHERE nombre_grado LIKE $grado AND ' : 'WHERE ';

        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT d.* 
                          FROM demandas d
                          INNER JOIN ofertas o ON d.id_oferta = o.id_oferta $whereGrado d.estado LIKE('Pendiente de Universidad')
                          ORDER BY d.fecha_solicitud DESC LIMIT $numDemandas");
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

    public static function creaDemanda($id_oferta,$id_estudiante){
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $estado = 'Pendiente de Universidad';

        //Comprobar que el estudiante tiene disponible esa oferta
        $ofertas = OfertaDAO::cargasOfertasEstudiante($id_estudiante);
        $ok = false;
        foreach($ofertas as $oferta) {
            if($id_oferta == $oferta->getIdOferta()) {
                $ok = true;
                break;
            }
        }
        if(!$ok){
            $result [] = "El estudiante no tiene disponible esa oferta";
            return $result;
        }

        //Comprobar que el estudiante tiene disponible esa oferta
        $demandas = self::cargaDemandasEstudiante($id_estudiante);
        if($ok) {
            foreach ($demandas as $demanda) {
                if ($id_oferta == $demanda->getOferta()->getIdOferta()) {
                    $result [] = "El estudiante ya ha seleccionado esa oferta anteriormente";
                    return $result;
                }
            }
        }



        //Comprobar que el estudiante no ha solicitado ya esa oferta

        $stmt = $conn->prepare('INSERT INTO demandas (id_oferta,id_estudiante,estado) VALUES (?,?,?)');
        $stmt->bind_param("iis", intval($id_oferta), intval($id_estudiante), $estado);

        if (!$stmt->execute()) {
            $result [] = $stmt->error;
            return $result;
        }

        return true;
    }

    private static function constructDemanda($fila) {
        $id_demanda = $fila['id_demanda'];
        $estudiante = UsuarioDAO::cargaEstudiante($fila['id_estudiante']);
        $oferta =  OfertaDAO::cargaOferta($fila['id_oferta']);
        $demanda = new Demanda($id_demanda);
        $demanda->setEstudiante($estudiante);
        $demanda->setOferta($oferta);
        $demanda->setEstado($fila['estado']);
        $demanda->setComentarios($fila['comentarios']);
        $demanda->setFechaSolicitud($fila['fecha_solicitud']);
        return $demanda;
    }
    
}