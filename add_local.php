<?
session_start();
include("config.php");
include("getcoord.php");
$username=$_SESSION['username'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Añadir local en <? print($titulo_corto); ?></title>
<link href="css/general.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 00px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #c2d0da;
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
    <? if(!$_POST['sitio']){
	
	

	
?>
<form action="add_local.php" method="post" id="form" name="form">
<? } ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="" style="">&nbsp;</td>
    <td bgcolor="#0066a7" width="480" style="border-top-width:1px; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;"><img src="images/logo_qcms.png" onclick="document.location.href='index.php'" style="cursor:pointer;" width="255" height="36" alt="logo" /></td>
    <td width="480" height="50" bgcolor="#0066a7" style="border-top-width:1px; border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3;border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3; "><div align="center"><a class="tindex">busca restaurantes de cualquier ciudad</a><input name="busca" type="text" class="cajabox" style="border: 2px solid #ffffff;" id="busca" size="45" value="<? echo($rpat);?>"  onkeypress="javascript:busca(event);"/></div></td>
    <td width="" style="">&nbsp;</td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" bgcolor="#E5E5E5" class="invitado_home" style="border-top-width:1px;border-top-width:1px; border-top-style:solid;border-top-color:#E3ECF3; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; ">Añadir local </td>
    <td style="">&nbsp;</td>
  </tr>
  <tr>
    <td style=""></td>
    <td colspan="2" style=" height:10px; "></td>
    <td style=""></td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" bgcolor="#ffffff" style="border-top-width:1px; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; ">
    <? if($_POST['sitio']){
	
	include("map_add3.php");
}else{
	
?>
    <table width="100%" border="0">
    
      <tr>
        <td colspan="2" align="center"><a class="textofootres4" >Indica la dirección en la que se encuentra el sitio:</a></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><label>
          <input name="sitio" type="text" class="boxboxlightes" id="sitio" size="55" />
        </label>
          &nbsp;&nbsp;<input name="enviar" type="submit" value="Buscar" />          <br /></td>
      </tr>
      <tr>
        <td width="4%" align="right"><img src="images/normal/001_30.png" width="24" height="24" alt="alert" /></td>
        <td width="96%" align="left"><span class="buscanew">&nbsp;&nbsp;&nbsp;</span><span class="textofootres3">comprueba antes en el buscador que el sitio no exista</span></td>
      </tr>
    </table></td>
    <td style="">&nbsp;</td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" style="">&nbsp;</td>
    <td style="">&nbsp;</td>
  </tr>
</table>
    <? if(!$_POST['sitio']){
	
	
	
?>
</form>
<?
}
?>
<?
}
?>
</body>
</html>