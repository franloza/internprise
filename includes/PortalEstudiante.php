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
        $bloqueEstudianteSideBar = <<<EOF
        <!-- Fragmento para definir el menú de estudiante-->
        <div id="estudiante-sidebar" class="sidebar">
            <div id="estudiante-menu-avatar" class="menu-avatar">
                <img src="img/estudiante-avatar.png" alt="Avatar image" width="100%"></img>
            </div>
                <ul>
                    <li><a onclick="return loadContent('PERFIL', 'Perfil')" href="#">PERFIL</a></li>
                    <li><a onclick="return loadContent('OFERTAS', 'Ofertas')" href="#">OFERTAS</a></li>
                    <li><a onclick="return loadContent('BUZON', 'Buzon')" href="#">BUZÓN</a></li>
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
       $widgets="";
       $buscador = <<<EOF
       <div class="dashboard-content">

           <!-- INI Contenedor busqueda dashboard -->
           <div class="btn-search">
               <a class="icon-search" href="#">
                   <i class="fa fa-search fa-2x" style="color:#444;"></i>
               </a>
               <div class="txt-search">
                   <form method="post" action="#">
                       <input class="txt-search" type="text" placeholder="Buscador de empresas">
                   </form>
               </div>
           </div>
           <!-- FIN Contenedor busqueda dashboard -->

           <!-- INI Contenedor Widgets superior -->
           <div class="widget-content">
EOF;

        //TIPOS DE ICONOS PARA LOS WIDGETS: envelope-o,check-circle,caret-square-o-down,commenting-o (VER FONTAWESOME ICONS)

        /*Generar contenido widget Ofertas */
        $widgets .= "<!-- INI Widget Ofertas activos -->";
        $ofertas = OfertaDAO::cargasOfertasEstudiante(null);
        $listaOfertas = array();
        foreach ( $ofertas as $oferta) {
            $titleItem = $oferta->getEmpresa();
            $subtitleItem = $oferta->getPuesto();
            $dias = $oferta->getDiasDesdeCreacion();
            if ($dias == 0) {$description = "Hoy";} else if ($dias == 1) {$description = "Ayer";} else {$description ="Hace " . $dias . " dias";};
            $item = array($titleItem,$subtitleItem,$description);
            array_push($listaOfertas,$item);
        }
        $widgets .= parent::generarWidget("Nuevas ofertas", $listaOfertas,"envelope-o","blue");
        $widgets .= "<!-- FIN Widget Ofertas activos -->";

        /*Generar contenido widget Novedades */
        $widgets .= "<!-- INI Widget Contratos activos -->";
        //TODO:Implementar Contrato model & ContratoDAO
        //$contratos = ContratoDAO::cargaTodosContratosActivos();
        $novedades = array();
        $novedades = array();
        foreach ( $novedades as $contrato) {

        }
        $widgets .= parent::generarWidget("Novedades", $novedades,"check-circle","green");
        $widgets .= "<!-- FIN Widget Contratos activos -->\n<!-- FIN Contenedor widgets superior -->";

        $content = $buscador . $widgets;
        $content .= "</div>";
        $content .= "</div>";
       return $content;
    }
    

    public function generaTitlebar()
    {
        return parent::generaTitlebarParam("Internprise Estudiante");

    }

    public function generaPerfil(){
        //TODO; Genera perfil
    }

    public function generaOfertas(){
        $ofertas = OfertaDAO::cargasOfertasEstudiante(20);
        $listaOfertas = array();
        foreach ( $ofertas as $oferta) {
            $empresa = $oferta ->getEmpresa();
            $puesto = $oferta->getPuesto();
            $sueldo = $oferta->getSueldo();
            $horas = $oferta->getHoras();
            $plazas = $oferta->getPlazas();
            $fila = array($empresa,$puesto,$sueldo, $horas, $plazas);
            array_push($listaOfertas,$fila);
        }

        $titulosColumnas = array("Empresa","Puesto", "Sueldo", "Horas", "Plazas");
        $content = self::generaTabla("tabla-ofertas", "estudiante-table",
            "Ofertas disponibles", $titulosColumnas, $listaOfertas);

        return $content;
    }

    public function generaBuzon(){
        // TODO: Implement generaBuzon() method.
    }

    public function generaSettings(){

        $formAdmin =  new \es\ucm\aw\internprise\FormularioSettings('estudiante');
        $formAdmin->gestiona();
    }
    
    

}



