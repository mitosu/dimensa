<?php include ('config.php'); ?>
<!DOCTYPE html>
<!--
/* 
    Created on : 4-Abril-2014, 10:50:50
    Author     : Mitosu
    Name: Miguel Angel Torres 
 */
-->
<html>
    <head>
        <meta charset="UTF-8">
        <!--<meta http-equiv="refresh" content="0; URL=info.php?mensaje=Información Enviado">-->
        <title>Mensaje enviado</title>
    </head>
    <body>
        <?php
        $empresa;
        $direccion;
        $dp;
        $ciudad;
        $nombre;
        $telefono;
        $fax;
        $email;
        $mensaje;
        $msg;

        require("scripts/class.phpmailer.php");
        if (isset($_GET)) {
            $empresa = filter_input(INPUT_GET, 'empresa', FILTER_SANITIZE_SPECIAL_CHARS);
            $direccion = filter_input(INPUT_GET, 'direccion', FILTER_SANITIZE_SPECIAL_CHARS);
            $dp = filter_input(INPUT_GET, 'cpostal', FILTER_SANITIZE_SPECIAL_CHARS);
            $ciudad = filter_input(INPUT_GET, 'ciudad', FILTER_SANITIZE_SPECIAL_CHARS);
            $nombre = filter_input(INPUT_GET, 'contacto', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefono = filter_input(INPUT_GET, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
            $fax = filter_input(INPUT_GET, 'fax', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL);
            $mensaje = filter_input(INPUT_GET, 'mensaje', FILTER_SANITIZE_SPECIAL_CHARS);

            $msg = "";
            $msg .= "Empresa : " . $empresa . "<br/>";
            $msg .= "Persona de contacto: ".$nombre."<br/>";
            $msg .= "Direcci&oacute;n : " . $direccion . "<br/>";
            $msg .= "Dp-Ciudad: " . $dp . " ".$ciudad."<br/>";
            $msg .= "Tel.: " . $telefono . "<br/>";
            $msg .= "Fax.: " . $fax . "<br/>";
            $msg .= "Email: " . $email . "<br/>";
            $msg .= "Servicios de interes :<br/>";

            $servicios = "";

            if (isset($_GET['servicios'])) {
                foreach ($_GET['servicios'] as $value) {
                    $servicios.= $value . "<br/>";
                }
            }
            $msg.=$servicios;
            $msg .="<br/>";
            $msg .= "Mensaje : " . $mensaje;
        }

        $dDate = date('Y-m-d');

        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->IsSMTP();
        $mail->Host = $enviainfo_host;
        $mail->SMTPAuth = true;
        $mail->Username = $enviainfo_username;
        $mail->Password = $enviainfo_password;
        $mail->Port = $enviainfo__port;

        $mail->From = $enviainfo_from;
        $mail->FromName = "Pes Systems";
        $mail->AddAddress($enviainfo_to, "Mensaje Web"); //Mail destino y además "máscara para la dirección".    
        $mail->AddReplyTo("web@recogidas.biz", "Pes Systems"); //Permite hacer un reply a una dirección x.

        $mail->WordWrap = 50;    // set word wrap to 50 characters
        $mail->IsHTML(false);    // set email format to HTML

        $mail->Subject = "Solicitud de información";
        $mail->msgHTML($msg);
        include ('carganbasewin.php');

        if (!$mail->Send()) {
            echo "El mensaje no pudo ser enviado. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
            exit;
        }
        header('Location: info.php?mensaje="ok"');
        ?>
    </body>
</html>
