<!DOCTYPE html>
<html>
<?php include ('empresa-head.html'); ?>
  <body>
  <div id="container-empresa-buzon" class="container">
	<?php include ('empresa-menu.html'); ?>
	<?php include ('empresa-titlebar.html'); ?>
	<div id="content-empresa-crear-oferta" class="content">
		<div id="empresa-crear-oferta" class="crear-oferta">
			<form class="form-crear-oferta" id="form-crear-oferta" action="" method="post">
			    <h2>Rellena los campos de la nueva oferta:</h2>
				<fieldset>
      				<input placeholder="Nombre" type="text" tabindex="1"required autofocus>
    			</fieldset>
    			<fieldset>
      				<textarea placeholder="Puesto" tabindex="2" cols="100" rows="10" required></textarea>
    			</fieldset>
				
				<fieldset>
      				<button name="submit" type="submit" id="buzon-submit-empresa" data-submit="...Sending">Crear</button>
    			</fieldset>
			</form>
		</div>
	</div>
  <?php include ('empresa-footer.html'); ?>
  </div>
  </body>
</html>