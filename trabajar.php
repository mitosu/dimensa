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
        <script src="js/languages/jquery.validationEngine-es.js"></script>
        <script src="js/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
        <link rel="stylesheet" href="css/validationEngine.jquery.css">
        <script>

        </script>
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
        <script>
            $(document).ready(function() {
                $('#trabaja').validationEngine();
                $('#recaptcha_response_field').addClass('validate[required]');
                $('#nombre').focus();
                $('#email').focus(showRecaptcha);
                $("#send").click(captcha);

            });

            function showRecaptcha() {
                Recaptcha.create("6LdIZvESAAAAAMvzK9XKazyoantAv1vg_KaPN-BY",
                        "recaptcha",
                        {
                            theme: "blackglass"
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
                            $('#trabaja').submit();
                        }
                    }
                });
            }

        </script>
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
                <div class="col-md-9">
                    <!--About us-->
                    <?php include ('trabajar_text.php'); ?>

                    <div class="row">
                        <div class="col-md-4">
                            <?php include ('empresa_box.php'); ?>
                        </div>
                        <div class="col-md-8">
                            <?php
                            if(isset($_GET['mensaje'])){
                                echo '<h5><span class="label label-success">Mensaje enviado con exito!</span></h5>';
                            }
                            ?>
                            <h4><span class="label label-primary">Envíe su curriculum</span></h4>
                            <form enctype="multipart/form-data" id="trabaja" role="form" action="enviaform_trabajar.php" method="POST">
                                <div class="form-group">
                                    <label for="nombre">(*) Su nombre: </label>
                                    <input type="text" class="form-control validate[required]" id="nombre" name="nombre" placeholder="Escriba su nombre">
                                </div>
                                <div class="form-group">
                                    <label for="email">(*) E-mail: </label>
                                    <input type="email" class="form-control validate[required,custom[email]]" id="email" name="email" placeholder="Escriba su e-mail">
                                </div>
                                <div class="form-group">
                                    <label for="addfile">Adjunte su curriculum</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10000" />
                                    <input type="file" id="addfile" name="userfile">
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label for="mensaje">Mensaje:</label>
                                    <textarea name="mensaje" id="mensaje" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="row"><div id="recaptcha" class="col-md-12"></div></div>
                                <div><p></p></div>
                                <button id="send" type="button" class="btn btn-default">Enviar</button>
                                <button type="reset" class="btn btn-default">Cancelar</button>
                            </form>
                        </div>
                        <div><p></p></div>
                    </div>

                </div>
                <div class="col-md-3">
                    <!--Our locations-->
                    <?php include ('destinos.php'); ?>
                    <!--Newsletters-->
                    <?php include ('newsletter.php'); ?>
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
            <!--</div>--> <!-- /container -->       <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>-->
            <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.js"><\/script>')</script>

            <script src="js/vendor/bootstrap.min.js"></script>

            <script src="js/main.js"></script>
        </div>
    </body>
</html>
