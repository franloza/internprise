<?php
namespace  es\ucm\aw\internprise;
require_once __DIR__.'/includes/config.php';

$app = Aplicacion::getSingleton();
$app->doInclude('comun/Error.php');
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

/*Logout*/
if (isset($_GET['logout'])) {
    $app->logout();
    header('Location: ' . $app->resuelve('/index.php'));
}
?>
<!DOCTYPE html>
<html>
    <?php if($error) {echo Error::generaErrorHead();} else { echo $portal->generaHead();}?>
    <script>
        $( document ).ready(function() {
            loadContent('<?php echo $app->section()?>');
        });
    </script>
    <body>
        <?php
        if($error) { echo $errorMsg;} else {
            echo '<div id="container-dashboard" class="container">';
            echo $portal->generaMenu();
            echo $portal->generaTitlebar();
            echo '<div id="content" class="content">';
            echo $portal->generaDashboard();
            echo '</div>';
            echo $portal->generaFooter();
         }?>
    </body>
</html>