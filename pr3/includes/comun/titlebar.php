<?php

$bloqueEstudianteTitleBar = <<<EOF
<!-- Fragmento para definir el titlebar del Portal Estudiante(header) -->
<div id="estudiante-titlebar" class='titlebar'>
	<img src="img/favicon-estudiante.png" alt="Internprise icon" height="70" width="70"></img>
	<div id="label-titlebar">
		<label>
			<a id="title-site" href="estudiante-dashboard.php">Internprise Estudiante</a>
			<i class="fa fa-angle-right fa-lg" aria-hidden="true"></i>
			<a id="previous-page" href="estudiante-dashboard.php">Anterior</a>
			<i class="fa fa-angle-right fa-lg" aria-hidden="true"></i>
			<a id="current-page" href="estudiante-dashboard.php">Actual</a>
		</label>
	</div>
	<div id="icons-titlebar">
		<a id="bell" class="fa fa-bell fa-lg" href="notifications.php"></a>
		<a id="settings" class="fa fa-cog fa-lg" href="settings.php"></a>
		<a class="fa fa-power-off fa-lg" href="index.html"></a>
	</div>
</div>
EOF;

$bloqueEmpresaTitleBar = <<<EOF
<!-- Fragmento para definir el titlebar del Portal Empresa(header) -->
<div id='empresa-titlebar' class='titlebar'>
	<img src="img/favicon-empresa.png" alt="Internprise icon" height="70" width="70"></img>
	<div id="label-titlebar">
		<label>
			<a id="title-site" href="empresa-dashboard.php">Internprise Empresa</a>
			<i class="fa fa-angle-right fa-lg" aria-hidden="true"></i>
			<a id="previous-page" href="empresa-dashboard.php">Anterior</a>
			<i class="fa fa-angle-right fa-lg" aria-hidden="true"></i>
			<a id="current-page" href="empresa-dashboard.php">Actual</a>
		</label>
	</div>
	<div id="icons-titlebar">
		<a id="bell" class="fa fa-bell fa-lg" href="#"></a>
		<a id="settings" class="fa fa-cog fa-lg" href="#"></a>
		<a class="fa fa-power-off fa-lg" href="index.html"></a>
	</div>
</div>
EOF;

$bloqueAdminTitleBar = <<<EOF
<!-- Fragmento para definir el titlebar del Portal Administración (header) -->
<div id='admin-titlebar' class='titlebar'>
	<img src="img/favicon-admin.png" alt="Internprise icon" height="70" width="70"></img>
	<div id="label-titlebar">
		<label>
			<a id="title-site" href="admin-dashboard.php">Internprise Administration</a>
			<i class="fa fa-angle-right fa-lg" aria-hidden="true"></i>
			<a id="previous-page" href="admin-dashboard.php">Anterior</a>
			<i class="fa fa-angle-right fa-lg" aria-hidden="true"></i>
			<a id="current-page" href="admin-dashboard.php">Actual</a>
		</label>
	</div>
	<div id="icons-titlebar">
		<a id="bell" class="fa fa-bell fa-lg" href="#"></a>
		<a id="settings" class="fa fa-cog fa-lg" href="#"></a>
		<a class="fa fa-power-off fa-lg" href="index.html"></a>
	</div>
</div>
EOF;

if ($_SESSION["rol"] == "Admin"){
    echo "$bloqueAdminTitleBar";
}elseif ($_SESSION["rol"] == "Estudiante") {
    echo "$bloqueEstudianteTitleBar";
}elseif ($_SESSION["rol"] == "Empresa") {
    echo "$bloqueEmpresaTitleBar";
}