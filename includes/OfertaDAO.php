<?php


namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class OfertaDAO
{
    /*FUNCIONES PARA ADMINISTRADOR*/

    /*
     * Función que carga todas últimas ofertas clasificadas (Aceptadas o rechazadas) de la BBDD.
     * Permite filtrar por grado. (Por defecto: TODOS)
     * Ordena por fecha de creación (Por defecto: 20)
     */
    public static function cargaOfertasClasificadas($numOfertas,$grado)
    {
        $numOfertas = isset($numOfertas)? $numOfertas : 20;
        $whereGrado = isset($grado)? 'WHERE nombre_grado LIKE $grado AND ' : 'WHERE ';

        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT DISTINCT o.*,em.razon_social as empresa
                            FROM ofertas o
                              INNER JOIN empresas em ON o.id_empresa = em.id_usuario
                              INNER JOIN grados_ofertas go ON go.id_oferta = o.id_oferta
                              INNER JOIN grados g ON g.id_grado = go.id_grado $whereGrado estado IN ('Aceptada', 'Rechazada')
                              ORDER BY fecha_creacion DESC LIMIT $numOfertas");
        $rs = $conn->query($query);
        if ($rs) {
            $ofertas =  array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($ofertas,self::constructOferta($fila));
            }
            $rs->free();
            return $ofertas;
        }
        return false;
    }

    /*
     * Función que carga todas las 20 últimas ofertas no clasificadas (Pendientes) de la BBDD.
     * Permite filtrar por grado. (Por defecto: TODOS)
     * Ordena por fecha de creación (Por defecto: 20)
     */
    public static function cargaOfertasNoClasificadas($numOfertas,$grado)
    {

        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $numOfertas = isset($numOfertas)? $numOfertas : 20;
        if (isset($grado)) {
            $whereGrado = sprintf("WHERE nombre_grado LIKE %s AND",$conn->real_escape_string($grado));
        }
        else {$whereGrado="WHERE";}
        $query = sprintf("SELECT DISTINCT o.*,em.razon_social as empresa
                            FROM ofertas o
                              INNER JOIN empresas em ON o.id_empresa = em.id_usuario
                              LEFT JOIN grados_ofertas go ON go.id_oferta = o.id_oferta
                              LEFT JOIN grados g ON g.id_grado = go.id_grado $whereGrado estado LIKE 'Pendiente'
                              ORDER BY fecha_creacion DESC LIMIT $numOfertas");
        $rs = $conn->query($query);
        if ($rs) {
            $ofertas =  array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($ofertas,self::constructOferta($fila));
            }
            $rs->free();
            return $ofertas;
        }
        return false;
    }

    /*Devuelve el numero de ofertas creadas*/
    public static function countOfertasSinClasificar()
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT COUNT(*) AS Total 
                          FROM (SELECT DISTINCT o.*,em.razon_social as empresa 
                          FROM ofertas o INNER JOIN empresas em ON o.id_empresa = em.id_usuario 
                            LEFT JOIN grados_ofertas go ON go.id_oferta = o.id_oferta 
                            LEFT JOIN grados g ON g.id_grado = go.id_grado 
                            WHERE estado LIKE 'Pendiente') 
                          dt");
        $rs = $conn->query($query);
        if ($rs) {
            $numOfertas = 0;
            while ($fila = $rs->fetch_assoc()) {
                $numOfertas = $fila['Total'];
            }
            return $numOfertas;
        }
        return 0;
    }

    /*Devuelve el numero de ofertas creadas en el día actual*/
    public static function countNewOfertas()
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT COUNT(*) AS numOfertas FROM ofertas WHERE DATE(fecha_creacion) = CURDATE()");
        $rs = $conn->query($query);
        if ($rs) {
            $numOfertas = 0;
            while ($fila = $rs->fetch_assoc()) {
                $numOfertas = $fila['numOfertas'];
            }
            return $numOfertas;
        }
        return 0;
    }

    /*Devuelve el numero de ofertas por estudiante*/
    public static function countOfertasEstudiante()
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $id_estudiante = intval($app->idUsuario());
        $query = sprintf("SELECT COUNT(*) AS Total FROM (SELECT o.*,em.razon_social as empresa FROM ofertas o
                          INNER JOIN grados_ofertas go ON o.id_oferta = go.id_oferta
                          INNER JOIN empresas em ON o.id_empresa = em.id_usuario
                          INNER JOIN estudiantes e ON e.id_grado = go.id_grado
                          WHERE e.id_usuario = $id_estudiante AND o.id_oferta NOT IN 
                              (SELECT d.id_oferta FROM demandas d WHERE id_estudiante = $id_estudiante)
                          AND o.estado = 'Aceptada'
                          ) dt");
        $rs = $conn->query($query);
        if ($rs) {
            $numOfertas = 0;
            while ($fila = $rs->fetch_assoc()) {
                $numOfertas = $fila['Total'];
            }
            return $numOfertas;
        }
        return 0;
    }

    /*Devuelve el numero de ofertas por empresa*/
    public static function countOfertasEmpresa()
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $id_empresa = intval($app->idUsuario());
        $query = sprintf("SELECT COUNT(*) AS Total FROM (SELECT o.*,em.razon_social as empresa FROM ofertas o
                          INNER JOIN empresas em ON o.id_empresa = em.id_usuario
                          WHERE id_empresa = $id_empresa) dt");
        $rs = $conn->query($query);
        if ($rs) {
            $numOfertas = 0;
            while ($fila = $rs->fetch_assoc()) {
                $numOfertas = $fila['Total'];
            }
            return $numOfertas;
        }
        return 0;
    }

    /*Clasifica una demanda como aceptada*/
    public static function aceptarOferta($op)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $stmt = $conn->prepare('UPDATE ofertas SET estado="Aceptada" WHERE id_oferta=?');
        $stmt->bind_param("i", intval($op));

        if (!$stmt->execute()) {
            $result [] = "Hubo un error en la operación";
            return $result;
        }
    }

    /*Clasifica una demanda como rechazada*/
    public static function rechazarOferta($op)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $stmt = $conn->prepare('UPDATE ofertas SET estado="Rechazada" WHERE id_oferta=?');
        $stmt->bind_param("i", intval($op));

        if (!$stmt->execute()) {
            $result [] = "Hubo un error en la operación";
            return $result;
        }
    }

    /*FUNCIONES PARA ESTUDIANTE*/

    /*
     * Devuelve las ofertas disponibles para el estudiante que no han sido solicitadas previamente
     * Ordena por fecha de creación (Por defecto: 20)
     */
    public static function cargasOfertasEstudiante($numOfertas)
    {
        $numOfertas = isset($numOfertas)? intval($numOfertas) : 20;

        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $id_usuario = intval($app->idUsuario());
        $query = sprintf("SELECT o.*,em.razon_social as empresa FROM ofertas o
                          INNER JOIN grados_ofertas go ON o.id_oferta = go.id_oferta
                          INNER JOIN empresas em ON o.id_empresa = em.id_usuario
                          INNER JOIN estudiantes e ON e.id_grado = go.id_grado
                          WHERE e.id_usuario = $id_usuario AND o.id_oferta NOT IN 
                              (SELECT d.id_oferta FROM demandas d WHERE id_estudiante = $id_usuario)
                          AND o.estado = 'Aceptada'
                          ORDER BY fecha_creacion DESC LIMIT $numOfertas");
        $rs = $conn->query($query);
        if ($rs) {
            $ofertas = array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($ofertas,self::constructOferta($fila));
            }
            return $ofertas;
        }
        return false;
    }

    /*FUNCIONES PARA EMPRESA*/

    /*
     * Función que recupera el número de ofertas (Aceptadas, rechazadas o pendientes) indicado creadas por la empresa
     * Ordena por fecha de creación (Por defecto: 20)
     */
    public static function cargaOfertasEmpresa($numOfertas)
    {
        $numOfertas = isset($numOfertas)? intval($numOfertas) : 20;

        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $id_empresa = $app->idUsuario();
        $query = sprintf("SELECT o.*,em.razon_social as empresa FROM ofertas o
                          INNER JOIN empresas em ON o.id_empresa = em.id_usuario
                          WHERE id_empresa = $id_empresa
                          ORDER BY fecha_creacion DESC LIMIT $numOfertas");
        $rs = $conn->query($query);
        if ($rs) {
            $ofertas = array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($ofertas,self::constructOferta($fila));
            }
            $rs->free();
            return $ofertas;
        }
        return false;
    }

    /*
     * Función que recupera las ofertas activas de una empresa
     */

    public static function cargaOfertasPorEstado($numOfertas, $estado){
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $id_usuario = $app->idUsuario();
        $numOfertas = isset($numOfertas)? intval($numOfertas) : 20;
        $query = sprintf("SELECT o.*,em.razon_social as empresa FROM ofertas o
                          INNER JOIN grados_ofertas go ON o.id_oferta = go.id_oferta
                          INNER JOIN empresas em ON o.id_empresa = em.id_usuario
                          WHERE id_usuario = $id_usuario AND estado = $estado
                          ORDER BY fecha_creacion DESC LIMIT $numOfertas");
        $rs = $conn->query($query);
        if ($rs) {
            $ofertas = array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($ofertas,self::constructOferta($fila));
            }
            $rs->free();
            return $ofertas;
        }
        return false;
    }

    /*Elimina una oferta de la empresa*/

    public static function eliminarOferta($id_oferta)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();

        //Comprobar que la oferta pertenece a la empresa
        $ofertas = self::cargaOfertasEmpresa(500);
        $ok = false;
        foreach($ofertas as $oferta) {
            if($id_oferta == $oferta->getIdOferta()) {
                $ok = true;
                break;
            }
        }
        if(!$ok){
            $result [] = "La oferta no pertenece a la empresa";
            return $result;
        }

        $stmt = $conn->prepare('DELETE FROM ofertas WHERE id_oferta = ?');
        $stmt->bind_param("i", intval($id_oferta));

        if (!$stmt->execute()) {
            $result [] = $stmt->error;
            return $result;
        }
    }

    /*FUNCIONES GENÉRICAS*/
    public static function cargaOferta($idOferta)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT DISTINCT o.*,em.razon_social as empresa FROM ofertas o
                          INNER JOIN grados_ofertas go ON o.id_oferta = go.id_oferta
                          INNER JOIN empresas em ON o.id_empresa = em.id_usuario
                          WHERE o.id_oferta = '%d'",intval($idOferta));
        $rs = $conn->query($query);
        if ($rs &&$rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $oferta =  self::constructOferta($fila);
            $oferta->setAptitudes(self::cargaAptitudesOferta($idOferta));
            return $oferta;
        }
        return false;
    }

    public static function creaOferta($datos){
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $conn->begin_transaction();
        $id_usuario = $app->idUsuario();
        $puesto = $datos['puesto'];
        $sueldo = intval($datos['sueldo']);
        $fechaInicio = $datos['fecha_inicio'];
        $fechaFin = $datos['fecha_fin'];
        $horas = intval($datos['horas']);
        $plazas = intval($datos['plazas']);
        $descripcion = $datos['descripcion'];
        $reqMinimos = $datos['reqMinimos'];
        $idiomas = $datos['idiomas'];
        $estado = 'Pendiente';
        

        $stmt = $conn->prepare('INSERT INTO ofertas (id_empresa, 
                          puesto, sueldo, fecha_incio, fecha_fin, horas, 
                          plazas, descripcion, reqMinimos, idiomas, estado) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
        $stmt->bind_param("isissiissss", $id_usuario, $puesto, $sueldo,$fechaInicio,
            $fechaFin, $horas, $plazas, $descripcion, $reqMinimos, $idiomas, $estado);

        if (!$stmt->execute()) {
            $result [] = $stmt->error;
            $conn->rollback();
            return $result;
        }
        $id_oferta = $conn->insert_id;

        foreach ($datos['aptitudes'] as $aptitud) {

            //Conseguir id de aptitud si existe
            $query = sprintf("SELECT id_aptitud FROM aptitudes WHERE nombre_aptitud = '%s'", $conn->real_escape_string($aptitud));
            $rs = $conn->query($query);
            if ($rs->num_rows > 0) {
                //Se ha encontrado la aptitud
                $fila = $rs->fetch_assoc();
                $idAptitud = intval($fila['id_aptitud']);
            } else {
                //No se ha encontrado la aptitud -> Se inserta
                $stmt = $conn->prepare('INSERT INTO aptitudes(nombre_aptitud) VALUES (?)');
                $stmt->bind_param("s", $aptitud);
                if (!$stmt->execute()) {
                    $result [] = "Hubo un problema en la inserción en la BBDD";
                    $rs->free();
                    $conn->rollback();
                    return $result;
                }
                $idAptitud = $conn->insert_id;
            }

            $stmt = $conn->prepare('INSERT INTO aptitudes_ofertas VALUES (?,?)');
            $stmt->bind_param("ii", intval($id_oferta), $idAptitud);
            if (!$stmt->execute()) {
                $rs->free();
                $result [] = $stmt->error;
                $conn->rollback();
                return $result;
            }
        }
        
        $conn->commit();
        return true;
    }

    public static function listOfertasEmpresa($id_empresa) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $aptitudes = array();
        $query = sprintf("SELECT puesto, plazas, estado FROM ofertas WHERE id_empresa='%d'", intval($id_empresa));
        $rs = $conn->query($query);
        $list = array();
        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                array_push($list, array($fila['puesto'],$fila['plazas'],$fila['estado']));
            }
            $rs->free();
        }
        return $list;
    }

    private static function cargaAptitudesOferta($id_oferta) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $aptitudes = array();
        $query = sprintf("SELECT nombre_aptitud FROM aptitudes_ofertas ae 
        INNER JOIN aptitudes a ON a.id_aptitud=ae.id_aptitud WHERE id_oferta='%d'", intval($id_oferta));
        $rs = $conn->query($query);
        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                array_push($aptitudes,$fila["nombre_aptitud"]);
            }
            $rs->free();
            return $aptitudes;
        }
        return false;
    }
    
    private static function constructOferta($fila) {
        $idOferta = $fila['id_oferta'];
        $empresa = $fila['empresa'];
        $oferta = new Oferta($idOferta, $empresa);
        $oferta->setEstado($fila['estado']);
        $oferta->setFechaFin($fila['fecha_fin']);
        $oferta->setFechaInicio($fila['fecha_incio']);
        $oferta->setPlazas($fila['plazas']);
        $oferta->setEstado($fila['estado']);
        $oferta->setPuesto($fila['puesto']);
        $oferta->setHoras($fila['horas']);
        $oferta->setSueldo($fila['sueldo']);
        $oferta->setDescripcion($fila['descripcion']);
        $oferta->setReqMinimos($fila['reqMinimos']);
        $oferta->setIdiomas($fila['idiomas']);

        $oferta->setDiasDesdeCreacion($fila['fecha_creacion']);
        return $oferta;
    }

}