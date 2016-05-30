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
        <div id="formAdmin">
            <?php $formAdmin =  new \es\ucm\aw\internprise\FormularioRegister('admin');$formAdmin->gestiona(); ?>
        </div>
        <div id="formEstudiante">
            <?php $formEstudiante =  new \es\ucm\aw\internprise\FormularioRegister('estudiante');$formEstudiante->gestiona(); ?>
        </div>
        <div id="formEmpresa">
            <?php $formEmpresa =  new \es\ucm\aw\internprise\FormularioRegister('empresa');$formEmpresa->gestiona(); ?>
        </div>

    </div>
</div>
<script>
    $(document).ready(function () {
        $("#regSelect").val("estudiante");
        $( "#formEstudiante").find("input:hidden#rolHidden").val("estudiante");
    });

    $( "#regSelect").change(function () {
        var valueSelected = this.value;
        switch (valueSelected) {
            case "empresa":
            {
                $('#formEstudiante').hide();
                $('#formEmpresa').show();
                $("#formAdmin").hide();
                $( "#formEmpresa").find("input:hidden#rolHidden").val("empresa");
                break;
            }
            case "estudiante":
            {
                $('#formEstudiante').show();
                $('#formEmpresa').hide();
                $('#formAdmin').hide();
                $( "#formEstudiante").find("input:hidden#rolHidden").val("estudiante");
                break;
            }
            case "admin":
            {
                $('#formEstudiante').hide();
                $('#formEmpresa').hide();
                $('#formAdmin').show();
                $( "#formAdmin").find("input:hidden#rolHidden").val("admin");
                break;
            }
        }
    }).change();
</script>
</body>
</html>



