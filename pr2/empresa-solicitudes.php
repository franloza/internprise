<!DOCTYPE html>
<html>
<?php include ('empresa-head.html'); ?>
  <body>
  <div id="container-empresa-solicitudes" class="container">
	<?php include ('empresa-menu.html'); ?>
	<?php include ('empresa-titlebar.html'); ?>
	<div id="content-empresa-solicitudes" class="content">
		 <div id="tabla-ofertas" class="table-container">
            <div class="table-header"> Solicitudes </div>
             <table class="admin-table">
                <tr>
                    <th>Id Oferta</th>
                    <th>Puesto</th>
                    <th>Estudiante</th>
                    <th>Acción</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Especialista IT</td>
                    <td><a href="estudiante-perfil.php">Alejandro Martin</a> </td>
                    <td><a href="">Aceptar / Rechazar</a></td>
                </tr>
				<tr>
                    <td>1</td>
                    <td>Especialista IT</td>
                    <td><a href="estudiante-perfil.php">Antonio Recio</a> </td>
                    <td><a href="">Aceptar / Rechazar</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Analista de datos</td>
                    <td><a href="estudiante-perfil.php">Enrique Pastor</a></td>
                    <td><a href="">Aceptar / Rechazar</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Analista de datos</td>
                    <td><a href="estudiante-perfil.php">Juan Cuesta</a></td>
                    <td><a href="">Aceptar / Rechazar</a></td>
                </tr>				
                <tr>
                    <td>2</td>
                    <td>Analista de datos</td>
                    <td><a href="estudiante-perfil.php">Amador Rivas</a></td>
                    <td><a href="">Aceptar / Rechazar</a></td>
                </tr>
            </table>
        </div>
	</div>
  <?php include ('empresa-footer.html'); ?>
  </div>
  </body>
</html>