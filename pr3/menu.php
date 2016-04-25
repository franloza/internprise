<?php

$bloqueEstudianteSideBar = <<<EOF
<!-- Fragmento para definir el menú de administrador-->
<div id="estudiante-sidebar" class="sidebar">
	<div id="estudiante-menu-avatar" class="menu-avatar">
		<img src="img/estudiante-avatar.png" alt="Avatar image" height="200" width="200"></img>
	</div>
		<ul>
			<li><a href="estudiante-perfil.php">PERFIL</a></li>
			<li><a href="estudiante-ofertas.php">OFERTAS</a></li>
			<li><a href="estudiante-buzon.php">BUZON</a></li>
		</ul>
</div>
EOF;

$bloqueEmpresaSideBar = <<<EOF
<!-- Fragmento para definir el menú de empresa-->
<div id="empresa-sidebar" class="sidebar">
	<div id="empresa-menu-avatar" class="menu-avatar">
		<img src="img/empresa-avatar.png" alt="Avatar image" height="200" width="200"></img>
	</div>
	<ul>
		<li><a href="empresa-perfil.php">PERFIL</a></li>
		<li><a href="empresa-ofertas.php">OFERTAS</a></li>
		<li><a href="empresa-solicitudes.php">SOLICITUDES</a></li>
		<li><a href="empresa-contratos.php">CONTRATOS</a></li>
		<li><a href="empresa-buzon.php">BUZÓN</a></li>
	</ul>
</div>
EOF;

$bloqueAdminSideBar = <<<EOF
<!-- Fragmento para definir el menú de administrador-->
<div id="admin-sidebar" class="sidebar">
		<ul>
			<li><a href="admin-ofertas.php">ADMIN OFERTAS</a></li>
			<li><a href="admin-demandas.php">ADMIN DEMANDAS</a></li>
			<li><a href="admin-contratos.php">VER CONTRATOS</a></li>
			<li><a href="admin-historial.php">HISTORIAL</a></li>
			<li><a href="admin-encuestas.php">ENCUESTAS</a></li>
			<li><a href="admin-buzon.php">ADMIN BUZON</a></li>
		</ul>
</div>
EOF;

if ($_SESSION["rol"] == "admin"){
		echo "$bloqueAdminSideBar";
	}elseif ($_SESSION["rol"] == "estudiante") {
		echo "bloqueEstudianteSideBar";
	}elseif ($_SESSION["rol"] == "empresa") {
		echo "bloqueEmpresaSideBar";
	}