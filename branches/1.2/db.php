<?
//Fichero de conexion para la base de datos de eZopin

$db_host="localhost"; //the host name of the sql server (if you do not know, leave as localhost. usually works)
$db_name="quecome_quecomes";  //the name of the database
$db_user="quecome_ezopin";  //the username that is associated with the database
$db_pass="ena10llo"; //the password for the username

//DO NOT MODIFY ANYTHING ELSE APART FROM THE ABOVE UNLESS YOU ARE SURE YOU KNOW WHAT YOU ARE DOING!

$dbc=mysql_connect($db_host,$db_user,$db_pass) OR DIE (header("Location: off2.php?e=1"));
$dbs=mysql_select_db($db_name) OR DIE (header("Location: off2.php?e=1"));
?>
