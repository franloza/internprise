<?php

namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class Usuario {

  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

  public static function login($email, $password) {
    $user = self::cargaUsuario($email);
    if ($user && $user->compruebaPassword($password)) {
      return $user;
    }    
    return false;
  }

  private static function cargaUsuario($email) {
    return UsuarioDAO::cargaUsuario($email);
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
        if (!$ok) {
            $result[] = 'La contraseña no tiene entre 4 y 14 caracteres';
            return $result;
        }
        return $ok;
    }

  private $id;

  private $email;

  private $password;

  private $rol;

  public function __construct($id, $email, $password) {
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

  public function getEmail() {
    return $this->email;
  }

    public function email() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getId()
    {
        return $this->id;
    }

    //TODO:Hashear contraseña
  public function compruebaPassword($password) {
    return password_verify($password, $this->password);
  }
}