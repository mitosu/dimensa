<?php include ('config.php');?>
<!DOCTYPE html>
<HTML>
    <HEAD>
        <META charset="utf-8">
        <TITLE> Mensaje enviado</TITLE>
        <META NAME="Generator" CONTENT="EditPlus">
        <META NAME="Author" CONTENT="">
        <META NAME="Keywords" CONTENT="">
        <META NAME="Description" CONTENT="">
        <!--<META HTTP-EQUIV=REFRESH CONTENT='2; URL=info.php?mensaje=Información Enviado'>-->

    </HEAD>

    <?php
    require_once('class.phpmailer.php');

    $empresa = $_GET['empresa'];
    $direccion = $_GET['direccion'];
    $dp = $_GET['cpostal'];
    $ciudad = $_GET['ciudad'];
    $nombre = $_GET['contacto'];
    $telefono = $_GET['phone'];
    $fax = $_GET['fax'];
    $email = $_GET['email'];
    $courier = $_GET['locales'];
    $carga = $_GET['nacionales'];
    $maritimo = $_GET['internacionales'];


    $msg = "";
    $msg .= "Empresa   :" . $empresa . "<BR>";
    $msg .= "Dirección :" . $direccion . "<BR>";
    $msg .= "Dp-Ciudad :" . $dp . "-" . $ciudad . "<BR>";
    $msg .= "<BR>";
    $msg .= "Contacto  :" . $nombre . "<BR>";
    $msg .= "Tel       :" . $telefono . "<BR>";

    $msg .= "Fax       :" . $fax . "<BR>";

    $msg .= "Email     :" . $email . "<BR>";
    $msg .= "<BR>";
    /*
      $msg .= "Courier   :". $courier."<BR>";
      $msg .= "Carga     :". $carga."<BR>";
      $msg .= "Maritimo  :". $maritimo."<BR>";

      $msg .= "<BR>";
     */
    $msg .= "Mensaje   :" . $mensaje . "<BR>";


    echo $msg;

    $dDate = DATE("Y-m-d");


    $mail = new PHPMailer();

    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->Host = $enviainfo_host; // SMTP server
    $mail->SMTPDebug = 1;                     // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth = true;                  // enable SMTP authentication
    $mail->Port = $enviainfo__port;                 // set the SMTP port for the GMAIL server
    $mail->Username = $enviainfo_username;             // SMTP account username
    $mail->Password = $enviainfo_password;             // SMTP account password

    $mail->SetFrom($enviainfo_from);


    $mail->Subject = "Solicitude de Información desde la Web";

    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

    $mail->MsgHTML($msg);


//$mail->AddAddress("pruebas@pes-systems.net");

    $mail->AddAddress($enviainfo_to);

    /*Mostrando variables*/
        echo $enviainfo__port .'<br/>';
        echo $enviainfo_from.'<br/>';
        echo $enviainfo_host.'<br/>';
        echo $enviainfo_username.'<br/>';
        echo $enviainfo_password.'<br/>';
    /*fin de mostrar variables*/
    
    if (!$mail->Send()) {
        echo " Mailer Error: " . $mail->ErrorInfo;
        echo " No puede enviar confirmación de enviado por EMail a " . $enviainfo_to;
    } else {
        //	echo "Confirmaci�n enviado por EMail a ".$to." con exito"									;
    }
    ?>


<BODY>
	<p><center>Formulario enviado</center></p>
	<p><center>Gracias</center></p>
  
 </BODY>
</HTML>

