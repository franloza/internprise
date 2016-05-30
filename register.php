<?php

require_once __DIR__ . '/includes/config.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8">
    <script src="js/jquery-2.2.3.js"></script>
    <title>Registro</title>
</head>
<body>
<div id="contenedor">
    <div id="contenido">
        <select id="regSelect">
            <option value="empresa">Empresa</option>
            <option value="estudiante" selected="selected">Estudiante</option>
            <option value="admin">Administrador</option>
        </select>
        <?php $formLogin =  new \es\ucm\aw\internprise\FormularioRegister();$formLogin->gestiona(); ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#regSelect").val("estudiante");
        $( "input:hidden#rolHidden").val("estudiante");
    });

    $( "#regSelect").change(function () {
        var valueSelected = this.value;
        switch (valueSelected) {
            case "empresa":
            {
                $('fieldset#estudiante').hide();
                $('fieldset#empresa').show();
                $("fieldset#admin").hide();
                $( "input:hidden#rolHidden").val("empresa");
                break;
            }
            case "estudiante":
            {
                $('fieldset#estudiante').show();
                $('fieldset#empresa').hide();
                $('fieldset#admin').hide();
                $( "input:hidden#rolHidden").val("estudiante");
                break;
            }
            case "admin":
            {
                $('fieldset#estudiante').hide();
                $('fieldset#empresa').hide();
                $('fieldset#admin').show();
                $( "input:hidden#rolHidden").val("admin");
                break;
            }
        }
    }).change();
</script>
</body>
</html>



