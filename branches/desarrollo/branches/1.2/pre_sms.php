<?
//Envio de reseñas por SMS
//
//Limite de envio en 
session_start();
include("config.php");
$username=$_SESSION['username'];
$local_id=$_GET['id'];
$status=$_GET['status'];
$ahora=time();
$dia=$ahora-86400;
$getsms=mysql_query("SELECT * FROM sms_log WHERE user = '$username' AND time > '$dia'");
$count=mysql_num_rows($getsms);
if($_SESSION['sms_type']=="no_limit"){
$max_sms="99999";
}
if($count >= $max_sms){
$enviar=false;
if(!$status){
die("Has superado el limite de envios por dia (".$max_sms."). Intentalo pasadas 24 Horas.");
}
}else{
$enviar=true;
}

$mes=$ahora-2592000;
$getsmsm=mysql_query("SELECT * FROM sms_log WHERE time > '$mes'");
$countt=mysql_num_rows($getsmsm);
if($countt >= $max_sms_month){
$enviar=false;
die("El servicio no está disponible. <br>ERR: MAX_MONTH_LIMIT.");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/general.css" rel="stylesheet" type="text/css">

<title>QueComes!? - Enviar por SMS</title>
</head>

<body>
<table width="100%" border="0" class="boxboxlighte">
  <tr>
    <td class="invitado_home">Enviar reseña por SMS</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="estilo2v3black">Introduce el numero de telefono:</td>
  </tr>
  <tr>
    <td><form id="form1" name="form1" method="post" action="SMS/sms_send.php?id=<? echo($local_id); ?>">
      <label>
      <input name="telf" type="text" class="boxboxlightee" id="telf" />
      </label>
        <label>
        <input type="submit" name="Enviar" id="Enviar" value="Enviar" />
        </label>
        <br />
    </form>    </td>
  </tr>
  <tr>
    <td class="nowp3">tienes 3 sms al mes gratis!</td>
  </tr>
  <tr>
    <td><? if($status){?>
      <span class="textodisponible">Mensaje enviado correctamente!</span> 
      <? }else{
?>
      <span class="estilo2v3link">Esto es lo que recibiras: </span><br />
<?    
  $verlocal=mysql_query("SELECT * FROM markers WHERE id = '$local_id' LIMIT 1");
$dato=mysql_fetch_array($verlocal);
$nombre=$dato['name'];
$direcc=$dato['address'];
$city=$dato['city'];

$msg = "Reseña del sitio: ".$nombre." en ".$direcc."-".$city."-- www.quecom.es"; 
$logsms=strlen($msg);
echo('<a class="estilo2v3black">'.$msg.'</a>');} ?></td>
  </tr>
</table>
</body>
</html>
