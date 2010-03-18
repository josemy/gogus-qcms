<?
//Ver mis favoritos
session_start();
include("config.php");
include("getcoord.php");
date_default_timezone_set('Europe/London'); 
$username=$_SESSION['username'];
if($username==""){
print("<script>document.location.href='index.php?action=info&item=f'</script>");
}
$ver_datos=mysql_query("SELECT * FROM usuarios WHERE username = '$username' LIMIT 1");
$ver_user=mysql_fetch_array($ver_datos);
$nombre=$ver_user['name'];
$avatar=$ver_user['avatar_img'];
//Get avatar image
if($avatar==''){
$avatar="avatars/pq_default.PNG";
}
//Ver datos:
$busquedas=mysql_query("SELECT id FROM busquedas WHERE username = '$username'");
$count_b=mysql_num_rows($busquedas);
$comm=mysql_query("SELECT id FROM comments WHERE username = '$username'");
$count_c=mysql_num_rows($comm);
$favvv=mysql_query("SELECT id FROM favoritos WHERE username = '$username'");
$count_f=mysql_num_rows($favvv);
$marks=mysql_query("SELECT id FROM markers WHERE medio_user = '$username'");
$count_m=mysql_num_rows($marks);
//
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
	height:100%;
}
	#apDiv1 {	position:absolute;
	left:45px;
	top:0px;
	width:224px;
	height:47px;
	z-index:1;
}
.new2 {font-size: 13px; font-family:arial,sans-serif; color: #0066cc;font-weight:bold;text-decoration:none;}
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
    <? include("new_header.php"); ?>
  </tr>
  <tr>
    <td style=""></td>
    <td colspan="2" style=" height:10px; "></td>
    <td style=""></td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" bgcolor="#ffffff" style=""><table width="500" border="0" align="center">
    <tr>
    <td> </td>
        <td align="right"><img src="<? echo($avatar); ?>" alt="tu avatar"  /></td>
            <td><a class="new1"><? echo($nombre); ?> (<? echo($username); ?>)</a></td>
          <td></td>
                </tr>
                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td>&nbsp;</td>
                   <td></td>
                 </tr>
                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td class="new2">Tus datos en QueComes!?</td>
                   <td></td>
                 </tr>
                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td class="estilo2v3black">- <? print($count_b); ?> busquedas</td>
                   <td></td>
                 </tr>
                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td class="estilo2v3black">- <? print($count_f); ?> favoritos</td>
                   <td></td>
                 </tr>
                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td class="estilo2v3black">- <? print($count_c); ?> comentarios</td>
                   <td></td>
                 </tr>
                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td class="estilo2v3black">- <? print($count_m); ?> Sitios descubiertos por ti</td>
                   <td></td>
                 </tr>
                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td>&nbsp;</td>
                   <td></td>
                 </tr>
                                  <tr>
                   <td></td>
                   <td align="right"></td>
                   <td class="new2">+ enlaces</td>
                   <td></td>
                 </tr>

                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td>- <span class="estilo2v3link"><a href="#"  class="estilo2v3link" onclick="javascript:box('mod_profile.php','1','700','500','1','300');">modificar mis datos</a></span></td>
                   <td></td>
                 </tr>
                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td>- <span class="estilo2v3link">dame de baja en QueComes!?</span></td>
                   <td></td>
                 </tr>
                 <tr>
                   <td></td>
                   <td align="right"></td>
                   <td class="estilo2v3black">- <a href="javascript:MM_openBrWindow('contactar.php' , 'contactar' , 'left=20,top=20,width=450,height=350,toolbar=0,resizable=1,scrollbars=yes');" class="estilo2v3link">informar de un fallo</a></td>
                   <td></td>
                 </tr>
            
 
    </table>
    
    <p>&nbsp;</p></td>
    <td style="">&nbsp;</td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" style=""><? include("new_foot.php"); ?></td>
    <td style="">&nbsp;</td>
  </tr>
</table>
<script type="text/javascript">
	function box(ruta,a,we,he,b,ti){
	TINY.box.show(ruta,a,we,he,b,ti);	
	}
</script>
</body>
</html>