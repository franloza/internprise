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
    public static function cargaContratosActivos($numContratos, $grado)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $numContratos = isset($numContratos)? intval($numContratos) : 20;
        if (isset($grado)) {
            $whereGrado = sprintf("WHERE nombre_grado LIKE %s AND",$conn->real_escape_string($grado));
        }
        else {$whereGrado="WHERE";}

        $query = sprintf("SELECT id_contrato, e.id_usuario, em.razon_social as empresa,puesto,fecha_incio ,fecha_fin,horas,sueldo as salario,c.estado, nombre_grado
                          FROM contratos c
                          INNER JOIN ofertas o ON c.id_oferta = o.id_oferta
                          INNER JOIN estudiantes e ON e.id_usuario = c.id_estudiante
                          INNER JOIN empresas em ON em.id_usuario = o.id_empresa
                          INNER JOIN grados g ON g.id_grado = e.id_Grado
                          $whereGrado c.estado = 'Activo' LIMIT $numContratos");
        $rs = $conn->query($query);
        if ($rs) {
            $contratos = array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($contratos,self::constructContrato($fila));
            }
            $rs->free();
            return $contratos;
        }
        return false;

    }

    /*
     * Función que carga los contratos ya finalizados de la BBDD.
     * Permite filtrar por grado. (Por defecto: TODOS)
     * Permite filtrar por año. (Por defecto: TODOS)
     * Ordena por fecha de finalizacion (Por defecto: 20)
     */
    public static function cargaContratosFinalizados($numContratos, $grado, $año)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $numContratos = isset($numContratos)? intval($numContratos) : 20;
        if (isset($grado)) {
            $whereGrado = sprintf("WHERE nombre_grado LIKE %s AND",$conn->real_escape_string($grado));
        }
        else {$whereGrado="WHERE";}
        
        if (isset($año)) {
            $añoFilter = sprintf("AND YEAR(fecha_incio) <= %d AND YEAR(fecha_fin) >= '%d'",intval($año),intval($año));
        }
        else {$añoFilter="";}

        $query = sprintf("SELECT id_contrato, e.id_usuario, em.razon_social as empresa,puesto,sueldo as salario,fecha_incio ,fecha_fin,horas,c.estado, nombre_grado
                          FROM contratos c
                          INNER JOIN ofertas o ON c.id_oferta = o.id_oferta
                          INNER JOIN estudiantes e ON e.id_usuario = c.id_estudiante
                          INNER JOIN empresas em ON em.id_usuario = o.id_empresa
                          INNER JOIN grados g ON g.id_grado = e.id_Grado
                          $whereGrado c.estado = 'Expirado' $añoFilter LIMIT $numContratos");
        $rs = $conn->query($query);
        if ($rs) {
            $contratos = array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($contratos,self::constructContrato($fila));
            }
            $rs->free();
            return $contratos;
        }
        return false;

    }

    /*FUNCIONES PARA ESTUDIANTE*/

    /*
     * Muestra la información del contrato activo que tiene el estudiante si tiene. Si no devuelve false
     */
    public static function cargaContratoActivoEstudiante()
    {
        {
            $app = App::getSingleton();
            $conn = $app->conexionBd();
            $id_estudiante = $app->idUsuario();
            $query = sprintf("SELECT id_contrato, e.id_usuario, em.razon_social as empresa,puesto,sueldo as salario,fecha_incio ,fecha_fin,horas,c.estado
                          FROM contratos c
                          INNER JOIN ofertas o ON c.id_oferta = o.id_oferta
                          INNER JOIN estudiantes e ON e.id_usuario = c.id_estudiante
                          INNER JOIN empresas em ON em.id_usuario = o.id_empresa
                          WHERE c.id_estudiante = 'Activo' AND estado = '%s'",intval($id_estudiante));
            $rs = $conn->query($query);
            if ($rs) {
                $fila = $rs->fetch_assoc();
                $contrato = self::constructContrato($fila);
                $rs->free();
                return $contrato;
            }
            return false;
        }

    }

    /*FUNCIONES PARA EMPRESA*/
    /*
     * Función que recupera las contratos finalizados o no de una empresa
     */

    public static function cargaContratosPorEstadoEmpresa($numContratos, $estado)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $id_empresa = $app->idUsuario();
        $numContratos = isset($numContratos)? intval($numContratos) : 20;
        $query = sprintf("SELECT id_contrato, e.id_usuario, em.razon_social as empresa,puesto,fecha_incio ,fecha_fin,horas,sueldo as salario,c.estado
                          FROM contratos c
                          INNER JOIN ofertas o ON c.id_oferta = o.id_oferta
                          INNER JOIN estudiantes e ON e.id_usuario = c.id_estudiante
                          INNER JOIN empresas em ON em.id_usuario = o.id_empresa
                          WHERE o.id_empresa = '%d' AND c.estado = '%s' LIMIT $numContratos",intval($id_empresa),$conn->real_escape_string($estado));
        $rs = $conn->query($query);
        if ($rs) {
            $contratos = array();
            while ($fila = $rs->fetch_assoc()) {
                array_push($contratos, self::constructContrato($fila));
            }
            $rs->free();
            return $contratos;
        }
        return false;
    }
	    /*Clasifica un contrato como finalizado*/
    public static function finalizarContrato($op)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
		$estado = 'Expirada';

		$query = sprintf("UPDATE contratos SET estado ='%s' WHERE id_contrato=?",$estado);
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", intval($op));

        if (!$stmt->execute()) {
            $result [] = "Hubo un error en la operación";
            return $result;
        }
    }

    /*FUNCIONES GENÉRICAS*/

    /*Carga un contrato por ID de la BBDDD*/
    public static function cargaContrato($idContrato)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT id_contrato, e.id_usuario, em.razon_social as empresa,puesto,sueldo as salario,fecha_incio ,fecha_fin,horas,c.estado
                          FROM contratos c
                          INNER JOIN ofertas o ON c.id_oferta = o.id_oferta
                          INNER JOIN estudiantes e ON e.id_usuario = c.id_estudiante
                          INNER JOIN empresas em ON em.id_usuario = o.id_empresa
                          WHERE id_contrato = '%d'", intval($idContrato));
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $contrato = self::constructContrato($fila);
            $rs->free();
            return $contrato;
        }
        return false;
    }

    /*Permite crear un contrato nuevo si el estudiante no tiene uno en vigor*/
    public static function creaContrato($id_oferta,$id_estudiante)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $estado = 'Activo';
        //Comprobar si el estudiante ya tiene un contrato en vigor
        if (!self::tieneContratoActivo($id_estudiante)) {
            $stmt = $conn->prepare('INSERT INTO contratos (id_oferta, id_estudiante,estado) VALUES (?,?,?)');
            $stmt->bind_param("iis", $id_oferta, $id_estudiante,$estado);
            if (!$stmt->execute()) {
                $result [] = $stmt->error;
                return $result;
            }
        } else {
            $result [] = "El usuario ya tiene un contrato activo";
            return $result;
        }
        return true;
    }

    private static function constructContrato($fila)
    {
        $idContrato = $fila['id_contrato'];
        $empresa = $fila['empresa'];
        $estudiante =  UsuarioDAO::cargaEstudiante($fila['id_usuario']);

        $contrato = new Contrato($idContrato, $empresa,$estudiante);
        $contrato->setPuesto($fila['puesto']);
        $contrato->setFechaInicio($fila['fecha_incio']);
        $contrato->setFechaFin($fila['fecha_fin']);
        $contrato->setHoras($fila['horas']);
        $contrato->setSalario($fila['salario']);
        $contrato->setEstado($fila['estado']);

        
        return $contrato;
    }
    
    private function tieneContratoActivo ($idEstudiante) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT id_contrato FROM contratos c
                          WHERE id_estudiante = '%d' AND estado = 'Activo'", intval($idEstudiante));
        $rs = $conn->query($query);
        return ($rs && $rs->num_rows > 0);
    }

    public static function countContratosActivos ($idEmpresa) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT COUNT(id_contrato) AS contratos FROM contratos c 
                            INNER JOIN ofertas o ON c.id_oferta = o.id_oferta 
                            INNER JOIN empresas e ON e.id_usuario = o.id_empresa
                          WHERE e.id_usuario = '%d' AND c.estado = 'Activo'", intval($idEmpresa));
        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            $contratos = $fila['contratos'];
            return $contratos;
        }
        return false;
    }
}