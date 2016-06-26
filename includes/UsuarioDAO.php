<?php

namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class UsuarioDAO
{

    public static function cargaUsuario($email)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios WHERE email='%s'", $conn->real_escape_string($email));
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $user = new Usuario($fila['id_usuario'], $fila['email'], $fila['password']);
            $user->setRol($fila['rol']);
            $rs->free();
            return $user;
        }
        return false;
    }

    public static function cargaEstudiante($id_estudiante)
    {
        $id_estudiante = intval($id_estudiante);
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios u INNER JOIN estudiantes e ON e.id_usuario = u.id_usuario INNER JOIN grados g ON g.id_grado = e.id_grado WHERE e.id_usuario='%d'", intval($id_estudiante));
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $user = new Estudiante($fila);
            $rs->free();
            $user->setAptitudes(self::cargaAptitudesEstudiante($id_estudiante));
            return $user;
        }
        return false;
    }

    public static function cargaEmpresa($id_empresa)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios u INNER JOIN empresas e ON e.id_usuario = u.id_usuario WHERE e.id_usuario='%d'", $id_empresa);
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $user = new Empresa($fila);
            $rs->free();
            return $user;
        }
        return false;
    }

    public static function cargaAdministrador($id_administrador)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios u INNER JOIN administradores a ON a.id_usuario = u.id_usuario WHERE a.id_usuario='%d'", intval($id_administrador));
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $user = new Administrador($fila);
            $rs->free();
            return $user;
        }
        return false;
    }

    /**
     * @param $datos
     * @return array|bool|mixed
     */
    public static function registerEstudiante($datos) {
        $id = self::registerUsuario ($datos['email'],$datos['password'],$datos['rol']);
        if (!is_array($id)){
            $app = App::getSingleton();
            $conn = $app->conexionBd();
            $grado = $datos['grado'];

            //Conseguir id del grado o crearlo si no existe
            $query = sprintf("SELECT id_grado FROM grados WHERE nombre_grado LIKE '%s'", $conn->real_escape_string($grado));
            $rs = $conn->query($query);
            if ($rs) {
                //Se ha encontrado el grado
                $fila = $rs->fetch_assoc();
                $idGrado = intval($fila['id_grado']);
                $rs->free();
            } else {
                //No se ha encontrado el grado -> Se inserta
                $stmt = $conn->prepare('INSERT INTO grados(nombre_grado) VALUES (?)');
                $stmt->bind_param("s",$grado);
                $idGrado = $conn->insert_id;
                if (!$stmt->execute()) {
                    $result [] = "Hubo un problema en la inserción en la BBDD";
                    return $result;
                }
            }
            $stmt = $conn->prepare('INSERT INTO estudiantes(id_usuario,dni,nombre_universidad,id_Grado,
                                        nombre,apellidos,direccion,sexo, nacionalidad,fecha_nacimiento,localidad,provincia,
                                        pais,telefono_fijo,telefono_movil) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $stmt->bind_param("ississsssssssss",$id,$datos['dni'],$datos['nombre_universidad'],$idGrado,
                $datos['nombre'],$datos['apellidos'],$datos['direccion'],$datos['sexo'], $datos['nacionalidad'],
                $datos['fecha_nacimiento'],$datos['localidad'],$datos['provincia'],$datos['pais'],$datos['telefono_fijo'],
                $datos['telefono_movil']);
            if (!$stmt->execute()) {
                $result [] = $stmt->error;
                return $result;
            }
        }
        else {
            //There was an error in the insertion
            return $id;
        }
        return true;
    }
    private function registerUsuario ($email,$password,$rol) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $stmt = $conn->prepare("INSERT INTO usuarios (email,password,rol) VALUES (?,?,?)");
        $stmt->bind_param("sss",$email, $password, $rol);
        if (!$stmt->execute()) {
            $result [] = "Hubo un problema en la inserción en la BBDD";
            return $result;
        }
        return $conn->insert_id;
    }

    public static function registerEmpresa($datos) {
        $id = self::registerUsuario ($datos['email'],$datos['password'],$datos['rol']);
        if (!is_array($id)) {
            $app = App::getSingleton();
            $conn = $app->conexionBd();
            $stmt = $conn->prepare('INSERT INTO empresas(id_usuario ,cif ,razon_social ,direccion ,localidad ,provincia ,cp ,
                                    pais ,telefono , web, descripcion ) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
            $stmt->bind_param("isssssisss", $id, $datos['cif'], $datos['razonSocial'],$datos['direccion'],
                $datos['localidad'], $datos['provincia'], $datos['cp'], $datos['pais'], $datos['telefono'], $datos['web'], $datos['descripcion']);
            if (!$stmt->execute()) {
                $result [] = $stmt->error;
                return $result;
            }
        }
        return true;
    }

    public static function registerAdmin($datos) {
        $id = self::registerUsuario ($datos['email'],$datos['password'],$datos['rol']);
        if (!is_array($id)) {
            $app = App::getSingleton();
            $conn = $app->conexionBd();
            $stmt = $conn->prepare('INSERT INTO administradores(id_usuario,nombre,apellidos,nombre_universidad,sexo,dirección,cp,localidad,
                provincia,pais,web,telefono) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
            $stmt->bind_param("isssssssssss", $id, $datos['nombre'], $datos['apellidos'],$datos['nombre_universidad'],
                $datos['sexo'],$datos['direccion'],$datos['localidad'], $datos['provincia'], $datos['cp'], $datos['pais'],
                $datos['telefono'], $datos['web']);
            if (!$stmt->execute()) {
                $result [] = $stmt->error;
                return $result;
            }
        }
        return true;
    }

    /**
     * @param $datos
     * @return array|bool|mixed
     */
    public static function updateEstudiante($datos) {
        $app = App::getSingleton();
        $id = $app->idUsuario();
        $conn = $app->conexionBd();;
        $conn->begin_transaction();

        $grado = $datos['grado'];
        $conn->begin_transaction();
        //Conseguir id del grado o crearlo si no existe
        $query = sprintf("SELECT id_grado FROM grados WHERE nombre_grado LIKE '%s'", $conn->real_escape_string($grado));
        $rs = $conn->query($query);
        if ($rs) {
            //Se ha encontrado el grado
            $fila = $rs->fetch_assoc();
            $idGrado = intval($fila['id_grado']);
        } else {
            //No se ha encontrado el grado -> Se inserta
            $stmt = $conn->prepare('INSERT INTO grados(nombre_grado) VALUES (?)');
            $stmt->bind_param("s",$grado);
            if (!$stmt->execute()) {
                $result [] = "Hubo un problema en la inserción en la BBDD";
                $rs->free();
                $conn->rollback();
                return $result;
            }
            $idGrado = $conn->insert_id;
        }
        $conn->commit();
        $conn->begin_transaction();
        //Actualizar aptitudes

        $stmt = $conn->prepare('DELETE FROM aptitudes_estudiantes WHERE id_estudiante = ?');
        $stmt->bind_param("i",intval($id));
        if (!$stmt->execute()) {
            $rs->free();
            $result [] = $stmt->error;
            $conn->rollback();
            return $result;
        }
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
                $stmt->bind_param("s",$aptitud);
                if (!$stmt->execute()) {
                    $result [] = "Hubo un problema en la inserción en la BBDD";
                    $rs->free();
                    $conn->rollback();
                    return $result;
                }
                $idAptitud = $conn->insert_id;
            }
            $stmt = $conn->prepare('INSERT INTO aptitudes_estudiantes VALUES (?,?)');
            $stmt->bind_param("ii",intval($id),$idAptitud);
            if (!$stmt->execute()) {
                $rs->free();
                $result [] = $stmt->error;
                $conn->rollback();
                return $result;
            }
        }
        $stmt = $conn->prepare('UPDATE estudiantes SET dni = ?,nombre_universidad = ?,id_Grado = ?,
                                    nombre = ?,apellidos = ?,direccion = ?,sexo = ?, nacionalidad = ?,
                                    fecha_nacimiento = ?,localidad = ?, provincia = ?, cp = ?,
                                    pais = ?,telefono_fijo = ?,telefono_movil = ?, descripción=?,localización=?,
                                    experiencia_puesto_1=?,experiencia_duracion_1=?,experiencia_puesto_2=?,
                                    experiencia_duracion_2=?,experiencia_puesto_3=?,experiencia_duracion_3=?,
                                    estudios_titulo_1=?,estudios_centro_1=?,estudios_titulo_2=?,estudios_centro_2=?,
                                    estudios_titulo_3=?,estudios_centro_3=?,idiomas_idioma_1=?,idiomas_nivel_1=?,
                                    idiomas_idioma_2=?,idiomas_nivel_2=?,idiomas_idioma_3=?,idiomas_nivel_3=?,
                                    cursos_titulo_1=?,cursos_horas_1=?,cursos_titulo_2=?,cursos_horas_2=?,
                                    cursos_titulo_3=?,cursos_horas_3=?,skype=?,google_plus=?,linkedin=?,
                                    twitter=?,avatar=?, web = ? WHERE id_usuario = ?');

        $stmt->bind_param("ssisssssssssssssssisisisssssssssssssisisissssssi",$datos['dni'],$datos['nombre_universidad'],$idGrado,
            $datos['nombre'],$datos['apellidos'],$datos['direccion'],$datos['sexo'], $datos['nacionalidad'],
            $datos['fecha_nacimiento'],$datos['localidad'],$datos['provincia'], $datos['cp'],$datos['pais'],
            $datos['telefono_fijo'],$datos['telefono_movil'],$datos['descripción'],$datos['localización'],
            $datos['experiencia_puesto_1'],$datos['experiencia_duracion_1'],$datos['experiencia_puesto_2'],
            $datos['experiencia_duracion_2'],$datos['experiencia_puesto_3'],$datos['experiencia_duracion_3'],
            $datos['estudios_titulo_1'],$datos['estudios_centro_1'],$datos['estudios_titulo_2'],$datos['estudios_centro_2'],
            $datos['estudios_titulo_3'],$datos['estudios_centro_3'],$datos['idiomas_idioma_1'],$datos['idiomas_nivel_1'],
            $datos['idiomas_idioma_2'],$datos['idiomas_nivel_2'],$datos['idiomas_idioma_3'],$datos['idiomas_nivel_3'],
            $datos['cursos_titulo_1'],$datos['cursos_horas_1'],$datos['cursos_titulo_2'],$datos['cursos_horas_2'],
            $datos['cursos_titulo_3'],$datos['cursos_horas_3'],$datos['skype'],$datos['google_plus'],$datos['linkedin'],
            $datos['twitter'],$datos['avatar'],$datos['web'],intval($id));
        if (!$stmt->execute()) {
            $rs->free();
            $result [] = $stmt->error;
            $conn->rollback();
            return $result;
        }
        $conn->commit();
        return true;
    }
    private function updateUsuario ($password) {
        $app = App::getSingleton();
        $id = $app->idUsuario();
        $conn = $app->conexionBd();
        $stmt = $conn->prepare("UPDATE usuarios SET password = ? WHERE id_usuario = ?");
        $stmt->bind_param("si",$password,$id);
        if (!$stmt->execute()) {
            $result [] = "Hubo un problema en la actualización de la BBDD";
            return $result;
        }
        return $conn->insert_id;
    }

    public static function updateEmpresa($datos) {
        $app = App::getSingleton();
        $id = $app->idUsuario();
        if (!is_array($id)) {
            $conn = $app->conexionBd();
            $stmt = $conn->prepare('UPDATE empresas SET cif = ?,razon_social= ? ,direccion = ?,
                                    localidad = ?,provincia = ?,cp = ?,pais = ?,telefono = ?, web= ?, descripcion= ? WHERE id_usuario = ?');
            $stmt->bind_param("sssssissssi",  $datos['cif'], $datos['razonSocial'],$datos['direccion'],
                $datos['localidad'], $datos['provincia'], $datos['cp'], $datos['pais'], $datos['telefono'], $datos['web'], $datos['descripcion'],$id);
            if (!$stmt->execute()) {
                $result [] = $stmt->error;
                return $result;
            }
        }
        return true;
    }

    public static function updateAdmin($datos) {
        $app = App::getSingleton();
        $id = $app->idUsuario();
        if (!is_array($id)) {
            $conn = $app->conexionBd();
            $stmt = $conn->prepare('UPDATE administradores SET nombre = ?,apellidos = ?,nombre_universidad = ?,sexo = ?,
                                  dirección = ?,cp = ?,localidad = ?,provincia = ?,pais = ?,web = ?,telefono = ? WHERE id_usuario = ?');
            $stmt->bind_param("sssssssssssi", $datos['nombre'], $datos['apellidos'],$datos['nombre_universidad'],
                $datos['sexo'],$datos['direccion'],$datos['localidad'], $datos['provincia'], $datos['cp'], $datos['pais'],
                $datos['telefono'], $datos['web'],$id);
            if (!$stmt->execute()) {
                $result [] = $stmt->error;
                return $result;
            }
        }
        return true;
    }


    public static function getDemandasPendientes($id_estudiante)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $demandas_pendientes = 0;
        $query = sprintf("SELECT COUNT(*) AS demandas_pendientes FROM demandas WHERE id_estudiante = '%d' AND ESTADO LIKE 'Pendiente%'",
            intval($id_estudiante));
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $demandas_pendientes = $fila['demandas_pendientes'];
            $rs->free();
        }
        return $demandas_pendientes;
    }
    public static function getGradosLike($patron) {
        $patron = '%' . $patron . '%';
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT nombre_grado FROM grados WHERE nombre_grado LIKE '%s'",$conn->real_escape_string($patron));
        $rs = $conn->query($query);
        $grados = array();
        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                array_push($grados,$fila['nombre_grado']);
            }
            $rs->free();
        }
        return $grados;
    }

    public static function getUniversidadesLike($patron) {
        $patron = '%' . $patron . '%';
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT DISTINCT nombre_universidad FROM estudiantes WHERE nombre_universidad LIKE'%s'",$conn->real_escape_string($patron));
        $rs = $conn->query($query);
        $universidades = array();
        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                array_push($universidades,$fila['nombre_universidad']);
            }
            $rs->free();
        }
        return $universidades;
    }

    public static function getEmails() {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT DISTINCT email FROM usuarios");
        $rs = $conn->query($query);
        $emails = array();
        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                array_push($emails,$fila['email']);
            }
            $rs->free();
        }
        return $emails;
    }

    public static function listEmpresasEstudiantes($patron) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT id_usuario,CONCAT(nombre,' ',apellidos) AS nombre , 'Estudiante' AS rol FROM estudiantes WHERE nombre LIKE '%s' 
              UNION ALL SELECT id_usuario,razon_social AS nombre, 'Empresa' AS rol FROM empresas WHERE razon_social LIKE '%s'",
            $conn->real_escape_string('%' . $patron  . '%'),$conn->real_escape_string('%' . $patron  . '%'));
        $rs = $conn->query($query);
        $list = array();
        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                array_push($list,array($fila['id_usuario'],$fila['nombre'],$fila['rol']));
            }
            $rs->free();
        }
        return $list;
    }

    public static function listEmpresasEstudiantesConcatenado($patron) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT id_usuario,CONCAT(nombre,' ',apellidos) AS nombre, 'Estudiante' AS rol FROM estudiantes WHERE CONCAT(nombre,' ',apellidos) LIKE '%s' 
              UNION ALL SELECT id_usuario,razon_social AS nombre, 'Empresa' AS rol FROM empresas WHERE razon_social LIKE '%s'",
            $conn->real_escape_string('%' . $patron  . '%'),$conn->real_escape_string('%' . $patron  . '%'));
        $rs = $conn->query($query);
        $list = array();
        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                array_push($list,array($fila['id_usuario'],$fila['nombre'],$fila['rol']));
            }
            $rs->free();
        }
        return $list;
    }


    public static function listEmpresas($patron) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $patron = '%' . $patron .'%';
        $query = sprintf("SELECT id_usuario,razon_social AS nombre FROM empresas WHERE razon_social LIKE'%s'",$conn->real_escape_string($patron));
        $rs = $conn->query($query);
        $list = array();
        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                array_push($list,array($fila['id_usuario'],$fila['nombre']));
            }
            $rs->free();
        }
        return $list;
    }

    private static function cargaAptitudesEstudiante($id_estudiante) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $aptitudes = array();
        $query = sprintf("SELECT nombre_aptitud FROM aptitudes_estudiantes ae 
        INNER JOIN aptitudes a ON a.id_aptitud=ae.id_aptitud  WHERE id_estudiante='%d'", intval($id_estudiante));
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

    public static function findUsuarioById($idUsuario)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios WHERE id_usuario='%d'", intval($idUsuario));
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $user = new Usuario($fila['id_usuario'], $fila['email'], $fila['password']);
            $user->setRol($fila['rol']);
            $rs->free();
            return $user;
        }
        return false;
    }

    public static function getAvatarByUsuarioId($idUsuario){
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        if($app->rolUsuario() === 'Empresa')
            $query = sprintf("SELECT avatar FROM empresas e WHERE e.id_usuario='%d'", intval($idUsuario));
        else if($app->rolUsuario() === 'Estudiante')
            $query = sprintf("SELECT avatar FROM estudiantes e WHERE e.id_usuario='%d'", intval($idUsuario));
        else
            return false;
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $avatar = $fila['avatar'];
            $rs->free();
            return $avatar;
        }
        return false;
    }

    public static function updateAvatarByIdUsuario($idUsuario, $fileName){
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        if($app->rolUsuario() === 'Empresa')
            $stmt = $conn->prepare("UPDATE empresas e SET avatar=? WHERE e.id_usuario = ?");
        else if($app->rolUsuario() === 'Estudiante')
            $stmt = $conn->prepare("UPDATE estudiantes e SET avatar=? WHERE e.id_usuario = ?");
        else
            return false;
        $stmt->bind_param("si", $fileName, intval($idUsuario));
        if ($stmt->execute())
            return true;
        return false;
    }
}