<?
$error=$_GET['e'];

if($error=='1'){
$mensa="Error de Base de datos";
}
if($error=='2'){
$mensa="Error interno del servidor.";
}
if($error==''){
$mensa="Error interno del servidor.";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="REFRESH" CONTENT="25;URL=http://quecom.es"> 
<title>QueComes!? - Ups! Tenemos un problemilla...</title>
<link href="css/general.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #DAE2E9;
}
.new1{
font-family:arial,sans-serif;
font-size: 24px;
font-weight:bold;
color:#333;

	
}
-->
</style></head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td height="37" colspan="2" bgcolor="#CC3333" style="padding-top:5px;"><img src="images/logo_qcms.png" width="255" height="37" alt="logo" />&nbsp;</td>
  </tr>
  <tr>
    <td width="21%"><br />      <? $ga=rand(0,2); //generamos un numero aleatorio entre 0 y 2 incluidos ambos

//bien con ifs o con un switch, definimos una imagen para cada numero:
if ($ga==0) $cab="images/closed1.jpg";
if ($ga==1) $cab="images/closed2.jpg";
if ($ga==2) $cab="images/closed3.jpg";
if ($ga==2) $cab="images/closed4.jpg";
if ($ga==2) $cab="images/closed5.jpg";
if ($ga==2) $cab="images/closed6.jpg";

echo "<img src=".$cab.">"; //mostramos la imagen ?></td>
    <td width="79%" align="center" valign="middle" c><br />
      <br />
<a class="new1">Ups, tenemos un problemilla por aqui:<br />
 
<span class="invitado_home2"><? echo($mensa); ?></span><br />
lo solucionaremos en breve...</a></td>
  </tr>
  <tr>
    <td colspan="2" class="textofootres3"></td>
  </tr>
  <tr>
    <td class="textofootres3">&nbsp;</td>
    <td class="textofootres3">&nbsp;</td>
  </tr>
</table>
</body>
</html>