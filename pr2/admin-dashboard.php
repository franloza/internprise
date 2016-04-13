 <!DOCTYPE html>
<html>
<?php include ('admin-head.html'); ?>
  <body>
	<div id="container-dashboard" class="container">   
        <?php include ('admin-menu.html'); ?>
        <?php include ('admin-titlebar.html'); ?>
        <div class="content">
		<div class="dashboard-content">

			<!-- INI Contenedor busqueda dashboard -->
			<div class="btn-search">
				<a class="icon-search" href="#">
					<i class="fa fa-search fa-2x" style="color:#444;"></i>
				</a>
				<div class="txt-search">
					<form method="post" action="#">
						<input class="txt-search" type="text" placeholder="Buscador de estudiantes / empresas">
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

                <!-- INI Widget Contratos activos -->   
                <div class="widget">
                    <!-- Header widget -->
                    <div class="widget-header">
                        <p class="title">Contratos activos</p>
                        <p class="title-items">
                            <a class="square" href="#">6</a>
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
                                    <strong>Ubisoft</strong>
                                    Jos&eacute; Miguel Maldonado 
                                </div>
                                <div class="text-muted">
                                    <small>Hace 5 dias</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Seltime</strong>
                                    Francisco Jos&eacute; Lozano
                                </div>
                                <div class="text-muted">
                                	<small>Hace 6 dias</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Cpl</strong>
                                    H&eacute;ctor Malag&oacute;n
                                </div>
                                <div class="text-muted">
                                    <small>Hace 12 dias</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Ecinsa</strong>
                                    Alejandro Mart&iacute;n
                                </div>
                                <div class="text-muted">
                                    <small>Hace 20 dias</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>VASS</strong>
                                    Andr&eacute;s Plaza
                                </div>
                                <div class="text-muted">
                                    <small>Hace 23 dias</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>ICES</strong>
                                    H&eacute;ctor Riesco
                                </div>
                                <div class="text-muted">
                                    <small>Hace 30 dias</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN Widget Contratos activos -->   

            </div>
            <!-- FIN Contenedor widgets superior -->    

            <!-- INI Contenedor widgets inferior -->    
            <div class="widget-content">
                <!-- INI Widget Nuevas demandas --> 
                <div class="widget">
                    <!-- Header widget -->
                    <div class="widget-header">
                        <p class="title">Nuevas demandas</p>
                        <p class="title-items">
                            <a class="square" href="#">3</a>
                        </p>
                    </div>
                    <!-- Content widget -->
                    <div class="content-widget">
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-caret-square-o-down" style="color:#FF800D"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Seguridad</strong>
                                    Empresas seguridad servidores
                                </div>
                                <div class="text-muted">
                                    <small>Hace 5 dias</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-caret-square-o-down" style="color:#FF800D"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Programacion</strong>
                                    Python
                                </div>
                                <div class="text-muted">
                                    <small>Hace 7 dias</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-caret-square-o-down" style="color:#FF800D"></i>
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Administrador</strong>
                                    Servidores Linux
                                </div>
                                <div class="text-muted">
                                    <small>Hace 10 dias</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- FIN Widget Nuevas demandas-->  

                <!-- INI Widget Dudas y sugerencias --> 
                <div class="widget">
                    <!-- Header widget -->
                    <div class="widget-header">
                        <p class="title">Dudas y sugerencias</p>
                        <p class="title-items">
                            <a class="square" href="#">10</a>
                        </p>
                    </div>
                    <!-- Content widget -->
                    <div class="content-widget">
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-commenting-o" style="color:#B9264F"></i>    
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Luis</strong>
                                    Sugerencia seccion ofertas
                                </div>
                                <div class="text-muted">
                                    <small>Hace 1 horas</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-commenting-o" style="color:#B9264F"></i>    
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Pedro</strong>
                                    Error acceso panel control
                                </div>
                                <div class="text-muted">
                                    <small>Hace 3 horas</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-commenting-o" style="color:#B9264F"></i>    
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Lucia</strong>
                                    Error login usuario
                                </div>
                                <div class="text-muted">
                                    <small>Hace 20 horas</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-commenting-o" style="color:#B9264F"></i>    
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Esther</strong>
                                    Sugerencia buzon de comentarios
                                </div>
                                <div class="text-muted">
                                    <small>Hace 1 dia</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-commenting-o" style="color:#B9264F"></i>    
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Jaime</strong>
                                    Duda con empresa Ubisoft
                                </div>
                                <div class="text-muted">
                                    <small>Hace 3 dias</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-commenting-o" style="color:#B9264F"></i>    
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Enrique</strong>
                                    Horas laborales en CPL
                                </div>
                                <div class="text-muted">
                                    <small>Hace 4 dias</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-commenting-o" style="color:#B9264F"></i>    
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Alejandro</strong>
                                    Problema con empresa CetMe
                                </div>
                                <div class="text-muted">
                                    <small>Hace 10 dias</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-commenting-o" style="color:#B9264F"></i>    
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Silvia</strong>
                                    Sugerencia sobre diseño
                                </div>
                                <div class="text-muted">
                                    <small>Hace 15 dias</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-commenting-o" style="color:#B9264F"></i>    
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Alberto</strong>
                                    Problema con boton Encuestas
                                </div>
                                <div class="text-muted">
                                    <small>Hace 20 dias</small>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-commenting-o" style="color:#B9264F"></i>    
                            </div>
                            <div class="media-body">
                                <div class="media-header">
                                    <strong>Andrea</strong>
                                    Sugerencia sobre contratos
                                </div>
                                <div class="text-muted">
                                    <small>Hace 1 mes</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN Widget Dudas y sugerencias --> 

            </div>
            <!-- FIN Contenedor widgets inferior -->    
		</div>   
		</div>

        <?php include ('admin-footer.html'); ?>
    </div>
  </body>
</html>
