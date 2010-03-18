<?php

function geo_distance($lafrom , $lofrom ,$lato , $loto){
$er="6366.707";

//$latFrom=deg2rad($from->lat);
//$latTo=deg2rad($to->lat);
//$lngFrom=deg2rad($from->lng);
//$lngTo=deg2rad($to->lng);

$latFrom=deg2rad($lafrom);
$latTo=deg2rad($lato);
$lngFrom=deg2rad($lofrom);
$lngTo=deg2rad($loto);

$x1=$er*cos($lngFrom)*sin($latFrom);
$y1=$er*sin($lngFrom)*sin($latFrom);
$z1=$er*cos($latFrom);

$x2=$er*cos($lngTo)*sin($latTo);
$y2=$er*sin($lngTo)*sin($latTo);
$z2=$er*cos($latTo);

$d=acos(sin($latFrom)*sin($latTo)+cos($latFrom)*cos($latTo)*cos($lngTo-$lngFrom))*$er;
return $d;
}


?>