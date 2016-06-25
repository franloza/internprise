<?php

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
                <img src="img/empresa-avatar.png" alt="Avatar image" width="100%"></img>
            </div>
            <ul>
                <li><a onclick="return loadContent('PERFIL', 'Perfil')" href="#">PERFIL</a></li>
                <li onmouseenter="subMenu(true, 'sub-menu-ofertas')" onmouseleave="subMenu(false, 'sub-menu-ofertas')" >
                    <a onclick="subMenu(true, 'sub-menu-ofertas')" href="#">OFERTAS</a>
                    <div id="sub-menu-ofertas" class="sub-menu">
                        <ul>
                            <li><a onclick="return loadContent('CREAR_OFERTA', 'Crear oferta')" href="#">Crear oferta</a></li>
                            <li><a onclick="return loadContent('OFERTAS', 'Ofertas')" href="#">Ver ofertas</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a onclick="return loadContent('SOLICITUDES', 'Solicitudes')" href="#">SOLICITUDES</a>
                </li>
                <li onmouseenter="subMenu(true, 'sub-menu-contratos')" onmouseleave="subMenu(false, 'sub-menu-contratos')" >
                    <a onclick="subMenu(true, 'sub-menu-contratos')" href="#">CONTRATOS</a>
                    <div id="sub-menu-contratos" class="sub-menu">
                        <ul>
                            <li><a onclick="return loadContent('CONTRATOS_VIGOR', 'Contratos en vigor')" href="#">En vigor</a></li>
                            <li><a onclick="return loadContent('CONTRATOS_FIN', 'Contratos finalizados')" href="#">Finalizados</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a onclick="return loadContent('BUZON', 'Buzon')" href="#">BUZÓN</a>
                </li>
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
       $widgets="";
       $buscador = <<<EOF
       <div class="dashboard-content">
           <!-- INI Contenedor Widgets superior -->
           <div class="widget-content">
EOF;

        //TIPOS DE ICONOS PARA LOS WIDGETS: envelope-o,check-circle,caret-square-o-down,commenting-o (VER FONTAWESOME ICONS)

        /*Generar contenido widget Ofertas */
        $widgets .= "<!-- INI Widget Ofertas activos -->";
        $ofertas = OfertaDAO::cargaOfertasEmpresa(null,null);
        $listaOfertas = array();
        foreach ( $ofertas as $oferta) {
            $titleItem = $oferta->getEmpresa();
            $subtitleItem = $oferta->getPuesto();
            $dias = $oferta->getDiasDesdeCreacion();
            if ($dias == 0) {$description = "Hoy";} else if ($dias == 1) {$description = "Ayer";} else {$description ="Hace " . $dias . " dias";};
            $item = array($titleItem,$subtitleItem,$description);
            array_push($listaOfertas,$item);
        }
        $numNewOfertas = OfertaDAO::countOfertasEmpresa();
        $widgets .= parent::generarWidget("Nuevas ofertas", $listaOfertas,"envelope-o","blue",$numNewOfertas);
        $widgets .= "<!-- FIN Widget Ofertas activos -->";

        /*Generar contenido widget Contratos */
        $widgets .= "<!-- INI Widget Contratos activos -->";
        //TODO:Implementar Contrato model & ContratoDAO
        //$contratos = ContratoDAO::cargaTodosContratosActivos();
        $contratos = array();
        $listaContratos = array();
        foreach ( $contratos as $contrato) {

        }
        $widgets .= parent::generarWidget("Contratos", $listaContratos,"check-circle","green",null);
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
        $widgets .= parent::generarWidget("Demandas", $listaContratos," fa-caret-square-o-down","#FF800D",null);
        $widgets .= "<!-- FIN Widget Nuevas demandas -->";

        /*Generar contenido widget Dudas y sugerencias */
        $widgets .= "<!-- INI Widget Dudas y sugerencias -->";
        //TODO:Implementar Sugerencia model & SugerenciaDAO
        //$sugerencias = SugerenciaDAO::cargaTodasSugerencias();
        $sugerencias = array();
        $listaSugerencias = array();
        foreach ( $sugerencias as $sugerencia) {
        }
        $widgets .= parent::generarWidget("Dudas y sugerencias", $listaContratos," fa-commenting-o","#B9264F",null);
        $widgets .= "<!-- FIN Widget Nuevas demandas -->";

        $content = $buscador . $widgets;
        $content .= "</div>";
        $content .= "</div>";
       return $content;
    }
    

    public function generaTitlebar()
    {
        return parent::generaTitlebarParam("Internprise Empresa");
    }

    public function generaPerfil($id_empresa) {
        $app = Aplicacion::getSingleton();

        $empresa = UsuarioDAO::cargaEmpresa($id_empresa);
        $ofertas = OfertaDAO::listOfertasEmpresa($id_empresa);

        $nombre = $empresa->getRazonSocial();
        $direccion = $empresa->getDireccion();
        $localidad = $empresa->getLocalidad();
        $provincia = $empresa->getProvincia();
        $cp = $empresa->getCp();
        $pais = $empresa->getPais();
        $telefono = $empresa->getTelefono();
        $web = $empresa->getWeb();
        $descripcion  = $empresa->getDescripcion();

        //Bloque contacto
        $bloqueContacto ="<div class='col-md-4'>";
        if(!empty(trim($web))) {
            $bloqueContacto .="<h2><a href='$web' class='web'><i class='fa fa-globe'></i> Website</a></h2>";
        }
        $bloqueContacto .="</div>";
        $bloqueContacto .=" <div class='col-md-4 contact-email'>";
        if(!empty(trim($telefono))) {
            $bloqueContacto .= "<h3><i class='fa fa-mobile'></i> $telefono</h3>";
        }
        $bloqueContacto .="</div>";
        
        $content = <<<EOF
        <div style="width:100%" class="container">
        <div class="row">
            <div id="imagen-empresa" class="col-sm-3">
                <IMG SRC="img/empresa-avatar.png" class="img-rounded" alt="Avatar" width="200" height="200">
            </div>      
            <div class="col-sm-8">  
                <h1 ><strong>$nombre</strong></h1>
                <h3><strong>$localidad</strong></h3>
                <p>$provincia</p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="text-left"><h1>Descripción</h1></div>
                    <table class="table table-hover ">
                        <tr><td><p class="text-justify">$descripcion</p></td></tr>
                    </table>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
            <div class="text-center"><h1>Ofertas</h1></div>                          
                <table class="table table-hover ">
                    <tr><td><strong>Puesto</strong></td><td><strong>Plazas</strong></td><td><strong>Estado</strong></td></tr>
EOF;

        $ofertas = OfertaDAO::listOfertasEmpresa($id_empresa);
        $contAceptadas = 0;
        $contPendiente = 0;
        $contPlazasA = 0;
        $contPlazasP = 0;
        foreach ($ofertas as $row){
            if(!empty(trim($row[0]))){
                if (strcmp($row[2], "Aceptada") == 0) {
                    $contAceptadas++;
                    $contPlazasA += $row[1];
                } else if (strcmp($row[2], "Pendiente") == 0) {
                    $contPendiente++;
                    $contPlazasP += $row[1];
                }
                $content .= "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
            }
        }
        $content .= <<<EOF
                </table>
            </div>
            <div class="col-sm-6">
            <div class="text-center""><h1>Datos</h1></div>
                <table class="table table-hover ">
                    <tr><td><strong>Estado</strong></td><td><strong>Cantidad Aceptadas / pendientes</strong></td><td><strong>Plazas totales</strong></td></tr>
                    <tr><td>Aceptadas</td><td>$contAceptadas</td><td>$contPlazasA</td></tr>
                    <tr><td>Pendientes</td><td>$contPendiente</td><td>$contPlazasP</td></tr>
                </table>
            </div>
  
            <div class="row"></div>          

            <div class="row">
                <div class="text-left"><h1>Contacto</h1></div>      
            </div>
            <div class="well well-sm quick-contact">
            <div class="row">
                $bloqueContacto
            </div>
        </div>
                        
EOF;
        return $content;
    }

    public function generaOfertas(){
        $ofertas = OfertaDAO::cargaOfertasEmpresa(30);
        $listaOfertas = array();
        $listaIds = array();
        foreach ( $ofertas as $oferta) {
            $puesto = $oferta->getPuesto();
            $sueldo = $oferta->getSueldo();
            $horas = $oferta->getHoras();
            $plazas = $oferta->getPlazas();
            $estado = $oferta->getEstado();
            $fila = array($puesto,$sueldo, $horas, $plazas,$estado);
            array_push($listaOfertas,$fila);
            array_push($listaIds, $oferta->getIdOferta());
        }

        $titulosColumnas = array("Puesto", "Sueldo", "Horas", "Plazas", "Estado");
        $content = self::generaTabla("tabla-ofertas", "empresa-table",
                                        "Tus ofertas disponibles", $titulosColumnas, $listaOfertas, $listaIds, 'oferta');

        return $content;
    }

    public function generaSolicitudes(){
        // TODO: Implement generaSolicitudes() method.
    }


    public function generaContratos($finalizado){
        // TODO: Implement generaContratos($finalizado) method.
    	$contratos = ContratoDAO::cargaContratosPorEstado(20, $finalizado);

    	$listaContratos = array();
    	$listaIds = array();
    	foreach ( $contratos as $contrato) {
    		$id_contrato = $contrato ->getIdContrato();
    		$estudiante = $contrato->getEstudiante();
    		$puesto = $contrato->getPuesto();
    		$fecha_inicio = $contrato->getFechaInicio();
    		$fecha_fin = $contrato->getFechaFin();
    		$fila = array($id_contrato, $estudiante,$puesto, $fecha_inicio, $fecha_fin);
    		array_push($listaContratos,$fila);
    		array_push($listaIds, $contrato->getIdContrato());
    	}
    	$titulosColumnas = array("Id Contrato", "Estudiante", "Puesto", "Inicio", "Fin");
    	$content = self::generaTabla("tabla-contrato","admin-table" ,
    			"Contratos", $titulosColumnas, $listaContratos, $listaIds, 'contrato');
    	return $content;
    }

    public function generaBuzon(){
        // TODO: Implement generaBuzon() method.
    }

    public function generaCrearOferta(){
        $formCrearOferta =  new \es\ucm\aw\internprise\FormularioCrearOferta();
        $formCrearOferta->gestiona();
    }

    public function generaSettings(){

        $formAdmin =  new \es\ucm\aw\internprise\FormularioSettings('empresa');
        $formAdmin->gestiona();
    }
}


