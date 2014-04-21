<?php 
error_reporting(0);

$CONFIG["hostname"]='localhost';
$CONFIG["mysql_user"]='dimen';
$CONFIG["mysql_password"]='dimeN1234';
$CONFIG["mysql_database"]='dimensa';
$CONFIG["server_path"]='/Applications/MAMP/htdocs/dimensa/';
$CONFIG["full_url"]='http://localhost/dimensa/';
$CONFIG["folder_name"]='/dimensa/';
$CONFIG["admin_user"]='dimen93';
$CONFIG["admin_pass"]='9dMe3sa';


//////////////////////////////////////////
////////// DO NOT CHANGE BELOW ///////////
//////////////////////////////////////////

$CONFIG["upload_folder"]='upload/';

$TABLE["News"] 		= 'pa_news_news';
$TABLE["Options"] 	= 'pa_news_options';

$Version = 1.2;

if (!isset($installed) or $installed != 'yes') {
	$conn = mysql_connect($CONFIG["hostname"], $CONFIG["mysql_user"], $CONFIG["mysql_password"]) or die ('Unable to connect to MySQL server.'.mysql_error());
	mysql_query('set names utf8', $conn);
	$db = mysql_select_db($CONFIG["mysql_database"], $conn) or die ('Unable to select database.'.mysql_error());
}

require_once('include/functions.php');

$configs_are_set = 1;
?>