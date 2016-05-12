<?php


namespace es\ucm\aw\internprise;


class PortalAdministracion extends Portal
{
    public function __construct() {
        parent::__construct("Admin");
    }

    public function generaMenu()
    {
        $bloqueAdminSideBar = <<<EOF
        <!-- Fragmento para definir el menú de administrador-->
        <div id="admin-sidebar" class="sidebar">
                <ul>
                    <li><a onclick="return loadContent('OFERTAS_ADMIN')" href="#">OFERTAS</a></li>
                    <li><a onclick="return loadContent('DEMANDAS_ADMIN')" href="#">DEMANDAS</a></li>
                    <li><a onclick="return loadContent('CONTRATOS_ADMIN')" href="#">VER CONTRATOS</a></li>
                    <li><a onclick="return loadContent('HISTORIAL_ADMIN')" href="#">HISTORIAL</a></li>
                    <li><a onclick="return loadContent('ENCUESTAS_ADMIN')" href="#">ENCUESTAS</a></li>
                    <li><a onclick="return loadContent('BUZON_ADMIN')" href="#">BUZON</a></li>
                </ul>
        </div>
EOF;
        return $bloqueAdminSideBar;
    }


    /**
     * Función que genera los encabezados de la página.
     */
    public function generaHead()
    {
        $titulo = "Internprise - Portal Administracion";
        $imagen = "img/favicon-admin.png";
        return parent::generaHeadParam($titulo,$imagen);
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
                       <input class="txt-search" type="text" placeholder="Buscador de estudiantes / empresas">
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
        $ofertas = OfertaDAO::cargaOfertasNoClasificadas(null,null);
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

        /*Generar contenido widget Contratos */
        $widgets .= "<!-- INI Widget Contratos activos -->";
        //TODO:Implementar Contrato model & ContratoDAO
        //$contratos = ContratoDAO::cargaTodosContratosActivos();
        $contratos = array();
        $listaContratos = array();
        foreach ( $contratos as $contrato) {

        }
        $widgets .= parent::generarWidget("Contratos", $listaContratos,"check-circle","green");
        $widgets .= "<!-- FIN Widget Contratos activos -->\n<!-- FIN Contenedor widgets superior -->";

        $widgets .= "<!-- INI Contenedor widgets inferior -->\n<!-- INI Contenedor widgets inferior -->";

        /*Generar contenido widget Demandas */
        $widgets .= "<!-- INI Widget Nuevas demandas -->";
        //TODO:Implementar Demanda model & DemandaDAO
        //$demandas = DemandaDAO::cargaTodasDemandas();
        $demandas = array();
        $listaDemandas = array();
        foreach ( $demandas as $demanda) {

        }
        $widgets .= parent::generarWidget("Demandas", $listaContratos," fa-caret-square-o-down","#FF800D");
        $widgets .= "<!-- FIN Widget Nuevas demandas -->";

        /*Generar contenido widget Dudas y sugerencias */
        $widgets .= "<!-- INI Widget Dudas y sugerencias -->";
        //TODO:Implementar Sugerencia model & SugerenciaDAO
        //$sugerencias = SugerenciaDAO::cargaTodasSugerencias();
        $sugerencias = array();
        $listaSugerencias = array();
        foreach ( $sugerencias as $sugerencia) {

        }
        $widgets .= parent::generarWidget("Dudas y sugerencias", $listaContratos," fa-commenting-o","#B9264F");
        $widgets .= "<!-- FIN Widget Nuevas demandas -->";

        $content = $buscador . $widgets;
        $content .= "</div>";
        $content .= "</div>";
       return $content;
    }

    public function generaTitlebar()
    {
        return parent::generaTitlebarParam("Internprise Administracion",'DASHBOARD_ADMIN');
    }

    public function generaOfertas(){
        $content = <<<EOF
        
EOF;
        return $content;

    }

    public function generaDemandas(){
        // TODO: Implement generaDemandas() method.
    }

    public function generaContratos(){
        // TODO: Implement generaContratos() method.
    }

    public function generaHistorial(){
        // TODO: Implement generaHistorial() method.
    }

    public function generaEncuestas(){
        // TODO: Implement generaEncuestas() method.
    }

    public function generaBuzon(){
        // TODO: Implement generaBuzon() method.
    }
}