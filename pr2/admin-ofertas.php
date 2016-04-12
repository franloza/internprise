<!DOCTYPE html>
<html>
<?php include ('admin-head.html'); ?>
  <body>
  <div id="container-ofertas" class="container">
	<?php include ('admin-menu.html'); ?>
	<?php include ('admin-titlebar.html'); ?>
	<div id="content-ofertas" class="content">
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
	   <div id="tablas-ofertas">
        <div id="tabla-noclasificadas" class="table-container">
            <div class="table-header"> Ofertas no Clasificadas </div>
             <table class="admin-table">
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
                    <td><a href="admin-ofertas-vista.php">Ver</a></td>
                </tr>
                <tr>
                    <td>Google ESP</td>
                    <td>Analista de datos</td>
                    <td>500€</td>
                    <td>25</td>
                    <td>1</td>
                    <td><a href="admin-ofertas-vista.php">Ver</a></td>
                </tr>
                <tr>
                    <td>Coritel</td>
                    <td>Desarrollador Web</td>
                    <td>450€</td>
                    <td>25</td>
                    <td>2</td>
                    <td><a href="admin-ofertas-vista.php">Ver</a></td>
                </tr>
                <tr>
                    <td>Indra</td>
                    <td>Seguridad y firewall</td>
                    <td>400€</td>
                    <td>20</td>
                    <td>1</td>
                    <td><a href="admin-ofertas-vista.php">Ver</a></td>
                </tr>
            </table>
        </div>
        <div id="tabla-clasificadas" class="table-container">
            <table class="admin-table">
                <div class="table-header"> Ofertas clasificadas</div>
                <tr>
                    <th>Empresa</th>
                    <th>Puesto</th>
                    <th>Sueldo</th>
                    <th>Horas</th>
                    <th>Plazas</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
                <tr>
                    <td>Red.es</td>
                    <td>Especialista IT</td>
                    <td>400€</td>
                    <td>20</td>
                    <td>2</td>
                    <td class="cell-status"><label class="pass">Aceptada</label></td>
                    <td><a href="admin-ofertas-vista2.php">Ver</a></td>
                </tr>
                <tr>
                    <td>UCM Fundacion</td>
                    <td>Programador Java Junior</td>
                    <td>400€</td>
                    <td>20</td>
                    <td>3</td>
                    <td class="cell-status"><label class="pass">Aceptada</label></td>
                    <td><a href="admin-ofertas-vista2.php">Ver</a></td>
                </tr>
                <tr>
                    <td>Indra</td>
                    <td>Desarrollador Web</td>
                    <td>450€</td>
                    <td>25</td>
                    <td>2</td>
                    <td class="cell-status"><label class="pass">Aceptada</label></td>
                    <td><a href="admin-ofertas-vista2.php">Ver</a></td>
                </tr>
                <tr>
                    <td>Oracle</td>
                    <td>Programador PHP</td>
                    <td>400€</td>
                    <td>25</td>
                    <td>4</td>
                    <td class="cell-status"><label class="fail">Rechazada</label></td>
                    <td><a href="admin-ofertas-vista2.php">Ver</a></td>
                </tr>
            </table>
        </div>
	</div>
    
  </div>
  <?php include ('footer.html'); ?>
  </div>
  </body>
</html>
