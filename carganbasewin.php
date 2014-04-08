<?php
      $dfecha = DATE("Y-m-d");
      $hora =$fecha["hours"]+6;
      $min  =$fecha["minutes"];
      $sec  =$fecha["seconds"];
	  $hora =STR_PAD(trim($hora),2,'0',STR_PAD_LEFT  );
      $min =STR_PAD(trim($min),2,'0',STR_PAD_LEFT  );
      $mitime=$hora."H".$min ; //."'".$sec;
	  
include "configsql.php";
$ipclient = $ip;
$comando="insert into nbasewin (COMPANIA,DIR1,DP,CIUDAD,TEL1,CONTACTO1,EMAIL ,NOTAS,FECHA,HORA,IP,PROGRAMAS) values  ('". $empresa."','".$direccion."','".$dp."','".$ciudad."','".$telefono."','".$nombre."','".$email."','".$mensaje."','".$dfecha."','".$mitime."','".$ipclient."','".$servicios."');" ;

$result=mysql_query($comando, $connect);

