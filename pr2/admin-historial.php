 <!DOCTYPE html>
<html>
<?php include ('admin-head.html'); ?>
  <body>
  <div id="container-historial" class="admin-container">
	<?php include ('admin-menu.html'); ?>
	<?php include ('admin-titlebar.html'); ?>
	<div id="content-historial" class="admin-content">
        <div class="filtros">
            <label>Año</label>
            <select class="filtro">
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
            </select>
            <label>Estudios</label>
            <select class="filtro">
                <option value="ing-inf">Grado en Ingeniería Informática</option>
                <option value="ing-com">Grado en Ingeniería de Computadores</option>
                <option value="ing-sof">Grado en Ingeniería del Software</option>
                <option value="dbl-grad-inf-mat">Doble Grado Ingeniería Informática - Matemáticas</option>
            </select>
        </div>

        <input type=image src="img/mover-a-la-anterior.jpg" width="25" height="15">
        <input type=image src="img/mover-a-la-siguiente.jpg" width="25" height="15">

	   <div id="tabla-historial" class="table-container">
        <table class="admin-table">
        <div class="table-header"> Contratos expirados </div>
        <tr>
            <th>ID Contrato</th>
            <th>Empresa</th>
            <th>Nombre estudiante</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Puesto</th>
            <th>Accion</th>
			<th>Estado</th>
        </tr>
        <tr>
            <td>0051299</td>
            <td>Everis</td>
            <td>Antonio Pérez Sánchez</td>
            <td>12/03/2014</td>
            <td>30/07/2014</td>
            <td>Programador Java</td>
            <td><a href="#">Ver</a></td>
			<td class="cell-status"><label class="pass">Finalizado</label></td>
        </tr>
        <tr>
            <td>0051100</td>
            <td>Everis</td>
            <td>Elvira Jurado Pérez</td>
            <td>12/03/2014</td>
            <td>30/07/2014</td>
            <td>Programador PHP</td>
            <td><a href="#">Ver</a></td>
			<td class="cell-status"><label class="fail">Cancelado</label></td>
        </tr>
        <tr>
            <td>0051101</td>
            <td>Indra</td>
            <td>Pedro Ramirez García</td>
            <td>13/03/2014</td>
            <td>31/12/2014</td>
            <td>Administrador de Sistemas</td>
            <td><a href="#">Ver</a></td>
			<td class="cell-status"><label class="fail">Cancelado</label></td>
        </tr>
        <tr>
            <td>0051101</td>
            <td>Iberdrola</td>
            <td>Javier Vega Rodriguez</td>
            <td>15/03/2014</td>
            <td>31/09/2014</td>
            <td>Analista de datos</td>
            <td><a href="#">Ver</a></td>
            <td class="cell-status"><label class="pass">Finalizado</label></td>
        </tr>
        </table>
        </div>

        <input type=image src="img/mover-a-la-anterior.jpg" width="25" height="15">
        <input type=image src="img/mover-a-la-siguiente.jpg" width="25" height="15">

	</div>
    <?php include ('footer.html'); ?>
  </div>
  </body>
</html>
