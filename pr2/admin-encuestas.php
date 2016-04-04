 <!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Internprise - Portal Administracion</title>
  <link rel="stylesheet" href="admin.css" type="text/css">
   <link rel="stylesheet" href="menu.css" type="text/css">
    <link rel="stylesheet" href="header.css" type="text/css">
  </head>
  <body>
  <h1> Internprise </h1>
  <div id="container-encuestas" class="admin-container">
	<?php include ('admin-menu.html'); ?>
	<?php include ('admin-header.html'); ?>
	<div id="content-encuestas" class="admin-content">
        <div id="buscador">
        <input type="text" placeholder="Introduzca ID de Contrato">
        </div>
        <div id="tabla-encuestas">
            <table class="admin-table">
                <tr>
                    <th>ID Contrato</th>
                    <th>Empresa</th>
                    <th>Nombre estudiante</th>
                    <th>Acción</th>
                </tr>    
        <tr>
            <td>0051299</td>
            <td>Everis</td>
            <td>Antonio Pérez Sánchez</td>
            <td><a href="#">Ver enc.estudiante</a> / <a href="#"> Ver enc.empresa</a></td>
        </tr>     
        </table>
        </div>
	</div>
     <div class ="widget" id="report-encuestas">
         <p> Total encuestas completadas: 542 </p>
         <p> Satisfacción media de empresas: 6.6/10 </p>
         <p> Satisfacción media de estudiantes: 7.1</p>
         <a href="#"> Ver informe extendido </a>   
	</div>   
  </div>
  </body>
</html>