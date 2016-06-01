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
                <img src="img/estudiante-avatar.png" alt="Avatar image" height="200" width="200"></img>
            </div>
                <ul>
                    <li><a onclick="return loadContent('PERFIL')" href="#">PERFIL</a></li>
                    <li><a onclick="return loadContent('OFERTAS')" href="#">OFERTAS</a></li>
                    <li><a onclick="return loadContent('BUZON')" href="#">BUZÓN</a></li>
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

           <!-- INI Contenedor busqueda dashboard -->
           <div class="btn-search">
               <a class="icon-search" href="#">
                   <i class="fa fa-search fa-2x" style="color:#444;"></i>
               </a>
               <div class="txt-search">
                   <form method="post" action="#">
                       <input class="txt-search" type="text" placeholder="Buscador de empresas">
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
        // TODO: Implement generaPerfil() method.
    }

    public function generaOfertas(){
        $ofertas = OfertaDAO::cargasOfertasEstudiante(20);
        $listaOfertas = array();
        foreach ( $ofertas as $oferta) {
            $empresa = $oferta ->getEmpresa();
            $puesto = $oferta->getPuesto();
            $sueldo = $oferta->getSueldo();
            $horas = $oferta->getHoras();
            $plazas = $oferta->getPlazas();
            $fila = array($empresa,$puesto,$sueldo, $horas, $plazas);
            array_push($listaOfertas,$fila);
        }

        $titulosColumnas = array("Empresa","Puesto", "Sueldo", "Horas", "Plazas","Accion");
        $content = self::generaTabla("tabla-ofertas", "estudiante-table",
            "Ofertas disponibles", $titulosColumnas, $listaOfertas);

        return $content;
    }

    public function generaBuzon(){
        // TODO: Implement generaBuzon() method.
    }

    public function generaSettings(){

        $app = Aplicacion::getSingleton();
        $id_estudiante = $app->idUsuario();
        $user = UsuarioDAO::cargaEstudiante($id_estudiante);
        $email = $user['email'];
        $content = <<<EOF
       <legend>Registro para Estudiantes</legend>
        <p><label>Email:</label> <input type="text" name="email" value="$email"/><br /></p>
        <p><label>Password:</label> <input type="password" name="password" value=""/><br /></p>
        <p><label>DNI:</label> <input type="text" name="dni" value=""/></p>
        <p><label>Nombre:</label> <input type="text" name="nombre" value=""/></p>
        <p><label>Apellidos:</label> <input type="text" name="apellidos" value=""/><br /></p>
        <p><label>Grado:</label> <input type="text" name="grado" value=""/><br/></p>
        <p><label>Universidad:</label> <input type="text" name="nombre_universidad" value=""/></p> 
        <p><label>Sexo:</label> 
             <input type="radio" name="sexo" value="Hombre"  >Hombre 
             <input type="radio" name="sexo" value="Mujer"  > Mujer <br></p>
        <p><label>Nacionalidad:</label> <input type="text" name="nacionalidad" value=""/><br /></p>
        <p><label>Direccion:</label> <input type="text" size="50" name="direccion" value=""/></p>
        <p><label>Fecha Nacimiento:</label> <input type="date" name="fecha_nacimiento" value=""/><br /></p>
        <p><label>Codigo Postal:</label> <input type="text" name="cp" value=""/><br /></p>
        <p><label>Localidad:</label> <input type="text" name="localidad" value=""/></p>
        <p><label>Provincia:</label> <input type="text" name="provincia" value=""/><br /></p>
        <p><label>Pais:</label> <input type="text" name="pais" value=""/></p>
        <p><label>Web:</label> <input type="text" name="web" value=""/><br /></p>
        <p><label>Telefono:</label> <input type="text" name="telefono" value=""/></p>
        <button type="submit">Registrarse</button>
EOF;
        return $content;
    }

}



