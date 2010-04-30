<?
/*
Guardar la localizacion nueva
*/
session_start();
?>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<?
require('config.php');
$sitio=$_POST['newloc'];
if(strlen($sitio)<1){
printf("<script>document.location.href='index.php?error=NO_NEW_LOC'</script>");	
}
print("<span class='textouserstopv3'>buscando las coordenadas de ".$sitio."...</span>");
$location["CountryCode"]="ES";
include('get_coord_gl.php');
$ver_city = ver_citt($sitio);
$city=$ver_city["LocalityNamee"];
$precoord=$ver_city["coordinates"];
$tsp = explode(",", $precoord);
$new_lat=$tsp[1];
$new_long=$tsp[0];
$new=$tsp[2];
if($city=='' || $new_long==''){
printf("<script>document.location.href='index.php?error=NO_NEW_LOC'</script>");	
}
$location['City']=$city;
$location["Longitude"]=$new_long;
$location["Latitude"]=$new_lat;
/* No crea la cookie xq tiene que estarinmediatamente despues del sesion, lo pasare por JS
$_COOKIE["qcms_lat"]=$location["Latitude"];
$_COOKIE["qcms_lon"]=$location["Longitude"];
$_COOKIE["qcms_geo"]="si";
*/
?>
<script>  
document.cookie='qcms_lat=<? print($location["Latitude"]); ?>;max-age=2592000';
document.cookie='qcms_lon=<? print($location["Longitude"]); ?>;max-age=2592000';
document.cookie='qcms_geo=si;max-age=2592000';
document.location.href='/';
</script>
<? echo($precoord." Long:".$new_long." Lat:".$new_lat." Resto:".$new); 
print_r($tsp);?>