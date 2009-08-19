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
<title>Ver mis favoritos en <? print($titulo_corto); ?></title>
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
    <td colspan="2" bgcolor="#E5E5E5" class="invitado_home" style="border-top-width:1px;border-top-width:1px; border-top-style:solid;border-top-color:#E3ECF3; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; ">Mis Favoritos</td>
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
        <td align="right"><img src="images/normal/001_15.png" alt="Mis Favoritos"  /></td>
            <td><span class="bordecajas"><a class="invitado_home">Mis Favoritos</a></span></td>
                <td></td>
                </tr>
                 <tr>
    <td> </td>
        <td align="right"></td>
            <td>&nbsp;</td>
                <td></td>
                </tr>
            
 <?
 $ver_mis=mysql_query("SELECT * FROM favoritos WHERE username='$username';");
 while($misfa=mysql_fetch_array($ver_mis)){
	 $rid=$misfa['local_id'];
	 $comment=$misfa['comentario'];
	
			$ver_todo=mysql_query("SELECT * FROM markers WHERE id = '$rid' ;");
			while ($prodrow=mysql_fetch_array($ver_todo)){
					$direcc=$prodrow['address'];
					$descri=$prodrow['name'];
					$coord=$prodrow['lat'];
					$coord=$coord.",".$prodrow['lng'];
					$latt=$prodrow['lat'];
					$lonn=$prodrow['lng'];
					$long=$prodrow['descripcion'];
					$vlong=$prodrow['desc_long'];
					$img=$prodrow['image'];
					$tags=$prodrow['tags'];
					$tags = explode(", ", $tags);
							if($img==''){
							$img="random.jpg";	
							}
			}
 
?>
      <tr>
      <td width="40"></td>
        <td width="100"><img src="resize_image.php?image=<? echo($img);?>&amp;new_width=100&amp;new_height=100"></td>
        <td><a class="textofootres2" href="ver_local.php?id=<? echo($rid); ?>"><? print($descri."</a> <a class='textofootres3'>en ".$direcc."</a>"); ?> <? if($comment){
	 ?><br />
<div class="boxboxlightw" style=" padding:2px;width:250px;float:right"><a class="nowp1"><? print($comment);?></a></div> <? }else{ ?><div class="boxboxlightw" style=" padding:2px;width:250px;float:right"><a class="textofootres2" id="comentar<? echo($rid);?>">insertar comentario</a></div><? } ?> </td>
        <td></td>
      </tr>
<? } ?>      
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
<?
 $ver_miss=mysql_query("SELECT * FROM favoritos WHERE username='$username' AND comentario = '';");
 while($misfaa=mysql_fetch_array($ver_miss)){
	 $ridd=$misfaa['local_id']; ?>
	T$('comentar<? echo($ridd);?>').onclick = function(){TINY.box.show('comenta_fav.php?id_local=<? echo($ridd);?>',1,600,150,1,60)}
<? } ?>
</script>
</body>
</html>