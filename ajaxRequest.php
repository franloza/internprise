<?php
namespace es\ucm\aw\internprise;
require_once __DIR__ . '/includes/config.php';
/**
 * Script para manejar las peticiones asíncronas AJAX.
 */

use es\ucm\aw\internprise\Aplicacion as App;
//use es\ucm\aw\internprise\Aplicacion\Error as Err;
$app = App::getSingleton();
$app -> doInclude('comun/Error.php');
$content = '';

if(isset($_GET['databuscador'])) {
	$buscador = $_GET['databuscador'];
	echo handle_autocompletebuscador($buscador);
}
else if($app -> usuarioLogueado()){
	$rol = $app->rolUsuario();
	$req = $_GET['val'];
	$op = (isset($_GET['op']))?$_GET['op']:null;
	$modalDialogReq = false;

	if(substr($req, 0, 2) === 'MD')
		$modalDialogReq = true;
	switch($rol){
		case 'Admin': handle_adminRequest($req,$op); break;
		case 'Estudiante':handle_studentRequest($req,$op); break;
		case 'Empresa': handle_empresaRequest($req,$op); break;
		default : $content = Error::generaErrorPermisos();
	}
    /*Save active section if its not a modal dialog request*/
	if(!$modalDialogReq)
    	$app->saveSection($req);
}
else if(isset($_GET['datamail'])) {
	$email = $_GET['datamail']; 
	echo handle_emailValidation($email);
} else if(isset($_GET['datagrado'])) {
	$grado = $_GET['datagrado'];
	echo handle_autocompleteGrado($grado);
} else if(isset($_GET['datauni'])) {
	$uni = $_GET['datauni']; 
	echo handle_autocompleteUni($uni);
} else
	$content = Error::generaErrorPermisos();
/*Returns the content to dashboard by ajax*/

echo $content;

function handle_adminRequest($req,$op){
	global $app, $content, $modalDialogReq;
	if( $app -> tieneRol('Admin')){
		$portalAdmin = Portal::factory($app->rolUsuario());
		if($modalDialogReq){
			switch (substr($req, 2, 1)){
				case 'O': $content = $portalAdmin -> generaDialogoOferta(substr($req, 4)); break;
				case 'D': $content = $portalAdmin -> generaDialogoDemanda(substr($req, 4)); break;
			}
		}
		else {
			switch ($req) {
				//Secciones
				case 'DASHBOARD': $content = $portalAdmin->generaDashboard(); break;
				case 'OFERTAS_CLASIFICADAS': $content = $portalAdmin->generaOfertas(true); break;
				case 'OFERTAS_NO_CLASIFICADAS': $content = $portalAdmin->generaOfertas(false); break;
				case 'DEMANDAS_CLASIFICADAS': $content = $portalAdmin->generaDemandas(true); break;
				case 'DEMANDAS_NO_CLASIFICADAS': $content = $portalAdmin->generaDemandas(false); break;
				case 'CONTRATOS': $content = $portalAdmin->generaContratos(); break;
				case 'HISTORIAL': $content = $portalAdmin->generaHistorial(); break;
				case 'ENCUESTAS': $content = $portalAdmin->generaEncuestas(); break;
				case 'BUZON': $content = $portalAdmin->generaBuzon(); break;
				case 'SETTINGS': $content = $portalAdmin->generaSettings(); break;

				//Acciones
				case 'ACEPTAR_OFERTA': {
					$content = OfertaDAO::aceptarOferta($op);
					if(is_array($content)){
						$content = $content[0];
					} else{
						$content = "Oferta aceptada";
					}
					break;
				}
				case 'RECHAZAR_OFERTA': {
					$content = OfertaDAO::rechazarOferta($op);
					if(is_array($content)){
						$content = $content[0];
					} else{
						$content = "Oferta rechazada";
					}
					break;
				}

				case 'ACEPTAR_DEMANDA': {
					$content = DemandaDAO::aceptarDemanda($op);
					if(is_array($content)){
						$content = $content[0];
					} else{
						$content = "Demanda aceptada";
					}
					break;
				}
				case 'RECHAZAR_DEMANDA': {
					$content = DemandaDAO::rechazarDemanda($op);
					if(is_array($content)){
						$content = $content[0];
					} else{
						$content = "Demanda rechazada";
					}
					break;
				}

				case 'CARGA_PERFIL': {
					$user = UsuarioDAO::findUsuarioById($op);
					if($user) {
						$rol = $user->getRol();
						if ($rol == 'Estudiante') {
							$content = PortalEstudiante::generaPerfil($op);
							break;
						}
						else if($rol == 'Empresa') {
							//TODO:
							//$content = PortalEmpresa::generaPerfil($op);
						}
					}
					else
						$content = false;
					break;
				}


			}
		}
	}
}

function handle_studentRequest($req,$op) {
	global $app, $content, $modalDialogReq;
	if($app -> tieneRol('Estudiante')){
		$portalEstudiante = Portal::factory($app->rolUsuario());
		if($modalDialogReq){
			switch (substr($req, 2, 1)){
				case 'O': $content = $portalEstudiante -> generaDialogoOferta(substr($req, 4)); break;
				case 'D': $content = $portalEstudiante -> generaDialogoDemanda(substr($req, 4)); break;
			}
		}
		else{
			switch($req){
				//Secciones
				case 'DASHBOARD': $content = $portalEstudiante -> generaDashboard(); break;
				case 'PERFIL': $content = PortalEstudiante::generaPerfil($app->idUsuario()); break;
				case 'OFERTAS': $content = $portalEstudiante -> generaOfertas(); break;
				case 'SOLICITUDES': $content = $portalEstudiante -> generaDemandas(); break;
				case 'BUZON': $content = $portalEstudiante -> generaBuzon(); break;
				case 'SETTINGS': $content = $portalEstudiante -> generaSettings(); break;
				
				//Acciones
				case 'CREAR_DEMANDA': {
					$content = DemandaDAO::creaDemanda($op,$app->idUsuario());
					if(is_array($content)){
						$content = $content[0];
					} else{
						$content = "Demanda solicitada correctamente";
					}
					break;
				}
				case 'CARGA_PERFIL': {
					$user = UsuarioDAO::findUsuarioById($op);
					if($user) {
						$rol = $user->getRol();
						if ($rol == 'Estudiante') {
							$content = PortalEstudiante::generaPerfil($op);
							break;
						}
					}
					else
						$content = false;
					break;
				}
				case 'BUSCA_PERFIL': {
					$listaEmpresas = UsuarioDAO::listEmpresas($op);
					if(sizeof($listaEmpresas) == 1) {

						$content = PortalEmpresa::generaPerfil($listaEmpresas[0][0]);
						break;
					}
					else
						$content = false;
					break;
				}
			}
		}

	}
}

function handle_empresaRequest($req,$op) {
	global $app, $content, $modalDialogReq;
	if($app -> tieneRol('Empresa')){
		$portalEmpresa = Portal::factory($app->rolUsuario());
		if($modalDialogReq){
			switch (substr($req, 2, 1)){
				case 'O': $content = $portalEmpresa -> generaDialogoOferta(substr($req, 4)); break;
			}
		}
		else{
			switch($req){
				//Secciones
				case 'DASHBOARD': $content = $portalEmpresa -> generaDashboard(); break;
				case 'PERFIL': $content = $portalEmpresa -> generaPerfil($app->idUsuario()); break;
				case 'OFERTAS': $content = $portalEmpresa -> generaOfertas(); break;
				case 'SOLICITUDES': $content = $portalEmpresa -> generaSolicitudes(); break;
				case 'CONTRATOS_VIGOR': $content = $portalEmpresa -> generaContratos("Activo"); break;
				case 'CONTRATOS_FIN': $content = $portalEmpresa -> generaContratos("Expirado"); break;
				case 'BUZON': $content = $portalEmpresa -> generaBuzon(); break;
				case 'CREAR_OFERTA': $content = $portalEmpresa->generaCrearOferta(); break;
				case 'SETTINGS': $content = $portalEmpresa -> generaSettings(); break;

				//Acciones
				case 'ELIMINAR_OFERTA': {
					$content = OfertaDAO::eliminarOferta($op);
					if(is_array($content)){
						$content = $content[0];
					} else{
						$content = "Oferta eliminada correctamente";
					}
					break;
				}
				case 'CARGA_PERFIL': {
					$user = UsuarioDAO::findUsuarioById($op);
					if($user) {
						$rol = $user->getRol();
						if($rol == 'Empresa') {
							//TODO:
							//$content = PortalEmpresa::generaPerfil($op);
						}
					}
					else
						$content = false;
					break;
				}
				case 'BUSCA_PERFIL': {
					$listaEmpresasEstudiantes = UsuarioDAO::listEmpresasEstudiantesConcatenado($op);
					if(sizeof($listaEmpresasEstudiantes) == 1) {

							$content = PortalEstudiante::generaPerfil($listaEmpresasEstudiantes[0][0]);
							break;
					}
					else
						$content = false;
					break;
				}
			}
		}
	}
	
    else return false;
}

function handle_emailValidation($email) {
	$ok = false;
	// Si devuelve false es que no existe el email
	if (!UsuarioDAO::cargaUsuario($email))
		$ok = true;
	$jsonArray =  json_encode(array("result" => $ok));
	return $jsonArray;
}

function handle_autocompleteGrado($grado) {
	$datos = array();
	$datos = UsuarioDAO::getGradosLike($grado);
	return json_encode($datos);
}

function handle_autocompleteUni($uni) {
	$datos = array();
	$datos = UsuarioDAO::getUniversidadesLike($uni);
	return json_encode($datos);
}	

function handle_autocompletebuscador($buscador) {
	$datos = array();

	$app = App::getSingleton();

		$rol = $app->rolUsuario();

		switch($rol){
			case 'Admin': $datos = UsuarioDAO::listEmpresasEstudiantes($buscador); break;
			case 'Estudiante': $datos = UsuarioDAO::listEmpresas($buscador); break;
			case 'Empresa': $datos = UsuarioDAO::listEmpresasEstudiantes($buscador); break;
		}

	return json_encode($datos);
}

?>
