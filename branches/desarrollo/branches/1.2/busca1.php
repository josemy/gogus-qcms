<? 
session_start();
include("db.php");

include("getcoord.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<table width="100%" border="0">

  <?
$pat=$_GET['p'];
$rpat=$pat;
//Partir si lleva coma o espacio en espacio
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
//echo($pat);

//convertir nombre a coord
$GoogleMapsApiKey = 'ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBTIu1KiFe28F4Nw1cnpSoAJjSwXMBR-1y-kGIMTRpZ6_A71qPiaPPz16g';
$ga = new googleRequest(' ', $pat, ' ', ' ');
//$ga = new googleRequest('C\ Tenerife, 29', 'Alovera', 'España', '19208');
$ga->setGoogleKey($GoogleMapsApiKey);
$ga->GetRequest();

$new_lat=$ga->getVar('latitude'); 
$new_lat=substr($new_lat,0,3);
$new_long=$ga->getVar('longitude'); 
$new_long=substr($new_long,0,3);
//$new_long=$splo[0];
if ($new_lat==''){
$new_lat='0';
}
if ($new_long==''){
$new_long='0';
}
//

//Convertir plural en singular de la variable sol
if ($sol=='restaurantes'){
$sol='restaurante';
}
if ($sol=='bares'){
$sol='bar';
}
//

$ver_todo=mysql_query("SELECT * FROM markers WHERE address LIKE '%%$pat%%' OR name LIKE '%%$pat%%' OR (lat LIKE '$new_lat%%' AND lng LIKE '$new_long%%' AND name LIKE '%%$sol%%') ;");
print('
	<tr>
    <td colspan="6">Buscando: '.$rpat.'</td>
    </tr>
	');

while ($prodrow=mysql_fetch_array($ver_todo)){
$direcc=$prodrow['address'];
$descri=$prodrow['name'];
$coord=$prodrow['lat'];
$coord=$coord.",".$prodrow['lng'];
$long=$prodrow['descripcion'];
$precio=$prodrow['precio_medio'];
$punt=$prodrow['puntuacion'];
print('
	    <tr>
    <td>'.$descri.'</td>
    <td>'.$direcc.'</td>
    <td>'.$long.'</td>
    <td>'.$precio.'</td>
    <td>'.$punt.'</td>
    <td>imagen</td>
	  </tr>
');
}

?>


</table>

<p>&nbsp;</p>
</body>
</html>

<div id="mapaini"> </div>
<?
//Verificar si hay coordenadas, centrar mapa
print("<script>javascript:llamarasincrono2('gmaps.php?c=c&la=".$new_lat."&lo=".$new_long."','mapaini');</script>");
//
?>