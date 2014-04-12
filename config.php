<?php
#Datos Zona Horario
date_default_timezone_set('Europe/Madrid');
$mashours=0;   //apartir 27.3.2011

# Datos MySql
$dbhost = "www.dimensa.net";
$dbuname= "dimensa" ;
$dbpass = "Dimensa2014";
$dbname = "dimensa";

#Datos recaptcha
define('_REC_PUBLIC_KEY', '6LdIZvESAAAAAMvzK9XKazyoantAv1vg_KaPN-BY');
define('_REC_PRIVATE_KEY', '6LdIZvESAAAAACA399e226Gx4bZkqQ-6eNmNrloM');

# Datos Generales del Sitio
define('_SITE_URL', 'www.dimensa.net'); // URL del Sitio (sin /)
define('_EMP_KEYWORDS', 'transporte madrid, empresa transporte madrid, mensajeria madrid');

# Datos Cliente
define('_EMP_TEL',	'91 326 32 40');
define('_EMP_MOTO',	'Dimensa, S.L.');
define('_EMP_TITLE', '<title>Dimensa | Mensajeros | Mensajerías | Courier | Transporte Urgente</title>');
define('_EMP_MAILTO', '<a href="mailto:trafico@dimensa.net">trafico@dimensa.net</a>' );
define('_EMP_MAIL_INFO', 'trafico@dimensa.net ');
define('_EMP_LEMA',	'Dimensa');
define('_EMP_LEMA_EMPRESA', 'Quienes somos');
define('_EMP_SERV_NACIONAL', 'Servicio Nacional');
define('_EMP_SERV_INSULAR', 'Servicio Insular');
define('_EMP_SERV_LOCAL','Servicio Local');
define('_EMP_SERV_INTERNACIONAL', 'Servicio Internacional');
define('_EMP_TRABAJAR', 'Trabaja con nosotros');
define('_EMP_INFO', 'Solicitud de información');
define('_EMP_LEMA_LOCATION', 'Localización');
define('_EMP_ZN_CLIENTES', 'Zona Clientes');
define('_EMP_TEL34', '91 326 32 40');
define('_EMP_SUPPORT_SPAIN', '+34 91 326 32 40');
define('_EMP_SKYPE', 'skype:pessystems?call');
define('_EMP_EMPRESA','Dimensa, S.L.');
define('_TEL_COMERCIAL', '91 326 32 40');
define('_TEL_RECOGIDAS', '91 326 32 40');
define('_EMP_MAIL','trafico&#64;dimensa.net');
define('_EMAIL_COMERCIAL', '<a href="mailto:comercial@pes-systems.net">trafico@dimensa.net</a>');
define('_EMAIL_RECOGIDAS', '<a href="mailto:recogidas@pes-systems.net">trafico@dimensa.net</a>');
define('_EMP_DP_CIUDAD','28027 Madrid');
define('_EMP_CIF','B78909611');
define('_EMP_CALLE',	'Vigen de la Paz, 14');
define('_TITULO_SERVICIOS_MAIN', '<h3> <span class="label label-primary">SERVICIOS</span></h3>');


define('_EMP_MAPA', '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3036.8572375183007!2d-3.659522!3d40.43416!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422f4a7db92ff7%3A0x5ee4ba224e32ebed!2sDimensa!5e0!3m2!1ses!2ses!4v1396884765270" width="600" height="450" frameborder="0" style="border:0"></iframe>');

define('_EMP_DT', '<b>Dimensa, S.L.<br> Virgen de la Paz,14<br>
28027 Madrid</b><br><br style="line-height:7px">
Teléfono: &nbsp; &nbsp; &nbsp;91 326 32 40<br>
E-mail: <strong><a href="mailto:trafico&#64;dimensa.net">trafico&#64;dimensa.net</a></strong>');
//IP Cliente
$ip = $_SERVER["REMOTE_ADDR"];

 $mailreco_to = "trafico@dimensa.net";
 $mailreco_from = "trafico@dimensa.net";
// $mailreco_subject="Solicitude de recolección desde la web ".$rnumserv ." Hr ".$horatoma;
 //$mailreco_body = $msg; 
 $mail_host     = "mail.dimensa.net";
 $mail_username = "trafico@dimensa.net";
 $mail_password = "913263240";
 $mail_port = "587"; 

$empmailentrega_sender_name="trafico@dimensa.net"					; 

#envia info
 $enviainfo_to = "trafico@dimensa.net";
 //$enviainfo_to = "ventas@pes-systems.net";
 
 $enviainfo_from = "trafico@dimensa.net";
 $enviainfo_host     = "mail.dimensa.net";
 $enviainfo_username = "trafico@dimensa.net";
 $enviainfo_password = "913263240";
 $enviainfo__port    = 25;
 
 
 /*
 $enviainfo_from = "clientes@recogidas.net";
 $enviainfo_host     = "mail.recogidas.net";
 $enviainfo_username = "clientes@recogidas.net";
 $enviainfo_password = "1234567890";
 $enviainfo__port    = 25;
 */
 
 
 

 

