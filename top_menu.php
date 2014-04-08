<?php
/* 
    Created on : 24-mar-2014, 20:59:50
    Author     : Mitosu
    Name: Miguel Angel Torres 
 */

echo '<nav class="menu_top navbar navbar-default" role="navigation">
                <div id="menu-superior" class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="pruebas.php"><span class="glyphicon glyphicon-home"></span></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="empresa.php">Empresa</a></li>
                            <li><a href="localizacion.php">Localización</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Servicios <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="servicios.php#servicio_local">Servicio Local</a></li>
                                    <li><a href="servicios.php#servicio_nacional">Servicio Nacional</a></li>
                                    <li><a href="servicios.php#servicio_insular">Servicio Insular</a></li>
                                    <li><a href="servicios.php#servicio_internacional">Servicio Internacional</a></li>
                                </ul>
                            </li>
                            <li><a href="trabajar.php">Trabajar</a></li>
                            <li><a href="info.php">Información</a></li>
                            <!--<li><a href="clientes.php">Clientes</a></li>-->
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            <!--EndMenu-->';

