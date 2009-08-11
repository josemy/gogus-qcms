<?
session_start();
include("config.php");
include("getcoord.php");
date_default_timezone_set('Europe/London'); 
$username=$_SESSION['username'];

$id=$_GET['id'];
//Crear id encriptada para pasarla a pre_editar
$newid=$id*69;
$ver_punt=mysql_query("SELECT SUM(`puntuacion`) FROM `markers`");
$ver_p=mysql_fetch_array($ver_punt);
$puntost=$ver_p['SUM(`puntuacion`)'];
$ver_todo=mysql_query("SELECT * FROM markers WHERE id = '$id' ;");
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
if($vlong==''){
$vlong="Aun no existe descripcion de este sitio, comentalo haciendo click aqui.";	
}
//$vlong=substr($vlong,0,100)."...";
$web=$prodrow['web'];
$precio=$prodrow['precio_medio'];
$punt=$prodrow['puntuacion'];

	}
if($descri==''){
printf("<script>document.location.href='index.php?item=generic'</script>;");	
}
if($img==''){
$img="random.jpg";	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo($descri); ?> en <? print($titulo_corto); ?></title>
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
</head>

<body>
<?


if($_POST['Votar']){
	$ip=$_SERVER['REMOTE_ADDR'];
//Comprobar si el usuario ya ha votado
	$ver_si=mysql_query("SELECT * FROM comments WHERE (username = '$username' OR ip = '$ip') AND 	local_id = '$id'  ;");
	$ver_sii=mysql_num_rows($ver_si);
	if($ver_sii=="0"){
					

			//Registra el voto
					$ver_user=mysql_query("SELECT * FROM usuarios WHERE username = '$username' ;");
					while ($userw=mysql_fetch_array($ver_user)){
					$user_p=$userw['puntuacion'];
					}
						$tipo=$_GET['tipo'];
						if($tipo=="1"){
						$final_punt=$punt+$user_p;
						}else{
						$final_punt=$punt-$user_p;	
						}
			mysql_query("UPDATE markers SET puntuacion = '$final_punt' WHERE id = '$id'");
			$punt=$final_punt;
			//Voto registrado, ahora guarda el comentario
			$titulo=$_POST['titulo'];
			$comentario=$_POST['comentario'];
			$comentario=str_replace(chr(13),"<br>",$comentario);
			$voto=$_GET['tipo'];
			$timee=time();
			if($username==''){
			$username="Anónimo";
			}
			
			mysql_query("INSERT INTO `quecomes`.`comments` (`id` ,`local_id` ,`titulo` ,`comentario` ,`username` ,`timestamp` ,`voto`, `ip`)VALUES ('', '$id', '$titulo', '$comentario', '$username', '$timee', '$voto' , '$ip');");
			
	}else{
	printf("<script>alert('Ya has votado antes!');</script>");	
	}
}
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="" style="">&nbsp;</td>
    <td bgcolor="#0066a7" width="480" style="border-top-width:1px; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;"><img src="images/logo_qcms.png" onclick="document.location.href='index.php'" style="cursor:pointer;"  width="255" height="37" alt="logo" /></td>
    <td width="480" height="50" bgcolor="#0066a7" style="border-top-width:1px; border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3;border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3; "><div align="center"><a class="tindex">busca restaurantes de cualquier ciudad</a><input name="busca" type="text" class="cajabox" style="border: 2px solid #ffffff;" id="busca" size="45" value="<? echo($rpat);?>"  onkeypress="javascript:busca(event);"/></div></td>
    <td width="" style="">&nbsp;</td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" bgcolor="#E5E5E5" class="invitado_home" style="border-top-width:1px;border-top-width:1px; border-top-style:solid;border-top-color:#E3ECF3; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; ">Ver local</td>
    <td style="">&nbsp;</td>
  </tr>
  <tr>
    <td style=""></td>
    <td colspan="2" style=" height:10px; "></td>
    <td style=""></td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" bgcolor="#ffffff" style="border-top-width:1px; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; "><table width="100%" border="0">
  <tr>
    <td colspan="2" valign="top"><a class="textofootres4"><strong><? print($descri); ?></strong></a><br />
<a class="textofootres3"><? print($direcc." - </a><a class='textofootres3' href='http://".$web."'>".$web.""); ?></a></td>
    <td width="250" rowspan="2" align="center" valign="middle"><img src="resize_image.php?image=<? echo($img);?>&amp;new_width=100&amp;new_height=100"></td>
  </tr>
  <tr>
    <td colspan="2"><p><a class="textofootres3"><strong><? print($long); ?></strong></a><br />
      <a class="textofootres3"><? print($vlong); ?></a>
      <br /></p></td>
  </tr>
  <tr>
  <td><? if($precio){ ?><a class="textofootres3">Sobre </a><a class="txtgra"> <? print($precio); ?></a><a class="textofootres3"> Euros</a><? } ?></td>
    <td width="25%"><a class="textofootres3">puntuacion:</a><a class="txtgra"> <? print($punt."/".$puntost); ?></a>
    <? if ($username){
	?>&nbsp;&nbsp;
<a class="textofootres3">vota:&nbsp;</a><img src="images/normal/001_01.png" alt="Positivo" name="votapos" width="20" height="20" id="votapos" title="Positivo" style="cursor:pointer;"  />&nbsp;&nbsp;&nbsp;<img src="images/normal/001_02.png" alt="Negativo" name="votaneg" width="20" height="20" id="votaneg" title="Negativo" style="cursor:pointer;" />
    <?
	}
	?>
    </td>
    <td width="250">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><p><img src="images/normal/001_35.png" height="16" width="16" title="Tags" alt="Tags" /><a class="textofootres3"><strong>Tags:  &nbsp;</strong></a><a class="textofootres2"><? foreach ($tags as $i) {
  print "<a href='buscando.php?p=".$i."' class='textofootres2'>".$i."</a><a class='textofootres2'>,</a>";
}
?>
</a>&nbsp;&nbsp;<a class="textofootres3"><strong>editar:</strong> </a>&nbsp;<img src="images/normal/001_45.png" height="16" width="16" title="Editar" alt="Editar" style="cursor:pointer;" onclick="document.location.href='pre_editar.php?id=<? echo($newid); ?>'" />
      &nbsp;<a class="textofootres3"><strong>Compartir:  &nbsp;</strong></a><script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
      <span style="text-decoration:none;"><a onclick="return fbs_click()" target="_blank"><img src="http://static.ak.fbcdn.net/rsrc.php/z39E0/hash/ya8q506x.gif" alt=""  style="text-decoration:none; cursor:pointer;" /></a></span>&nbsp;&nbsp;<img src="images/twitter.gif" height="16" width="16" title="twitter" alt="twitter" style="cursor:pointer;" onclick="document.location.href='http://twitter.com/home?status=<? echo($descri); ?> en <? echo($direcc); ?>. Visto en <? echo($_SERVER["SCRIPT_URI"]."?id=".$id); ?>'" />&nbsp;&nbsp;<a class="textofootres3"><strong>favorito:</strong></a>&nbsp;<img src="images/normal/001_16.png" height="16" width="16" title="Agregar a mis favoritos" alt="Agregar a mis favoritos" /> &nbsp;&nbsp;<a class="textofootres3"><strong>historial:</strong></a>&nbsp;<img src="images/normal/001_39.png" height="16" width="16" title="Ver Historial" alt="Ver Historial" style="cursor:pointer;" onclick="document.location.href='ver_historial.php?id=<? echo($id); ?>'" /></p></td>
    <td width="250" rowspan="2" align="center" valign="middle"><div id="mapita" style="position:absolute"><? include("gmaps_mini.php"); ?></div></td>
  </tr>
  <tr>
    <td colspan="2"><img src="images/normal/001_50.png" height="24" width="24" title="Comentarios" alt="Comentarios" /><a class="textofootres3"><strong>Comentarios:</strong></a></td>
  </tr>
  <?
  date_default_timezone_set("UTC");
  $ver_com=mysql_query("SELECT * FROM comments WHERE local_id = '$id' ORDER BY id DESC  ;");
  $num_com=mysql_num_rows($ver_com);
  if($num_com=="0"){
	  ?>
    <tr>
    <td colspan="2" class="boxboxlighte"><br /><a class="textofootres4"> Aun no existen comentarios para este local, se el primero votando positivo o negativo.</a><br /><br />

      
      
      
</td>
    <td width="250" align="center" valign="middle">&nbsp;</td>
    </tr>
  <tr>
   <td colspan="2">&nbsp;</td>
  <td>&nbsp;</td>
  </tr>    
      <tr>
    <td colspan="2" ><br /><br />
      <br />      <br />

</td>
    <td width="250" align="center" valign="middle">&nbsp;</td>
    </tr>
  <tr>
   <td colspan="2">&nbsp;</td>
  <td>&nbsp;</td>
  </tr>  
      
      <?
	  
  }else{
							while ($com=mysql_fetch_array($ver_com)){
							$com_tit=$com['titulo'];
							$com_text=$com['comentario'];
							$com_user=$com['username'];
							$com_time=$com['timestamp'];
							$com_tipo=$com['voto'];
							$com_time=$com_time+7200;
							$com_time=date("j-m-Y H:i",$com_time);
							if($com_tipo=="1"){
							   $voto_img="images/normal/001_18.png";
							   }else{
								 $voto_img="images/normal/001_19.png" ; 
							   }
					?>
  <tr>
    <td colspan="2" class="boxboxlighte"><img src="<? echo($voto_img); ?>" height="24" width="24" title="Positivo" alt="Positivo" /><a class="textofootres4"><? print($com_tit); ?></a><br /><a class="textofootres3"><? print($com_text); ?></a><br /><a class="textofootres2">De <? print($com_user); ?> el <? print($com_time); ?></a><br />
      
      
      
</td>
    <td width="250" align="center" valign="middle">&nbsp;</td>
    </tr>
  <tr>
   <td colspan="2">&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
  
  <?
  }
  }
  ?>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td><br />      <br /></td>
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
<script type="text/javascript">
<? 
	$ip=$_SERVER['REMOTE_ADDR'];
//Comprobar si el usuario ya ha votado
	$ver_si=mysql_query("SELECT * FROM comments WHERE (username = '$username' OR ip = '$ip') AND 	local_id = '$id'  ;");
	$ver_sii=mysql_num_rows($ver_si);
if($ver_sii=="0"){
	
	?>
		
		
		T$('votapos').onclick = function(){TINY.box.show('vota.php?id_local=<? echo($id); ?>&tipo=1',1,450,200,1,300)}
			T$('votaneg').onclick = function(){TINY.box.show('vota.php?id_local=<? echo($id); ?>&tipo=0',1,450,200,1,300)}
	<? }else{ ?>
	T$('votapos').onclick = function(){TINY.box.show('mensa_box.php?c=Ya has votado antes!',1,450,90,1,7)}
	T$('votaneg').onclick = function(){TINY.box.show('mensa_box.php?c=Ya has votado antes!',1,450,90,1,7)}
	<? } ?>
	</script>
</body>
</html>