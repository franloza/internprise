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

if($app -> usuarioLogueado()){
	$rol = $app->rolUsuario();
	$req = $_REQUEST['val'];
	switch($rol){
		case 'Admin': handle_adminRequest($req); break;
		case 'Estudiante':handle_studentRequest($req); break;
		case 'Empresa': handle_empresaRequest($req); break;
		default : $content = Error::generaErrorPermisos();
	}
    /*Save active section*/
    $app->saveSection($req);
}
else
	$content = Error::generaErrorPermisos();

/*Returns the content to dashboard by ajax*/
echo $content;

function handle_adminRequest($req){
	global $app, $content;
	if( $app -> tieneRol('Admin')){
		$portalAdmin = Portal::factory($app->rolUsuario());
		switch($req){
			case 'DASHBOARD': $content = $portalAdmin -> generaDashboard(); break;
			case 'OFERTAS_CLASIFICADAS': $content = $portalAdmin -> generaOfertas(true); break;
			case 'OFERTAS_NO_CLASIFICADAS': $content = $portalAdmin -> generaOfertas(false); break;
			case 'DEMANDAS': $content = $portalAdmin -> generaDemandas(); break;
			case 'CONTRATOS': $content = $portalAdmin -> generaContratos(); break;
			case 'HISTORIAL': $content = $portalAdmin -> generaHistorial(); break;
			case 'ENCUESTAS': $content = $portalAdmin -> generaEncuestas(); break;
			case 'BUZON': $content = $portalAdmin -> generaBuzon(); break;
		}		
	}
}

function handle_studentRequest($req) {
	global $app, $content;
	if($app -> tieneRol('Estudiante')){
		$portalEstudiante = Portal::factory($app->rolUsuario());
		switch($req){
			case 'DASHBOARD': $content = $portalEstudiante -> generaDashboard(); break;
			case 'PERFIL': $content = $portalEstudiante -> generaPerfil(); break;
			case 'OFERTAS': $content = $portalEstudiante -> generaOfertas(); break;
			case 'BUZON': $content = $portalEstudiante -> generaBuzon(); break;
		}
	}
}

function handle_empresaRequest($req) {
	global $app, $content;
	if($app -> tieneRol('Empresa')){
		$portalEmpresa = Portal::factory($app->rolUsuario());
		switch($req){
			case 'DASHBOARD': $content = $portalEmpresa -> generaDashboard(); break;
			case 'PERFIL': $content = $portalEmpresa -> generaPerfil(); break;
			case 'OFERTAS': $content = $portalEmpresa -> generaOfertas(); break;
			case 'SOLICITUDES': $content = $portalEmpresa -> generaSolicitudes(); break;
			case 'CONTRATOS': $content = $portalEmpresa -> generaContratos(); break;
			case 'BUZON': $content = $portalEmpresa -> generaBuzon(); break;
			//case 'CREAR_OFERTA': $content = $portalEmpresa -> generaCrearOferta(); break;
			case 'CREAR_OFERTA':
				$form = new \es\ucm\aw\internprise\FormularioCrearOferta();
				$form->gestiona();
				break;
		}
	}
    else return false;
}

?>