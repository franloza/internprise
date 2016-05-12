<?php
namespace es\ucm\aw\internprise;
require_once __DIR__.'/config.php';
/**
 * Script para manejar las peticiones asíncronas AJAX.
 */

use es\ucm\aw\internprise\Aplicacion as App;
//use es\ucm\aw\internprise\Aplicacion\Error as Err;
$app = App::getSingleton();
$app -> doInclude('comun/Error.php');
$content = '';

if($app -> usuarioLogueado()){
	$req = $_REQUEST['val'];
	switch($req){
		case 'DASHBOARD_ADMIN':
		case 'OFERTAS_ADMIN':
		case 'DEMANDAS_ADMIN':
		case 'CONTRATOS_ADMIN':
		case 'HISTORIAL_ADMIN':
		case 'ENCUESTAS_ADMIN':
		case 'BUZON_ADMIN': handle_adminRequest($req); break;
		case 'DASHBOARD_ESTUDIANTE':
		case 'PERFIL_ESTUDIANTE':
		case 'OFERTAS_ESTUDIANTE':
		case 'BUZON_ESTUDIANTE':handle_studentRequest($req); break;
		case 'DASHBOARD_EMPRESA':
		case 'PERFIL_EMPRESA':
		case 'OFERTAS_EMPRESA':
		case 'SOLICITUDES_EMPRESA':
		case 'CONTRATOS_EMPRESA': handle_empresaRequest($req); break;
		case 'BUZON_EMPRESA': handle_empresaRequest($req); break;
		default : $content = Error::generaErrorPermisos();
	}
}
else
	$content = Error::generaErrorPermisos();

echo $content;

function handle_adminRequest($req){
	global $app, $content;
	if( $app -> tieneRol('Admin')){
		$portalAdmin = Portal::factory($app->rolUsuario());
		switch($req){
			case 'DASHBOARD_ADMIN': $content = $portalAdmin -> generaDashboard(); break;
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
	if($app -> tieneRol('Estudiante')){
		$portalEstudiante = Portal::factory($app->rolUsuario());
		switch($req){
			case 'DASHBOARD_ESTUDIANTE': $content = $portalEstudiante -> generaDashboard(); break;
			case 'PERFIL_ESTUDIANTE': $content = $portalEstudiante -> generaPerfil(); break;
			case 'OFERTAS_ESTUDIANTE': $content = $portalEstudiante -> generaOfertas(); break;
			case 'BUZON_ESTUDIANTE': $content = $portalEstudiante -> generaBuzon(); break;
		}
	}
}

function handle_empresaRequest($req) {
	global $app, $content;
	if($app -> tieneRol('Empresa')){
		$portalEmpresa = Portal::factory($app->rolUsuario());
		switch($req){
			case 'DASHBOARD_EMPRESA': $content = $portalEmpresa -> generaDashboard(); break;
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