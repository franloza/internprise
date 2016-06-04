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
		 
		/*
         * este metodo es el cual debe usarse al pinchar en la pestaña ver contratos del perfil
		 * administrador, y iniciarlmente muestra los ultimos 20 contratos, en este caso filtrado
		 * por todos los grados, y tambien se usa cuando se seleccione un grado de los disponibles 
		 * en un combobox que abra encima de la tabla en la pagina
         */

    }

    /*
     * Función que carga los 20 ultimos contratos ya finalizados (estado de finalizado a true) de la BBDD.
     * Permite filtrar por grado. (Por defecto: TODOS)
     * Ordena por fecha de finalizacion (Por defecto: 20)
     */
    public static function cargaContratosFinalizados($numContratos, $grado, $año)
    {

        /*
         * Como en la de antes, este metodo carga todos los contratos que ya han finalizado por el valor
         * de la variable finalizado de contrato, y los ordena por fecha de finalización del  contrato
         * Tambien se puede filtrar por el grado
         *
         */
		 
		 /*
         * este metodo es el que se usa en la pestaña historial del portal administrador, inicialmente
		 * muestra los ultimos contratos ordenados por fecha de finalizacion y por grado( todos )
		 *  habra dos combobox para seleccionar el grado por el que buscar, y tambien estara la opcion 
		 *  de buscar por año en otro combobox
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
		 
        /*
         * Este metodo es el que se usa al pinchar en principio en la pestaña ofertas del perfil 
         * estudiantes, que en el caso de tener un contrato en vigor, se mostrara una tabla con un 
		 * unico elemento, que sera el contrato actual que tiene, en lugar de las ofertas que hay 
		 * disponibles, en caso de que tenga algun contrato finalizado anteriormente tambien 
		 * se mostrará
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
         * Este metodo se puede usar para ambas pestañas de la empresa en contratos.
         *
         */
    }

    /*FUNCIONES GENÉRICAS*/
	
	     /*
         * Estos metodos no estan implementados correctamente, solo estan cogidos del dao de ofertas para 
		 * amoldarlo a los contratos, hay que cambiar todos los atributos por los que tiene los 
         * contratos, que ya esta hecho.
         */

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