<!DOCTYPE html>
<html>
<?php include ('admin-head.html'); ?>
  <body>
  <div id="container-demandas" class="admin-container">
	<?php include ('admin-menu.html'); ?>
	<?php include ('admin-titlebar.html'); ?>
	<div id="content-demandas" class="admin-content">
        <div id="carrera">
            <label>Seleccione una carrera:</label>
            <select class="filtro">
                <option value="todos">Todos</option>
                <option value="informatica">Grado en Ingenieria Informatica</option>
                <option value="computadores">Grado en Ingenieria de Computadores</option>
                <option value="software">Grado en Ingenieria del Software</option>
				<option value="videojuegos">Grado en Videojuegos</option>
                <option value="infor-mates">Doble Grado Ingenieria Informatica - Matematicas</option>
            </select>
        </div>
	   <div id="tabla-demandas">
        <table class="admin-table">
        <tr>
			<th>ID Contrato</th>
            <th>Empresa</th>
			<th>Estudiante</th>
            <th>Accion</th>
        </tr>
        <tr>
			<td>0051300</td>
            <td>Intel</td>
            <td><a href="admin-demandas-vista.php">Luna Maria Moreno Sanchez</a></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        <tr>
			<td>0051111</td>
            <td>Google ESP</td>
			<td><a href="lista-estudiantes.php">Alejandro Reguilon Mota</a></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        <tr>
			<td>0051322</td>
            <td>Coritel</td>
			<td><a href="lista-estudiantes.php">Hector Garcia Ronda</a></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        <tr>
			<td>0052000</td>
            <td>Indra</td>
			<td><a href="lista-estudiantes.php">Jaime Borregon Perez</a></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        </table>
        </div>
	</div>
  </div>
  </body>
</html>
