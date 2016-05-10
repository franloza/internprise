<?php

namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class Usuario {

  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

  public static function login($email, $password) {
    $user = UsuarioDAO::buscaUsuario($email);
    if ($user && $user->compruebaPassword($password)) {
      return UsuarioDAO::cargaUsuario($email);
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

  public function id() {
    return $this->id;
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

  public function factory() {
      $id =$this->id;
      $email = $this->email;
      $password = $this ->password;        

      if ($this->rol === "Admin"){
          return new \es\ucm\aw\internprise\Administrador($id,$email,$password);
      }elseif ($this->rol === "Estudiante") {
          return new \es\ucm\aw\internprise\Estudiante($id,$email,$password);
      }elseif ($this->rol === "Empresa") {
          return new \es\ucm\aw\internprise\Empresa($id,$email,$password));
      }
      return false;
  }
}