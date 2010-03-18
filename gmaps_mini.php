<?php
require'EasyGoogleMap.class.php';
$entrada="c";
$gla=$latt;
$glo=$lonn;
//SUSTITUIR POR LA KEY DE GOOGLE
$key ="ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBS3CkSPi3aKTtiOuwmOy6_GhXJFGxSPc3miXfruwYGlbR74XB975r5dgA";

$gm = & new EasyGoogleMap($key);
$gm->SetMarkerIconColor('POPPY');
$gm->SetMapControl('SMALL_ZOOM');


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
$gm->SetAddress("".$gla.",".$glo);
$gm->SetInfoWindowText('<a class="textofootres4"><strong>'.$descri.'</strong></a><br /><a class="textofootres3">'.$direcc.'</a>');
$gm->SetMapZoom(15);

}







$gm->mScale = false;
$gm->mInset = false;

$gm->SetMapWidth(250); 
$gm->SetMapHeight(250);

?>

<?php echo $gm->GmapsKey(); ?>

<?php echo $gm->MapHolder(); ?>
<?php echo $gm->InitJs(); ?>
<?php echo $gm->UnloadMap(); ?>
