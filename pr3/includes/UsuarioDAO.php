<?php

namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class UsuarioDAO {

  public static function cargaUsuario($user) {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT rol FROM usuarios WHERE id_usuario=%s", $conn->real_escape_string($user.id()));
      $rs = $conn->query($query);
      if ($rs) {
        $fila = $rs->fetch_assoc();
        $user->setRol($fila['rol']);
        $user = self::cargaUsuarioConRol($user);
        $rs->free();
      }
      return $user;
  }

  private static function buscaUsuario($email) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM Usuarios WHERE email='%s'", $conn->real_escape_string($email));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $user = new Usuario($fila['id_usuario'], $fila['email'], $fila['password']);
      $rs->free();

      return $user;
    }
    return false;
  }


  private static function cargaUsuarioConRol($user) {

    //TODO: Completar función
    $user = $user.factory();
    if ($user.id()){
      $app = App::getSingleton();
      $conn = $app->conexionBd();

      if ($user.rol() === "Admin"){
         $query = sprintf("SELECT * FROM administradores WHERE id_usuario=%s", $conn->real_escape_string($user.id()));

      }elseif ($user.rol() === "Estudiante") {
        $query = sprintf("SELECT * FROM estudiantes WHERE id_usuario=%s", $conn->real_escape_string($user.id()));  
          
      }elseif ($user.rol() === "Empresa") {
        $query = sprintf("SELECT * FROM empresas WHERE id_usuario=%s", $conn->real_escape_string($user.id()));  
          
      } else {$user = false;}
    } else {$user = false;}

    return $user;
  }
}