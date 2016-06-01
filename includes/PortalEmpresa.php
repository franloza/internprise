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
        foreach ( $ofertas as $oferta) {
            $puesto = $oferta->getPuesto();
            $sueldo = $oferta->getSueldo();
            $horas = $oferta->getHoras();
            $plazas = $oferta->getPlazas();
            $estado = $oferta->getEstado();
            $fila = array($puesto,$sueldo, $horas, $plazas,$estado);
            array_push($listaOfertas,$fila);
        }

        $titulosColumnas = array("Puesto", "Sueldo", "Horas", "Plazas", "Estado");
        $content = self::generaTabla("tabla-ofertas", "empresa-table",
                                        "Tus ofertas disponibles", $titulosColumnas, $listaOfertas);

        return $content;
    }

    public function generaSolicitudes(){
        // TODO: Implement generaSolicitudes() method.
    }


    public function generaContratos(){
        // TODO: Implement generaContratos() method.
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

        $app = Aplicacion::getSingleton();
        $id_empresa = $app->idUsuario();
        $user = UsuarioDAO::cargaEmpresa($id_empresa);

        $email = $user->getEmail();
        $password = $user->getPassword();
        $cif = $user->getCif();
        $razonSocial = $user->getRazonSocial();
        $direccion = $user->getDireccion();
        $localidad = $user->getLocalidad();
        $provincia = $user->getProvincia();
        $pais = $user->getPais();
        $web = $user->getWeb();
        $telefono = $user->getTelefono();
        $cp = $user->getCp();

        $content = <<<EOF
       <legend>Cambios en el perfil: </legend>
      <p><label>eMail:</label> <input type="text" name="email" value="$email"/></p>
      <p><label>Password:</label> <input type="password" name="password" value="$password"/><br /></p>
      <p><label>CIF:</label> <input type="text" name="cif" value="$cif"/></p>
      <p><label>Razon Social:</label> <input type="text" name="razonSocial" value="$razonSocial"/><br /></p>
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


