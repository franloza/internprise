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
}