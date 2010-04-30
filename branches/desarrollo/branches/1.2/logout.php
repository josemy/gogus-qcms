<?php
include("db.php");
include("config.php");
session_start();
$return_url=$_GET['return'];

$times=time();
$ip=$_SERVER['REMOTE_ADDR'];
$motivo='Cierre de sesion';
$username=$_SESSION['username'];

session_destroy();
setcookie("quecomes","");
session_start();



mysql_query("INSERT INTO `logs` ( `id` , `motivo` , `username` , `timestamp` ,`ip` ) VALUES ('' , '$motivo' , '$username', '$times' , '$ip')");
//header('Location: index.php');
	if(!$return_url){
	printf("<script>document.location.href='".$quecomespath."'</script>");
	}else{
	printf("<script>document.location.href='".$return_url."'</script>");
	}
?>