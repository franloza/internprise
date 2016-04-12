 <!DOCTYPE html>
<html>
<?php include ('admin-head.html'); ?>
  <body>
    <div id="container-encuestas" class="admin-container">
      <?php include ('admin-menu.html'); ?>
      <?php include ('admin-titlebar.html'); ?>
        <div id="content-encuestas" class="admin-content">
          <div class="widget-container">
            <form class="form-search cf" action="">
             <input type="text" placeholder="Introduzca ID de Contrato">
            </form>
           </div>
            <div id="tabla-encuestas" class="table-container">
              <div class="table-header"> Encuestas realizadas </div>
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