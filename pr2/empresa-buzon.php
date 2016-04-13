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
				    <p> Consulta </p>
				    <p>
					<textarea name="consulta" rows=1 placeholder="Asunto" id="textarea-asunto"></textarea>
					<textarea name="consulta" rows=8 placeholder="Escribo con motivo de ..." id="textarea-texto"></textarea>
				    </p>
				  	<p>
					  Motivo de la consulta <input type="radio" name="motivo" value="Evaluacion" checked="checked" /> Evaluacion
					  <input type="radio" name="motivo" value="Sugerencias" /> Sugerencias
					  <input type="radio" name="motivo" value="Críticas" /> Criticas
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