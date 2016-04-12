 <!DOCTYPE html>
<html>
<?php include ('estudiante-head.html'); ?>
  <body>
	<div id="container-dashboard" class="estudiante-container">   
        <?php include ('estudiante-menu.html'); ?>
        <?php include ('estudiante-titlebar.html'); ?>
        <div class="dashboard-content" class="estudiante-content">
          
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
                    <div class="content">
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <p class="media-header">
                                    <strong>Coritel</strong>
                                    Programador Junior C++
                                </p>
                                <p class="text-muted">
                                    <small>Justo ahora</small>
                                </p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <p class="media-header">
                                    <strong>Ubisoft</strong>
                                    Desarrollador de videojuegos 
                                </p>
                                <p class="text-muted">
                                    <small>Hace 4 minutos</small>
                                </p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <p class="media-header">
                                    <strong>Seltime</strong>
                                    Analista Programador Java/J2EE
                                </p>
                                <p class="text-muted">
                                <small>Hace 43 minutos</small>
                                </p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <p class="media-header">
                                    <strong>Cpl</strong>
                                    Android Developers
                                </p>
                                <p class="text-muted">
                                    <small>Hace 4 horas</small>
                                </p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <p class="media-header">
                                    <strong>Ecinsa</strong>
                                    Programador PHP Senior
                                </p>
                                <p class="text-muted">
                                    <small>Hace 1 dia</small>
                                </p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <p class="media-header">
                                    <strong>VASS</strong>
                                    Analista Programador .NET
                                </p>
                                <p class="text-muted">
                                    <small>Hace 2 dias</small>
                                </p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-envelope-o" style="color:blue;"></i>
                            </div>
                            <div class="media-body">
                                <p class="media-header">
                                    <strong>ICES</strong>
                                    Desarrollador Oracle forms reports
                                </p>
                                <p class="text-muted">
                                    <small>Hace 3 dias</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN Widget Nuevas ofertas -->  

                <!-- INI Widget Contratos activos -->   
                <div class="widget">
                    <!-- Header widget -->
                    <div class="widget-header">
                        <p class="title">Novedades</p>
                        <p class="title-items">
                            <a class="square" href="#">2</a>
                        </p>
                    </div>
                    <!-- Content widget -->
                    <div class="content">
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-times-circle" style="color:red;" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <p class="media-header">
                                    <strong> Oracle España </strong> ha rechazado tu demanda a la oferta <strong>Administrador Solaris</strong>
                                </p>
                                <p class="text-muted">
                                    <small>Hace 2 dias</small>
                                </p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <p class="media-header">
                                    La universidad ha aprobado tu demanda a la oferta <strong>Administrador Solaris</strong> de <strong>Oracle España</strong>
                                </p>
                                <p class="text-muted">
                                <small>Hace 6 dias</small>
                                </p>
                            </div>
                        </div>
                   </div>
            </div>
            <!-- FIN Contenedor widgets superior -->    
        </div> 
    </div>
    <?php include ('estudiante-footer.html'); ?>
  </body>
</html>