<?
$er="6366.707";
$lafrom=40.596701;
$lofrom-3.248165;
$lato=38.695824;
$loto=-0.474129;
$latFrom=$lafrom;
$latTo=$lato;
$lngFrom=$lofrom;
$lngTo=$loto;
$x1=$er*cos($lngFrom)*sin($latFrom);
$y1=$er*sin($lngFrom)*sin($latFrom);
$z1=$er*cos($latFrom);

$x2=$er*cos($lngTo)*sin($latTo);
$y2=$er*sin($lngTo)*sin($latTo);
$z2=$er*cos($latTo);

$d=acos(sin($latFrom)*sin($latTo)+cos($latFrom)*cos($latTo)*cos($lngTo-$lngFrom))*$er;
echo($d);



?>