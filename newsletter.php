<?php

/* 
    Created on : 24-mar-2014, 20:59:50
    Author     : Mitosu
    Name: Miguel Angel Torres 
 */
if(isset($_GET['mensaje'])){
    echo '<h5><span class="label label-success">Se ha suscrito con exito!</span></h5>';
}
echo '<form name="news" id="news" action="envia_subscripcion_news.php" method="POST">
                        <span class="boletin label label-info">Boletín de Noticias</span>
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input type="text" name="email" class="form-control" placeholder="Correo">
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-default">Subscribirme !</button>
                    </form>';
