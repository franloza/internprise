<?php

namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class Usuario {

  public static function login($email, $password) {
    $user = self::buscaUsuario($email);
    if ($user && $user->compruebaPassword($password)) {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT rol FROM usuarios WHERE usuario_id=%s", $conn->real_escape_string($user->id));
      $rs = $conn->query($query);
      if ($rs) {
        $user->setRol($fila['rol']);
        $rs->free();
      }
      return $user;
    }    
    return false;
  }

  private static function buscaUsuario($email) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM Usuarios WHERE email='%s'", $conn->real_escape_string($email));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $user = new Usuario($fila['usuario_id'], $fila['email'], $fila['password']);
      $rs->free();

      return $user;
    }
    return false;
  }

  private $id;

  private $email;

  private $password;

  private $rol;

  private function __construct($id, $email, $password) {
    $this->id = $id;
    $this->email = $email;
    $this->password = $password;
    $this->rol = null;
  }

  public function setRol($role) {
    $this->rol = $role;
  }

  public function rol() {
    return $this->rol;
  }

  public function email() {
    return $this->email;
  }

  public function compruebaPassword($password) {
    return $this->password === $password;
  }
}