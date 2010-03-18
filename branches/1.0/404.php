<?
session_start();
include("config.php");
include("getcoord.php");
$username=$_SESSION['username'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? print($titulo_web); ?> , que estarias buscando...  </title>
<link href="css/general.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 00px;
	margin-right: 0px;
	margin-bottom: 0px;
	height:100%;
}
	#apDiv1 {	position:absolute;
	left:45px;
	top:0px;
	width:224px;
	height:47px;
	z-index:1;
}
-->
</style>
<script language="javascript" src="codigo2.js"></script>
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="" bgcolor="#CC3333" style="">&nbsp;</td>
    <td bgcolor="#CC3333" width="480" ><img src="images/logo_qcms.png" onclick="document.location.href='index.php'" style="cursor:pointer;" width="255" height="36" alt="logo" /></span></td>
    <td width="480" height="50" bgcolor="#CC3333" style="border-top-width:1px;"><div align="center"><a class="tindex">busca restaurantes de cualquier ciudad</a><input name="busca" type="text" class="cajabox" style="border: 2px solid #ffffff;" id="busca" size="45" value="<? echo($rpat);?>"  onkeypress="javascript:busca(event);"/></div></td>
    <td width="" bgcolor="#CC3333" style="">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#E5E5E5" style="">&nbsp;</td>
    <td colspan="2" bgcolor="#E5E5E5" class="invitado_home" style="border-top-width:1px;border-top-width:1px; border-top-style:solid;border-top-color:#E3ECF3; ">Error 404</td>
    <td bgcolor="#E5E5E5" style="">&nbsp;</td>
  </tr>
  <tr>
    <td style=""></td>
    <td colspan="2" style=" height:10px; "></td>
    <td style=""></td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" valign="top" bgcolor="#F5F5F5" style="border-top-width:1px; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; "><table width="90%" border="0" cellpadding="2">
</table>
      <p><span class="textorojo3">Vaya! La pagina que buscas no existe.<br />
      </span><span class="estilo2v3black">Quizas te sirva con esto: </span></p>
      <p><span class="textorojo3"><? include("last_searchs.php"); ?><br />
    </span></p></td>
    <td style="">&nbsp;</td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" style="">&nbsp;</td>
    <td style="">&nbsp;</td>
  </tr>
</table>
</body>
</html>