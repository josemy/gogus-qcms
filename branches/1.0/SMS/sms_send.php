<?php
session_start();
include("../config.php");
include("APISMS.php");
$username=$_SESSION['username'];
$dest = $_POST['telf'];
$local_id = $_GET['id'];
$time=time();
$verlocal=mysql_query("SELECT * FROM markers WHERE id = '$local_id' LIMIT 1");
$dato=mysql_fetch_array($verlocal);
$nombre=$dato['name'];
$direcc=$dato['address'];
$city=$dato['city'];

$sms = new MensajeriaWeb();

$log = "";	# MSISDN
$pwd = "";	# password de acceso a la web (22770)



$msg = "Reseña del sitio: ".$nombre." en ".$direcc."-".$city."-- www.quecom.es";
mysql_query("INSERT INTO `quecome_quecomes`.`sms_log` (
`id` , `destino` ,
`mensaje` ,
`time` ,
`user`
)
VALUES (
NULL , '$dest' , '$msg', '$time', '$username'
);");
$sms->EnviaMensaje($log, $pwd, $dest, $msg);
print("<script>document.location.href='../pre_sms.php?status=ok'</script>;");

?>
