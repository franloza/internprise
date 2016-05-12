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
        $bloqueEmpresaSideBar = <<<EOF
        <!-- Fragmento para definir el menú de empresa-->
        <div id="empresa-sidebar" class="sidebar">
            <div id="empresa-menu-avatar" class="menu-avatar">
                <img src="img/empresa-avatar.png" alt="Avatar image" height="200" width="200"></img>
            </div>
            <ul>
                <li><a onclick="return loadContent('PERFIL_EMPRESA')" href="#">PERFIL</a></li>
                <li><a onclick="return loadContent('OFERTAS_EMPRESA')" href="#">OFERTAS</a></li>
                <li><a onclick="return loadContent('SOLICITUDES_EMPRESA')" href="#">SOLICITUDES</a></li>
                <li><a onclick="return loadContent('CONTRATOS_EMPRESA')" href="#">CONTRATOS</a></li>
                <li><a onclick="return loadContent('BUZON_EMPRESA')" href="#">BUZÓN</a></li>
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
        $imagen = "img/favicon-empresa.png";
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

    public function generaPerfil(){
        // TODO: Implement generaPerfil() method.
    }

    public function generaOfertas(){
        // TODO: Implement generaOfertas() method.
        $ofertas = OfertaDAO::cargaOfertasPorEstado(30, 'Aceptada');
        $listaOfertas = array();
        foreach ( $ofertas as $oferta) {
            $idOferta = $oferta->getIdOferta();
            $empresa = $oferta->getEmpresa();
            $puesto = $oferta->getPuesto();
            $sueldo = $oferta->getSueldo();
            $horas = $oferta->getHoras();
            $plazas = $oferta->getPlazas();
            $fila = array($idOferta, $empresa,$puesto,$sueldo, $horas, $plazas);
            array_push($listaOfertas,$fila);
        }


        $titulosColumnas = array("Empresa", "Puesto", "Sueldo", "Horas", "Plazas", "Accion");
        $content = parent::generaTabla("tabla-ofertas", "empresa-table",
                                        "Ofertas disponibles", $titulosColumnas, $listaOfertas);

        return $content;
    }

    public function generaSolicitudes(){
        // TODO: Implement generaSolicitudes() method.
    }


    public function generaContratos(){
        // TODO: Implement generaContratos() method.
    }

    public function generaBuzon(){
        // TODO: Implement generaBuzon() method.
    }

}


