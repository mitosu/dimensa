<?php

/* 
    Created on : 09-Abril-2014, 13:09:50
    Author     : Mitosu
    Name: Miguel Angel Torres 
 */

        include ('config.php');
        $email;
        $msg;

        require("scripts/class.phpmailer.php");
        if (isset($_POST)) {
            $mail = new PHPMailer();
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

            $msg = "";
            $msg .= "Email: " . $email . "<br/>";         
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
        $mail->FromName = "Dimensa S.L.";
        $mail->AddAddress($enviainfo_to, "Mensaje Web | Suscribirme a boletín de noticias"); //Mail destino y además "máscara para la dirección".    
        $mail->AddReplyTo("web@recogidas.biz", "Pes Systems"); //Permite hacer un reply a una dirección x.

        $mail->WordWrap = 50;    // set word wrap to 50 characters
        $mail->IsHTML(false);    // set email format to HTML

        $mail->Subject = "Marketing - Suscribirme";
        $mail->msgHTML($msg);
        //include ('cargarnbasewin.php');

        if (!$mail->Send()) {
            echo "El mensaje no pudo ser enviado. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
            exit;
        }
        header('Location: pruebas.php?mensaje="ok"');
        


