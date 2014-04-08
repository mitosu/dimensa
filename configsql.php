<?php
include "config.php";

$connect=mysql_connect($dbhost,$dbuname,$dbpass);

mysql_select_db( $dbname, $connect );


if (!$connect){
   echo "<p align='center'><font face='Arial' size='4' color='Green'><b>ERROR: Imposible establecer conexi�n con el servidor.</b></p>";
   exit;
}
if (! mysql_select_db($dbname, $connect)) {
echo "<p align='center'><font face='Arial' size='4' color='Green'><b>ERROR: Imposible seleccionar la base de datos ".$dbname."</b></p>";
exit;
}
?>
