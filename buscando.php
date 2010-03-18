<?
session_start();
include("config.php");

include("geo_km.php");
$username=$_SESSION['username'];
$pat=$_GET['p'];
$cit=$_GET['city'];
$pre_city=$cit;
$city=$cit;
$cpat=$pat;
$coun=$_GET['c'];
$mode=$_GET['mode'];
$art=$_GET['pg'];
$art_p=10;
if($art==''){
$art=$art_p;
}
$com=$art-$art_p;
$vermas=$art+$art_p;
$rpat=$pat;
//Extraer puntos totales
	$ver_punt=mysql_query("SELECT SUM(`puntuacion`) FROM `markers`");
	$ver_p=mysql_fetch_array($ver_punt);
	$puntost=$ver_p['SUM(`puntuacion`)'];
//




//Busca si la cadena a buscar es una localidad o provincia
$ver_loc=mysql_query("SELECT * FROM localidades WHERE localidad = '$pat' OR provincia = '$pat'");
$num_loc=mysql_num_rows($ver_loc);
//

//prueba de rendimiento
//$num_loc=0;

//Si es mayor que 0, quiere decir que si es una localidad.
if ($num_loc > 0){
	
	include('get_coord_gl.php');
	$ver_city = ver_citt($pat);
	$city=$ver_city["LocalityNamee"];
	$precoord=$ver_city["coordinates"];
	$tsp = explode(",", $precoord);
	$new_lat=$tsp[1];
	$new_long=$tsp[0];
		
		if ($pre_lon){
			$new_lat=$pre_lat;
		}
		if ($pre_lat){
			$new_long=$pre_lon;
		}
	//Recorta las Coordenadas a 40.0 para poder compararlas con la bbdd
		$new_lat=substr($new_lat,0,4);
		$new_long=substr($new_long,0,4);
	//$new_lat=round($new_lat,1);
	//$new_long=round($new_long,1);
	
	//
}
//
	if ($new_lat==''){
		$new_lat='0';
	}
	if ($new_long==''){
		$new_long='0';
	}


if($new_lat!='0'){
//Solucion Issue 6
	//$ver_todo=mysql_query("SELECT * FROM markers WHERE (ROUND(lat,4) LIKE '$new_lat%%' AND ROUND(lng,4) LIKE '$new_long%%');");
			if($pre_city){
			$ver_todo=mysql_query("SELECT * FROM markers WHERE city = '$pre_city' ORDER BY priority DESC LIMIT $com,$art;");
				
			}else{
			$ver_todo=mysql_query("SELECT * FROM markers WHERE (ROUND(lat,4) LIKE '$new_lat%%' AND ROUND(lng,4) LIKE '$new_long%%') OR (lat-0.1 LIKE '$new_lat%%' AND lng-0.03 LIKE '$new_long%%') OR (lat-0.1 LIKE '$new_lat%%' AND lng-0.02 LIKE '$new_long%%') OR (lat-0.1 LIKE '$new_lat%%' AND lng-0.01 LIKE '$new_long%%') OR (lat+0.1 LIKE '$new_lat%%' AND lng+0.02 LIKE '$new_long%%') OR (lat+0.1 LIKE '$new_lat%%' AND lng+0.01 LIKE '$new_long%%') OR (lat LIKE '$new_lat%%' AND lng+0.02 LIKE '$new_long%%') OR (lat LIKE '$new_lat%%' AND lng+0.01 LIKE '$new_long%%') OR (lat LIKE '$new_lat%%' AND lng-0.02 LIKE '$new_long%%') OR (lat LIKE '$new_lat%%' AND lng-0.01 LIKE '$new_long%%') OR (city='$city') ORDER BY priority DESC LIMIT $com,$art;");
			//
			}
}else{
	//Comprueba si la cadena a buscar lleva frase del tipo "Restaurantes en Oviedo"
	$prett=explode(",",$pat);
		if($prett[1]!=''){
			$sol=$prett[0];
			$pat=$prett[1];
		}
	$pret=explode(", ",$pat);
		if($pret[1]!=''){
			$sol=$pret[0];
			$pat=$pret[1];
		}
	$preta=explode(" de ",$pat);
		if($preta[1]!=''){
			$sol=$preta[0];
			$pat=$preta[1];
		}
	$pretaa=explode(" en ",$pat);
		if($pretaa[1]!=''){
			$sol=$pretaa[0];
			$pat=$pretaa[1];
		}
		
		$pretaa=explode("restaurantes ",$pat);
		if($pretaa[1]!=''){
			$sol="restaurantes";
			$pat=$pretaa[1];
		}
		$pretaa=explode("bares ",$pat);
		if($pretaa[1]!=''){
			$sol="bares";
			$pat=$pretaa[1];
		}
			$pretaa=explode("pizzerias ",$pat);
		if($pretaa[1]!=''){
			$sol="pizzerias";
			$pat=$pretaa[1];
		}
			//Convertir plural en singular de la variable sol
			if ($sol=='restaurantes'){
				$sol='restaurante';
			}
			if ($sol=='bares'){
				$sol='bar';
			}
			if ($sol==''){
				$sol=$pat;
			}
			if ($sol=='pizzerias'){
				$sol='pizzeria';
			}
		//
	//$ver_todo=mysql_query("SELECT * FROM markers WHERE  (name LIKE '%%$sol%%$pat%%') OR (address LIKE '%%$pat%%') OR (name LIKE '%%$pat%%') OR (name LIKE '%%$sol%%') ORDER BY priority DESC LIMIT $com,$art;");
			if($pre_city){
			$ver_todo=mysql_query("SELECT * FROM markers WHERE city = '$pre_city' ORDER BY priority DESC LIMIT $com,$art;");
							
			}else{
			//Full text
			$ver_todo=mysql_query(" SELECT *, MATCH(name) AGAINST('$sol $pat') AS score FROM markers WHERE MATCH(name) AGAINST('$sol $pat') OR (city = '$pat') OR (address LIKE '%%$pat%%') OR (name LIKE '%%$pat%%') ORDER BY  score DESC, priority DESC LIMIT $com,$art; ");
			}
}
//
//Guardar la busqueda para las estadisticas de busquedas recientes.
	$referer=$_SERVER['HTTP_REFERER'];
	$iip=$_SERVER['REMOTE_ADDR'];
	$times=time();
	mysql_query("INSERT INTO busquedas (id,busqueda,ip,referer,timestamp,username) VALUES ('','$rpat','$iip','$referer','$times','$username')");
//
		//Mostrar el box "Cerca de..."
		if($pre_city){
		$rpat="Cerca de ".$pre_city;	
		}
		//
$cuantos_re=mysql_num_rows($ver_todo);
		//Modo debug
		if($mode=="debug"){
			echo("Busqueda: ".$sol." ".$pat);
			echo(" Coordenadas acortadas: ".$new_lat." - ");
			echo($new_long."".$pre_city);
			echo(" Existe como localidad?: ".$num_loc);
			echo("paginas: ".$num_p);
		}
		//

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<base href = "<? echo $_URL_BASE; ?>" target="_top" />
<title><? echo($rpat); ?> en <? print($titulo_corto); ?></title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
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
font-size: 20px;
font-weight:bold;
text-decoration:none;
color:#333;

	
}
.new2 {font-size: 13px; font-family:arial,sans-serif; color: #0066cc;font-weight:bold;text-decoration:none;}
.new3 {font-size: 13px;  font-family:arial,sans-serif; color: #777eb3;text-decoration:none;}
.new4 {color: #090; font-family: arial,sans-serif; font-size: 11px; text-decoration: none; }
.new5 {font-size: 11px;  font-family:arial,sans-serif; color: #333;text-decoration:none;font-weight:bold;}
.new6 {font-size: 11px;  font-family:arial,sans-serif; color: #999;text-decoration:none;font-weight:bold;}
-->
</style>
<script language="javascript" src="codigo2.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function GuardaFav(nu){
llamarasincrono2('add_fav.php?fid='+nu,'guardafav'+nu);	
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
    <td colspan="2" bgcolor="#ffffff" ><table width="90%" border="0" cellpadding="2">
    <?
	if($cuantos_re > "0"){
		print('    <tr>
    <td ><a class="estilo2v3black"><strong>Descripci&oacute;n</strong></a></td>
   <td class="estilo2v3black"></td>
    <td class="estilo2v3black"></td>
    <td ><a class="estilo2v3black" title=""></a></td>
    <td class="estilo2v3black"></td>
<td>&nbsp;</td>
	  </tr>');
		
	}
    while ($prodrow=mysql_fetch_array($ver_todo)){
		$iid=$prodrow['id'];
$direcc=$prodrow['address'];
$citz=$prodrow['city'];
$descri=$prodrow['name'];
$coord=$prodrow['lat'];
$coord=$coord.",".$prodrow['lng'];
$latt=$prodrow['lat'];
$lonn=$prodrow['lng'];
$city=$prodrow['city'];
if($city){
$get_prov=mysql_query("SELECT provincia FROM localidades WHERE localidad = '$city' LIMIT 1");
$get_prova=mysql_fetch_array($get_prov);
$provincia=$get_prova['provincia'];
}
$long=$prodrow['descripcion'];
$vlong=$prodrow['desc_long'];
if($vlong){
		if(strlen($vlong)>200){
			$vlong=mb_substr($vlong,0,200)."...";
		}else{
			$vlong=$vlong;
		}
}
if($vlong==''){
$vlong="Este local aun no tiene descripci&oacute;n. &iquest;Lo conoces? Entra y comentalo.";
}
$vlong=str_replace("<br>","",$vlong);
$web=$prodrow['web'];
$precio=$prodrow['precio_medio'];
$punt=$prodrow['puntuacion'];
$img=$prodrow['image'];
$telf=$prodrow['phone'];
$titulo_f=$prodrow['titulo_f'];
if($precio){
$precio=('sobre '.$precio.' euros');
}
if($img==''){
$img="random.jpg";	
}
if($img=='local_img/'){
$img="random.jpg";	
}
	if(strlen($web)>1){
		if(strlen($web)>50){
			$webl=substr($web,0,47)."...";
		}else{
			$webl=$web;
		}
		$web=str_replace("http://","",$web);
	}else{
		$webl="";
	}
	
	$distancia=(int)geo_distance($_SESSION["Latitude"],$_SESSION["Longitude"],$latt,$lonn);

if($long!=""){
	
		if(strlen($long)>80){
			$long=substr($long,0,77)."...";
		}

$divtit='<div style="height:15px;" class="estilo2v3"><b>'.$long.'</b></div>';
}else{
$divtit="";	
}
$type=$prodrow['type'];

if($type){
	$verty=mysql_query("SELECT * FROM tipos_locales WHERE id = '$type'");
	$vertya=mysql_fetch_array($verty);
	$typen=$vertya['nombre'];
	if($typen!=""){
	$divtip='<div style="height:18px;"><b><a class="estilo2v3">Categoria: '.$typen.'</a></b></div>';
	}
}
//Ver los comments
$vercoment=mysql_query("SELECT `id` FROM `comments` WHERE `local_id` = '$iid'");
$commnum=mysql_num_rows($vercoment);
//
//Ver si esta en favoritos
$ver_si=mysql_query("SELECT * FROM favoritos WHERE local_id = '$iid' AND username = '$username';");
$n_ver=mysql_num_rows($ver_si);
if($n_ver > 0){
$img_fav="images/normal/001_15.png";
}else{
$img_fav="images/normal/001_16.png";
}
//
if(strlen($direcc)>50){
	$direcc=substr($direcc,0,47)."...";
}

//print('
//	    <tr >
//    <td class="textofootres3"><b><a class="textofootres4" href="sitio/'.$titulo_f.'"><u>'.$descri.'</u></a></b><br>'.$direcc.' (a '.$distancia.' kms de ti)<br><b>'.$long.'</b><br>'.$vlong.'<br><a class="textofootres6" style="font-size:11px;" href="http://'.$web.'" target="_blank" >'.$webl.'</a></td>
//    <td class="textofootres3"></td>
    
//    <td class="textofootres3"></td>
//    <td class="txtgra">'.$punt.'</td>
//	<td class="textofootres3"></td>
//    <td><img src="resize_image.php?image='.$img.'&amp;new_width=100&amp;new_height=100"></td>
//	  </tr>
//');

//Div para "sitio patrocidano" <div align="right" style=" position:relative; display:inline; text-align:right;"><a class="new6">sitio patrocinado</a></div>
//Color de fondo:style="background-color:#ffff99;"

print('
	      <tr >
    <td colspan="2" class="textofootres3" ><a class="new1" href="sitio/'.$titulo_f.'">'.$descri.'</a>&nbsp;<span class="new2"><a href="buscando.php?p='.$city.'">'.$city.'</a>&nbsp;<a href="buscando.php?p='.$provincia.'">'.$provincia.'</a></span>&nbsp;<div style="position: relative; display:inline;" id="guardafav'.$iid.'"><img src="'.$img_fav.'" height="16" width="16" title="Agregar a mis favoritos" alt="Agregar a mis favoritos" style="cursor:pointer;" onclick="javascript:GuardaFav('.$iid.');" /></div>  <a class="estilo2v3link" href="sitio/'.$titulo_f.'#comments"><u>'.$commnum.' comentarios</u></a> - '.$punt.' puntos<br /></td>
    <td rowspan="2" class="textofootres3"></td>
    
    <td rowspan="2" class="textofootres3"></td>
    </tr>
    <tr >
      <td class="textofootres3" width="100"><div style="border-color:#333; border:solid;border-width:1px;" ><img src="resize_image.php?image='.$img.'&amp;new_width=100&amp;new_height=100" alt="" style="cursor:pointer;"'); ?> onclick="document.location.href='sitio/<? echo($titulo_f); ?>'" /> <? print('</div></td>
      <td class="new3" valign="top"><div style="height:18px;">'.$direcc.' - '.$citz.' (a '.$distancia.' kms de ti) - <a class="estilo2v3"><strong>'.$telf.'</strong></a></div>'.$divtip.''.$divtit.'<div style="height:15px;width:500px;text-align:justify;vertical-align:text-top;" class="estilo2v3">'.$vlong.'<div style="height:18px;"><a class="textofootres6" style="font-size:11px;" href="http://'.$web.'" target="_blank" >'.$webl.'</a></div></div></td>
    </tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	');



}


if($cuantos_re=="0"){
	print('
	    <tr>
    <td class="textofootres3" colspan="4" align="center"><img src="images/normal/001_30.png" height="24px" width="24px" title="Error" alt="Error" /></td>
    <td class="textofootres3" colspan="2"><b> No hay resultados para la busqueda.</b><br />
Si conoces algun sitio que concuerde con esta zona, puedes subirlo </a><a class="textofootres4" href="add_local.php"><u>aqui</u></a></td>

	  </tr>
');
	$nores=1;
}
//calcular paginas

//$num_p=$cuantos_re/10+1;
//$num_p=round($num_p);
//$i=0;
//$a=1;

?>    <!-- <tr>
    <td colspan="6"><a href='1'><</a>&nbsp;<?
    while($i<=$num_p){ 
	while($i<=10){
		$g=$i+1;
		echo("<a href='buscando.php?p=$pat&pg=$a'>$a</a>&nbsp;");
		$i=$i+$art_p;
		$a++;
	}
	}?>&nbsp;<a href='<? echo($a); ?>'>></a></td>
	  </tr>
    <tr>&nbsp;-->
    </table>
    <? if(!$nores){ ?>
    <table border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td><img onclick="document.location.href='buscando.php?p=<? echo($cpat); ?>&amp;pg=<? echo($vermas); ?>';" style="cursor:pointer;" src="images/icons/Plus.png" width="24" height="24" alt="mas" /> &nbsp;</td>
    <? if($pre_lat){
		$pre_lat=$_GET['la'];
		$pre_lon=$_GET['lo'];
		$pre_city=$_GET['city'];
		$segunda="&lo=".$pre_lon."&la=".$pre_lat."&city=".$pre_city;
	}
	?>
    <td valign="middle"><a href='buscando.php?p=<? echo($cpat); ?>&amp;pg=<? echo($vermas); ?><? echo($segunda); ?>' class="textofootres4"><u>Ver mas</u></a></td>
  </tr>
</table>
    <? } ?>
    </td>
    <td style="">&nbsp;</td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" style=""><? include("new_foot.php"); ?></td>
    <td style="">&nbsp;</td>
  </tr>
</table>
</body>
</html>