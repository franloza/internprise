<?php

namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class UsuarioDAO
{

    public static function cargaUsuario($email)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM internprise.Usuarios WHERE email='%s'", $conn->real_escape_string($email));
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
            $query = sprintf("SELECT id_grado FROM internprise.grados WHERE nombre_grado LIKE '%s'", $conn->real_escape_string($grado));
            $rs = $conn->query($query);
            if ($rs) {
                //Se ha encontrado el grado
                $fila = $rs->fetch_assoc();
                $idGrado = $fila['id_grado'];
                $rs->free();
            } else {
                //No se ha encontrado el grado -> Se inserta
                $stmt = $conn->prepare('INSERT INTO internprise.grados(nombre_grado) VALUES (?)');
                $stmt->bind_param($grado);
                $idGrado = $conn->insert_id;
                if (!$stmt->execute()) {
                    $result [] = "Hubo un problema en la inserción en la BBDD";
                    return $result;
                }
            }
            $stmt = $conn->prepare('INSERT INTO internprise.estudiantes(id_usuario,dni,nombre_universidad,id_Grado,
                                        nombre,apellidos,direccion,sexo, nacionalidad,fecha_nacimiento,localidad,provincia,
                                        pais,telefono,web) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $stmt->bind_param($id,$datos['dni'],$datos['nombre_universidad'],$idGrado,
                $datos['nombre'],$datos['apellidos'],$datos['direccion'],$datos['sexo'], $datos['nacionalidad'],
                $datos['fecha_nacimiento'],$datos['localidad'],$datos['provincia'],$datos['pais'],$datos['telefono'],
                $datos['web']);
            if (!$stmt->execute()) {
                $result [] = "Hubo un problema en la inserción en la BBDD";
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
        $stmt = $conn->prepare("INSERT INTO internprise.usuarios VALUES (?,?,?,?)");
        $stmt->bind_param('DEFAULT',$email, $password, $rol);
        if (!$stmt->execute()) {
            $result [] = "Hubo un problema en la inserción en la BBDD";
            return $result;
        }
        return $conn->insert_id;
    }
}