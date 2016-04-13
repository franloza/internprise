<!DOCTYPE html>
<html>
	<?php include ('empresa-head.html'); ?>
  	<body>
  	<div id="container-empresa-dashboard" class="container">
		<?php include ('empresa-menu.html'); ?>
		<?php include ('empresa-titlebar.html'); ?>
		<div class="content">

			<div class="dashboard-content" class="empresas-content">

		<!-- INI Contenedor widgets superior -->
		<div class="widget-content">
			<!-- INI Widget Contratos activos -->
			<div class="Buscador-talentos">
				<h2>Buscador de talentos</h1>
				<div class="filtros">
            <label>Seleccionar oferta:</label>
            <select class="filtro">
                <option value="Todas">Todas</option>
                <option value="ProgramadorJava">Programador en Java</option>
                <option value="DiseñadorGrafico">Diseñador Gráfico</option>
            </select>
        </div>
				<a href=#> Buscar </a>

			</div>
			<!-- FIN Widget Contratos activos -->

				<!-- INI Widget Novedades -->
				<div class="widget">
						<!-- Header widget -->
						<div class="widget-header">
								<p class="title">Novedades</p>
								<p class="title-items">
										<a class="square" href="#">2</a>
								</p>
						</div>
						<!-- Content widget -->
						<div class="content-widget">
								<div class="media">
										<div class="media-left">
												<i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i>
										</div>
										<div class="media-body">
												<div class="media-header">
														<strong> Gallina Lopez </strong> ha aceptado tu oferta <strong>Administrador Solaris</strong>
												</div>
												<div class="text-muted">
														<small>Hace 2 dias</small>
												</div>
										</div>
								</div>
								<div class="media">
										<div class="media-left">
												<i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i>
										</div>
										<div class="media-body">
												<div class="media-header">
														<strong> Gallina Lopez </strong> ha demandado tu oferta <strong>Administrador Solaris</strong>
												</div>
												<div class="text-muted">
													<small>Hace 6 dias</small>
												</div>
										</div>
								</div>
						</div>
				</div>
				<!-- FIN Widget Contratos activos -->

		</div>
		<!-- FIN Contenedor widgets superior -->
</div>

		</div>
  		<?php include ('empresa-footer.html'); ?>
  	</div>
  </body>
</html>
