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
        $numOfertas = isset($numOfertas)? $numOfertas : 20;
        $whereGrado = isset($grado)? 'WHERE nombre_grado LIKE $grado AND' : 'WHERE';

        $app = App::getSingleton();
        $conn = $app->conexionBd();
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

    /*FUNCIONES PARA ESTUDIANTE*/

    /*
     * Ordena por fecha de creación (Por defecto: 20)
     */
    public static function cargasOfertasEstudiante($numOfertas)
    {
        $numOfertas = isset($numOfertas)? $numOfertas : 20;

        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $id_usuario = $app->idUsuario();
        $query = sprintf("SELECT o.*,em.razon_social as empresa FROM ofertas o
                          INNER JOIN grados_ofertas go ON o.id_oferta = go.id_oferta
                          INNER JOIN empresas em ON o.id_empresa = em.id_usuario
                          INNER JOIN estudiantes e ON e.id_grado = go.id_grado
                          WHERE e.id_usuario = $id_usuario
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

    /*FUNCIONES PARA EMPRESA*/

    /*
     * Función que recupera el número de ofertas (Aceptadas, rechazadas o pendientes) indicado creadas por la empresa
     * Ordena por fecha de creación (Por defecto: 20)
     */
    public static function cargaOfertasEmpresa($numOfertas)
    {
        $numOfertas = isset($numOfertas)? $numOfertas : 20;

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

    /*FUNCIONES GENÉRICAS*/
    public static function cargaOferta($idOferta)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT o.*,em.razon_social as empresa FROM ofertas o
                          INNER JOIN grados_ofertas go ON o.id_oferta = go.id_oferta
                          INNER JOIN empresas em ON o.id_empresa = em.id_usuario
                          WHERE o.id_oferta = '%d'",intval($idOferta));
        $rs = $conn->query($query);
        if ($rs &&$rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $oferta =  self::constructOferta($fila);
            $rs->free();
            return $oferta;
        }
        return false;
    }

    public static function creaOferta($datos){
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $id_usuario = $app->idUsuario();
                $puesto = $datos['puesto'];
        $sueldo = intval($datos['sueldo']);
        $fechaInicio = $datos['fecha_inicio'];
        $fechaFin = $datos['fecha_fin'];
        $horas = intval($datos['horas']);
        $plazas = intval($datos['plazas']);
        $descripcion = $datos['descripcion'];
        $estado = 'Pendiente';

        $stmt = $conn->prepare('INSERT INTO ofertas (id_empresa, 
                          puesto, sueldo, fecha_incio, fecha_fin, horas, 
                          plazas, descripcion,estado) VALUES (?,?,?,?,?,?,?,?,?)');
        $stmt->bind_param("isissiiss", $id_usuario, $puesto, $sueldo,$fechaInicio,
            $fechaFin, $horas, $plazas, $descripcion, $estado);

        if (!$stmt->execute()) {
            $result [] = $stmt->error;
            return $result;
        }
        return true;
    }
    
    private static function constructOferta($fila) {
        $idOferta = $fila['id_oferta'];
        $empresa = $fila['empresa'];
        $oferta = new Oferta($idOferta,$empresa);
        $oferta->setEstado($fila['estado']);
        $oferta->setFechaFin($fila['fecha_fin']);
        $oferta->setFechaInicio($fila['fecha_incio']);
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