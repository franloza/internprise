<!DOCTYPE html>
<html>
<?php include ('empresa-head.html'); ?>
  <body>
  <div id="container-empresa-buzon" class="container">
	<?php include ('empresa-menu.html'); ?>
	<?php include ('empresa-titlebar.html'); ?>
	<div id="content-empresa-buzon" class="content">
		<div id="empresa-buzon" class="buzon">
			<h2>Dejanos tus sugerencias y las leeremos cuanto antes</h2>
			<h1>¡Ayuda a mejorar Internprise!</h1>
	    <div id="form-buzon-empresa" class="form-buzon">
 		    <div class="form-div">
			    <form class="form" id="form1" action="">
				    <div id="container-texareas-empresa-buzon" class="container-texareas-buzon">
						<textarea name="consulta" rows="1" cols="50" placeholder="Asunto" id="textarea-asunto"></textarea>
						<br>
						<textarea name="consulta" rows="20" cols="50" placeholder="Escribo con motivo de ..." id="textarea-texto"></textarea>
				    </div>
				  	<p>
					  <input type="radio" name="motivo" value="Duda" checked="checked" /> Duda
					  <input type="radio" name="motivo" value="Sugerencia" /> Sugerencia
					  <input type="radio" name="motivo" value="Contacto" /> Contacto
					  <input type="radio" name="motivo" value="Otro" /> Otro
				  	</p>
				 	<div class="submit">
						<input type="submit" value="Enviar" id="boton-enviar"/>
				  	</div>
				</form>
			</div>
		</div>
		</div>
	</div>
  <?php include ('empresa-footer.html'); ?>
  </div>
  </body>
</html>