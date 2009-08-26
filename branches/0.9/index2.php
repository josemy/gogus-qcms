<? 
session_start();
include("db.php");

include('geoLocateIp.class.php');
$geo = new geoLocateIp();
$location = $geo -> getLocationFromIp();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Que Comes! - food social network</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 00px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #981c12
	;
}
-->
</style>
<link href="css/general.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
#apDiv1 {
	position:absolute;
	left:45px;
	top:0px;
	width:214px;
	height:47px;
	z-index:1;
}
-->
</style>
<script language="javascript" src="codigo2.js"></script>
</head>

<body>

<br />
<table width="930px" border="0" cellpadding="0" cellspacing="0" align="center" style="border-top-width:2px; border-top-style:solid;border-top-color:#333;border-bottom-width:2px; border-bottom-style:solid;border-bottom-color:#333;border-left-style:solid;border-left-width:2px; border-left-color:#333;border-right-style:solid;border-right-width:2px; border-right-color:#333;">
<tr>
<td bgcolor="#333333">prueba</td>
<td bgcolor="#333333"><div align="right">crear cuenta - iniciar sesion&nbsp;</div></td>
</tr>
  <tr>
    <td width="40%" rowspan="6" align="center" valign="top" bgcolor="#FFFFFF"><div id="mapaini" align="left" style="position:relative;"><div class="textologo" id="apDiv1" style="filter:alpha(opacity=75);-moz-opacity:0.75; background-color:#333">que com.es!</div>
      <? include("gmaps.php"); ?>
    </div>
      <p>&nbsp;</p></td>
    <td align="center" valign="top" bgcolor="#FFFFFF" width="40%"></td>
  </tr>
  <tr>
    <td align="center" valign="bottom" bgcolor="#ffffff"></td>
  </tr>
    <tr>
    <td align="center" valign="middle" bgcolor="#ffffff"><? include("content_register.php"); ?></td>
  </tr>
  <tr>
    <td align="center" valign="middle" bgcolor="#ffffff"><a class="invitado_home" id='tag1' href='#' onClick="javascript:buscaclick('tag1');">de tapeo en madrid</a> <a class="invitado_home" id='tag2' href='#' onClick="javascript:buscaclick('tag2');">bares en valencia</a> <a class="invitado_home" id='tag3' href='#' onClick="javascript:buscaclick('tag3');">restaurantes de bilbao</a> </td>
  </tr>

  <tr>
    <td align="center" valign="bottom" bgcolor="#ffffff" class="texto1" style="padding-bottom:1px;">busca restaurantes de cualquier ciudad</td>
  </tr>
  <tr>
    <td height="33" align="center" valign="top" bgcolor="#ffffff"><input name="busca" type="text" class="cajabox" id="busca" size="35"  onkeypress="javascript:busca(event);"/></td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFF">      <table width="100%" border="0">
        <tr>
          <td width="24"><span style="text-decoration:none;"><img src="images/icons/Home.png"  width="24" height="24" alt="inicio" /></span></td>
          <td width="24"><a href="javascript:llamarasincrono2('login.php','mini_cont');" style="text-decoration:none;"><img src="images/icons/Key.png"  width="24" height="24" alt="Iniciar sesion" /></a></td>
          <td width="24"><img src="images/icons/User.png"  width="24" height="24" alt="Registrar" /></td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
    <td align="center" valign="top" bgcolor="#ffffff">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF"><div id="master">
      <table width="100%" border="0">
        <tr>
          <td width="50%"><div id="mini_cont" align="center"></div></td>
          <td width="50%" valign="top"><? include("random_local.php"); ?></td>
        </tr>
        <tr>
        <td colspan="2" ></td>
        </tr>
                <tr>
                
          <td colspan="2" >        <? 
echo("quecomes alpha version 0.145");
echo($location['City']); 
echo($location['Latitude'].$location['Longitude']);
echo($location["CountryCode"]);
?></td>
        </tr>

      </table>
    </div></td>
  </tr>
</table>
<!-- <div style="position:absolute; bottom:0%; width: 100%;">
   <table width="960px" border="0" align="center"  cellpadding="0" cellspacing="0" style="border-top-width:2px; border-top-style:solid;border-top-color:#333;border-left-style:solid;border-left-width:2px; border-left-color:#333;border-right-style:solid;border-right-width:2px; border-right-color:#333;">
    <tr bgcolor="#ffffff">
      <td bgcolor="#ffffff"></td>
    </tr>
  </table>
</div> -->
</body>
</html>
