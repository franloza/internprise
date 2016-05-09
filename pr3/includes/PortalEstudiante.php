<?php

namespace es\ucm\aw\internprise;


class PortalEstudiante extends Portal
{

    public function __construct()
    {
        parent::__construct("Estudiante");
    }

    /**
     * Función que genera un menú lateral.
     */
    public function generaMenu()
    {

        //TODO:Peticiones AJAX para conseguir contenido
        $bloqueEstudianteSideBar = <<<EOF
        <!-- Fragmento para definir el menú de administrador-->
        <div id="estudiante-sidebar" class="sidebar">
            <div id="estudiante-menu-avatar" class="menu-avatar">
                <img src="img/estudiante-avatar.png" alt="Avatar image" height="200" width="200"></img>
            </div>
                <ul>
                    <li><a href="#">PERFIL</a></li>
                    <li><a href="#">OFERTAS</a></li>
                    <li><a href="#">BUZON</a></li>
                </ul>
        </div>
EOF;
        return $bloqueEstudianteSideBar;
    }

    /**
     * Función que genera los encabezados de la página.
     */
    public function generaHead()
    {
        $titulo = "Internprise - Portal Estudiante";
        $imagen = "img/favicon-estudiante.png";
        return parent::generaHeadParam($titulo, $imagen);
    }

    /**
     * Función que genera el contenido de la página principal del portal.
     * El resto de contenido debe generarse por medio de peticiones AJAX.
     */
    public function generaDashboard()
    {
        // TODO: Implement generaDashboard() method.
    }

    public function generaTitlebar()
    {
        return parent::generaTitlebarParam("Internprise Estudiante");

    }

}



