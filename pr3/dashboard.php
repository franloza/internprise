<?php
namespace  es\ucm\aw\internprise;
require_once __DIR__.'/includes/config.php';

$app = Aplicacion::getSingleton();
$error = false; $errorMsg = '';$portal = false;
if(!$app->usuarioLogueado()) {
    $error = true;
    $errorMsg = Error::generaErrorPermisos();
}
else {
    $portal = Portal::factory($app->rolUsuario());
    if(!$portal) {
        $error = true;
        $errorMsg = Error::generaErrorPermisos();
    }
}
?>
<!DOCTYPE html>
<html>
    <?php if($error) {echo Error::generaErrorHead();} else { echo $portal->generaHead();}?>
    <body>
        <?php
        if($error) { echo $errorMsg;} else {
            echo '<div id="container-dashboard" class="container">';
            echo $portal->generaMenu();
            echo $portal->generaTitlebar();
            echo '<div class="content">';
            echo $portal->generaDashboard();
            echo '</div>';
            echo $portal->generaFooter();
         }?>
    </body>
</html>