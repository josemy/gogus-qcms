<?
session_start();
include("config.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar local en <? print($titulo_corto); ?></title>
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
    <td bgcolor="#0066a7" width="480" style="border-top-width:1px; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;"><img src="images/logo_qcms.png" onclick="document.location.href='index.php'" style="cursor:pointer;"  width="255" height="36" alt="logo" /></td>
    <td width="480" height="50" bgcolor="#0066a7" style="border-top-width:1px; border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3;border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3; "><div align="center"><a class="tindex">busca restaurantes de cualquier ciudad</a><input name="busca" type="text" class="cajabox" style="border: 2px solid #ffffff;" id="busca" size="45" value="<? echo($rpat);?>"  onkeypress="javascript:busca(event);"/></div></td>
    <td width="" style="">&nbsp;</td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" bgcolor="#E5E5E5" class="invitado_home" style="border-top-width:1px;border-top-width:1px; border-top-style:solid;border-top-color:#E3ECF3; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; ">Editar local</td>
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
<?php


// Gets data from URL parameters
$name = $_GET['name'];
$address = $_GET['address'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$type = $_GET['type'];
$id = $_GET['id'];
$newid=$id/69;
//echo($newid);
$ver_todo=mysql_query("SELECT * FROM markers WHERE id = '$newid' ;");
    while ($prodrow=mysql_fetch_array($ver_todo)){
$address=$prodrow['address'];
$name=$prodrow['name'];
$coord=$prodrow['lat'];
$coord=$coord.",".$prodrow['lng'];
$latt=$prodrow['lat'];
$lonn=$prodrow['lng'];
$long=$prodrow['descripcion'];
$vlong=$prodrow['desc_long'];
$img=$prodrow['image'];

$web=$prodrow['web'];
$precio=$prodrow['precio_medio'];

$tipo=$prodrow['tipo_cocina'];
$tags=$prodrow['tags'];
$phone=$prodrow['phone'];
//$tags = explode(", ", $tags);
}

//echo($name.$address.$lat.$lng.$type);

?>
<?
//Bloquear ips restringidas
$ip=$_SERVER['REMOTE_ADDR'];
$ver_tod=mysql_query("SELECT * FROM blacklist WHERE ip = '$ip' AND (accion_bloqueada = 'editar' OR accion_bloqueada = 'todas') ;");
$num_b=mysql_num_rows($ver_tod);

while ($pr=mysql_fetch_array($ver_tod)){
$motiv=$pr['motivo'];
}

if($num_b < 1){
?>
<p align="center"><a class="textores2" >Edita los datos que creas incorrectos, y expon el motivo:</a></p>
<form action="editar.php?lat=<? echo($lat); ?>&lng=<? echo($lng); ?>&type=<? echo($type); ?>" method="post" id="form1" name="form1" enctype="multipart/form-data">
  <table border="0" align="center" class="boxboxlighte" style=" background-color:#FFE">
  <tr>
    <td colspan="2"><a class="textofootres4"><strong>Nombre:</strong></a></td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <input type="text" name="nombre" id="nombre" class="boxboxlighte" value="<? echo($name); ?>">
    </label></td>
  </tr>
  <tr>
    <td colspan="2"><a class="textofootres4"><strong>Direccion:</strong></a></td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <input type="text" name="direcc" id="direcc" class="boxboxlighte" value="<? echo($address); ?>">
    </label></td>
  </tr>
  <tr>
    <td colspan="2"><a class="textofootres4"><strong>Pequeña descripcion:</strong></a></td>
  </tr>
  <tr>
    <td colspan="2"><input name="desc" type="text" id="desc" size="70" class="boxboxlighte" value="<? echo($long); ?>" ></td>
  </tr>
   <tr>
    <td><a class="textofootres4"><strong>Foto Nueva:</strong></a></td>
    <td><a class="textofootres4"><strong>Foto Actual:</strong></a></td>
   </tr>
   <tr>
    <td><input type="file" name="foto" id="foto" class="boxboxlighte" /></td>
    <td><img src="resize_image.php?image=<? echo($img);?>&amp;new_width=100&amp;new_height=100">&nbsp;</td>
   </tr>
  <tr>
    <td colspan="2"><a class="textofootres4"><strong>Descripcion Larga:</strong></a></td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <textarea name="ldesc" id="ldesc" cols="67" rows="5" class="boxboxlighte"><? echo($vlong); ?></textarea>
    </label></td>
  </tr>
  <tr>
    <td ><a class="textofootres4"><strong>Precio Medio:</strong></a></td>
    <td><a class="textofootres4"><strong>Sitio Web:</strong></a></td>
  </tr>
  <tr>
    <td><input name="precio" type="text" id="precio" size="5" class="boxboxlighte" value="<? echo($precio); ?>"></td>
    <td><input type="text" name="web" id="web" class="boxboxlighte" value="<? echo($web); ?>"></td>
  </tr>
  <tr>
    <td><a class="textofootres4"><strong>Tipo de Cocina:</strong></a></td>
    <td><a class="textofootres4"><strong>Etiquetas (separadas por comas):</strong></a></td>
  </tr>
  <tr>
    <td><input type="text" name="tipo_co" id="tipo_co" class="boxboxlighte" value="<? echo($tipo); ?>"></td>
    <td><input name="etiq" type="text" id="etiq" size="55" class="boxboxlighte" value="<? echo($tags); ?>"></td>
  </tr>
      <tr>
    <td><a class="textofootres4"><strong>Telefono:</strong></a></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td><input type="text" name="phone" id="phone" class="boxboxlighte" value="<? echo($phone); ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><a class="textofootres4"><strong>Motivo de la edicion:</strong></a></td>
    </tr>
    <tr>
    <td colspan="2"><input name="motiv" type="text" id="motiv" size="70" class="boxboxlighte" value="" /></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label>
      <input type="submit" name="guardar" id="guardar" value="Guardar">
    </label></td>
    <td><input name="nid" type="text" id="nid" size="5" class="boxboxlighte" value="<? echo($newid); ?>"  style="visibility:hidden;"/></td>
  </tr>
</table>
<br />
</form>
<?
}else{
?>
    <p class="textofootres3" ><img src="images/normal/001_30.png" height="24px" width="24px" title="Error" alt="Error" /></p>
    <p class="textofootres3"><b> No puedes editar este local.</b><br />
Debido a: <strong><? echo($motiv); ?></strong>, no tienes permiso para realizar esta accion</p>
<?
}
?>
</td>
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