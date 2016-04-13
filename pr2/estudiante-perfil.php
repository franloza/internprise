<!DOCTYPE html>
<html>
	<?php include ('admin-head.html'); ?>
  	<body>
 	<div class="container">
	<?php include ('estudiante-menu.html'); ?>
	<?php include ('estudiante-titlebar.html'); ?>
	<div id="content-perfil" class="content">  
		<div id="imagen-estudiante">
			<IMG SRC="img/kakshi.jpg">
		</div>
		<div class="contenedor-perfil">
			<h2><strong>Pedro Sanchez Pérez</strong></h2>
			<p>Analista de datos y consultor técnico</p>
			<p>Madrid zona centro y norte</p>
			<table class="estudiante-table">
				<tr>
					<td>Actual</td>
					<td>Analista de datos en Data Center</td>
				</tr>
				
				<tr>
					<td>Anterior</td>
					<td>Becario en la Universidad Complutense. Tecnico de Infomatica</td>
				</tr>
				
				<tr>
					<td>Educacion</td>
					<td>UCM-Informatica</td>
				</tr>
				
				<tr>
					<td>Idiomas</td>
					<td>Ingles y Frances</td>
				</tr>
			</table>
		</div>

		<div id="estudiante-aptitudes" class="aptitudes"> 
			<ul>
				<li class="estudiante-table"><strong>Aptitudes</strong></li>
				<li class="li2">SQL Server 2008</li>
				<li class="li2">PL/SQL</li>
				<li class="li2">R</li>
				<li class="li2">Python</li>
				<li class="li2">Microsoft Excel</li>
				<li class="li2">Hadoop</li>
				<li class="li2">SAS</li>
			</ul>

		</div>
		<div id="informacion-personal">
			<p><strong>Informacion Personal</strong></p>
			<table class="estudiante-table">
				<tr>
					<td>eMail</td>
					<td>psanchez@ucm.es</td>
				</tr>

				<tr>
					<td>telefono movil</td>
					<td>608 82 66 47</td>
				</tr>

				<tr>
					<td>telefono fijo</td>
					<td> 91 847 24 89</td>
				</tr>

			</table>


		</div>

		<div id="documentacion-adicional">
			<a href="cvPSanchez.docx"><strong>Curriculum Vitae</strong></a>

		</div>

	</div>
	<?php include ('estudiante-footer.html'); ?>
  </div>
  </body>
</html>
