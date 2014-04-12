<?php require_once ('recaptchalib.php'); ?>
<!DOCTYPE html>
<?php include ('config.php'); ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
        <?php echo _EMP_TITLE; ?>
        <meta name="keywords" content="<?php echo _EMP_KEYWORDS ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery-1.8.2.min.js"></script>
        <script src="js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
        <script>
            $(document).ready(function() {
                $('#info').validationEngine();
                $('#recaptcha_response_field').addClass('validate[required]');
                $('#empresa').focus();
                $('#empresa').focusout(showRecaptcha);
                $("#send").click(captcha);

            });

            function showRecaptcha() {
                Recaptcha.create("6LdIZvESAAAAAMvzK9XKazyoantAv1vg_KaPN-BY",
                        "recaptcha",
                        {
                            theme: "clean"
                        }
                );
            }
            //Comprobación
            function captcha() {
                var v1 = $("input#recaptcha_challenge_field").val();
                var v2 = $("input#recaptcha_response_field").val();

                $.ajax({
                    type: "POST",
                    url: "verify.php",
                    data: "recaptcha_challenge_field=" + v1 + "&recaptcha_response_field=" + v2,
                    dataType: "html",
                    error: function() {
                        alert("error petición ajax");
                    },
                    success: function(data) {
                        if (data == 0) {
                            alert('El código es incorrecto');
                            showRecaptcha();
                        } else if (data == 1) {
                            $('#info').submit();
                        }
                    }
                });
            }

        </script>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>-->
        <script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylepage.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!--customers_area-->
<?php include('customers_area_nav.php'); ?>
        <div id="contenido" class="container"><!--Contenido-->
            <!--header.php-->
<?php include ('header.php'); ?>

            <!--Cotenido Cuerpo-->
            <div class="row">
                <div class="col-md-9 ">
                    <!--About us-->
                    <?php
                    if (isset($_GET['mensaje'])) {
                        echo '<h5><span class="label label-success">Mensaje enviado con exito!</span></h5>';
                    }
                    ?>
<?php include ('info_text.php'); ?>
                    <form id="info" role="form" action="enviaform_info.php" method="GET">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="empresa">(*) Empresa: </label>
                                    <input type="text" class="form-control validate[required]" id="empresa" placeholder="Escriba el nombre de su empresa" name="empresa">
                                </div>
                                <div class="form-group">
                                    <label for="contacto">(*) Persona de contacto: </label>
                                    <input type="text" class="form-control validate[required]" id="contacto" placeholder="Escriba el nombre de contacto" name="contacto">
                                </div>
                                <div class="form-group">
                                    <label for="direccion">(*) Dirección: </label>
                                    <input type="text" class="form-control validate[required]" id="direccion" placeholder="Escriba la dirección de la empresa" name="direccion">
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cpostal">(*) C.P. : </label>
                                            <input type="text" class="form-control validate[required]" id="cpostal" placeholder="Código postal" name="cpostal">
                                        </div>                                        
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="ciudad">(*) Ciudad: </label>
                                            <input type="text" class="form-control validate[required]" id="ciudad" placeholder="Ciudad" name="ciudad">
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Teléfono: </label>
                                            <input type="text" class="form-control" id="phone" placeholder="Escriba su teléfono" name="phone">
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fax">Fax: </label>
                                            <input type="text" class="form-control" id="fax" placeholder="Escriba su fax" name="fax">
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">(*) E-Mail: </label>
                                    <input type="email" class="form-control validate[required,custom[email]]" id="email" placeholder="Escriba su dirección de correo" name="email">
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <h6><strong>Nos interesa servicios:</strong></h6>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="Locales" name="servicios[]">
                                        Locales
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="Nacionales" name="servicios[]">
                                        Nacionales
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="Internacionales" name="servicios[]">
                                        Internacionales
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="mensaje">Mensaje:</label>
                                    <textarea  class="form-control" rows="5" id="mensaje" placeholder="Escriba su mensaje" name="mensaje"></textarea>
                                </div>
                                <div id="recaptcha" class="form-group">

                                </div>
                                <button id="send" type="button" class="btn btn-default">Enviar</button>
                                <button type="reset" class="btn btn-default">Restablecer</button><br/>
                                (*) Campos obligatorios
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <!--Our locations-->
<!---<?php include ('destinos.php'); ?>-->
                    <!--Newsletters-->
                </div>
            </div>


            <!--SubContenido-->
            <div class="row">
            </div>

            <hr>

            <footer>
                <!--Menu Bottom-->
<?php include ('footer.php'); ?>
            </footer>
            <!--</div>--> <!-- /container -->
            <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.js"><\/script>')</script>
            <script src="js/vendor/bootstrap.min.js"></script>
            <script src="js/main.js"></script>           
            <script>

            </script>
        </div>
    </body>
</html>