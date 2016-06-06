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
        $content = <<<EOF
        <div class="container">
        <div class="row">
            <div id="imagen-estudiante" class="col-sm-3">
                <IMG SRC="img/estudiante-avatar.png" class="img-rounded" alt="Avatar" width="200" height="200">
            </div>
            
            <div class="col-sm-8">
                <h1 ><strong>Pedro Sanchez Pérez</strong></h1>
                <h3>Analista de datos y consultor técnico</h3>
                <p>Madrid zona centro y norte</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
            <div class="text-center"><h1>Experiencia</h1></div>
                <table class="table table-hover ">
                    <tr>
                        <td>Actual</td>
                        <td>Analista de datos en Data Center</td>
                    </tr>
    
                    <tr>
                        <td>Anterior</td>
                        <td>Becario en la Universidad Complutense. Tecnico de Infomatica</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
            <div class="text-center""><h1>Educación</h1></div>
                <table class="table table-hover ">
                    <tr>
                        <td>Estudios</td>
                        <td>Grado en Ingeniería Informática</td>
                        <td>Universidad Complutense de Madrid</td>
                        </tr>
        
                        <tr>
                            <td>Idiomas</td>
                            <td>Inglés (C1)</td>
                            <td>Frances (B1) </td>
                        </tr>
                    </table>
             </div>
         </div>      
        <div class="row">
            <div class="text-left"><h1>Aptitudes</h1>
                <div class="aptitudes">
                    <button class="btn btn-primary">SQL Server 2008</button>
                    <button class="btn btn-primary">PL/SQL</button>
                    <button class="btn btn-primary">R</button>
                    <button class="btn btn-primary">Python</button>
                    <button class="btn btn-primary">Microsoft Excel</button>
                    <button class="btn btn-primary">Hadoop</button>
                    <button class="btn btn-primary">SAS</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="text-left"><h1>Contacto</h1></div>      
        </div>
        <div class="well well-sm quick-contact">
        <div class="row">
            <div class="col-md-4">
                <h2><i class="fa fa-envelope"></i> <a href="mailto:psanchez@ucm.com">psanchez@ucm.es</a></h2>
            </div>
            <div class="col-md-4 contact-email">
                <h3><i class="fa fa-mobile"></i> 608 82 66 47</h3>
                <h3><i class="fa fa-phone"></i> 91 847 24 89</h3>
            </div>
            <div class="col-md-4">
                <div class="row contact row-first">
                    <div class="col-md-6">
                        <a href="#" class="skype"><i class="fa fa-skype"></i> Skype</a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="google"><i class="fa fa-google-plus"></i> Google+</a>
                    </div>
                </div>
                <div class="row contact">
                    <div class="col-md-6">
                        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i> LinkedIn</a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="twitter"><i class="fa fa-twitter"></i> Twitter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>              
EOF;
        echo $content;
    }

    public function generaOfertas(){
        $ofertas = OfertaDAO::cargasOfertasEstudiante(20);
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

    public function generaDialogoOferta($idOferta){
        $oferta = OfertaDAO::cargaOferta($idOferta);
        if($oferta) {
            $id = $oferta->getIdOferta();
            $empresa = $oferta->getEmpresa();
            $puesto = $oferta->getPuesto();
            $sueldo = $oferta->getSueldo();
            $fecha_inicio = $oferta->getFechaInicio();
            $fecha_fin = $oferta->getFechaFin();
            $horas = $oferta->getHoras();
            $plazas = $oferta->getPlazas();
            $descripcion = $oferta->getDescripcion();
            $aptitudes = $oferta->getAptitudes();
            $reqMinimos = $oferta->getReqMinimos();
            $idiomas = $oferta->getIdiomas();
            $reqDeseables = $oferta->getReqDeseables();
            $estado = $oferta->getEstado();
            $diasDesdeCreacion = $oferta->getDiasDesdeCreacion();
            $content = <<<EOF
    <!-- Modal dialog oferta -->
        <div id='estudiante-modal-content' class="dialogo-modal-content">
            <div id='estudiante-modal-header' class="dialogo-modal-header">
                <span class="close">×</span>
                <h2>Oferta</h2>
            </div>
            <div class="dialogo-modal-body">
                <p>Id: $id</p>
                <p>Empresa: $empresa</p>
                <p>Puesto: $puesto</p>
                <p>Sueldo: $sueldo</p>
                <p>Fecha inicio: $fecha_inicio</p>
                <p>Fecha fin: $fecha_fin </p>
                <p>Horas: $horas</p>
                <p>Plazas: $plazas</p>
                <p>Descripción: $descripcion</p>
                <p>Aptitudes: $aptitudes</p>
                <p>Requisitos minimos: $reqMinimos</p>
                <p>Idiomas: $idiomas</p>
                <p>Requisitos deseables: $reqDeseables</p>
                <p>Estado: $estado</p>
                <p>Días desde la creación: $diasDesdeCreacion</p>
            </div>
            <div id='estudiante-modal-footer' class="dialogo-modal-footer">
                <button id='aceptar-btn' type="button" class="btn btn-info">Solicitar</button>
            </div>
        </div>
EOF;
        }
        else{
            $content = <<<EOF
            <h1 style="color:red">Fallo al cargar la oferta</h1>
EOF;

        }

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



