<?php

namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

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
        $app = App::getSingleton();
        $avatar = UsuarioDAO::getAvatarByUsuarioId($app->idUsuario());
        $bloqueEmpresaSideBar = <<<EOF
        <!-- Fragmento para definir el menú de empresa-->
        <div id="empresa-sidebar" class="sidebar">
            <div id="empresa-menu-avatar" class="menu-avatar">
                <img id="avatar" src="img/avatares/$avatar" alt="Avatar image" width="100%"></img>
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
                
                <li onmouseenter="subMenu(true, 'sub-menu-demandas')" onmouseleave="subMenu(false, 'sub-menu-demandas')" >
                    <a onclick="subMenu(true, 'sub-menu-demandas')" href="#">SOLICITUDES</a>
                    <div id="sub-menu-demandas" class="sub-menu">
                            <ul>
                                <li><a onclick="return loadContent('DEMANDAS_CLASIFICADAS', 'Solicitudes clasificadas')" href="#">Clasificadas</a></li>
                                <li><a onclick="return loadContent('DEMANDAS_NO_CLASIFICADAS', 'Solicitudes no clasificadas')" href="#">No clasificadas</a></li>
                            </ul>
                     </div>
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
        $empresa = UsuarioDAO::cargaEmpresa($id_empresa);
        $nombre = $empresa->getRazonSocial();
        $direccion = $empresa->getDireccion();
        $localidad = $empresa->getLocalidad();
        $provincia = $empresa->getProvincia();
        $telefono = $empresa->getTelefono();
        $web = $empresa->getWeb();
        $descripcion  = $empresa->getDescripcion();
        $avatar = $empresa->getAvatar();

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
                <img src="img/avatares/$avatar" class="img-rounded" alt="Avatar" width="200" height="200">
            </div> 
        
        <!-- NOMBRE EMPRESA Y LOCALIZACION -->         
            <div class="col-sm-8">  
                <h1 ><strong>$nombre</strong></h1>
                <h3><strong>$localidad</strong></h3>
                <p>$provincia</p>
            </div>
        </div>
        
        <!-- DESCRIPCION -->
        <div class="row">
            <div class="col-sm-12">
                <div class="text-left"><h1>Descripción</h1></div>
                    <table class="table table-hover ">
                        <tr><td><p class="text-justify">$descripcion</p></td></tr>
                    </table>
            </div>
        </div>

        <!-- NUMERO DE OFERTAS ACTIVAS -->
        <div class="row">
            <div class="col-sm-6">
            <div class="text-center"><h1>Ofertas disponibles</h1></div>                          
                <table class="table table-hover ">
                    <tr></td><td><strong>Oferta</strong></td><td><strong>Plazas totales</strong></td></tr>
EOF;

        $ofertas = OfertaDAO::listOfertasEmpresa($id_empresa);
        foreach ($ofertas as $row){
            if(!empty(trim($row[0]))){
                if (strcmp($row[2], "Aceptada") == 0) {
                    $content .="<tr><td>$row[0]</td><td>$row[1]</td></tr>";
                }
            }
        }

        $contratosVigor = ContratoDAO::countContratosActivos($id_empresa);
        $content .= <<<EOF
                </table>
            </div>
            
            <!-- NUMERO DE CONTRATOS EN VIGOR-->
            <div class="col-sm-6">
            <div class="text-center""><h1>Estudiantes contratados</h1></div>
                <table class="table table-hover ">                
                    <tr><td><strong>$contratosVigor</strong></td></tr>
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

    public function generaDemandas($clasificadas){
        if ($clasificadas)
            $demandas = DemandaDAO::cargaDemandasClasificadasEmpresa(30);
        else
            $demandas = DemandaDAO::cargaDemandasNoClasificadasEmpresa(30);
        $listaDemandas = array();
        $listaIds = array();
        foreach ( $demandas as $demanda) {
            $oferta = $demanda->getOferta();
            $estudiante = $demanda->getEstudiante();
            $nombreEstudiante = $estudiante->getNombre() . " " . $estudiante->getApellidos();
            $empresa = $oferta ->getEmpresa();
            $puesto = $oferta->getPuesto();
            $sueldo = $oferta->getSueldo();
            $horas = $oferta->getHoras();
            $estado = $demanda->getEstado();
            $fila = array($nombreEstudiante,$empresa, $puesto,$sueldo, $horas,$estado);
            array_push($listaDemandas,$fila);
            array_push($listaIds, $demanda->getIdDemanda());
        }
        $titulosColumnas = array("Estudiante","Empresa", "Puesto", "Sueldo", "Horas", "Estado");
        $content = self::generaTabla("tabla-oferta","empresa-table" ,
            "Demandas" . (($clasificadas)? ' ' : ' no ') . 'clasificadas',
            $titulosColumnas, $listaDemandas, $listaIds, 'demanda');
        return $content;
    }


    public function generaContratos($finalizado){
    	$contratos = ContratoDAO::cargaContratosPorEstadoEmpresa(20, $finalizado);
			
    	$listaContratos = array();
    	$listaIds = array();
    	foreach ( $contratos as $contrato) {
    		$estudiante = $contrato->getEstudiante();
            $nombreEstudiante = $estudiante->getNombre() . " " . $estudiante->getApellidos();
            $empresa = $contrato->getEmpresa();
    		$puesto = $contrato->getPuesto();
    		$fecha_inicio = $contrato->getFechaInicio();
    		$fecha_fin = $contrato->getFechaFin();
            $estado = $contrato->getEstado();
    		$fila = array($nombreEstudiante, $empresa,$puesto, $fecha_inicio, $fecha_fin,$estado);
    		array_push($listaContratos,$fila);
    		array_push($listaIds, $contrato->getIdContrato());
    	}
    	$titulosColumnas = array("Estudiante", "Empresa", "Puesto", "Inicio", "Fin","Estado");
    	$content = self::generaTabla("tabla-contrato","empresa-table" ,
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
        //Avatar form
        $content = <<<EOF
        <div id="formSettings">
            <div id="avatar" class="col-xs-12">
                <div class="row"><h1> Avatar </h1> </div>           
                    <div id="avatar-div" class="col-md-12">
                        <form id="upload-avatar" action="" method="post" enctype="multipart/form-data">
                            <div id="avatar-div" class="col-md-6">
                                <input type='file' name='avatar-upload' style="width:200px display:inline">
                            </div>
                            <div id="avatar-div" class="col-md-6">
                                <button type="submit" class="btn btn-default">Cambiar avatar</button>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
         </div>
            <script>
                    $("#upload-avatar").on('submit',(function(e) {
                    //e.preventDefault();
                    //$("#message").empty();
                    //$('#loading').show();
                    $.ajax({
                        url: "ajaxRequest.php?val=UPLOAD_AVATAR", // Url to which the request is send
                        type: "POST",             // Type of request to be send, called as method
                        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false,       // The content type used when sending data to the server.
                        cache: false,             // To unable request pages to be cached
                        processData:false,        // To send DOMDocument or non processed data file it is set to false
                        success: function(data)   // A function to be called if request succeeds
                    {
                    $("#avatar-div").html(data);
                    window.location.replace("dashboard.php");
                    }
                    });
                    }));
            </script>
EOF;
        echo $content;
        $formAdmin =  new \es\ucm\aw\internprise\FormularioSettings('empresa');
        $formAdmin->gestiona();
    }
}


