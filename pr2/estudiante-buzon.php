<!DOCTYPE html>
<html>
<?php include ('estudiante-head.html'); ?>
  <body>
  <div id="container-estudiante-buzon" class="container">
	<?php include ('estudiante-menu.html'); ?>
	<?php include ('estudiante-titlebar.html'); ?>
	<div id="content-estudiante-buzon" class="content">
		<div id="estudiante-buzon" class="buzon">
			<form class="form-buzon" id="form-buzon-estudiante" action="" method="post">
			    <h2>Dejanos tus sugerencias y las leeremos cuanto antes</h2>
				<h1>¡Ayuda a mejorar Internprise!</h1>
				<fieldset>
      				<input placeholder="Asunto" type="text" tabindex="1"required autofocus>
    			</fieldset>
    			<fieldset>
      				<textarea placeholder="Texto explicativo..." tabindex="2" cols="100" rows="10" required></textarea>
    			</fieldset>
				<div>
					<input type="radio" name="motivo" value="Duda" checked="checked" /> Duda
					<input type="radio" name="motivo" value="Sugerencia" /> Sugerencia
					<input type="radio" name="motivo" value="Contacto" /> Contacto
					<input type="radio" name="motivo" value="Otro" /> Otro
				</div>
				<fieldset>
      				<button name="submit" type="submit" id="buzon-submit-estudiante" data-submit="...Sending">Enviar</button>
    			</fieldset>
			</form>
		</div>
	</div>
  <?php include ('estudiante-footer.html'); ?>
  </div>
  </body>
</html>