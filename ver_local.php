<?
session_start();
include("config.php");
include("getcoord.php");
include("geo_km.php");

$globals['base_url'] = '/';

date_default_timezone_set('Europe/London'); 
$username=$_SESSION['username'];
$page_name="Ver Sitio";
$id=$_GET['id'];
$title=$_GET['title'];
if(!$id){
$verid=mysql_query("SELECT * FROM markers WHERE titulo_f = '$title' ;");
    while ($idp=mysql_fetch_array($verid)){
		$id=$idp['id'];
	}
}
//Crear id encriptada para pasarla a pre_editar
$newid=$id*69;
$ver_punt=mysql_query("SELECT SUM(`puntuacion`) FROM `markers`");
$ver_p=mysql_fetch_array($ver_punt);
$puntost=$ver_p['SUM(`puntuacion`)'];
$ver_todo=mysql_query("SELECT * FROM markers WHERE id = '$id' ;");
    while ($prodrow=mysql_fetch_array($ver_todo)){
$direcc=$prodrow['address'];
$descri=$prodrow['name'];
$city=$prodrow['city'];

$coord=$prodrow['lat'];
$coord=$coord.",".$prodrow['lng'];
$latt=$prodrow['lat'];
$lonn=$prodrow['lng'];
$long=$prodrow['descripcion'];
$vlong=$prodrow['desc_long'];
$img=$prodrow['image'];
$tipoco=$prodrow['tipo_cocina'];
$tags=$prodrow['tags'];
$phone=$prodrow['phone'];
$titulo_f=$prodrow['titulo_f'];

$vcount=$prodrow['votos_count'];
$mediouser=$prodrow['medio_user'];
$mediouserurl=$prodrow['medio_user_url'];

	//Ver avatar del usuario que descubrió el sitio
	$ver_datosa=mysql_query("SELECT avatar_img FROM usuarios WHERE username = '$mediouser' LIMIT 1");
	$ver_users=mysql_fetch_array($ver_datosa);
	$avatar=$ver_users['avatar_img'];
	//Get avatar image
	if($avatar==''){
	$avatar_link="images/normal/001_57.png";
	}else{
	$avatar_link="resize_image.php?image=".$avatar."&amp;new_width=24&amp;new_height=24";
	}
	//
$tags = explode(",", $tags);
if($vlong==''){
$vlong="<a class='invitado_home2'>Aun no existe descripcion de este sitio, </a><a class='invitado_home' href='editar/$title'>editalo aqui.</a>";	
}
//Ver si la url tiene http://
$web=$prodrow['web'];
$buscado="http"; // busco "lalala" en $cadena 
$buscado= "/".$buscado."/i"; 
if (preg_match($buscado, $web)) { 
$web=substr($web,7); 
}
//
$precio=$prodrow['precio_medio'];
$punt=$prodrow['puntuacion'];
$pnt=$punt;

	}
if($descri==''){
printf("<script>document.location.href='../404.php'</script>;");	
}
if($img==''){
$img="random.jpg";	
}
if($img=='local_img/'){
$img="random.jpg";	
}
$ver_si=mysql_query("SELECT * FROM favoritos WHERE local_id = '$id' AND username = '$username';");
$n_ver=mysql_num_rows($ver_si);
if($n_ver > 0){
$img_fav="images/normal/001_15.png";
}else{
$img_fav="images/normal/001_16.png";
}
//Introducir en el log
	$motivo=$id;
	$times=time();
	$ip=$_SERVER['REMOTE_ADDR'];
	$hostname = gethostbyaddr($ip);
mysql_query("INSERT INTO `logs` ( `id` , `motivo` , `username` , `timestamp` ,`ip` , `host`) VALUES ('' , '$motivo' , '$username', '$times' , '$ip' , '$hostname')");

//
//Sitio descubierto por:
if($mediouser==""){

}
if($mediouser=="PA_BOT"){
$mediouser="QueComes!? Bot";
}
if($mediouser=="google local"){
$mediouser="QueComes!? Bot";
}
if($mediouser==""){
$mediouser="QueComes!? Bot";
}
if($mediouser=="11870_BOT"){
$mediouser="11870.com API";
$mediouserlink=$mediouserurl;
$mediouser='<a class="new5" target="_blank" href="'.$mediouserlink.'"><u>'.$mediouser.'</u></a>';

}
//
//Datos usuario:

$userc=mysql_query("SELECT * FROM `usuarios` WHERE `username` = '$username' LIMIT 1");	
$muserc=mysql_fetch_array($userc);
$uname=$muserc['name'];
//
//Ver si el usuario ya ha votado este sitio
$ver_si=mysql_query("SELECT * FROM comments WHERE (username = '$username' OR ip = '$ip') AND local_id = '$id';");
$ver_tipo=mysql_fetch_array($ver_si);
//$tipo_voto=$ver_tipo['voto'];
//$puntu_voto=$ver_tipo['puntuacion'];
$ver_sii=mysql_num_rows($ver_si);
if($ver_sii>0){
$ya_voto=true;	
}
//
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
$distancia=(int)geo_distance($_SESSION["Latitude"],$_SESSION["Longitude"],$latt,$lonn);



?>
<base href = "<? echo $_URL_BASE; ?>" target="_top" />

<title><? echo($descri); ?> en <? print($titulo_corto); ?></title>
<link href="css/general.css" rel="stylesheet" type="text/css">
<link rel="image_src" href="http://quecom.es/<? echo($quecomespath.$img);?>" / >
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
.new1{
font-family:arial,sans-serif;
font-size: 24px;
font-weight:bold;
color:#333;

	
}
.new2 {font-size: 13px; font-family:arial,sans-serif; color: #0066cc;font-weight:bold;text-decoration:none;}
.new3 {font-size: 13px;  font-family:arial,sans-serif; color: #777eb3;text-decoration:none;}
.new4 {color: #090; font-family: arial,sans-serif; font-size: 11px; text-decoration: none; }
.new5 {font-size: 11px;  font-family:arial,sans-serif; color: #333;text-decoration:none;font-weight:bold;}

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

function cambiaimg(img,ruta){

document.getElementById(img).src = "resize_image.php?image="+ruta+"&new_width=60&new_height=60";
}
function cambiaimgre(img,ruta){

document.getElementById(img).src = "resize_image.php?image="+ruta+"&new_width=50&new_height=50";
}
</script>
</head>

<body>
<?

//Registrar Voto
if($_POST['Votar']){
	$ip=$_SERVER['REMOTE_ADDR'];


	if($ya_voto==false){
			//Registra el voto
			$tipv=$_POST['type'];
			$vcount=$vcount+1;
			$punt=($punt+$tipv);
			$punt=$punt/$vcount;
			$pnt=$punt;
			mysql_query("UPDATE markers SET puntuacion = '$punt' WHERE id = '$id';");
			mysql_query("UPDATE markers SET votos_count = '$vcount' WHERE id = '$id';");
			$punt=$final_punt;
			//Voto registrado, ahora guarda el comentario
			$titulo=$_POST['titulo'];
			$comentario=$_POST['comentario'];
			
			$comentario=str_replace(chr(13),"<br>",$comentario);
			$puntu=$_POST['type'];
			if($puntu > 4){
			$voto=1;	
			}else{
			$voto=0;	
			}
			
			$timee=time();
			if($username==''){
			$username="Comensal anónimo";
			}
			
			mysql_query("INSERT INTO `comments` (`id` ,`local_id` ,`titulo` ,`comentario` ,`username` ,`timestamp` ,`voto`,`puntuacion`,`ip`)VALUES ('', '$id', '$titulo', '$comentario', '$username', '$timee', '$voto' , '$puntu' , '$ip');");
			printf("<script>document.location.href='sitio/".$titulo_f."'</script>;");

			
	}else{
	//El usuario ya ha votado, solo comentar.
	if($username==''){
	$username="Comensal anónimo";
	}
	$voto=3;
	$puntu=0;
	$timee=time();

	$titulo=$_POST['titulo'];
	$comentario=$_POST['comentario'];
	$comentario=str_replace(chr(13),"<br>",$comentario);
	mysql_query("INSERT INTO `comments` (`id` ,`local_id` ,`titulo` ,`comentario` ,`username` ,`timestamp` ,`voto`,`puntuacion`,`ip`)VALUES ('', '$id', '$titulo', '$comentario', '$username', '$timee', '$voto' , '$puntu' , '$ip');");
			printf("<script>document.location.href='sitio/".$titulo_f."'</script>;");
	//
	}
	include("twitter.php");
 postToTwitter("quecompuntoes","rebrok2000",$username." ha comentado el sitio: http://quecom.es/sitio/".$titulo_f."");
}
//
if($city){
$get_prov=mysql_query("SELECT provincia FROM localidades WHERE localidad = '$city' LIMIT 1");
$get_prova=mysql_fetch_array($get_prov);
$provincia=$get_prova['provincia'];
}
?>
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
    <td colspan="2" bgcolor="#ffffff" style=""><table width="100%" border="0">
  <tr>
    <td colspan="3" rowspan="2" valign="top" align="justify"><div align="justify"><a class="new1"><? print($descri); ?></a> &nbsp;<a  class="invitado_home2"><? echo($phone); ?></a><br />
<a class="new3"><? print($direcc); ?><? if($distancia!=4853){if($distancia>0){ ?>&nbsp;(a <? print($distancia); ?> kms de ti)<? }else{?>&nbsp;(Muy cerca de ti!)<? } }?></a> <br />
<a class="new2" href="buscando.php?p=<? print($city); ?>"><? print($city); ?></a>&nbsp;<a class="new2" href="buscando.php?p=<? print($provincia); ?>"><? print($provincia); ?></a><br />
<a class="new4"  href="http://<? print($web); ?>"><u><? print($web); ?></u></a>
<br />
<br />
<table border="0">
  <tr>
    <td width="24"><? if ($username || $sms_reg==false){
	?><img src="images/normal/001_13.png" title="SMS" alt="Enviar por sms" style="cursor:pointer;" onclick="javascript:MM_openBrWindow('pre_sms.php?id=<? echo($id); ?>' , 'sms' , 'left=20,top=20,width=250,height=210,toolbar=0,resizable=1,scrollbars=yes');" /><? } ?></td>
    <td width="41" align="justify"><? if ($username || $sms_reg==false){
	?><a class="nowp4" href="javascript:MM_openBrWindow('pre_sms.php?id=<? echo($id); ?>' , 'sms' , 'left=20,top=20,width=250,height=210,toolbar=0,resizable=1,scrollbars=yes');">enviar por SMS</a><? } ?></td>
    <td width="5">&nbsp;</td>
    
    <td width="24" ><img src="images/normal/001_12.png" title="Mail" alt="Enviar por Mail" style="cursor:pointer;" onclick="javascript:MM_openBrWindow('pre_mail.php?id=<? echo($id); ?>' , 'sms' , 'left=20,top=20,width=250,height=210,toolbar=0,resizable=1,scrollbars=yes');" /></td>
    <td width="41" align="justify"><a class="nowp4" href="javascript:MM_openBrWindow('pre_mail.php?id=<? echo($id); ?>' , 'sms' , 'left=20,top=20,width=250,height=210,toolbar=0,resizable=1,scrollbars=yes');">enviar por Mail</a></td>
    <td width="5">&nbsp;</td>

    <td width="20" >
	<img src="images/normal/001_43.png" alt="Positivo" onclick="javascript:box('web_embed.php?title=<? echo($titulo_f); ?>','1','550','200','1','300');"  width="20" height="20"  style="cursor:pointer;"  /></td>
    <td width="45" >      
	<a class="nowp4" onclick="javascript:box('web_embed.php?title=<? echo($titulo_f); ?>','1','550','200','1','300');" style="cursor:pointer;" >incluir en tu web</a></td>
        <td width="10">&nbsp;</td>

    <td width="20" >        <? if ($username || $vote_reg==false){
	?><img src="images/normal/001_01.png" alt="Positivo" name="votapos" width="20" height="20" id="votapos" title="Positivo" style="cursor:pointer;"  /><? } ?></td>
    <td width="41" >        <? if ($username || $vote_reg==false){
	?><a class="nowp4" id="votapos" name="votapos" onclick="javascript:box('vota.php?id_local=<? echo($id); ?>&tipo=1','1','450','200','1','300');" style="cursor:pointer;" >voto positivo</a><? }?></td>
        <td width="5">&nbsp;</td>

        <td width="20" ><? if ($username  || $vote_reg==false){
	?><img src="images/normal/001_02.png" alt="Negativo" name="votaneg" width="20" height="20" id="votaneg" title="Negativo" style="cursor:pointer;" /><? } ?></td>
    <td width="41" ><? if ($username  || $vote_reg==false){
	?><a class="nowp4" id="votaneg" name="votaneg" onclick="javascript:box('vota.php?id_local=<? echo($id); ?>&tipo=0','1','450','200','1','300');" style="cursor:pointer;" >voto negativo</a><? } ?></td>
    <td width="5">&nbsp;</td>
            <td width="20" ><? if ($username  || $foto_reg==false){
	?><img src="images/normal/001_07.png" alt="Subir foto" name="subefoto" width="20" height="20" id="subefoto" title="Subir Foto" style="cursor:pointer;" /><? } ?></td>
    <td width="41" ><? if ($username  || $foto_reg==false){
	?><a class="nowp4" id="subefoto" name="subefoto" onclick="javascript:box('pre_guardar_img.php?id=<? echo($id); ?>&tipo=1','1','550','200','1','300');" style="cursor:pointer;" >subir foto</a><? } ?></td>
  </tr>
</table>
<p><a class="estilo2v3"><strong><? print($long); ?></strong></a><br />
  <a class="estilo2v3"><? print($vlong); ?></a>
  <br /></p></div>
  <? include("gmaps_mini_new.php"); ?></td>
    <td valign="top"></td>
    <td width="225" rowspan="13" align="center" valign="top"><img src="resize_image.php?image=<? echo($img);?>&amp;new_width=200&amp;new_height=200"><br />      <div id="mapita"><br />
        <? include("pre_como_llegar.php"); ?>
    </div>

      <p><span class="new2">Sitio descubierto por:</span></p> 
      <table  border="0">
  <tr>
    <td><img src="<? echo($avatar_link); ?>" alt="Usuario"  title="Usuario" /></td>
    <td>&nbsp;</td>
    <td valign="middle"><span class="new5"><? print($mediouser); ?></span></td>
  </tr>
</table>
		<?
    	$num_c=mysql_query("SELECT * FROM favoritos WHERE local_id = '$id' ;");
		$count_f=mysql_num_rows($num_c);
		
		if($count_f==1){
		$wordusu="usuario";
		$favo=true;
		}
		if($count_f>1){
		$wordusu="usuarios";
		}
		if($count_f>0){
		
		$ver_usf=mysql_query("SELECT * FROM `favoritos` WHERE `local_id` = '$id' LIMIT 3;");
		while($arr_ffa=mysql_fetch_array($ver_usf)){
		$newusu=$arr_ffa['username'];
		$usuarios=$usuarios." ".$newusu;
		}
		if($count_f>3){
		$count_neg=$count_f-3;
		$usuarios=$usuarios." y otros ".$count_neg." usuarios.";
		}else{
		$usuarios=$usuarios;
		}
		?>
        <br />
        <p><span class="new2">Favorito de:</span></p> 
        <table  border="0">
        <tr>
        <td><img src="images/normal/001_15.png" alt="Favoritos"  width="20" height="20"  title="Favoritos" /></td>
        <td>&nbsp;</td>
        <td valign="middle"><span class="new5" title="<? print($usuarios); ?>"><span class="new2"><? print($count_f); ?></span> <? print($wordusu); ?> </span></td>
        </tr>
        </table>
    	<? }?> <br />
<? include("ver_local_img.php"); ?>
                </td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
  <td width="130"><? if($tipoco){ ?><a class="textofootres3">Cocina </a><a class="txtgra"> <? print($tipoco); ?></a><? } ?></td>
  <td width="171"><? if($precio){ ?><a class="textofootres3">Sobre </a><a class="txtgra"> <? print($precio); ?></a><a class="textofootres3"> Euros</a><? } ?></td>
  <? $pnt=round($pnt,2); ?>
    <td width="188"><a class="textofootres3">puntuacion:</a><a class="txtgra"> <? print($pnt); ?></a>    </td>
    <td width="1" align="right">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="4"><p>
    <div style="display:inline;"><a class="textofootres3"><strong>etiquetas:  &nbsp;</strong></a><a class="textofootres2"><? foreach ($tags as $i) {
	if($i!=''){
  print "<a href='buscando.php?p=".$i."' class='textofootres2'>".$i."</a><a class='textofootres2'>,</a>";
}else{ print"<a class='textofootres2'> sin etiquetas</a>"; }}
?>
  </a><img src="images/normal/001_35.png" height="16" width="16" title="Tags" alt="Tags" />&nbsp;&nbsp;<br />
<? if ($username || $anon_edit==true){ ?><a class="textofootres3"><strong>editar:</strong> </a>&nbsp;<img src="images/normal/001_45.png" height="16" width="16" title="Editar" alt="Editar" style="cursor:pointer;" onclick="document.location.href='editar/<? echo($title); ?>'" />&nbsp;<? } ?>
      <a class="textofootres3"><strong>compartir:  &nbsp;</strong></a>
      <script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
      <span style="text-decoration:none;"><a onclick="return fbs_click()" target="_blank"><img src="http://static.ak.fbcdn.net/rsrc.php/z39E0/hash/ya8q506x.gif" alt=""  style="text-decoration:none; cursor:pointer;" /></a></span>&nbsp;&nbsp;<img src="images/twitter.gif" height="16" width="16" title="twitter" alt="twitter" style="cursor:pointer;" onclick="document.location.href='http://twitter.com/home?status=<? echo($descri); ?> en <? echo($direcc); ?>. Visto en http://quecom.es/sitio/<? echo($title); ?>'" />&nbsp;&nbsp;</div><? if($username){ ?><a class="textofootres3"><strong>favorito:</strong></a>&nbsp;<div id="cargafav" style="width:16px; display:inline;"><img src="<? echo($img_fav); ?>" height="16" width="16" title="Agregar a mis favoritos" alt="Agregar a mis favoritos" style="cursor:pointer;" onclick="javascript:GuardaFav(<? echo($id);?>);" /></div> <? } ?>&nbsp;&nbsp;<a class="textofootres3"><strong>historial:</strong></a>&nbsp;<img src="images/normal/001_39.png" height="16" width="16" title="Ver Historial" alt="Ver Historial" style="cursor:pointer;" onclick="document.location.href='ver_historial.php?id=<? echo($id); ?>'" /></p></td>
    </tr>
  <?
  date_default_timezone_set("UTC");
  $ver_com=mysql_query("SELECT * FROM comments WHERE local_id = '$id' ORDER BY id DESC  ;");
  $num_com=mysql_num_rows($ver_com);
  if($num_com=="0"){
	$tiene_com=false;
	  ?>

      
      <?
	  
  }else{
	?>
      <tr>
    <td colspan="4" valign="middle"><a class="textofootres3" name="comments"><strong>Comentarios:</strong></a></td>
  </tr>
  <?						while ($com=mysql_fetch_array($ver_com)){
							$com_tit=$com['titulo'];
							$com_text=$com['comentario'];
							$com_user=$com['username'];
							$com_time=$com['timestamp'];
							$com_tipo=$com['voto'];
							$com_punt=$com['puntuacion'];
							$com_time=$com_time+7200;
							$com_time=date("j-m-Y H:i",$com_time);
							if($com_tipo=="1"){
							   $voto_img="images/normal/001_18.png";
							   }
							if($com_tipo=="0"){
								 $voto_img="images/normal/001_19.png" ; 
							   }
							if($com_tipo=="3"){
								 $voto_img="images/normal/001_50.png" ; 
							   }
							   	//Ver avatar del usuario que comentra
								$ver_datosa=mysql_query("SELECT avatar_img FROM usuarios WHERE username = '$com_user' LIMIT 1");
								$ver_users=mysql_fetch_array($ver_datosa);
								$avatar=$ver_users['avatar_img'];
								//Get avatar image
								if($avatar==''){
								$avatar="avatars/pq_default.PNG";
								$avatar_link="resize_image.php?image=".$avatar."&amp;new_width=24&amp;new_height=24";
								}else{
								$avatar_link="resize_image.php?image=".$avatar."&amp;new_width=24&amp;new_height=24";
								}
								//
					?>
  <tr>
    <td colspan="4" class="boxboxlighte"><table width="100%" border="0">
      <tr>
        <td width="24" height="24"><img src="<? echo($voto_img); ?>" height="24" width="24" title="Positivo" alt="Positivo" /></td>
        <td valign="middle"><a class="new2"><? print($com_tit); ?></a></td>
      </tr>
      <tr>
        <td height="11" colspan="2" align="left"><a class="estilo2v3"><? print($com_text); ?></a></td>
        </tr>
      <tr>
        <td height="11" colspan="2" align="right">
        <? if($com_tipo=='3'){ ?>
        <a class="textofootres2">De <? print($com_user); ?> el <? print($com_time); ?></a>
        <? }else{ ?>
        <a class="textofootres2"><? print($com_user); ?> puntu&oacute; el sitio con un <? print($com_punt); ?>/10 el <? print($com_time); ?></a>
        <? } ?>
        </td>
      </tr>
    </table></td>
    </tr>
  <tr>
   <td colspan="4">&nbsp;</td>
  </tr>
 
  <?
  }
  }
  ?>
     <tr>
   <td colspan="4"><form id="form1" name="form1" method="post" action="ver_local.php?id=<? echo($id); ?>">
<table width="100%" border="0" class="boxboxlighte">
  <tr>
    <td class="textores2">Comenta el sitio</td>
  </tr>
  <tr>
    <td>
      <label>
        <span class="textofootres3">titulo del comentario:</span><br />
        <input name="titulo" type="text" class="boxboxlighte" id="titulo" size="45" maxlength="50" />
      </label>
      <?
	  if($ya_voto!=true){
 	  ?>
      <select id='type' name='type' class='boxboxlighte'>
      <?
		print_r('<option value="0" >0 - Horrible</option>');
		print_r('<option value="1" >1 - Muy Malo</option>');
		print_r('<option value="2" >2 - Malo</option>');  
		print_r('<option value="3" >3 - Mediocre</option>');
	  	print_r('<option value="4" >4 - Regular</option>');
		print_r('<option value="5" SELECTED>5 - Aceptable</option>');
		print_r('<option value="6" >6 - Bueno</option>');
		print_r('<option value="7" >7 - Bastante Bueno</option>');
		print_r('<option value="8" >8 - Muy Bueno</option>');
		print_r('<option value="9" >9 - Excelente</option>');
		print_r('<option value="10" >10 - Increible</option>');					  
	 
	  }
	  ?>
      
      </select>
    </td>
  </tr>
  <tr>
    <td><label>
      <span class="textofootres3">comentario:</span><br />
      <textarea name="comentario" cols="90" rows="5" class="boxboxlighte" id="comentario"></textarea>
      <br />
      <input type="submit" name="Votar" id="Votar" value="Comentar" />
    </label></td>
  </tr>
</table>
</form></td>
  </tr>
  <tr>
    <td colspan="5"><? include("new_foot.php"); ?></td>
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
	T$('subefoto').onclick = function(){TINY.box.show('pre_guardar_img.php?id=<? echo($id); ?>&tipo=1',1,550,200,1,300)}
	
	function box(ruta,a,we,he,b,ti){
	TINY.box.show(ruta,a,we,he,b,ti);	
	}
	</script>
 
    
</body>
</html>