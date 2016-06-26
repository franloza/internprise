<?php

namespace es\ucm\aw\internprise;
use es\ucm\aw\internprise\Aplicacion as App;

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
        $app = App::getSingleton();
        $estudiante = UsuarioDAO::cargaEstudiante($app->idUsuario());
        $avatar = $estudiante->getAvatar();
        $bloqueEstudianteSideBar = <<<EOF
        <!-- Fragmento para definir el menú de estudiante-->
        <div id="estudiante-sidebar" class="sidebar">
            <div id="estudiante-menu-avatar" class="menu-avatar">
                <img src="img/$avatar" alt="Avatar image" width="100%"></img>
                <div id='change-avatar'>
                    <i class="fa fa-pencil" aria-hidden="true"></i> 
                </div>
            </div>
                <ul>
                    <li><a onclick="return loadContent('PERFIL', 'Perfil')" href="#">PERFIL</a></li>
                    <li><a onclick="return loadContent('OFERTAS', 'Ofertas')" href="#">OFERTAS</a></li>
                    <li><a onclick="return loadContent('SOLICITUDES', 'Ofertas')" href="#">SOLICITUDES</a></li>
					<li><a onclick="return loadContent('CONTRATOS', 'Contratos')" href="#">CONTRATOS</a></li>
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
        $numNewOfertas = OfertaDAO::countOfertasEstudiante();
        $widgets .= parent::generarWidget("Nuevas ofertas", $listaOfertas,"envelope-o","blue",$numNewOfertas);
        $widgets .= "<!-- FIN Widget Ofertas activos -->";

        /*Generar contenido widget Novedades */
        $widgets .= "<!-- INI Widget Contratos activos -->";
        //$contratos = ContratoDAO::cargaTodosContratosActivos();
        $novedades = array();
        $novedades = array();
        foreach ( $novedades as $contrato) {

        }
        $widgets .= parent::generarWidget("Novedades", $novedades,"check-circle","green",null);
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

    public function generaPerfil($id_estudiante){
        //TODO: Implementar funcionalidad Avatar

        $app = Aplicacion::getSingleton();

        $user = UsuarioDAO::cargaEstudiante($id_estudiante);

        $nombre = $user->getNombre() . " " . $user->getApellidos();
        $email = $user->getEmail();
        $descripcion = $user->getDescripcion();
        $localizacion = $user->getLocalizacion();
        $experiencia = $user->getExperiencia();
        $estudios = $user->getEstudios();
        $idiomas = $user->getIdiomas();
        $cursos = $user->getCursos();
        $telefono_fijo = $user->getTelefonoFijo();
        $telefono_movil = $user->getTelefonoMovil();
        $redesSociales = $user->getRedesSociales();
        $web = $user->getWeb();
        $avatar = $user->getAvatar();
        $aptitudes = $user->getAptitudes();

        //Bloque contacto
        $bloqueContacto ="<div class='col-md-4'>".
                         "<h2><i class='fa fa-envelope'></i> <a href='mailto:$email'> Email</a></h2>";
        if(!empty(trim($web))) {
            $bloqueContacto .="<h2><a href='$web' class='web'><i class='fa fa-globe'></i> Website</a></h2>";
        }
        $bloqueContacto .="</div>";
        $bloqueContacto .=" <div class='col-md-4 contact-email'>";
        if(!empty(trim($telefono_movil))) {
            $bloqueContacto .="<h3><i class='fa fa-mobile'></i> $telefono_movil</h3>";
        }
        if(!empty(trim($telefono_movil))) {
            $bloqueContacto .="<h3><i class='fa fa-phone'></i> $telefono_fijo</h3>";
        }
        $bloqueContacto .="</div>".
                          "<div class='col-md-4'>";
        $socialCounter = 0;
        for($x = 0;$x < 4; $x++){
            if(!empty(trim($redesSociales[$x]))){
                if($socialCounter==0) {
                    $bloqueContacto .= "<div class='row contact row-first'>";
                }
                elseif ($socialCounter==2){
                    $bloqueContacto .= "<div class='row contact row-second'>";
                }
                $bloqueContacto .="<div class='col-md-6'>";
                switch($x){
                    case 0: {
                        $bloqueContacto .= "<a href='skype:$redesSociales[$x]?call' class='skype'><i class='fa fa-skype'></i>Skype</a>";
                    }break;
                    case 1: {
                        $bloqueContacto .= "<a href='$redesSociales[$x]' class='google'><i class='fa fa-google-plus'></i> Google+</a>";
                    }break;
                    case 2: {
                        $bloqueContacto .= "<a href='$redesSociales[$x]' class='linkedin'><i class='fa fa-linkedin'></i> LinkedIn</a>";
                    }break;
                    case 3: {
                        $bloqueContacto .= "<a href='$redesSociales[$x]' class='twitter'><i class='fa fa-twitter'></i> Twitter</a>";
                    }
                }
                $bloqueContacto .="</div>";

                if ($socialCounter==1) {
                    $bloqueContacto .= "</div>";
                } elseif ($socialCounter==3) {
                    $bloqueContacto .= "</div>";
                }
                else if($x == 3){
                    $bloqueContacto .= "</div>";
                }
                $socialCounter++;
            }
        }


        $content = <<<EOF
        <div class="container" style="width:100%">
        <div class="row">
            <div id="imagen-estudiante" class="col-sm-3">
                <IMG SRC="img/estudiante-avatar.png" class="img-rounded" alt="Avatar" width="200" height="200">
            </div>      
            <div class="col-sm-8">     
                <h1 ><strong>$nombre</strong></h1>
                <h3>$descripcion</h3>
                <p>$localizacion</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
            <div class="text-center"><h1>Experiencia</h1></div>                          
                <table class="table table-hover ">
                    <tr><td><strong>Puesto</strong></td><td><strong>Duración (meses) </strong></td></tr>
EOF;
        foreach ($experiencia as $row){
            if(!empty(trim($row[0]))){
                $content .= "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
            }
        }
        $content .= <<<EOF
                </table>
            </div>
            <div class="col-sm-6">
            <div class="text-center""><h1>Estudios</h1></div>
                <table class="table table-hover ">
                <tr><td><strong>Título</strong></td><td><strong>Centro de impartición</strong></td></tr>
EOF;
        foreach ($estudios as $row){
            if(!empty(trim($row[0]))){
                $content .= "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
            }
        }
        $content .= <<<EOF
                </table>
             </div>
         </div>
         <div class="row">
            <div class="col-sm-6">
                <div class="text-center""><h1>Idiomas</h1></div>
                     <table class="table table-hover ">
                     <tr><td><strong>Idioma</strong></td><td><strong>Nivel</strong></td></tr>
                     
EOF;
        foreach ($idiomas as $row){
            if(!empty(trim($row[0]))){
                $content .= "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
            }
        }
        $content .= <<<EOF
                </table>
             </div>
                     <div class="col-sm-6">
            <div class="text-center""><h1>Cursos</h1></div>
                <table class="table table-hover ">
                <tr><td><strong>Título</strong></td><td><strong>Duración (horas) </strong></td></tr>
EOF;
        foreach ($cursos as $row){
            if(!empty(trim($row[0]))){
                $content .= "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
            }
        }

        $content .= <<<EOF
                </table>
             </div>
         </div> 
        <div class="row">
            <div class="text-left"><h1>Aptitudes</h1>
                <ol class="aptitudes">
EOF;
        foreach ($aptitudes as $aptitud){
            if(!empty(trim($aptitud))){
                $content .= "<li class='btn btn-primary'> $aptitud</li>";
            }
        }
        $content .= <<<EOF
                 </ol>
            </div>
        </div>
        <div class="row">
            <div class="text-left"><h1>Contacto</h1></div>      
        </div>
        <div class="well well-sm quick-contact">
        <div class="row">
            $bloqueContacto
         </div>
        </div>
    </div>              
EOF;
        return $content;
    }

    public function generaOfertas(){
        $app = App::getSingleton();
        $ofertas = OfertaDAO::cargasOfertasEstudiante(null);
        $listaOfertas = array();
        $listaIds = array();
        foreach ( $ofertas as $oferta) {
            $empresa = $oferta ->getEmpresa();
            $puesto = $oferta->getPuesto();
            $sueldo = $oferta->getSueldo();
            $horas = $oferta->getHoras();
            $plazas = $oferta->getPlazas();
            $fila = array($empresa,$puesto,$sueldo, $horas, $plazas);
            array_push($listaOfertas,$fila);
            array_push($listaIds, $oferta->getIdOferta());
        }

        $titulosColumnas = array("Empresa","Puesto", "Sueldo", "Horas", "Plazas");
        $content = self::generaTabla("tabla-ofertas", "estudiante-table",
            "Ofertas disponibles", $titulosColumnas, $listaOfertas, $listaIds, 'oferta');

        return $content;
    	
    }

    public function generaDemandas(){
        $app = App::getSingleton();
        $demandas = DemandaDAO::cargaDemandasEstudiante($app->idUsuario());
        $listaDemandas = array();
        $listaIds = array();
        foreach ( $demandas as $demanda) {
            $oferta = $demanda->getOferta();
            $empresa = $oferta->getEmpresa() ;
            $puesto = $oferta->getPuesto();
            $sueldo = $oferta->getSueldo();
            $horas = $oferta->getHoras();
            $plazas = $oferta->getPlazas();
            $estado = $demanda->getEstado();
            $fila = array($empresa,$puesto,$sueldo, $horas, $plazas,$estado);
            array_push($listaDemandas,$fila);
            array_push($listaIds, $demanda->getIdDemanda());
        }

        $titulosColumnas = array("Empresa","Puesto", "Sueldo", "Horas", "Plazas","Estado");
        $content = self::generaTabla("tabla-demandas", "estudiante-table",
            "Ofertas solicitadas", $titulosColumnas, $listaDemandas, $listaIds, 'demanda');

        return $content;
    }
    public function generaContratos(){
    	$app = App::getSingleton();
    	$contratos = contratoDAO::cargaContratoActivoEstudiante($app->idUsuario());
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
    	$content = self::generaTabla("tabla-contratos","estudiante-table" ,
    			"Contratos", $titulosColumnas, $listaContratos, $listaIds, 'contrato');
    	return $content;
    	
    }

    public function generaSettings(){

        $formAdmin =  new \es\ucm\aw\internprise\FormularioSettings('estudiante');
        $formAdmin->gestiona();
    }
    
    

}



