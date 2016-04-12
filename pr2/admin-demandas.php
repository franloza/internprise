<!DOCTYPE html>
<html>
<?php include ('admin-head.html'); ?>
  <body>
  <div id="container-demandas" class="admin-container">
	<?php include ('admin-menu.html'); ?>
	<?php include ('admin-titlebar.html'); ?>
	<div id="content-demandas" class="admin-content">
        <div class="filtros">
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
	   <div id="tabla-demandas" class="table-container">
        <div class="table-header"> Demandas no clasificadas </div>
        <table class="admin-table">
        <tr>
			<th>ID Oferta</th>
            <th>Empresa</th>
			<th>Estudiante</th>
            <th>Accion</th>
        </tr>
        <tr>
			<td>0151300</td>
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

        <div id="tabla-demandas" class="table-container">
        <div class="table-header"> Demandas clasificadas </div>
        <table class="admin-table">
        <tr>
            <th>ID Oferta</th>
            <th>Empresa</th>
            <th>Estudiante</th>
            <th> Estado </th>
            <th>Accion</th>
        </tr>
        <tr>
            <td>0152370</td>
            <td>Everis</td>
            <td><a href="admin-demandas-vista.php">Antonio García Perez</a></td>
            <td class="cell-status"><label class="pass">Aceptada</label></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        <tr>
            <td>0052189</td>
            <td>Becarios NO S.A</td>
            <td><a href="lista-estudiantes.php">Pedro Aguilar Rodriguez</a></td>
            <td class="cell-status"><label class="fail">Rechazada</label></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        <tr>
            <td>0051242</td>
            <td>Yin Peng Consultora</td>
            <td><a href="lista-estudiantes.php"> Sara Diaz Diaz</a></td>
            <td class="cell-status"><label class="pass">Aceptada</label></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        <tr>
            <td>00525012</td>
            <td>Indra</td>
            <td><a href="lista-estudiantes.php">Rosa Vega Sanchez</a></td>
            <td class="cell-status"><label class="pass">Aceptada</label></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        </table>
        </div>         
	</div>
  </div>
  </body>
</html>
