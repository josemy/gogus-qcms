<?
include('get_city_gl.php');
$ver_city = ver_cit("40.811999","-3.772121");
$location['City']=$ver_city["name"];
echo($ver_city["LocalityName"]);
print_r($ver_city["LocalityNamee"]);
?>