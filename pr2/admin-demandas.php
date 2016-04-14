<!DOCTYPE html>
<html>
<?php include ('admin-head.html'); ?>
  <body>
  <div id="container-demandas" class="container">
	<?php include ('admin-menu.html'); ?>
	<?php include ('admin-titlebar.html'); ?>
	<div id="content-demandas" class="content">
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
            <td><a href="admin-demandas-vista-empresa.php">Intel</a></td>
            <td><a href="admin-demandas-vista.php">Luna Maria Moreno Sanchez</a></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        <tr>
			<td>0051111</td>
            <td><a href="admin-demandas-vista-empresa.php">Google ESP</a></td>
			<td><a href="admin-demandas-vista.php">Alejandro Reguilon Mota</a></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        <tr>
			<td>0051322</td>
            <td><a href="admin-demandas-vista-empresa.php">Coritel</a></td>
			<td><a href="admin-demandas-vista.php">Hector Garcia Ronda</a></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        <tr>
			<td>0052000</td>
            <td><a href="admin-demandas-vista-empresa.php">Indra</a></td>
			<td><a href="admin-demandas-vista.php">Jaime Borregon Perez</a></td>
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
            <td><a href="admin-demandas-vista-empresa.php">Everis</a></td>
            <td><a href="admin-demandas-vista.php">Antonio García Perez</a></td>
            <td class="cell-status"><label class="pass">Aceptada</label></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        <tr>
            <td>0052189</td>
            <td><a href="admin-demandas-vista-empresa.php">Becarios NO S.A</a></td>
            <td><a href="admin-demandas-vista.php">Pedro Aguilar Rodriguez</a></td>
            <td class="cell-status"><label class="fail">Rechazada</label></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        <tr>
            <td>0051242</td>
            <td><a href="admin-demandas-vista-empresa.php">Yin Peng Consultora</a></td>
            <td><a href="admin-demandas-vista.php"> Sara Diaz Diaz</a></td>
            <td class="cell-status"><label class="pass">Aceptada</label></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        <tr>
            <td>00525012</td>
            <td><a href="admin-demandas-vista-empresa.php">Indra</a></td>
            <td><a href="admin-demandas-vista.php">Rosa Vega Sanchez</a></td>
            <td class="cell-status"><label class="pass">Aceptada</label></td>
            <td><a href="admin-ofertas-vista.php">Ver</a></td>
        </tr>
        </table>
        </div>         
	</div>
    <?php include ('admin-footer.html'); ?>
  </div>
  </body>
</html>
