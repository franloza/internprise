<?php


namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class contratoDAO
{
    /*FUNCIONES PARA ADMINISTRADOR*/

    /*
     * Función que carga todos los  contratos en vigor (todavia no han terminado) de la BBDD.
     * Permite filtrar por grado. (Por defecto: TODOS)
     * Ordena por fecha de creación (Por defecto: 20)
     */
    public static function cargaContratosVigor($numContratos, $grado)
    {
        /*
         * esto de momento me supera, deberia cargar todos los contratos que no han terminado
         * hasta la fecha de hoy, creo una variable  en contrato llamada finalizado
         */

    }

    /*
     * Función que carga los 20 ultimos contratos ya finalizados (estado de finalizado a true) de la BBDD.
     * Permite filtrar por grado. (Por defecto: TODOS)
     * Ordena por fecha de finalizacion (Por defecto: 20)
     */
    public static function cargaContratosFinalizados($numContratos, $grado)
    {

        /*
         * Como en la de antes, este metodo carga todos los contratos que ya han finalizado por el valor
         * de la variable finalizado de contrato, y los ordena por fecha de finalización del  contrato
         * Tambien se puede filtrar por el grado
         *
         */
    }

    /*FUNCIONES PARA ESTUDIANTE*/

    /*
     * Muestra la información del contrato que tiene el estudiante
     */
    public static function cargaContratoEstudiante($numContratos)
    {
        /*
         * En este caso solo muestra la información del contrato que esta realizando el estudiante,
         * en caso de no tener ningun contrato, no muestra nada, saldran las ofertas que correspondan.
         */


    }

    /*FUNCIONES PARA EMPRESA*/


    /*
     * Función que recupera las contratos finalizados o no de una empresa
     */

    public static function cargaOfertasPorEstado($numContratos, $estado)
    {
        /*
         *  Este metodo muestra todos los contratos que tiene la empresa en funcion del estado de la variable
         * finalizado, si es true muestra todos los contratos finalizados, si es false muestra todos los
         * contratos que tiene en vigor.
         * Este metodo se puede usar para ambas pestañas de la empresa en contratos y sustituir a la de arriba.
         *
         */
    }

    /*FUNCIONES GENÉRICAS*/

    public static function cargaContrato($idContrato)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT o.*,em.razon_social as empresa FROM ofertas o
                          INNER JOIN grados_ofertas go ON o.id_oferta = go.id_oferta
                          INNER JOIN empresas em ON o.id_empresa = em.id_usuario
                          WHERE o.id_oferta = '%d'", intval($idOferta));
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $oferta = self::constructContrato($fila);
            $rs->free();
            return $oferta;
        }
        return false;
    }

    public static function creaContrato($datos)
    {
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
        $stmt->bind_param("isissiiss", $id_usuario, $puesto, $sueldo, $fechaInicio,
            $fechaFin, $horas, $plazas, $descripcion, $estado);

        if (!$stmt->execute()) {
            $result [] = $stmt->error;
            return $result;
        }
        return true;
    }

    private static function constructContrato($fila)
    {
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
        $oferta->setDiasDesdeCreacion($fila['fecha_creacion']);
        return $oferta;
    }
}