<?php
session_start();
$db_host="localhost"; //the host name of the sql server (if you do not know, leave as localhost. usually works)
$db_name="quecome_quecomes";  //the name of the database
$db_user="quecome_ezopin";  //the username that is associated with the database
$db_pass="ena10llo"; //the password for the username
$location["Latitude"]=$_GET['lat'];
$location["Longitude"]=$_GET['lon'];
$filter=$_GET['filter'];
if($_GET['flat']){
$fla=str_replace("(","",$_GET['flat']);
$fla=str_replace(")","",$fla);
$fla=explode(", ",$fla);
$location["Latitude"]=$fla[0];
$location["Longitude"]=$fla[1];
}
//Filtros
if($filter=="vpos"){
$otherwhere="AND `votos_count` > '1'";	
}
if($filter=="telf"){
$otherwhere="AND `phone` NOT LIKE ''";	
}
if($filter=="foto"){
$otherwhere="AND `image` NOT LIKE ''";	
}
//
if($location["Latitude"]=="1"){
$location["Latitude"]="40.4670445";
$location["Longitude"]="-3.6928294";
}
function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 

// Opens a connection to a MySQL server
$connection=mysql_connect ($db_host, $db_user, $db_pass);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($db_name, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
$query = "SELECT *,(acos(sin(radians(lat)) * sin(radians(".$location["Latitude"].")) + 
cos(radians(lat)) * cos(radians(".$location["Latitude"].")) * cos(radians(lng) - radians(".$location["Longitude"]."))) * 6378) as 'AA' FROM `markers` WHERE (acos(sin(radians(lat)) * sin(radians(".$location["Latitude"].")) + cos(radians(lat)) * cos(radians(".$location["Latitude"].")) * cos(radians(lng) - radians(".$location["Longitude"]."))) * 6378) ".$otherwhere." < '3000' ORDER BY `AA` ASC LIMIT 0,75;";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'name="' . parseToXML($row['name']) . '" ';
  echo 'address="' . parseToXML($row['address']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'type="' . $row['type'] . '" ';
  echo 'img="' . $row['image'] . '" ';
  echo 'lnk="' . $row['titulo_f'] . '" ';
  echo '/>';
}
//Ahora añadir el Punto donde estas
  echo '<marker ';
  echo 'name="Este el el punto aproximado donde te encuentras." ';
  echo 'address="Aleja el mapa para ver restaurantes cercanos." ';
  echo 'lat="40.4670445" ';
  echo 'lng="-3.6928294" ';
  echo 'type="7" ';
  echo 'img="random.jpg" ';
  echo 'lnk="' . $row['titulo_f'] . '" ';
  echo '/>';
// End XML file
echo '</markers>';


?>