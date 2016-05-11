<?php
namespace es\ucm\aw\internprise;
require_once __DIR__.'/config.php';
/**
 * Script para manejar las peticiones asíncronas AJAX.
 */

use es\ucm\aw\internprise\Aplicacion as App;
$app = App::getSingleton();
$content = '';

if($app -> usuarioLogueado()){
	$req = $_REQUEST['val'];
	switch($req){
		case 'OFERTAS_ADMIN': handle_adminRequest($req); break;
		case 'DEMANDAS_ADMIN': handle_adminRequest($req); break;
		case 'CONTRATOS_ADMIN': handle_adminRequest($req); break;
		case 'HISTORIAL_ADMIN': handle_adminRequest($req); break;
		case 'ENCUESTAS_ADMIN': handle_adminRequest($req); break;
		case 'BUZON_ADMIN': handle_adminRequest($req); break;
		case 'PERFIL_ESTUDIANTE': handle_studentRequest($req); break;
		case 'OFERTAS_ESTUDIANTE': handle_studentRequest($req); break;
		case 'BUZON_ESTUDIANTE': handle_studentRequest($req); break;
		case 'PERFIL_EMPRESA': handle_empresaRequest($req); break;
		case 'OFERTAS_EMPRESA': handle_empresaRequest($req); break;
		case 'SOLICITUDES_EMPRESA': handle_empresaRequest($req); break;
		case 'CONTRATOS_EMPRESA': handle_empresaRequest($req); break;
		case 'BUZON_EMPRESA': handle_empresaRequest($req); break;
		default : $content = Error::generaErrorPermisos();
	}
}

echo $content;

function handle_adminRequest($req){
	global $app, $content;
	if( $_SESSION['rol'] ==='Admin'){
		$portalAdmin = Portal::factory($app->rolUsuario());
		switch($req){
			case 'OFERTAS_ADMIN': $content = $portalAdmin -> generaOfertas(); break;
			case 'DEMANDAS_ADMIN': $content = $portalAdmin -> generaDemandas(); break;
			case 'CONTRATOS_ADMIN': $content = $portalAdmin -> generaContratos(); break;
			case 'HISTORIAL_ADMIN': $content = $portalAdmin -> generaHistorial(); break;
			case 'ENCUESTAS_ADMIN': $content = $portalAdmin -> generaEncuestas(); break;
			case 'BUZON_ADMIN': $content = $portalAdmin -> generaBuzon(); break;
		}		
	}
}

function handle_studentRequest($req) {
	global $app, $content;
	if($_SESSION['rol'] ==='Estudiante'){
		$portalEstudiante = Portal::factory($app->rolUsuario());
		switch($req){
			case 'PERFIL_ESTUDIANTE': $content = $portalEstudiante -> generaPerfil(); break;
			case 'OFERTAS_ESTUDIANTE': $content = $portalEstudiante -> generaEstudiante(); break;
			case 'BUZON_ESTUDIANTE': $content = $portalEstudiante -> generaBuzon(); break;
		}
	}
}

function handle_empresaRequest($req) {
	global $app, $content;
	if($_SESSION['rol'] ==='Empresa'){
		$portalEmpresa = Portal::factory($app->rolUsuario());
		switch($req){
			case 'PERFIL_EMPRESA': $content = $portalEmpresa -> generaPerfil(); break;
			case 'OFERTAS_EMPRESA': $content = $portalEmpresa -> generaOfertas(); break;
			case 'SOLICITUDES_EMPRESA': $content = $portalEmpresa -> generaSolicitudes(); break;
			case 'CONTRATOS_EMPRESA': $content = $portalEmpresa -> generaContratos(); break;
			case 'BUZON_EMPRESA': $content = $portalEmpresa -> generaBuzon(); break;
		}
	}
    else return false;
}

?>