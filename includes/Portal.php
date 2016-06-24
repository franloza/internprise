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
        <!-- Fragmento para incluir CSS -->
        <head>
            <meta charset="UTF-8">
            <title>$titulo</title>
            <link rel="stylesheet" href="css/menu.css" type="text/css">
            <link rel="stylesheet" href="css/content.css" type="text/css">
            <link rel="stylesheet" href="css/titlebar&footer.css" type="text/css">
            <link rel="stylesheet" href="css/modal.css" type="text/css">
            <link rel="stylesheet" href="css/font-awesome-4.5.0/css/font-awesome.min.css">
            <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
            <script src="js/jquery-2.2.3.js"></script>
            <script type="text/javascript" src="js/datatables/datatables.min.js"></script>
            <!-- css solo para los colores-->
            <link rel="icon" type="image/png" href="$imagen">            
        </head>
EOF;
        return $bloqueHead;
    }

    protected function generarWidget($titulo, $lista,$typeIcon,$colorIcon )
    {
        $numItems = count($lista);
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
                    default: { $tabla .= "<td>"; $tabla .= $celda;}
                }
                $tabla .= "</td>\n";
            }
            // TODO: Implement generaDialogoModal() for each oferta
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
                <span class="close">×</span>
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
                        text: 'Borrar filas seleccionadas',
                        action: function (e, dt, node, config){
                        }
                    },
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
        //TODO: Implementar correctamente los enlaces
        $bloqueTitleBar = <<<EOF
    <!-- Fragmento para definir el titlebar del Portal -->
    <div id="$rol-titlebar" class='titlebar'>
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
			   <datalist id="list666"></datalist>
           </form>
           
       </div>
    </div>
EOF;

        return $bloqueTitleBar;
    }

    protected function generaPerfil($id_usuario)
    {


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
        
        <!-- script para lista infinita de aptitudes (Settings) -->
        <script>
         function addInputAptitud() { 
               $('#all-aptitudes').append('<div class="form-group col-xs-2"><input type="text" class="form-control" name="aptitudes[]"/></div>');  
          }                
        </script>
        
        <!--Script para solicitar oferta en portal estudiante-->
        <script>
            function solicitarOferta(id) {
                 $('#aceptar-btn').hide();
                 $('.dialogo-modal-body').html('<h1>Procesando...</h1>');
                //Petición ajax para solicitar oferta
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
        </script>
EOF;
        return $bloqueScripts;
    }
}
