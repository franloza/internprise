<?php

namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

/**
 * Clase de gestión de portales.
 */
abstract class Portal
{
    /**
     * Cadena utilizada como valor del atributo "rol"  asociada al rol activo del portal.
     */
    protected $rol;

    public function __construct($rol) {
        $this->rol = $rol;
    }

    /**
     * Función que comprueba si el usuario tiene un rol asignado y si este coincide con el de la instancia del portal.
     * Genera un mensaje de error en caso contrario.
     */
    public function checkRol() {
        $app = App::getSingleton();
        if($app -> tieneRol($this->rol)) {
            echo Error::generaErrorPermisos();
            return false;
        }
        return true;
    }

    /**
     * Función que genera el contenido de la página principal del portal.
     * El resto de contenido debe generarse por medio de peticiones AJAX.
     */
    public abstract function generaDashboard();

    /**
     * Función que genera un menú lateral.
     */
    public abstract function generaMenu();

    /**
     * Función que genera un footer al final de la página.
     */
    public function generaFooter() {
        $rol = strtolower($this->rol);
        $bloqueFooter = <<<EOF
        <!-- Fragmento para definir el footer -->
        <div id="$rol-footer" class ="footer">
            Internprise
            <div class="footer-icons">
                <a class="fa fa-github" href="https://github.com/franloza/aw"></a>
            </div>
        </div>
EOF;
        return $bloqueFooter;

    }
	
    /**
     * Función que genera los encabezados de la página.
     */
    protected function generaHeadParam($titulo,$imagen)
    {
        $bloqueHead = <<<EOF
        <!-- Fragmento para incluir CSS -->
        <head>
            <meta charset="UTF-8">
            <title>$titulo</title>
            <link rel="stylesheet" href="css/menu.css" type="text/css">
            <link rel="stylesheet" href="css/content.css" type="text/css">
            <link rel="stylesheet" href="css/titlebar&footer.css" type="text/css">
            <link rel="stylesheet" href="css/font-awesome-4.5.0/css/font-awesome.min.css">
            <!-- css solo para los colores-->
            <link rel="stylesheet" href="css.php">
            <link rel="icon" type="image/png" href="$imagen">
        </head>
EOF;
        return $bloqueHead;
    }

    protected function generarWidget($titulo, $numItems, $arrayItems)
    {
        $bloqueWidget = <<<EOF
        <!-- INI Widget Nuevas ofertas -->  
        <div class="widget">
            <!-- Header widget -->
            <div class="widget-header">
                <p class="title">$titulo</p>
                <p class="title-items">
                    <a class="square" href="#">$numItems</a>
                    </p>
                </div>
EOF;

        for ($i = 0; i < $numItems; $i++)
        {
            $bloqueContent = <<<EOF
            <!-- Content widget -->
                <div class="content-widget">
                    <div class="media">
                        <div class="media-left">
                            <i class="fa fa-envelope-o" style="color:blue;"></i>
                        </div>
                    <div class="media-body">
                        <div class="media-header">
                            <strong>$arrayItems[$i]->Empresa</strong>
                            $arrayItems[$i]->Oferta;
                        </div>
                        <div class="text-muted">
                            <small>$arrayItems[$i]->Hora</small>
                        </div>
                    </div>
                </div>
EOF;
        }
        $bloqueFin = <<<EOF
            </div>
        </div>
    <!-- FIN Widget Nuevas ofertas -->
EOF;

        return $bloqueWidget . $bloqueContent . $bloqueFin;

    }

    /**
     * Función que genera la barra de iconos del portal.
     */
    protected function generaTitlebarParam($titulo)
    {
        $rol = strtolower($this->rol);
        //TODO: Implementar correctamente los enlaces
        $bloqueTitleBar = <<<EOF
    <!-- Fragmento para definir el titlebar del Portal -->
    <div id="$rol-titlebar" class='titlebar'>
        <img src="img/favicon-$rol.png" alt="Internprise icon" height="70" width="70"></img>
        <div id="label-titlebar">
            <label>
                <a id="title-site" href="$rol-dashboard.php">$titulo</a>
                <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i>
                <a id="previous-page" href="$rol-dashboard.php">Anterior</a>
                <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i>
                <a id="current-page" href="$rol-dashboard.php">Actual</a>
            </label>
        </div>
        <div id="icons-titlebar">
            <a id="bell" class="fa fa-bell fa-lg" href="#"></a>
            <a id="settings" class="fa fa-cog fa-lg" href="#"></a>
            <a class="fa fa-power-off fa-lg" href="index.html"></a>
        </div>
    </div>
EOF;

        return$bloqueTitleBar;
    }

    public static function factory($rol) {
        if ($rol === "Admin"){
            return new \es\ucm\aw\internprise\PortalAdministracion();
        }elseif ($rol === "Estudiante") {
            return new \es\ucm\aw\internprise\PortalEstudiante();
        }elseif ($rol === "Empresa") {
            return new \es\ucm\aw\internprise\PortalEmpresa();
        }
        return false;
    }
}
