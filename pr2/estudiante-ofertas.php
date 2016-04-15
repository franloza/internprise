<!DOCTYPE html>
<html>
<?php include ('estudiante-head.html'); ?>
  <body>
  <div id="container-ofertas" class="container">
	<?php include ('estudiante-menu.html'); ?>
	<?php include ('estudiante-titlebar.html'); ?>
	<div id="content-ofertas" class="content">
        <div id="tabla-ofertas" class="table-container">
            <div class="table-header"> Ofertas disponibles - 4 restantes</div>
             <table class="estudiante-table">
                <tr>
                    <th>Empresa</th>
                    <th>Puesto</th>
                    <th>Sueldo</th>
                    <th>Horas</th>
                    <th>Plazas</th>
                    <th>Accion</th>
                    <th>Solicitar</th>    
                </tr>
                <tr>
                    <td><a href="estudiante-ofertas-vista.php">Intel</a></td>
                    <td>Especialista IT</td>
                    <td>400€</td>
                    <td>20</td>
                    <td>2</td>
                    <td><a href="#">Ver</a></td>
                    <td><input type="checkbox"></td>
                </tr>
                <tr>
                    <td><a href="estudiante-ofertas-vista.php">Google ESP</a></td>
                    <td>Analista de datos</td>
                    <td>500€</td>
                    <td>25</td>
                    <td>1</td>
                    <td><a href="estudiante-ofertas-vista.php">Ver</a></td>
                    <td><input type="checkbox" disabled="disabled" checked></td>
                </tr>
                <tr>
                    <td><a href="estudiante-ofertas-vista.php">Coritel</a></td>
                    <td>Desarrollador Web</td>
                    <td>450€</td>
                    <td>25</td>
                    <td>2</td>
                    <td><a href="estudiante-ofertas-vista.php">Ver</a></td>
                    <td><input type="checkbox"></td>
                </tr>
                <tr>
                    <td><a href="estudiante-ofertas-vista.php">Indra</a></td>
                    <td>Seguridad y firewall</td>
                    <td>400€</td>
                    <td>20</td>
                    <td>1</td>
                    <td><a href="estudiante-ofertas-vista.php">Ver</a></td>
                    <td><input type="checkbox"></td>
                </tr>
            </table>
        </div>
	</div>  
  <?php include ('estudiante-footer.html'); ?>
  </div>
  </body>
</html>
