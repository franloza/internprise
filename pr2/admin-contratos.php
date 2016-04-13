 <!DOCTYPE html>
<html>
<?php include ('admin-head.html'); ?>
  <body>
  <div id="container-historial" class="container">
	<?php include ('admin-menu.html'); ?>
	<?php include ('admin-titlebar.html'); ?>
	<div id="content-historial" class="content">
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

        <input type=image src="img/mover-a-la-anterior.jpg" width="25" height="15">
        <input type=image src="img/mover-a-la-siguiente.jpg" width="25" height="15">

	   <div id="tabla-historial" class="table-container">
        <div class="table-header"> Contratos en vigor </div>
        <table class="admin-table">
        <tr>
            <th>ID Contrato</th>
            <th>Empresa</th>
            <th>Nombre estudiante</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Puesto</th>
            <th>Accion</th>
        </tr>
        <tr>
            <td>0051299</td>
            <td>Everis</td>
            <td>Antonio Perez Sanchez</td>
            <td>12/03/2014</td>
            <td>30/07/2014</td>
            <td>Programador Java</td>
            <td><a href="admin-contratos-vista.php">Ver</a></td>
        </tr>
        <tr>
            <td>0051100</td>
            <td>Everis</td>
            <td>Elvira Jurado Perez</td>
            <td>12/03/2014</td>
            <td>30/07/2014</td>
            <td>Programador PHP</td>
            <td><a href="admin-contratos-vista.php">Ver</a></td>
        </tr>
        <tr>
            <td>0051101</td>
            <td>Indra</td>
            <td>Pedro Ramirez Garcia</td>
            <td>13/03/2014</td>
            <td>31/12/2014</td>
            <td>Administrador de Sistemas</td>
            <td><a href="admin-contratos-vista.php">Ver</a></td>
        </tr>
        <tr>
            <td>0051101</td>
            <td>Iberdrola</td>
            <td>Javier Vega Rodriguez</td>
            <td>15/03/2014</td>
            <td>31/09/2014</td>
            <td>Analista de datos</td>
            <td><a href="admin-contratos-vista.php">Ver</a></td>
        </tr>
        </table>
        </div>

        <input type=image src="img/mover-a-la-anterior.jpg" width="25" height="15">
        <input type=image src="img/mover-a-la-siguiente.jpg" width="25" height="15">

	</div>
    <?php include ('admin-footer.html'); ?>
  </div>
  </body>
</html>
