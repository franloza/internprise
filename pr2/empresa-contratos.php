<!DOCTYPE html>
<html>
<?php include ('empresa-head.html'); ?>
  <body>
  <div id="container-empresa-contratos" class="container">
	<?php include ('empresa-menu.html'); ?>
	<?php include ('empresa-titlebar.html'); ?>
	<div id="content-empresa-contratos" class="content">
		<div id="tabla-historial" class="table-container">
        <div class="table-header"> Contratos en vigor </div>
        <table class="empresa-table">
        <tr>
            <th>ID Contrato</th>
            <th>Estudiante</th>
            <th>Fecha Inicio</th>
            <th>Finalización</th>
            <th>Puesto</th>
            <th>Sueldo</th>
			<th>Ver</th>
        </tr>
        <tr>
            <td>0051299</td>
            <td>Antonio Perez Sanchez</td>
            <td>12/03/2016</td>
            <td>30/07/2016</td>
            <td>Programador Java</td>
			<td>400€</td>
            <td><a href="empresa-contratos-vista.php">Ver</a></td>
        </tr>
        <tr>
            <td>0051100</td>
            <td>Elvira Jurado Perez</td>
            <td>01/03/2016</td>
            <td>16/08/2016</td>
            <td>Programador PHP</td>
			<td>450€</td>
            <td><a href="empresa-contratos-vista.php">Ver</a></td>
        </tr>
        <tr>
            <td>0051101</td>
            <td>Pedro Ramirez Garcia</td>
            <td>31/3/2016</td>
            <td>31/12/2016</td>
            <td>Administrador de Sistemas</td>
			<td>400€</td>
            <td><a href="empresa-contratos-vista.php">Ver</a></td>
        </tr>
        </table>
        </div>
		<div id="tabla-historial" class="table-container">
        <div class="table-header"> Contratos finalizados </div>
        <table class="empresa-table">
        <tr>
            <th>ID Contrato</th>
            <th>Estudiante</th>
            <th>Fecha Inicio</th>
            <th>Finalización</th>
            <th>Puesto</th>
            <th>Sueldo</th>
			<th>Ver</th>
        </tr>
        <tr>
            <td>0051459</td>
            <td>Antonio Perez Sanchez</td>
            <td>12/03/2015</td>
            <td>30/07/2015</td>
            <td>Tecnico telecomunicaciones</td>
			<td>400€</td>
            <td><a href="empresa-contratos-vista.php">Ver</a></td>
        </tr>
        <tr>
            <td>0057569</td>
            <td>Jesus Gil y Gil</td>
            <td>12/03/2015</td>
            <td>30/07/2015</td>
            <td>Administrador BBDD</td>
			<td>400€</td>
            <td><a href="empresa-contratos-vista.php">Ver</a></td>
        </tr>
		<tr>
            <td>0053252</td>
            <td>Florentino Pérez</td>
            <td>12/03/2014</td>
            <td>30/07/2014</td>
            <td>Programador C++</td>
			<td>400€</td>
            <td><a href="empresa-contratos-vista.php">Ver</a></td>
        </tr>
        <tr>
            <td>0094059</td>
            <td>Santiago Bernabeú Gerard</td>
            <td>12/03/2014</td>
            <td>30/07/2014</td>
            <td>Gestor de la web de la empresa</td>
			<td>400€</td>
            <td><a href="empresa-contratos-vista.php">Ver</a></td>
        </tr>
        </table>
        </div>
	</div>
  <?php include ('empresa-footer.html'); ?>
  </div>
  </body>
</html>