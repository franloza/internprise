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
                    <li onmouseenter="subMenu(true, 'sub-menu-ofertas')" onmouseleave="subMenu(false, 'sub-menu-ofertas')">
                        <a onclick="subMenu(true, 'sub-menu-ofertas')" href="#">OFERTAS</a>
                        <div id="sub-menu-ofertas" class="sub-menu">
                            <ul>
                                <li><a onclick="return loadContent('OFERTAS_CLASIFICADAS', 'Ofertas clasificadas')" href="#">Clasificadas</a></li>
                                <li><a onclick="return loadContent('OFERTAS_NO_CLASIFICADAS', 'Ofertas no clasificadas')" href="#">No clasificadas</a></li>
                            </ul>
                        </div>
                    </li>
                    <li onmouseenter="subMenu(true, 'sub-menu-demandas')" onmouseleave="subMenu(false, 'sub-menu-demandas')">
                        <a onclick="subMenu(true, 'sub-menu-demandas')" href="#">DEMANDAS</a>
                        <div id="sub-menu-demandas" class="sub-menu">
                            <ul>
                                <li><a onclick="return loadContent('DEMANDAS_CLASIFICADAS', 'Demandas clasificadas')" href="#">Clasificadas</a></li>
                                <li><a onclick="return loadContent('DEMANDAS_NO_CLASIFICADAS', 'Demandas no clasfificadas')" href="#">No clasificadas</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a onclick="return loadContent('CONTRATOS', 'Contratos')" href="#">VER CONTRATOS</a></li>
                    <li><a onclick="return loadContent('HISTORIAL', 'Historial')" href="#">HISTORIAL</a></li>
                    <li><a onclick="return loadContent('ENCUESTAS', 'Encuestas')" href="#">ENCUESTAS</a></li>
                    <li><a onclick="return loadContent('BUZON', 'Buzon')" href="#">BUZÓN</a></li>
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
                   <form method="post" action="#" accept-charset="utf-8">
                       <input id="busqueda" name="busqueda" value="" autocomplete="off" maxlength="30" class="txt-search" type="text" placeholder="Buscador de estudiantes / empresas">
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
        return parent::generaTitlebarParam("Internprise Administración");
    }

    public function generaOfertas($clasificadas){
        if ($clasificadas) {
            $ofertas = OfertaDAO::cargaOfertasClasificadas(30, null);
            $ajaxTableContent = 'OFERTAS_CLASIFICADAS';
        }
        else {
            $ofertas = OfertaDAO::cargaOfertasNoClasificadas(30, null);
            $ajaxTableContent = 'OFERTAS_NO_CLASIFICADAS';
        }
        $listaOfertas = array();
        foreach ( $ofertas as $oferta) {
            $empresa = $oferta ->getEmpresa();
            $puesto = $oferta->getPuesto();
            $sueldo = $oferta->getSueldo();
            $horas = $oferta->getHoras();
            $plazas = $oferta->getPlazas();
            $estado = $oferta->getEstado();
            $fila = array($empresa, $puesto,$sueldo, $horas, $plazas, $estado);
            array_push($listaOfertas,$fila);
        }
        $titulosColumnas = array("Empresa", "Puesto", "Sueldo", "Horas", "Plazas", "Estado");
        $content = self::generaTabla("tabla-oferta","admin-table" ,"Ofertas" . (($clasificadas)? ' ' : ' no ') . 'clasificadas', $titulosColumnas, $listaOfertas);

        //Inicialización de DataTable y cambio de la página actual
        /*$content .= <<<EOF
        <script>
            $('.table').DataTable( {
                serverSide: true,
                "ajax": {
                    "url": "ajaxRequest.php?table=$ajaxTableContent",
                    "type": "POST"
                },
                "columns":[
                    {"data": "id" },
                    {"data": "empresa" },
                    {"data": "puesto" },
                    {"data": "sueldo" },
                    {"data": "horas" },
                    {"data": "plazas" },
                    {"data": "estado" }
                    ],
                "language": {
                    "url": "js/datatables/Spanish.json"
                },
                "processing": true,
                "pagingType": "full_numbers",
                deferRender: true,
                fixedHeader: true,
                colReorder: true,
                select: true,
                "dom": 'Blfrtip',
                buttons: [
                    'pdf',
                    {
                        text: 'Borrar filas seleccionadas',
                        action: function (e, dt, node, config){
                            dt.ajax.reload();
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
        </script>
EOF;
        */
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

    public function returnTableData($table){
        //require (__DIR__ . '/includes/ssp.class.php');
        //$app = App::getSingleton();
        //$conn = $app->conexionBd();
        $sql_details = array(
            'user' => 'internprise',
            'pass' => 'aprobamos2016',
            'db'   => 'internprise',
            'host' => 'localhost'
        );
        $table = 'ofertas';
        $primaryKey = 'id_oferta';
        $columns = array(
            array( 'db' => 'id_oferta', 'dt' => 'id_oferta' ),
            array( 'db' => 'id_empresa',  'dt' => 'last_name' ),
            array( 'db' => 'position',   'dt' => 'position' ),
            array( 'db' => 'office',     'dt' => 'office' ),
            array(
                'db'        => 'start_date',
                'dt'        => 'start_date',
                'formatter' => function( $d, $row ) {
                    return date( 'jS M y', strtotime($d));
                }
            ),
            array(
                'db'        => 'salary',
                'dt'        => 'salary',
                'formatter' => function( $d, $row ) {
                    return '$'.number_format($d);
                }
            )
        );

        echo json_encode(
            SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
        );
    }

    public function generaSettings(){

        $app = Aplicacion::getSingleton();
        $id_administrador = $app->idUsuario();
        $user = UsuarioDAO::cargaAdministrador($id_administrador);
        
        $email = $user->getEmail();
        $password = $user->getPassword();
        $nombre = $user->getNombre();
        $apellidos = $user->getApellidos();
        $nombre_universidad = $user->getNombreUniversidad();
        $sexo = $user->getSexo();
        $direccion = $user->getDireccion();
        $localidad = $user->getLocalidad();
        $provincia = $user->getProvincia();
        $pais = $user->getPais();
        $web = $user->getWeb();
        $telefono = $user->getTelefono();
        $cp = $user->getCp();


        $hChecked = ($sexo == 'Hombre') ? "checked" : "";
        $mChecked = ($sexo == 'Mujer') ? "checked" : "";

        $content = <<<EOF
       <legend>Cambios en el perfil: </legend>
        <p><label>eMail:</label> <input type="text" name="email" value="$email"/></p>
        <p><label>Password:</label> <input type="password" name="password" value="$password"/><br /></p>
        <p><label>Nombre:</label> <input type="text" name="nombre" value="$nombre"/></p>
        <p><label>Apellidos:</label> <input type="text" name="apellidos" value="$apellidos"/><br /></p>
        <p><label>Universidad:</label> <input type="text" name="nombre_universidad" value="$nombre_universidad"/></p>
        <p><label>Sexo:</label> 
             <input type="radio" name="sexo" value="Hombre" $hChecked >Hombre 
             <input type="radio" name="sexo" value="Mujer" $mChecked > Mujer <br></p>
        <p><label>Direccion:</label> <input type="text" size="50" name="direccion" value="$direccion"/></p>
        <p><label>Codigo Postal:</label> <input type="text" name="cp" value="$cp"/><br /></p>
        <p><label>Localidad:</label> <input type="text" name="localidad" value="$localidad"/></p>
        <p><label>Provincia:</label> <input type="text" name="provincia" value="$provincia"/><br /></p>
        <p><label>Pais:</label> <input type="text" name="pais" value="$pais"/></p>
        <p><label>Web:</label> <input type="text" name="web" value="$web"/><br /></p>
        <p><label>Telefono:</label> <input type="text" name="telefono" value="$telefono"/></p>
        <button type="submit">Confirmar cambios</button>
EOF;
        return $content;
    }
}