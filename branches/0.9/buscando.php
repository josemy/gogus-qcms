<?
session_start();
include("config.php");
include("getcoord.php");
$username=$_SESSION['username'];
$pat=$_GET['p'];
$coun=$_GET['c'];
$mode=$_GET['mode'];
$rpat=$pat;
//Extraer puntos totales
	$ver_punt=mysql_query("SELECT SUM(`puntuacion`) FROM `markers`");
	$ver_p=mysql_fetch_array($ver_punt);
	$puntost=$ver_p['SUM(`puntuacion`)'];
//



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
//Busca si la cadena a buscar es una localidad o provincia
$ver_loc=mysql_query("SELECT * FROM localidades WHERE localidad = '$pat' OR provincia = '$pat'");
$num_loc=mysql_num_rows($ver_loc);
//

//prueba de rendimiento
//$num_loc=0;

//Si es mayor que 0, quiere decir que si es una localidad.
if ($num_loc > 0){
	
	//Convertir cadena de busqueda a coordenadas
		$GoogleMapsApiKey = 'ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBTIu1KiFe28F4Nw1cnpSoAJjSwXMBR-1y-kGIMTRpZ6_A71qPiaPPz16g';
		$ga = new googleRequest(' ', $pat, ' ', ' ');
		//$ga->country="ES";
		$ga->setGoogleKey($GoogleMapsApiKey);
		$ga->GetRequest();
		$pre_lat=$_GET['la'];
		$pre_lon=$_GET['lo'];
		$pre_city=$_GET['city'];
		$new_lat=$ga->getVar('latitude'); 
		$new_long=$ga->getVar('longitude'); 
	
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

	if ($new_lat==''){
		$new_lat='0';
	}
	if ($new_long==''){
		$new_long='0';
	}
//Modo debug
if($mode=="debug"){
	echo("Busqueda: ".$pat);
	echo(" Coordenadas acortadas: ".$new_lat." - ");
	echo($new_long);
	echo(" Existe como localidad?: ".$num_loc);
}
//
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
//
if($new_lat!='0'){
//Solucion Issue 6
	//$ver_todo=mysql_query("SELECT * FROM markers WHERE (ROUND(lat,4) LIKE '$new_lat%%' AND ROUND(lng,4) LIKE '$new_long%%');");
	
$ver_todo=mysql_query("SELECT * FROM markers WHERE (ROUND(lat,4) LIKE '$new_lat%%' AND ROUND(lng,4) LIKE '$new_long%%') OR (lat-0.1 LIKE '$new_lat%%' AND lng-0.03 LIKE '$new_long%%') OR (lat-0.1 LIKE '$new_lat%%' AND lng-0.02 LIKE '$new_long%%') OR (lat-0.1 LIKE '$new_lat%%' AND lng-0.01 LIKE '$new_long%%') OR (lat+0.1 LIKE '$new_lat%%' AND lng+0.02 LIKE '$new_long%%') OR (lat+0.1 LIKE '$new_lat%%' AND lng+0.01 LIKE '$new_long%%') OR (lat LIKE '$new_lat%%' AND lng+0.02 LIKE '$new_long%%') OR (lat LIKE '$new_lat%%' AND lng+0.01 LIKE '$new_long%%') OR (lat LIKE '$new_lat%%' AND lng-0.02 LIKE '$new_long%%') OR (lat LIKE '$new_lat%%' AND lng-0.01 LIKE '$new_long%%');");
//
}else{

	$ver_todo=mysql_query("SELECT * FROM markers WHERE (address LIKE '%%$pat%%') OR (name LIKE '%%$pat%%') OR (name LIKE '%%$sol%%') ;");
}
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><? echo($rpat); ?> en <? print($titulo_corto); ?></title>
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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="" style="">&nbsp;</td>
    <td bgcolor="#0066a7" width="480" ><img src="images/logo_qcms.png" onclick="document.location.href='index.php'" style="cursor:pointer;" width="255" height="36" alt="logo" /></span></td>
    <td width="480" height="50" bgcolor="#0066a7" style="border-top-width:1px; border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; "><div align="center"><a class="tindex">busca restaurantes de cualquier ciudad</a><input name="busca" type="text" class="cajabox" style="border: 2px solid #ffffff;" id="busca" size="45" value="<? echo($rpat);?>"  onkeypress="javascript:busca(event);"/></div></td>
    <td width="" style="">&nbsp;</td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" bgcolor="#E5E5E5" class="invitado_home" style="border-top-width:1px;border-top-width:1px; border-top-style:solid;border-top-color:#E3ECF3; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; ">buscando: <? echo($rpat); ?></td>
    <td style="">&nbsp;</td>
  </tr>
  <tr>
    <td style=""></td>
    <td colspan="2" style=" height:10px; "></td>
    <td style=""></td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" bgcolor="#ffffff" style="border-top-width:1px; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; "><table width="90%" border="0" cellpadding="2">
	<?
    while ($prodrow=mysql_fetch_array($ver_todo)){
		$iid=$prodrow['id'];
$direcc=$prodrow['address'];
$descri=$prodrow['name'];
$coord=$prodrow['lat'];
$coord=$coord.",".$prodrow['lng'];
$long=$prodrow['descripcion'];
$vlong=$prodrow['desc_long'];
if($vlong){
		if(strlen($vlong)>100){
			$vlong=substr($vlong,0,100)."...";
		}else{
			$vlong=$vlong;
		}
}
if($vlong==''){
$vlong="Este local aun no tiene descripci&oacute;n. Entra y comentalo.";
}
$web=$prodrow['web'];
$precio=$prodrow['precio_medio'];
$punt=$prodrow['puntuacion'];
$img=$prodrow['image'];

if($precio){
$precio=('sobre '.$precio.' euros');
}
if($img==''){
$img="random.jpg";	
}
	if(strlen($web)>1){
		if(strlen($web)>27){
			$webl=substr($web,0,27)."...";
		}else{
			$webl=$web;
		}
		$web=str_replace("http://","",$web);
	}else{
		$webl="";
	}
print('
	    <tr>
    <td class="textofootres3"><b><a class="textofootres4" href="ver_local.php?id='.$iid.'"><u>'.$descri.'</u></a></b><br>'.$direcc.'<br><b>'.$long.'</b><br>'.$vlong.'</td>
    <td class="textofootres3"></td>
    <td class="textofootres3"></td>
    <td class="textofootres3"><a class="textofootres5" href="http://'.$web.'" >'.$webl.'</a> <br>'.$precio.'</td>
    <td class="txtgra">'.$punt.'/'.$puntost.'</td>
    <td><img src="resize_image.php?image='.$img.'&amp;new_width=100&amp;new_height=100"></td>
	  </tr>
');
}

$cuantos_re=mysql_num_rows($ver_todo);
if($cuantos_re=="0"){
	print('
	    <tr>
    <td class="textofootres3" colspan="4" align="center"><img src="images/normal/001_30.png" height="24px" width="24px" title="Error" alt="Error" /></td>
    <td class="textofootres3" colspan="2"><b> No hay resultados para la busqueda.</b><br />
Si conoces algun sitio que concuerde con esta zona, puedes subirlo </a><a class="textofootres4" href="add_local.php"><u>aqui</u></a></td>

	  </tr>
');
}
?>&nbsp;</table></td>
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