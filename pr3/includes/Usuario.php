<?php

namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class Usuario {

  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

  public static function login($email, $password) {
    $user = self::buscaUsuario($email);
    if ($user && $user->compruebaPassword($password)) {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT rol FROM usuarios WHERE id_usuario=%s", $conn->real_escape_string($user->id));
      $rs = $conn->query($query);
      if ($rs) {
        $fila = $rs->fetch_assoc();
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
      $user = new Usuario($fila['id_usuario'], $fila['email'], $fila['password']);
      $rs->free();

      return $user;
    }
    return false;
  }
    protected static function validateUsuario($datos)
    {
        $ok = true;
        if (!isset($datos['email'])) {
            $ok = false;
        }
        if (!mb_ereg_match(self::HTML5_EMAIL_REGEXP, $datos['email'])) {
            $ok = false;
        }
        if (!$ok) {
            $result[] = 'El email introducido no es válido';
            return $result;
        }
        if (!isset($datos['password'])) {
            $ok = false;
        }
        if ((strlen($datos['password']) < 4) || (strlen($datos['password']) > 12)) {
            $ok = false;
        }
        if (!$ok) {
            $result[] = 'La contraseña no tiene entre 4 y 12 caracteres';
            return $result;
        }
        return $ok;
    }

  private $id;

  private $email;

  private $password;

  private $rol;

  protected function __construct($id, $email, $password) {
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