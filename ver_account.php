<?
//Ver mis favoritos
session_start();
include("config.php");
include("getcoord.php");
date_default_timezone_set('Europe/London'); 
$username=$_SESSION['username'];


//inserta el comentario
if($_POST['Votar']){
	$idf=$_POST['idf'];
	$com=$_POST['comentario'];
$guarda=mysql_query("UPDATE `favoritos` SET `comentario` = '$com' WHERE `local_id` ='$idf'");
			if (!$guarda) {
				$message  = 'Error: ' . mysql_error() . "\n";
				echo($message);
			}
	
}
//


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ver mi cuenta en <? print($titulo_corto); ?></title>
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
<script type="text/javascript" src="tinybox.js"></script>
<script language="javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
window.open(theURL,winName,features); }

function GuardaFav(nu){
llamarasincrono2('add_fav.php?fid='+nu,'cargafav');	
}

</script>
</head>

<body>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="" style="">&nbsp;</td>
    <td bgcolor="#0066a7" width="480" style="border-top-width:1px; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;"><img src="images/logo_qcms.png" onclick="document.location.href='index.php'" style="cursor:pointer;"  width="255" height="37" alt="logo" /></td>
    <td width="480" height="50" bgcolor="#0066a7" style="border-top-width:1px; border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3;border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3; "><div align="center"><a class="tindex">busca restaurantes de cualquier ciudad</a><input name="busca" type="text" class="cajabox" style="border: 2px solid #ffffff;" id="busca" size="45" value="<? echo($rpat);?>"  onkeypress="javascript:busca(event);"/></div></td>
    <td width="" style="">&nbsp;</td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" bgcolor="#E5E5E5" class="invitado_home" style="border-top-width:1px;border-top-width:1px; border-top-style:solid;border-top-color:#E3ECF3; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; ">Mis Cuenta</td>
    <td style="">&nbsp;</td>
  </tr>
  <tr>
    <td style=""></td>
    <td colspan="2" style=" height:10px; "></td>
    <td style=""></td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" bgcolor="#ffffff" style="border-top-width:1px; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; "><table width="500" border="0" align="center">
    <tr>
    <td> </td>
        <td align="right"><img src="images/normal/001_55.png" alt="Mis Favoritos"  /></td>
            <td><span class="bordecajas"><a class="invitado_home">Mi Cuenta</a></span></td>
                <td></td>
                </tr>
                 <tr>
    <td> </td>
        <td align="right"></td>
            <td>&nbsp;</td>
                <td></td>
                </tr>
                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td>- <a href="javascript:MM_openBrWindow('contactar.php' , 'contactar' , 'left=20,top=20,width=450,height=350,toolbar=0,resizable=1,scrollbars=yes');" class="estilo2v3link">informar de un fallo</a></td>
                   <td></td>
                 </tr>
                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td>- <span class="estilo2v3link">ver mi historial</span></td>
                   <td></td>
                 </tr>
                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td>- <span class="estilo2v3link">modificar mis datos</span></td>
                   <td></td>
                 </tr>
                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td>- <span class="estilo2v3link">dame de baja en QueComes!?</span></td>
                   <td></td>
                 </tr>
            
 
    </table>
    
    </td>
    <td style="">&nbsp;</td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" style="">&nbsp;</td>
    <td style="">&nbsp;</td>
  </tr>
</table>
<script type="text/javascript">

</script>
</body>
</html>