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
					$titulo_f=$prodrow['titulo_f'];
					$tags = explode(", ", $tags);
							if($img==''){
							$img="random.jpg";	
							}
			}
 
?>
      <tr>
      <td width="40"></td>
        <td width="100"><img src="resize_image.php?image=<? echo($img);?>&amp;new_width=100&amp;new_height=100"></td>
        <td><a class="textofootres2" href="sitio/<? echo($titulo_f); ?>"><? print($descri."</a> <a class='textofootres3'>en ".$direcc."</a>"); ?> <? if($comment){
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
</table><br />
<br />
<br />
<br />

<div><? include("new_foot.php"); ?></div>
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