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
        $contacto;
        $email;
        $mensaje;
        $msg;

        require("scripts/class.phpmailer.php");
        if (isset($_POST)) {
            $mail = new PHPMailer();
            $contacto = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            
            $varfilename = $_FILES['userfile']['name'];
            $varfilenametemp = $_FILES['userfile']['tmp_name'];
            if($varfilename != ""){
                $mail->addAttachment($varfilenametemp, $varfilename);
            }

            $mensaje = filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_SPECIAL_CHARS);

            $msg = "";
            $msg .= "Contacto : " . $contacto . "<br/>";
            $msg .= "Email: " . $email . "<br/>";         
            $msg .= "Mensaje : " . $mensaje;
        }

        $dDate = date('Y-m-d');

        //$mail = new PHPMailer();
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

        $mail->Subject = "Recursos Humanos - Curriculum Vitae";
        $mail->msgHTML($msg);
        //include ('cargarnbasewin.php');

        if (!$mail->Send()) {
            echo "El mensaje no pudo ser enviado. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
            exit;
        }
        header('Location: trabajar.php?mensaje="ok"');
        echo "El Mensaje fue enviado correctamente";
        ?>
    </body>
</html>
