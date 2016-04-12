 <!DOCTYPE html>
<html>
<?php include ('admin-head.html'); ?>
  <body>
	<div id="container-dashboard" class="container">   
        <?php include ('admin-menu.html'); ?>
        <?php include ('admin-titlebar.html'); ?>
        <div id="dashboard-content" class="content"> 
	        <div class="widget-container">
                <form class="form-search cf" action="">
                    <input type="text" placeholder="Buscador de estudiantes / empresas">
                </form>
	        </div>
            <div class="widget-container">
                <div class="widget">
                    <header>
                        <h2>Nuevas ofertas</h2>
                    </header>
                    <div class="widget-content">
                        <ul>
                            <li>Programador C++ en Coritel</li>
                            <li>Administrador de redes en Telefonica</li>
                            <li>Diseñador Web en Bankia</li>
                            <li>Desarrollador de videojuegos en Activision</li>
                        </ul>
                    </div>
                </div>    
                <div class="widget">
                    <header>
                        <h2>Contratos activos</h2>
                    </header>
                    <div class="widget-content">
                        <ul>
                            <li>Juan Machin en Red.es</li>
                            <li>Francisco Gonzalez </li>
                            <li>Linea 3</li>
                            <li>Linea 4</li>
                        </ul>
                    </div>
                </div>
	        </div>
            <div class="widget-container">
                <div class="widget">
                    <header>
                        <h2>Nuevas demandas</h2>
                    </header>
                    <div class="widget-content">
                        <ul>
                            <li>Linea 1</li>
                            <li>Linea 2</li>
                            <li>Linea 3</li>
                            <li>Linea 4</li>
                        </ul>
                    </div>
                </div>
                <div class="widget">
                    <header>
                        <h2>Dudas y sugerencias</h2>
                    </header>
                    <div class="widget-content">
                        <ul>
                            <li>Linea 1</li>
                            <li>Linea 2</li>
                            <li>Linea 3</li>
                            <li>Linea 4</li>
                        </ul>
                    </div>
                </div>
    	   </div>
        </div>
        <?php include ('footer.html'); ?>
    </div>
  </body>
</html>
