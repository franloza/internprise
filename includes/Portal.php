<?php

namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

/**
 * Clase de gestión de portales.
 */
abstract class Portal
{
    /**
     * Cadena utilizada como valor del atributo "rol"  asociada al rol activo del portal.
     */
    protected $rol;

    public function __construct($rol) {
        $this->rol = $rol;
    }

    /**
     * Función que comprueba si el usuario tiene un rol asignado y si este coincide con el de la instancia del portal.
     * Genera un mensaje de error en caso contrario.
     */
    public function checkRol() {
        $app = App::getSingleton();
        if($app -> tieneRol($this->rol)) {
            echo Error::generaErrorPermisos();
            return false;
        }
        return true;
    }

    /**
     * Función que genera el contenido de la página principal del portal.
     * El resto de contenido debe generarse por medio de peticiones AJAX.
     */
    public abstract function generaDashboard();

    /**
     * Función que genera un menú lateral.
     */
    public abstract function generaMenu();


    /**
     * Función que genera un footer al final de la página.
     */
    public function generaFooter() {
        $rol = strtolower($this->rol);
        $bloqueFooter = <<<EOF
        <!-- Fragmento para definir el footer -->
        <div id="$rol-footer" class ="footer">
            Internprise
            <div class="footer-icons">
                <a class="fa fa-github" href="https://github.com/franloza/internprise"></a>
            </div>
        </div>       
EOF;
        return $bloqueFooter;
    }
	
    /**
     * Función que genera los encabezados de la página.
     */
    protected function generaHeadParam($titulo, $imagen)
    {
        $bloqueHead = <<<EOF
        <!-- Fragmento para incluir CSS y JS-->
        <head>
            <meta charset="UTF-8">
            <title>$titulo</title>
            <link rel="stylesheet" href="css/menu.css" type="text/css">
            <link rel="stylesheet" href="css/content.css" type="text/css">
            <link rel="stylesheet" href="css/titlebar&footer.css" type="text/css">
            <link rel="stylesheet" href="css/modal.css" type="text/css">
            <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
            <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
            <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
            <script src="js/jquery-2.2.3.js"></script>
            <script type="text/javascript" src="js/datatables/datatables.min.js"></script>
            <script type="text/javascript" src="js/moment-with-locales.min.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="css/datepicker.css" />
            <script src="js/bootstrap-datepicker.js"></script>

            <!-- css solo para los colores-->
            <link rel="icon" type="image/png" href="$imagen">            
        </head>
EOF;
        return $bloqueHead;
    }

    protected function generarWidget($titulo, $lista,$typeIcon,$colorIcon,$numNewItems)
    {
        $numItems = isset($numNewItems)?$numNewItems:count($lista);
        $typeIcon = isset($typeIcon)?$typeIcon:"envelope";
        $colorIcon = isset($colorIcon)?$colorIcon: "blue";

        $widgetHeader = <<<EOF
            <div class="widget">
                <!-- HEADER -->
                <div class="widget-header">
                    <p class="title">$titulo</p>
                    <p class="title-items">
                        <a class="square" href="#">$numItems</a>
                    </p>
                </div>
EOF;
        $contenido = $widgetHeader . '<div class="content-widget">';

        foreach($lista as $item) {
            $itemTitle = $item[0];
            $itemSubtitle = $item[1];
            $itemDescription= $item[2];

            $widgetContent = <<<EOF
                    <div class="widget-media">
                        <div class="widget-media-left">
                            <i class="fa fa-$typeIcon" style="color:$colorIcon;"></i>
                        </div>
                        <div class="widget-media-body">
                            <div class="widget-media-header">
                                <strong>$itemTitle</strong>
                                $itemSubtitle
                            </div>
                            <div class="text-muted">
                                <small>$itemDescription</small>
                            </div>
                        </div>
                    </div>
EOF;
            $contenido = $contenido . $widgetContent;
        }
        $contenido = $contenido . "</div></div>";

        return $contenido;
    }

    /*
     * Función que genera una tabla.
     */
    protected function generaTabla($idTabla, $classTable,
                                   $tituloTabla, $titulosColumnas, $arrayFilas, $arrayIds = NULL, $data = NULL){
        //Para evaluar si cada fila de la tabla tiene un atributo data-* para poder clickarla
        $ids = false;
        //Guarda el atributo de la fila, ya sea de ofertas, demandas, contratos...
        $dataAttribute = 'data-id';
        if($arrayIds != NULL && count($arrayFilas) === count($arrayIds)) {
            $ids = true;
            if($data === 'oferta')
                $dataAttribute .= '-oferta';
            else if ($data === 'demanda')
                $dataAttribute .= '-demanda';
            else if ($data === 'contrato')
                $dataAttribute .= '-contrato';
        }

        $tabla = <<<EOF
        <!-- Tabla de $tituloTabla -->
        <div id="$idTabla" class="table-container">
             <table class="$classTable table table-striped table-bordered table-hover">
                <thead>
                    <tr>
EOF;
        foreach ($titulosColumnas as $titulo){
            $tabla .= "<th>";
            $tabla .= $titulo;
            $tabla .= "</th>\n";
        }
        $tabla .= "</tr>\n";
        $tabla .= "</thead>\n";

        $tabla .= "<tbody>\n";
        foreach($arrayFilas as $fila_key => $fila){
            if($ids)
                $tabla .= "<tr $dataAttribute='$arrayIds[$fila_key]' onclick='showDialog(this, \"$dataAttribute\")'>\n";
            else
                $tabla .= "<tr>\n";
            foreach($fila as $celda){
                //Colorear estado
                switch ($celda) {
                    /*Estados oferta*/
                    case 'Aceptada':{$tabla .= "<td class='cell-status'>\n\t<label class='pass'>Aceptada</label>";break;}
                    case 'Rechazada':{$tabla .= "<td class='cell-status'>\n\t<label class='fail'>Rechazada</label>";break;}
                    case 'Pendiente':{$tabla .= "<td class='cell-status'>\n\t<label class='warning'>Pendiente</label>";break;}
                    /*Estados demanda*/
                    case 'Pendiente de Universidad':{$tabla .= "<td class='cell-status'>\n\t<label class='warning'>Pendiente de Universidad</label>";break;}
                    case 'Pendiente de Empresa':{$tabla .= "<td class='cell-status'>\n\t<label class='warning'>Pendiente de Empresa</label>";break;}
                    case 'Rechazada por Universidad':{$tabla .= "<td class='cell-status'>\n\t<label class='fail'>Rechazada por Universidad</label>";break;}
                    case 'Rechazada por Empresa':{$tabla .= "<td class='cell-status'>\n\t<label class='fail'>Rechazada por Empresa</label>";break;}
                    /*Estados contrato*/
                    case 'Activo':{$tabla .= "<td class='cell-status'>\n\t<label class='pass'>Activo</label>";break;}
                    case 'Expirado':{$tabla .= "<td class='cell-status'>\n\t<label class='fail'>Expirado</label>";break;}
                    default: { $tabla .= "<td>"; $tabla .= $celda;}
                }
                $tabla .= "</td>\n";
            }
            //$tabla .= "<td><a href=\"#\">Ver</a></td>\n";
            //$tabla .= "<td><a onclick=\"return loadContent('OFERTAS_ADMIN')\" href='dashboard.php'>Ver</a></td>";
            $tabla .= "</tr>\n";
        }
        $tabla .= "<tbody>\n";
        $tabla .= "</table>\n";
        $tabla .= "</div>\n";
        $tabla .= <<<EOF
        <!-- Modal dialog oferta -->
    <div class="dialogo-modal">
        <div class="dialogo-modal-content">
            <div class="dialogo-modal-header">
                <i class=" fa fa-times close"></i>
                <h2>Modal Header</h2>
            </div>
            <div class="dialogo-modal-body">
                <p>Id: </p>
            </div>
            <div class="dialogo-modal-footer">
                <h3>Modal Footer</h3>
            </div>
        </div>
    </div>
        <script>
            $('.table').DataTable( {
                "language": {
                    "url": "js/datatables/Spanish.json"
                },
                "processing": true,
                "pagingType": "full_numbers",
                deferRender: true,
                "fixedHeader": true,
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
                "pageLength": 25,
                colReorder: true,
                select: true,
                select: {
                    style: 'api',
                    blurable: true
                },
                "dom": 'Blfrtip',
                buttons: [
                    'pdf',
                    'print',
                    {
                        text: 'Recargar',
                        action: function (e, dt, node, config){
                            dt.ajax.reload();
                        }
                    }
                ]
            } );
            function showDialog(row, rowType) {
                var value, id;
                if(rowType == 'data-id-oferta')
                    value = 'MDO';
                else if (rowType == 'data-id-demanda')
                    value = 'MDD';
                else if (rowType == 'data-id-contrato')
                    value = 'MDC';
                id = row.getAttribute(rowType);
                //Petición ajax para cargar los datos de la oferta
                $.get("ajaxRequest.php?val=" + value + '_' + id, function(data, status){
                    //Mete el html recibido dentro del div del dialogo modal
                    $('.dialogo-modal').html(data);
                    //Muestra el dalogo modal
                    $('.dialogo-modal').css('display','block');
                    
                    // Cuando el usuario pulsa en la X para cerrar el dialogo
                    $(".close").click (function() {
                        $(".dialogo-modal").css('display', 'none');
                    });       
                });
            }
        </script>
EOF;
        return $tabla;
    }
    
    /*
     * Función que genera la barra de iconos del portal.
     */
    protected function generaTitlebarParam($titulo)
    {
        $urlLogout = $_SERVER['PHP_SELF'] . '?logout';
        $rol = strtolower($this->rol);
        $bloqueTitleBar = <<<EOF
    <!-- Fragmento para definir el titlebar del Portal -->
    <div id="$rol-titlebar" class='titlebar'>
        <i class="fa fa-bars fa-lg burger" aria-hidden="true"></i>
        <img src="img/favicon-$rol.png" alt="Internprise icon" height="70" width="70"></img>
        <div id="label-titlebar">
            <label>
                <a id="title-site" onclick="return loadContent('DASHBOARD')" href="#">$titulo</a>
                <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i>
                <a id="current-page" href="dashboard.php">Dashboard</a>
            </label>
        </div>
        <nav id="icons-titlebar">
            <ul>
                <li onclick="return loadContent('NOTIFICATIONS', 'Notifications')" >
                    <a href="#">
                        <i id="bell" class="fa fa-bell fa-lg"></i>
                    </a>
                </li>
                <li onclick="return loadContent('SETTINGS', 'Modificar perfil')">
                    <a href="#">
                        <i id="settings" class="fa fa-cog fa-lg"></i>
                    </a>                        
                </li>
                <li>
                    <a href=$urlLogout>
                        <i class="fa fa-power-off fa-lg"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="search-bar">
       
           <form method="post" action="#" accept-charset="utf-8">
               <input list="list666" type="text" onkeyup="validate('buscador', this)" maxlength="100" name="buscador" placeholder="Buscador..."/>
			   <datalist class="i_reg" id="list666"></datalist>
           </form>
           
       </div>
    </div>
EOF;

        return $bloqueTitleBar;
    }


    public static function factory($rol) {
        if ($rol === "Admin"){
            return new PortalAdministracion();
        }elseif ($rol === "Estudiante") {
            return new PortalEstudiante();
        }elseif ($rol === "Empresa") {
            return new PortalEmpresa();
        }
        return false;
    }

    public function generaScriptsAdicionales(){
        $bloqueScripts = <<<EOF
        <!-- script para peticiones asíncronas AJAX -->
        <script>
            function loadContent(value, currentPage) { 
                 $.get("ajaxRequest.php?val=" + value, function(data, status){
                    $('#dashboard-content').html(data);
                    $('#current-page').text(currentPage);
                 });     
            }
            function subMenu(showHide, id){
                if(showHide)
                    $('#'+id).slideDown(200);
                else
                    $('#'+id).slideUp(200);
            }
        </script>
        
        <!-- script para cargar perfil -->
        <script>
        function cargaPerfil(id) { 
             $.get("ajaxRequest.php?val=CARGA_PERFIL&op=" + id , function(data, status){
                if (data) {
                    $('#dashboard-content').html(data);
                    $('#current-page').text(currentPage);
                }
             });     
        }
        </script>
        
        <!-- script para lista infinita de aptitudes (Settings) -->
        <script>
         function addInputAptitud() { 
               $('#all-aptitudes').append('<div class="form-group col-xs-2"><input type="text" class="form-control" name="aptitudes[]"/></div>');  
          }                
        </script>
        
        
EOF;
        return $bloqueScripts;
    }

    public function generaDialogoOferta ($idOferta){
        $cssClass = "";
        switch ($this->rol){
            case 'Admin': $cssClass = 'admin'; break;
            case 'Estudiante': $cssClass = 'estudiante'; break;
            case 'Empresa': $cssClass = 'empresa'; break;
        }
        $content = <<<EOF
    <!-- Modal dialog oferta -->
        <!-- Scripts para el dialogo -->
        <script>  
            //Funciones para aceptar/rechazar oferta en portal administrador      
            function aceptarOferta(id) {
                 $('#aceptar-btn').hide();
                 $('#rechazar-btn').hide();
                 $('.dialogo-modal-body').html('<h1>Procesando...</h1>');
                //Petición ajax para aceptar oferta
                $.ajax({
                    type: 'GET',
                    url: "ajaxRequest.php?val=ACEPTAR_OFERTA&op="+id,
                    success: function (data) { 
                        $('.dialogo-modal-body').html('<h1>'+data+'</h1>');
                     },
                    error: function (data) { 
                        $('.dialogo-modal-body').html('<h1>'+data+'</h1>');}
                })       
            }
            
            function rechazarOferta(id) {
                 $('#aceptar-btn').hide();
                 $('#rechazar-btn').hide();
                 $('.dialogo-modal-body').html('<h1>Procesando...</h1>');
                //Petición ajax para aceptar demanda
                $.ajax({
                    type: 'GET',
                    url: "ajaxRequest.php?val=RECHAZAR_OFERTA&op="+id,
                    success: function (data) { 
                        $('.dialogo-modal-body').html('<h1>'+data+'</h1>');
                     },
                    error: function (data) { 
                        $('.dialogo-modal-body').html('<h1>'+data+'</h1>');}
                })       
            }                 
            
            //Funcion para solicitar oferta en portal estudiante
            function solicitarOferta(id) {
                 $('#solicitar-btn').hide();
                 $('.dialogo-modal-body').html('<h1>Procesando...</h1>');
                //Petición ajax para aceptar demanda
                $.ajax({
                    type: 'GET',
                    url: "ajaxRequest.php?val=CREAR_DEMANDA&op="+id,
                    success: function (data) { 
                        $('.dialogo-modal-body').html('<h1>'+data+'</h1>');
                     },
                    error: function (data) { 
                        $('.dialogo-modal-body').html('<h1>'+data+'</h1>');}
                })       
            }
            
            //Funcion para eliminar oferta en portal empresa
            function eliminarrOferta(id) {
                 $('#eliminar-btn').hide();
                 $('.dialogo-modal-body').html('<h1>Procesando...</h1>');
                //Petición ajax para aceptar demanda
                $.ajax({
                    type: 'GET',
                    url: "ajaxRequest.php?val=ELIMINAR_OFERTA&op="+id,
                    success: function (data) { 
                        $('.dialogo-modal-body').html('<h1>'+data+'</h1>');
                     },
                    error: function (data) { 
                        $('.dialogo-modal-body').html('<h1>'+data+'</h1>');}
                })       
            }   
        </script> 
     
        <div id='$cssClass-modal-content' class="dialogo-modal-content">
            <div id='$cssClass-modal-header' class="dialogo-modal-header text-center">
                <i class=" fa fa-times close"></i>
EOF;
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

            $bloqueAptitudes = "<ol class='aptitudes'>";
            foreach ($aptitudes as $aptitud){
                if(!empty(trim($aptitud))){
                    $bloqueAptitudes .= "<li class='btn btn-primary'> $aptitud</li>";
                }
            }
            $bloqueAptitudes .= "</ol>";

            if ($this->rol === 'Admin')
                $content .= "<h3 class=\"h3\">$puesto (ID: $id)</h3>";
            else
                $content .= "<h3 class=\"h3\">$puesto</h3>";

            $content .= <<<EOF
            </div>
            <div class="dialogo-modal-body">
                <div class="container" style="width:100%">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Empresa</h4>
                            <p>$empresa</p>
                        </div>
                        <div class="col-md-4">
                            <h4>Plazas</h4>
                            <p>$plazas</p>
                        </div>
                        <div class="col-md-4">
                            <h4>Sueldo</h4>
                            <p>$sueldo €</p>
                        </div>             
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Horas</h4>
                            <p>$horas h </p>
                        </div>
                        <div class="col-md-4">
                            <h4>Fecha inicio</h4>
                            <p>$fecha_inicio</p>
                        </div>
                        <div class="col-md-4">
                            <h4>Fecha fin</h4>
                            <p>$fecha_fin</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Aptitudes recomendables</h4>
                            <p>$bloqueAptitudes</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Idiomas</h4>
                            <p>$idiomas</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Requisitos mínimos</h4>
                            <p>$reqMinimos</p>
                        </div>        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Descripción</h4>
                            <p>$descripcion</p>
                        </div>
                    </div>
EOF;
            if ($this->rol === 'Admin' || $this->rol === 'Empresa'){
                $content .= <<<EOF
                 <div class="row">
                        <div class="col-md-6">
                            <h4>Estado</h4>
                            <p>$estado</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Días desde creación</h4>
                            <p>$diasDesdeCreacion</p>
                        </div>
                    </div>
EOF;
            }
            $content .= <<<EOF
            </div>     
            </div>
            <div id='$cssClass-modal-footer' class="dialogo-modal-footer">
EOF;
            if ($this->rol === 'Admin') {
                $content .= "<button id='aceptar-btn' type='button' class='btn btn-success' onclick='aceptarOferta($id)'>Aceptar</button>";
                $content .= "<button id='rechazar-btn' type='button' class='btn btn-danger' onclick='rechazarOferta($id)'>Rechazar</button>";
            } else if ($this->rol === 'Empresa') {
                $content .= "<button id='eliminar-btn' type='button' class='btn btn-danger' onclick='eliminarrOferta($id)'>Eliminar</button>";
            }
            else if ($this->rol === 'Estudiante') {
                $content .= "<button id='solicitar-btn' type='button' class='btn btn-success' onclick='solicitarOferta($id)'>Solicitar</button>";
            }
            $content .= "</div>";
            $content .= "</div>";

        }
        else
            //Error message
            $content .=<<<EOF
            </div>
            <div class="dialogo-modal-body">
                <div class="container" style='width:100%'>
                    <h1 style='color:red'>Fallo al cargar la oferta</h1>
                </div>         
            </div>
            <div id='$cssClass-modal-footer' class="dialogo-modal-footer"></div>                                      
EOF;

        return $content;
    }

    public function generaDialogoDemanda ($idDemanda)
    {
        $cssClass = "";
        switch ($this->rol) {
            case 'Admin':
                $cssClass = 'admin';
                break;
            case 'Estudiante':
                $cssClass = 'estudiante';
                break;
            case 'Empresa':
                $cssClass = 'empresa';
                break;
        }
        $content = <<<EOF
    <!-- Modal dialog demanda -->
        <div id='$cssClass-modal-content' class="dialogo-modal-content">
            <div id='$cssClass-modal-header' class="dialogo-modal-header text-center">
                <i class=" fa fa-times close"></i>
EOF;
        $demanda = DemandaDAO::cargaDemanda($idDemanda);
        if ($demanda) {
            $estudiante = $demanda->getEstudiante();
            $oferta = $demanda->getOferta();
            $id = $demanda->getIdDemanda();
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

            $bloqueAptitudes = "<ol class='aptitudes'>";
            foreach ($aptitudes as $aptitud) {
                if (!empty(trim($aptitud))) {
                    $bloqueAptitudes .= "<li class='btn btn-primary'> $aptitud</li>";
                }
            }
            $bloqueAptitudes .= "</ol>";

            if ($this->rol === 'Admin')
                $content .= "<h3 class=\"h3\">$puesto (ID: $id)</h3>";
            else
                $content .= "<h3 class=\"h3\">$puesto</h3>";

            //Inicio contenido
            $content .= <<<EOF
            </div>
            <div class="dialogo-modal-body">
                <div class="container" style="width:100%">                  
EOF;

            //Información del estudiante
            if ($this->rol === 'Admin' || $this->rol === 'Empresa') {
                $nombre = $estudiante->getNombre() . " " . $estudiante->getApellidos();
                $grado = $estudiante->getGrado();
                $idEstudiante = $estudiante->getId();
                $content .= <<<EOF
                 <div class="row">
                 <h2> Información del estudiante </h2>
                        <div class="col-md-6">
                            <h3><b>$nombre</b></h3>
                        </div>   
                         <div class="col-md-4">
                            <h3>$grado</h3>
                        </div>                    
                        <div class="col-md-2">
                            <h3><button id='perfil-btn' type='button' class='btn btn-info' onclick='cargaPerfil($idEstudiante)'>Ver Perfil</button></h3>
                        </div>                       
                    </div>
EOF;
            }

            //Información de la oferta
            $content .= <<<EOF
            <div class="row">
            <h2> Información de la oferta </h2>
                <div class="col-md-4">
                    <h4>Empresa</h4>
                    <p>$empresa</p>
                </div>
                <div class="col-md-4">
                    <h4>Plazas</h4>
                    <p>$plazas</p>
                </div>
                <div class="col-md-4">
                    <h4>Sueldo</h4>
                    <p>$sueldo €</p>
                </div>             
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h4>Horas</h4>
                    <p>$horas </p>
                </div>
                <div class="col-md-4">
                    <h4>Fecha inicio</h4>
                    <p>$fecha_inicio</p>
                </div>
                <div class="col-md-4">
                    <h4>Fecha fin</h4>
                    <p>$fecha_fin</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4>Aptitudes recomendadas</h4>
                    <p>$bloqueAptitudes</p>
                </div>
                <div class="col-md-6">
                    <h4>Idiomas</h4>
                    <p>$idiomas</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Requisitos mínimos</h4>
                    <p>$reqMinimos</p>
                </div>        
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Descripción</h4>
                    <p>$descripcion</p>
                </div>
            </div>
EOF;

            //Campos adicionales oferta
            if ($this->rol === 'Admin' || $this->rol === 'Empresa') {
                $content .= <<<EOF
                 <div class="row">
                        <div class="col-md-6">
                            <h4>Estado</h4>
                            <p>$estado</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Días desde creación</h4>
                            <p>$diasDesdeCreacion</p>
                        </div>
                    </div>
EOF;
            }

            //Cierre contenido
            $content .= <<<EOF
            </div>     
            </div>
            <div id='$cssClass-modal-footer' class="dialogo-modal-footer">
EOF;
            if ($this->rol === 'Admin' || $this->rol === 'Empresa') {
                $content .= "<button id='aceptar-btn' type='button' class='btn btn-success' onclick='aceptarDemanda($id)'>Aceptar</button>";
                $content .= "<button id='rechazar-btn' type='button' class='btn btn-danger' onclick='rechazarDemanda($id)'>Rechazar</button>";
                $content .= "</div>";
                $content .= "</div>";
            }
            $content .= <<<EOF
            <!--Script para aceptar/rechazar demanda en portal administrador/empresa-->
            <script>
                function aceptarDemanda(id) {
                     $('#aceptar-btn').hide();
                     $('#rechazar-btn').hide();
                     $('.dialogo-modal-body').html('<h1>Procesando...</h1>');
                    //Petición ajax para aceptar demanda
                    $.ajax({
                        type: 'GET',
                        url: "ajaxRequest.php?val=ACEPTAR_DEMANDA&op="+id,
                        success: function (data) { 
                            $('.dialogo-modal-body').html('<h1>'+data+'</h1>');
                         },
                        error: function (data) { 
                            $('.dialogo-modal-body').html('<h1>'+data+'</h1>');}
                    })       
                }
                
                function rechazarDemanda(id) {
                     $('#aceptar-btn').hide();
                     $('#rechazar-btn').hide();
                     $('.dialogo-modal-body').html('<h1>Procesando...</h1>');
                    //Petición ajax para aceptar demanda
                    $.ajax({
                        type: 'GET',
                        url: "ajaxRequest.php?val=RECHAZAR_DEMANDA&op="+id,
                        success: function (data) { 
                            $('.dialogo-modal-body').html('<h1>'+data+'</h1>');
                         },
                        error: function (data) { 
                            $('.dialogo-modal-body').html('<h1>'+data+'</h1>');}
                    })       
                }
            </script>           
EOF;
        }
        else
            //Error block
            $content .= <<<EOF
            </div>
            <div class="dialogo-modal-body">
                <div class="container" style='width:100%'>
                    <h1 style='color:red'>Fallo al cargar la oferta</h1>
                </div>         
            </div>
            <div id='$cssClass-modal-footer' class="dialogo-modal-footer">
            </div>
EOF;
        return $content;
    }

    public function generaDialogoContrato ($idContrato)
    {
        $cssClass = "";
        switch ($this->rol) {
            case 'Admin':
                $cssClass = 'admin';
                break;
            case 'Estudiante':
                $cssClass = 'estudiante';
                break;
            case 'Empresa':
                $cssClass = 'empresa';
                break;
        }
        $content = <<<EOF
    <!-- Modal dialog contrato -->
        <div id='$cssClass-modal-content' class="dialogo-modal-content">
            <div id='$cssClass-modal-header' class="dialogo-modal-header text-center">
                <i class=" fa fa-times close"></i>
EOF;
        $contrato = ContratoDAO::cargaContrato($idContrato);
        if ($contrato) {
            
            $id = $contrato->getIdContrato();
			$estudiante = $contrato->getEstudiante();
            $empresa = $contrato->getEmpresa();
            $puesto = $contrato->getPuesto();
            $fecha_fin = $contrato->getFechaFin();
            $fecha_inicio  =$contrato->getFechaInicio();
			$horas = $contrato->getHoras();
			$salario = $contrato->getSalario();
            $estado = $contrato->getEstado();
            //Inicio contenido
			
            $nombre = $estudiante->getNombre() . " " . $estudiante->getApellidos();
            $grado = $estudiante->getGrado();
            $idEstudiante = $estudiante->getId();

            if ($this->rol === 'Admin')
                $content .= "<h3 class=\"h3\">Información del contrato (ID: $id)</h3>";
            else
                $content .= "<h3 class=\"h3\">Información del contrato</h3>";
            $content .= <<<EOF
            </div>
            <div class="dialogo-modal-body">
                <div class="container" style="width:100%">                  
EOF;

            //Información del contrato

            $content .= <<<EOF
             <div class="row">
				<div class="col-md-4">
                    <h4>Estudiante</h4>
                    <p>$nombre</p>
				</div>   
				 <div class="col-md-4">
                    <h4>Grado</h4>
                    <p>$grado</p>
				</div>                    
				<div class="col-md-4">
				    <h4>enlace</h4>
                    <p><button id='perfil-btn' type='button' class='btn btn-info' onclick='cargaPerfil($idEstudiante)'>Ver Perfil</button></p>
				</div>                       
            </div>
            <div class="row">
				<div class="col-md-12">
					<h4>Empresa</h4>
					<p>$empresa</p>
				</div>           
            </div>
            <div class="row">
			   <div class="col-md-4">
				   <h4>Puesto</h4>
				   <p>$puesto h </p>
			   </div>
			   <div class="col-md-4">
				   <h4>Fecha inicio</h4>
				   <p>$fecha_inicio</p>
			   </div>
			   <div class="col-md-4">
				   <h4>Fecha fin</h4>
				   <p>$fecha_fin</p>
			   </div>
            </div>
			<div class="row">
			   <div class="col-md-4">
				   <h4>Horas</h4>
				   <p>$horas </p>
			   </div>
			   <div class="col-md-4">
				   <h4>Salario</h4>
				   <p>$salario</p>
			   </div>
			   <div class="col-md-4">
				   <h4>Estado</h4>
				   <p>$estado</p>
			   </div>
            </div>
EOF;
            //Cierre contenido
            $content .= <<<EOF
            </div>     
            </div>
            <div id='$cssClass-modal-footer' class="dialogo-modal-footer">
EOF;
            if (($this->rol === 'Admin' || $this->rol === 'Empresa') && $estado === "Activo" ) {
                $content .= "<button id='finalizar-btn' type='button' class='btn btn-danger' onclick='finalizarContrato($id)'>Finalizar</button>";
                $content .= "</div>";
                $content .= "</div>";
        	}
		$content .= <<<EOF
            <!--Script para finalizar contrato en portal administrador/empresa-->
            <script>
                function finalizarContrato(id) {
                     $('#finalizar-btn').hide();
                     $('.dialogo-modal-body').html('<h1>Procesando...</h1>');
                    //Petición ajax para finalizar contrato
                    $.ajax({
                        type: 'GET',
                        url: "ajaxRequest.php?val=FINALIZAR_CONTRATO&op="+id,
                        success: function (data) {
                            $('.dialogo-modal-body').html('<h1>'+data+'</h1>');
                         },
                        error: function (data) {
                            $('.dialogo-modal-body').html('<h1>'+data+'</h1>');}
                    })
                }
    
            </script>
EOF;
		}
        else
            //Error block
            $content .= <<<EOF
            </div>
            <div class="dialogo-modal-body">
                <div class="container" style='width:100%'>
                    <h1 style='color:red'>Fallo al cargar la oferta</h1>
                </div>         
            </div>
            <div id='$cssClass-modal-footer' class="dialogo-modal-footer">
            </div>
EOF;
        return $content;
    }

}
