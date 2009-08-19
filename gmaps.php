<?php
require'EasyGoogleMap.class.php';
$entrada=$_GET['c'];
$gla=$_GET['la'];
$glo=$_GET['lo'];
//SUSTITUIR POR LA KEY DE GOOGLE
$key ="ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBS3CkSPi3aKTtiOuwmOy6_GhXJFGxSPc3miXfruwYGlbR74XB975r5dgA";

$gm = & new EasyGoogleMap($key);
$gm->SetMarkerIconColor('PACIFICA');


//if($location['City'] =="(Unknown city)"){
//$location['City']="Valencia";
//}else{
	//if($location["CountryCode"]!="ES"){
//	$location['City']="Valencia";
//	}	
//}

if($entrada=='c'){
//$gm->map.SetCenter($new_lat,$new_long);
//$gm->setCenterCoords($gla, $glo);
//$gm->setCenterCoords(37.4419, -122.1419);
//$gm->new GLatLng(37.4419, -122.1419);
$gm->SetAddress($gla.",".$glo);
$gm->SetMapZoom(12);
echo($entrada.$gla.$glo);
}


//$gm->SetAddress($location_data['City']);



$gm->SetAddress($location["Latitude"].",".$location["Longitude"]);
$gm->SetInfoWindowText("<a class='textouserstopv3'>Este el el punto aproximado donde te encuentras.</a> <br><br><a class='textofootres3'>Aleja el mapa para ver restaurantes cercanos.</a> ");
$gm->SetMapZoom(12);
$prodcat=mysql_query("SELECT * FROM markers LIMIT 5;");

while ($prodrow=mysql_fetch_array($prodcat)){
$direcc=$prodrow['address'];
$descri=$prodrow['name'];
$coord=$prodrow['lat'];
$img=$prodrow['image'];
if($img==''){
$img="random.jpg";	
}
$coord=$coord.",".$prodrow['lng'];

$gm->SetAddress($prodrow['lat'].",".$prodrow['lng']);
$gm->SetInfoWindowText("<img src='resize_image.php?image=".$img."&amp;new_width=50&amp;new_height=50'> <br><a class='textofootres3'>".$descri."</a> <a class='textofootres2'>en la calle <strong>".$direcc."</strong></a>");
}

$gm->mScale = false;
$gm->mInset = false;

$gm->SetMapWidth(400); 
$gm->SetMapHeight(300);

?>

<?php echo $gm->GmapsKey(); ?>

<?php echo $gm->MapHolder(); ?>
<?php echo $gm->InitJs(); ?>
<?php echo $gm->UnloadMap(); ?>
