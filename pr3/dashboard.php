<?php session_start();
?>

<!DOCTYPE html>
<html>
<?php include('includes/comun/head.php'); ?>
  <body>
	<div id="container-dashboard" class="container">   
        <?php include ('includes/comun/menu.php'); ?>
        <?php include ('includes/comun/titlebar.php'); ?>
        <div class="content">
            <div class="dashboard-content" class="estudiante-content">
                
                <!-- INI Contenedor busqueda dashboard -->
			<div class="btn-search">
				<a class="icon-search" href="#">
					<i class="fa fa-search fa-2x" style="color:#444;"></i>
				</a>
				<div class="txt-search">
					<form method="post" action="#">
						<input class="txt-search" type="text" placeholder="Buscador de empresas">
					</form>
				</div>
			</div>	            
			<!-- FIN Contenedor busqueda dashboard -->

 
            <!-- INI Contenedor widgets superior -->    
            <div class="widget-content">
                <!-- INI Widget Nuevas ofertas -->  
                <div class="widget">
                    <!-- Header widget -->
                    <div class="widget-header">
                        <p class="title">Nuevas ofertas</p>
                        <p class="title-items">
                            <a class="square" href="#">7</a>
                        </p>
                    </div>
                    <!-- Content widget -->
                    <div class="content-widget">
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Coritel</strong>
                                    Programador Junior C++
                                </div>
                                <div class="text-muted">
                                    <small>Justo ahora</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Ubisoft</strong>
                                    Desarrollador de videojuegos 
                                </div>
                                <div class="text-muted">
                                    <small>Hace 4 minutos</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Seltime</strong>
                                    Analista Programador Java/J2EE
                                </div>
                                <div class="text-muted">
                                	<small>Hace 43 minutos</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Cpl</strong>
                                    Android Developers
                                </div>
                                <div class="text-muted">
                                    <small>Hace 4 horas</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Ecinsa</strong>
                                    Programador PHP Senior
                                </div>
                                <div class="text-muted">
                                    <small>Hace 1 dia</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>VASS</strong>
                                    Analista Programador .NET
                                </div>
                                <div class="text-muted">
                                    <small>Hace 2 dias</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>ICES</strong>
                                    Desarrollador Oracle forms reports
                                </div>
                                <div class="text-muted">
                                    <small>Hace 3 dias</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN Widget Nuevas ofertas -->  

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
                                <i class="fa fa-times-circle" style="color:red;" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong> Oracle España </strong> ha rechazado tu demanda a la oferta <strong>Administrador Solaris</strong>
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
                                   La universidad ha aprobado tu demanda a la oferta <strong>Administrador Solaris</strong> de <strong>Oracle España</strong>
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


        <?php include ('includes/comun/footer.php'); ?>
  </body>
</html>