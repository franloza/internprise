<?php

$bloqueEstudianteFooter = <<<EOF
<!-- Fragmento para definir el footer -->
<div id="estudiante-footer" class ="footer">
	Internprise
	<div class="footer-icons">
		<a class="fa fa-github" href="https://github.com/franloza/aw"></a>
	</div>
</div>
EOF;

$bloqueEmpresaFooter = <<<EOF
<!-- Fragmento para definir el footer -->
<div id="empresa-footer" class="footer">
	Internprise 
	<div class="footer-icons">
		<a class="fa fa-github" href="https://github.com/franloza/aw"></a>
	</div>
</div>
EOF;

$bloqueAdminFooter = <<<EOF
<!-- Fragmento para definir el footer -->
<div id="admin-footer" class ="footer">
	Internprise 
	<div class="footer-icons">
		<a class="fa fa-github-square" href="https://github.com/franloza/aw"></a>
	</div>
</div>
EOF;

if ($_SESSION["rol"] == "Admin"){
    echo "$bloqueAdminFooter";
}elseif ($_SESSION["rol"] == "Estudiante") {
    echo "$bloqueEstudianteFooter";
}elseif ($_SESSION["rol"] == "Empresa") {
    echo "$bloqueEmpresaFooter";
}