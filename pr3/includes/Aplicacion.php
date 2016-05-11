<?php

namespace es\ucm\aw\internprise;

class Aplicacion {

  private static $instancia;

  private $bdDatosConexion;

  private $rutaRaizApp;

  private $dirInstalacion;

  public static function getSingleton() {
      if (  !self::$instancia instanceof self) {
         self::$instancia = new self;
      }
      return self::$instancia;
  }

  private function __construct() {
  }

  public function init($bdDatosConexion, $rutaRaizApp, $dirInstalacion){
    $this->bdDatosConexion = $bdDatosConexion;

    $this->rutaRaizApp = $rutaRaizApp;
    $tamRutaRaizApp = mb_strlen($this->rutaRaizApp);
    if ($tamRutaRaizApp > 0 && $this->rutaRaizApp[$tamRutaRaizApp-1] !== '/') {
      $this->rutaRaizApp .= '/';
    }

    $this->dirInstalacion = $dirInstalacion;
    $tamDirInstalacion = mb_strlen($this->dirInstalacion);
    if ($tamDirInstalacion > 0 && $this->dirInstalacion[$tamDirInstalacion-1] !== '/') {
      $this->dirInstalacion .= '/';
    }

    $this->conn = null;
    session_start();
  }

  public function resuelve($path = '') {
    if (strlen($path) > 0 && $path[0] == '/') {
      $path = mb_substr($path, 1);
    }
    return $this->rutaRaizApp . $path;
  }

  public function doInclude($path = '') {
    if (strlen($path) > 0 && $path[0] == '/') {
      $path = mb_substr($path, 1);
    }
    include($this->dirInstalacion . '/'.$path);
  }

  public function login(Usuario $user) {
    $_SESSION['login'] = true;
    $_SESSION['email'] = $user->email();
    $_SESSION['rol'] = $user->rol();
    $_SESSION['id_usuario'] = $user->id();
  }

  public function logout() {
    //Doble seguridad: unset + destroy
    unset($_SESSION["login"]);
    unset($_SESSION["email"]);
    unset($_SESSION["rol"]);
    unset($_SESSION["id_usuario"]);
    session_destroy();
    session_start();
  }

  public function usuarioLogueado() {
    return isset($_SESSION["login"]) && ($_SESSION["login"]===true);
  }

   public function idUsuario() {
     return isset($_SESSION["id_usuario"]) ? ($_SESSION["id_usuario"]) : 0;
   }

  public function emailUsuario() {
    return isset($_SESSION['email']) ? $_SESSION['email'] : '';
  }

  public function rolUsuario() {
    return isset($_SESSION['rol']) ? $_SESSION['rol'] : '';
  }

  public function conexionBd() {
    if (! $this->conn ) {
      $bdHost = $this->bdDatosConexion['host'];
      $bdUser = $this->bdDatosConexion['user'];
      $bdPass = $this->bdDatosConexion['pass'];
      $bd = $this->bdDatosConexion['bd'];

      $this->conn = new \mysqli($bdHost, $bdUser, $bdPass, $bd);
      if ( $this->conn->connect_errno ) {
        echo "Error de conexión a la BD: (" . $this->conn->connect_errno . ") " . utf8_encode($this->conn->connect_error);
        exit();
      }
      if ( ! $this->conn->set_charset("utf8mb4")) {
        echo "Error al configurar la codificación de la BD: (" . $this->conn->errno . ") " . utf8_encode($this->conn->error);
        exit();
      }
    }
    return $this->conn;
  }

  public function tieneRol($rol) {
    if (!isset($_SESSION['rol'])) {return false;}
    else if ($_SESSION['rol'] !=$rol) {return false;}
    else return true;
  }
}