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
        return parent::generaTitlebarParam("Internprise Empresa");
    }

    public function generaPerfil(){
        // TODO: Implement generaPerfil() method.
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
            $estado = $oferta->getEstado();
            $diasDesdeCreacion = $oferta->getDiasDesdeCreacion();
            $content = <<<EOF
    <!-- Modal dialog oferta -->
        <div id='empresa-modal-content' class="dialogo-modal-content">
            <div id='empresa-modal-header' class="dialogo-modal-header">
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
                <p>Requisitos minimos: $reqMinimos</p>
                <p>Idiomas: $idiomas</p>
                <p>Estado: $estado</p>
                <p>Días desde la creación: $diasDesdeCreacion</p>
            </div>
            <div id='empresa-modal-footer' class="dialogo-modal-footer">
                <button id='modificar-btn' type="button" class="btn btn-info disabled">Modificar</button>
                <button id='eliminar-btn' type="button" class="btn btn-danger">Eliminar</button>
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
        $content = <<<EOF
            <div id="form-crear-oferta" class="form">
                <h2>Rellena los campos de la nueva oferta:</h2>
                <form action="includes/ajaxRequest.php" method="post">
                    <fieldset>
                        <label for="name">Puesto</label>
                        <input type="text" name="puesto">
                        <br>
                        <label for="sueldo">Sueldo</label>
                        <input type="number" name="sueldo">
                        <br>
                        <label for="horas">Horas</label>
                        <input type="number" min="0" max="20" name="horas">
                        <br>
                        <label for="plazas">Plazas</label>
                        <input type="number" name="plazas">
                        <br>
                        <label for="fecha-inicio">Fecha inicio</label>
                        <input type="date" name="fecha-inicio">
                        <br>
                        <label for="fecha-fin">Fecha fin</label>
                        <input type="date" name="fecha-fin">
                        <br>
                        <label for="horas">Descripción</label>
                        <textarea type="text" name="fecha-inicio"></textarea>
                        <br>
                        <input type="submit" tabindex="-1">
                    </fieldset>
                </form>
            </div>
EOF;
        return $content;

    }

    public function generaSettings(){

        $formAdmin =  new \es\ucm\aw\internprise\FormularioSettings('empresa');
        $formAdmin->gestiona();
    }
}


