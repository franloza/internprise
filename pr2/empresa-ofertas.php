<!DOCTYPE html>
<html>
<?php include ('empresa-head.html'); ?>
  <body>
  <div id="container-empresa-ofertas" class="container">
	<?php include ('empresa-menu.html'); ?>
	<?php include ('empresa-titlebar.html'); ?>
	<div id="content-empresa-ofertas" class="content">
		<div class="crear">
            <form action="empresa-crear-oferta.php">
				<input type=submit value="Crear Oferta">
			</form>
        </div>
	   <div id="tablas-ofertas">
        <div id="tabla-ofertas" class="table-container">
            <div class="table-header"> Ofertas disponibles </div>
             <table class="empresa-table">
                <tr>
                    <th>Empresa</th>
                    <th>Puesto</th>
                    <th>Sueldo</th>
                    <th>Horas</th>
                    <th>Plazas</th>
                    <th>Accion</th>
                </tr>
                <tr>
                    <td>Intel</td>
                    <td>Especialista IT</td>
                    <td>400€</td>
                    <td>20</td>
                    <td>2</td>
                    <td><a href="empresa-ofertas-vista.php">Ver</a></td>
                </tr>
                <tr>
                    <td>Google ESP</td>
                    <td>Analista de datos</td>
                    <td>500€</td>
                    <td>25</td>
                    <td>1</td>
                    <td><a href="empresa-ofertas-vista.php">Ver</a></td>
                </tr>
                <tr>
                    <td>Coritel</td>
                    <td>Desarrollador Web</td>
                    <td>450€</td>
                    <td>25</td>
                    <td>2</td>
                    <td><a href="empresa-ofertas-vista.php">Ver</a></td>
                </tr>
                <tr>
                    <td>Indra</td>
                    <td>Seguridad y firewall</td>
                    <td>400€</td>
                    <td>20</td>
                    <td>1</td>
                    <td><a href="empresa-ofertas-vista.php">Ver</a></td>
                </tr>
            </table>
        </div>
	</div>
	</div>
  <?php include ('empresa-footer.html'); ?>
  </div>
  </body>
</html>