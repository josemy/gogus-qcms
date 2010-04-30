<?
//Envio de reseñas por SMS
//
//Limite de envio en 
session_start();
include("config.php");
$username=$_SESSION['username'];
$local_id=$_GET['id'];
$status=$_GET['status'];
$userc=mysql_query("SELECT * FROM `usuarios` WHERE `username` = '$username' LIMIT 1");	
$muserc=mysql_fetch_array($userc);
$uname=$muserc['name'];
$umail=$muserc['mail'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/general.css" rel="stylesheet" type="text/css">

<title>QueComes!? - Enviar por Mail</title>
</head>

<body>
<table width="100%" border="0" class="boxboxlighte">
  <tr>
    <td class="invitado_home">Enviar reseña por Mail</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="estilo2v3black">Introduce el email:</td>
  </tr>
  <tr>
    <td><form id="form1" name="form1" method="post" action="mail_send.php?id=<? echo($local_id); ?>">
      <label>
      <input name="mail" type="text" class="boxboxlightee" id="mail" value="<? print($umail); ?>" />
      </label>
        <label>
        <input type="submit" name="Enviar" id="Enviar" value="Enviar" />
        </label>
        <br />
    </form>    </td>
  </tr>
  <tr>
    <td class="nowp3">&nbsp;</td>
  </tr>
  <tr>
    <td><? if($status){?>
      <span class="textodisponible">Mensaje enviado correctamente!</span> 
      <? }
?>
      </td>
  </tr>
</table>
</body>
</html>
