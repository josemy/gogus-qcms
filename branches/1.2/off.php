<?
$error=$_GET['e'];

if($error=='1'){
$mensa="Error de DB";
}
if($error=='2'){
$mensa="Error 500";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QueComes!? - Error Ouch!</title>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;

.test {
	font-family: Arial, Helvetica, sans-serif;
}

-->
</style></head>

<body>
<span class="textologo" style="top:21px; filter:alpha(opacity=50); -moz-opacity:0.50; cursor:pointer; border-top-width:1px; border-top-style:solid; border-top-color:#E3ECF3; border-bottom-width:1px; border-bottom-style:solid; border-bottom-color:#E3ECF3; border-left-style:solid; border-left-width:1px; border-left-color:#E3ECF3; border-right-style:solid; border-right-width:1px; border-right-color:#E3ECF3;"><img src="images/logo_qcms.png" width="255" height="37" alt="logo" /></span><br />
<br />
<br />
<table width="100%" border="0">
  <tr>
    <td bgcolor="#EEEEEE" style="border-style:solid; border-width:2px; border-bottom-color:#333"><table width="100%" border="0">
      <tr>
        <td width="30%">&nbsp;</td>
        <td width="70%">&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="2" align="center" valign="middle"><h1>Ouch!! <br />
          <? echo($mensa); ?></h1></td>
        <td class="test" style="color: #000000"><strong><h1>El servicio no se encuentra disponible.</h1></strong></td>
      </tr>
      <tr>
        <td rowspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        </tr>
    </table>
      <br /></td>
  </tr>
  <tr>
    <td><strong><a style="color:#FFF">Volveremos en unos instantes...</a></strong></td>
  </tr>
</table>
</body>
</html>