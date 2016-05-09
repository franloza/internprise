<?php
/**
 * Created by IntelliJ IDEA.
 * User: Fran Lozano
 * Date: 08/05/2016
 * Time: 18:07
 */

namespace es\ucm\aw\internprise;


class PortalEmpresa extends Portal
{

    public function __construct() {
        parent::__construct("Empresa");
    }

    /**
     * Función que genera un menú lateral.
     */
    public function generaMenu()
    {
        //TODO:Peticiones AJAX para coonseguir contenido
        $bloqueEmpresaSideBar = <<<EOF
        <!-- Fragmento para definir el menú de empresa-->
        <div id="empresa-sidebar" class="sidebar">
            <div id="empresa-menu-avatar" class="menu-avatar">
                <img src="img/empresa-avatar.png" alt="Avatar image" height="200" width="200"></img>
            </div>
            <ul>
                <li><a href="#">PERFIL</a></li>
                <li><a href="#">OFERTAS</a></li>
                <li><a href="#">SOLICITUDES</a></li>
                <li><a href="#">CONTRATOS</a></li>
                <li><a href="#">BUZÓN</a></li>
            </ul>
        </div>
EOF;
        return $bloqueEmpresaSideBar;
    }

    /**
     * Función que genera los encabezados de la página.
     */
    public function generaHead()
    {
        $titulo = "Internprise - Portal Empresa";
        $imagen = "img/favicon-empresa.png";;
        return parent::generaHeadParam($titulo,$imagen);
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
        return parent::generaTitlebarParam("Internprise Empresa");
    }

}


