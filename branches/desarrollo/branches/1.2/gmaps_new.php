<?php
require'EasyGoogleMap.class.php';
$entrada=$_GET['c'];
$gla=$_GET['la'];
$glo=$_GET['lo'];
$nnew_long=$location["Longitude"];
$nnew_lat=$location["Latitude"];
$nnew_lat=substr($nnew_lat,0,3);
$nnew_long=substr($nnew_long,0,4);
$ccity=$location["City"];
$gm = & new EasyGoogleMap($key);
$gm->mCitydefault =$location["Latitude"].','.$location["Longitude"];
if($entrada=='c'){
$gm->SetAddress($gla.",".$glo);
$gm->SetMapZoom(12);


echo($entrada.$gla.$glo);
}
$gm->SetMarkerIconColor('POPPY');
$gm->SetAddress($location["Latitude"].",".$location["Longitude"]);
$gm->SetInfoWindowText(" <br /><a class='textouserstopv3'>Este el el punto aproximado donde te encuentras.</a><br><a class='textofootres3'>Aleja el mapa para ver restaurantes cercanos.</a> ");
$gm->SetMapZoom(15);
$gm->SetMarkerIconColor('PACIFICA');
//$prodcat=mysql_query("SELECT * FROM markers WHERE (city = '$ccity') LIMIT 15;");

//Apura la busqueda...
		$new_lat=substr($location["Latitude"],0,4);
		$new_long=substr($location["Longitude"],0,4);
		//$prodcat=mysql_query("SELECT * FROM markers WHERE (ROUND(lat,4) LIKE '$new_lat%%' AND ROUND(lng,4) LIKE '$new_long%%') OR (lat-0.1 LIKE '$new_lat%%' AND lng-0.03 LIKE '$new_long%%') OR (lat-0.1 LIKE '$new_lat%%' AND lng-0.02 LIKE '$new_long%%') OR (lat-0.1 LIKE '$new_lat%%' AND lng-0.01 LIKE '$new_long%%') OR (lat+0.1 LIKE '$new_lat%%' AND lng+0.02 LIKE '$new_long%%') OR (lat+0.1 LIKE '$new_lat%%' AND lng+0.01 LIKE '$new_long%%') OR (lat LIKE '$new_lat%%' AND lng+0.02 LIKE '$new_long%%') OR (lat LIKE '$new_lat%%' AND lng+0.01 LIKE '$new_long%%') OR (lat LIKE '$new_lat%%' AND lng-0.02 LIKE '$new_long%%') OR (lat LIKE '$new_lat%%' AND lng-0.01 LIKE '$new_long%%') OR (city='$ccity') ORDER BY priority DESC LIMIT 15");
		//$prodcat=mysql_query("SELECT * FROM markers WHERE '1' > sqrt((lat-lng*lat-lng)-('".$location["Latitude"]."'-'".$location["Longitude"]."'*'".$location["Latitude"]."'-'".$location["Longitude"]."')) LIMIT 50");
		
		//$prodcat=mysql_query("SELECT *,SQRT( (lat - lng * lat - lng) - ( '".$location["Latitude"]."' - '".$location["Longitude"]."' * '".$location["Latitude"]."' - '".$location["Longitude"]."' ) ) As dis FROM markers WHERE SQRT( (lat - lng * lat - lng) - ( '".$location["Latitude"]."' - '".$location["Longitude"]."' * '".$location["Latitude"]."' - '".$location["Longitude"]."' ) ) < '0.9'  ORDER BY dis ASC LIMIT 20");
		
		$prodcat=mysql_query("SELECT *,(acos(sin(radians(lat)) * sin(radians(".$location["Latitude"].")) + 
cos(radians(lat)) * cos(radians(".$location["Latitude"].")) * cos(radians(lng) - radians(".$location["Longitude"]."))) * 6378) as 'AA' FROM `markers` WHERE (acos(sin(radians(lat)) * sin(radians(".$location["Latitude"].")) + cos(radians(lat)) * cos(radians(".$location["Latitude"].")) * cos(radians(lng) - radians(".$location["Longitude"]."))) * 6378) < '2000' ORDER BY `AA` ASC LIMIT 0,20;");
		
//
//Declara la variable ya que si no falla
$ant_coord="";
//
while ($prodrow=mysql_fetch_array($prodcat)){
$direcc=$prodrow['address'];
$descri=$prodrow['name'];
$nombre_f=$prodrow['titulo_f'];
$coord=$prodrow['lat'];
$img=$prodrow['image'];
if($img==''){
$img="random.jpg";	
}
$coord=$coord.",".$prodrow['lng'];
//Comprobar si las coordenadas ya están en el array, si no, dibujalo en el mapa
	if(!in_array($coord,$ant_coord)){
	$gm->SetAddress($prodrow['lat'].",".$prodrow['lng']);
	$gm->SetInfoWindowText("<table border='0' cellspacing='2' cellpadding='2'>  <tr>    <td><img src='resize_image.php?image=".$img."&amp;new_width=50&amp;new_height=50'></td>    <td valign='middle'><a class='textofootres3' href='sitio/".$nombre_f."'><u>".$descri."</u></a><br /> <a class='textofootres2'>en la calle <strong>".$direcc."</strong></a></td>  </tr></table>");
	}
//
//Mete las coordenadas en un array
$ant_coord=array($coord);
//
}
$gm->mScale = false;
$gm->mInset = false;
$gm->SetMapWidth(850); 
$gm->SetMapHeight(300);
echo $gm->GmapsKey(); 
echo $gm->MapHolder();
echo $gm->InitJs();
echo $gm->UnloadMap();
?>
