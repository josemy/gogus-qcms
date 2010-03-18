<?
//Prueba de algoritmo "sorprendeme"
session_start();
include("config.php");
include("getcoord.php");
//error_reporting(0);
$username=$_SESSION['username'];
?>
<style type="text/css">
<!--
#apDiv1 {
	position:absolute;
	left:8px;
	top:10px;
	width:30px;
	height:27px;
	z-index:1;
}
-->
</style>
<?
$time=time();
$result=mysql_query("SELECT count(*),busqueda,username FROM `busquedas` WHERE `username` = '$username' GROUP BY `busqueda` ORDER BY count(*) DESC");
$ver=mysql_fetch_array($result);

$resulta=mysql_query("SELECT * FROM `favoritos` WHERE `username` = '$username'");
while($vera=mysql_fetch_array($resulta)){
$ver_id=$vera['local_id'];
	$rid=mysql_query("SELECT * FROM `markers` WHERE `id` = '$ver_id'");
	$verid=mysql_fetch_array($rid);
	$tipoco=$verid['tipo_cocina'];
	$tipoco=strtolower($tipoco);
	
	mysql_query("CREATE TEMPORARY TABLE `sorp_temp` (
`id` INT( 6 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`username` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`tipo` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
)");
if($tipoco!=''){
	mysql_query("INSERT INTO `sorp_temp` ( `id` ,`username` ,`tipo`)VALUES (NULL , '$username', '$tipoco');");
	}
	
	
}

$resultaa=mysql_query("SELECT count(*),tipo,username FROM `sorp_temp` WHERE `username` = '$username' GROUP BY `tipo` ORDER BY count(*) DESC");
$veraa=mysql_fetch_array($resultaa);

$sitio=$ver['busqueda'];
$tipococi=$veraa['tipo'];


//echo($ver['busqueda']."<br>".$tipoco.$username);
if(!$sitio){
die("<a class='textorojo2'>Aun no existen datos para obtener los resultados.</a><br>
<a class='textofootres3'>Para que Sorprendeme! encuentre tus gustos, debes buscar, votar y añadir a favoritos los restaurantes que mas te gusten.</a>");	
}
if(!$tipococi){
die("<a class='textorojo2'>Aun no existen datos para obtener los resultados.</a><br>
<a class='textofootres3'>Para que Sorprendeme! encuentre tus gustos, debes buscar, votar y añadir a favoritos los restaurantes que mas te gusten.</a>");	
}
echo("<a class='textoartistarec3_peq'>".$username." prefiere los sitios de ".$ver['busqueda']." y de cocina ".$veraa['tipo']."</a>");

//Convertir cadena de busqueda a coordenadas
		$GoogleMapsApiKey = 'ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBTIu1KiFe28F4Nw1cnpSoAJjSwXMBR-1y-kGIMTRpZ6_A71qPiaPPz16g';
		$ga = new googleRequest(' ', $sitio, ' ', ' ');
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


	if ($new_lat==''){
		$new_lat='0';
	}
	if ($new_long==''){
		$new_long='0';
	}
	printf('<br>
<a class="textofootres2">Esto es lo que Sorprendeme! ha encontrado para ti:</a><br /><br />');
//$ver_todo=mysql_query("SELECT * FROM markers WHERE (ROUND(lat,4) LIKE '$new_lat%%' AND ROUND(lng,4) LIKE '$new_long%%') AND tipo_cocina = '$tipococi' LIMIT 3;");
$ver_todo=mysql_query("SELECT * FROM markers WHERE city= '$sitio' AND tipo_cocina = '$tipococi' LIMIT 3;");
$cuantos_re=mysql_num_rows($ver_todo);
if($cuantos_re=="0"){
$ver_todo=mysql_query("SELECT * FROM markers WHERE tipo_cocina = '$tipococi' LIMIT 3;");
}
  while ($prodrow=mysql_fetch_array($ver_todo)){
		$iid=$prodrow['id'];
$direcc=$prodrow['address'];
$descri=$prodrow['name'];
$coord=$prodrow['lat'];
$coord=$coord.",".$prodrow['lng'];
$long=$prodrow['descripcion'];
$vlong=$prodrow['desc_long'];
$vlong=substr($vlong,0,100)."...";
$web=$prodrow['web'];
$precio=$prodrow['precio_medio'];
$punt=$prodrow['puntuacion'];
$img=$prodrow['image'];
$titulo_f=$prodrow['titulo_f'];

if($precio){
$precio=('sobre '.$precio.' euros');
}
if($img==''){
$img="random.jpg";	
}
	if($web){
		if(strlen($web)>27){
			$webl=substr($web,0,27)."...";
		}else{
			$webl=$web;
		}
	}
print('
<div > 
<a class="textofootres4" href="sitio/'.$titulo_f.'"><u><strong>'.$descri.'</strong></u></a><a class="textofootres3">&nbsp;'.$direcc.'</a>
</div>
');
}

$cuantos_re=mysql_num_rows($ver_todo);
if($cuantos_re=="0"){
echo("No existen resultados de Sorprendeme! para tu usuario.");	
}
if($mode=="debug"){
	echo("Busqueda: ".$pat);
	echo(" Coordenadas acortadas: ".$new_lat." - ");
	echo($new_long);
	echo(" Existe como localidad?: ".$num_loc);
}


?>
<div align="right" onclick="javascript:TINY.box.hide()"><span style="cursor:pointer;" class="textouserstopv3"><u>cerrar</u></span></div>