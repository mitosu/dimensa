<?php
/* 
    Created on : 24-mar-2014, 20:59:50
    Author     : Mitosu
    Name: Miguel Angel Torres 
 */

echo '<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">'._EMP_EMPRESA.'</a>
                </div>
                <div class="navbar-collapse collapse">
                    <form class="navbar-form navbar-right" role="form">
                        <div id="text-zona-clientes" class="form-group">
                            <label for="usuario">Zona de Clientes</label>
                        </div>
                        <div class="form-group">
                            <input id="usuario" type="text" placeholder="Usuario" class="form-control" data-toggle="popover" data-placement="bottom" data-content="Para acceder al area de Clientes por favor Ingrese sus credenciales">
                        </div>
                        <div class="form-group">
                           <input type="password" class="form-control" placeholder="Contraseña">
                        </div>
                        <button type="submit" class="btn btn-success">Entrar</button>
                    </form>
                </div><!--/.navbar-collapse -->
            </div>
        </div>';