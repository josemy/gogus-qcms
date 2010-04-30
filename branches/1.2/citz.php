<?
//City Script.
//
//Sacar el Campo city a los registros ya existentes en quecomes.
include("db.php");
$query=mysql_query("SELECT * FROM markers WHERE city = '';");
while($geto=mysql_fetch_array($query)){
$id=$geto['id'];
$lat=$geto['lat'];
$lng=$geto['lng'];
$localfile="http://maps.google.com/maps/geo?q=".$lat.",".$lng."&oe=utf8&output=csv&key=ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBTIu1KiFe28F4Nw1cnpSoAJjSwXMBR-1y-kGIMTRpZ6_A71qPiaPPz16g";
				if ($d = fopen($localfile, "r")) {
		//Prueba de rendimiento, se baja el valor del fread a 50, ya que no necesita leer mas
        //$gcsv = @fread($d, 30000);
		
		$xmlData = fread($d, 500);
        fclose($d);
				}
				$geta=explode(",",$xmlData);
				print_r($geta);
				$cit=$geta[5];
				if(eregi("Spain",$cit)){
				$cit=$geta[4];
				}
				$cit=trim($cit);

				echo($cit);
				echo($id);
				echo("<br>");
				mysql_query("UPDATE `markers` SET `city` = '".$cit."' WHERE `markers`.`id` ='".$id."' LIMIT 1 ;");
				
				
}
?>