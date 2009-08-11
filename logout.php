<?php
include("db.php");
session_start();

$times=time();
$ip=$_SERVER['REMOTE_ADDR'];
$motivo='Cierre de sesion';
$username=$_SESSION['username'];

session_destroy();
setcookie("ezpsession","");
session_start();



mysql_query("INSERT INTO `logs` ( `id` , `motivo` , `username` , `timestamp` ,`ip` ) VALUES ('' , '$motivo' , '$username', '$times' , '$ip')");
header('Location: index.php');
//mysql_query("DELETE FROM sesiones WHERE username ='$username';");
//include("bar2.php");
//echo "<a><span class='textonormal Estilo1'>Has sido desconectado! </span>";
?>