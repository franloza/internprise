<!DOCTYPE html>
<html>
<?php include ('admin-head.html'); ?>
 <body>
 <div id="container-historial" class="admin-container">
 <?php include ('admin-menu.html'); ?>
 <?php include ('admin-titlebar.html'); ?>
 <div id="content-buzon" class="admin-buzon">
       <div id="filtros">
           <label>Tipo de mensaje</label>
           <select class="filtro">
               <option value="duda">Duda</option>
               <option value="sugerencia">Sugerencia</option>
               <option value="contacto">Contacto</option>
               <option value="otro">Otro</option>
           </select>
       </div>
    <div id="tabla-buzon">
       <table class="buzon-table">
       <tr>
           <th>Tipo</th>
           <th>Asunto</th>
           <th>Nombre</th>
           <th>Entidad</th>
           <th>Accion</th>
       </tr>
       <tr>
           <td>Duda</td>
           <td>Gallinas</td>
           <td>Iberdrola</td>
           <td>Empresa</td>
           <td><a href="#">Ver</a></td>
       </tr>
       <tr>
         <td>Otro</td>
         <td>Gatos</td>
         <td>E.Lecrerc</td>
         <td>Empresa</td>
         <td><a href="#">Ver</a></td>
       </tr>
       <tr>
         <td>Contacto</td>
         <td>Becas</td>
         <td>Management Solutions</td>
         <td>Empresa</td>
         <td><a href="#">Ver</a></td>
       </tr>
       <tr>
         <td>Sugerencia</td>
         <td>Notas</td>
         <td>UCM</td>
         <td>Empresa</td>
         <td><a href="#">Ver</a></td>
       </tr>
       </table>
       </div>
 </div>
 </div>
 </body>
</html>
