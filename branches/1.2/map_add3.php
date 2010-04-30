
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <?

$GoogleMapsApiKey = 'ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBTIu1KiFe28F4Nw1cnpSoAJjSwXMBR-1y-kGIMTRpZ6_A71qPiaPPz16g';

//$q = str_replace(' ', '_', $_POST['sitio']);
$q=rawurlencode($_POST['sitio']);
//$q = $_POST['sitio'];
	  $remoteurl = "http://maps.google.com/maps/geo?q=$q&oe=utf8&output=csv&sensor=false&gl=es&key=".$GoogleMapsApiKey; //Url you want to retrive
$chtime = "2"; //hours
$timeout = "10"; //secconds
$localfile = preg_replace("/[^A-Za-z0-9_\.]/", "_", $remoteurl);
$localfile="cache/".$localfile;

if (file_exists($localfile)){
           
                $localfile_stat = stat($localfile);
                if ($localfile_stat['mtime'] < strtotime("-$chtime hours")){
               
            $chresponse = @curl_init($remoteurl);
            $ret = @curl_setopt($chresponse, CURLOPT_HEADER, 1);
            $ret = @curl_setopt($chresponse, CURLOPT_FOLLOWLOCATION, 1);
            $ret = @curl_setopt($chresponse, CURLOPT_TIMEOUT,        $timeout);
            $ret = @curl_setopt($chresponse, CURLOPT_RETURNTRANSFER, 1);
            $ret = @curl_exec($chresponse);

            if (empty($ret)) {
                    die(@curl_error($chresponse));
                    @curl_close($chresponse);
            } else {
                $info = @curl_getinfo($chresponse);
                @curl_close($chresponse);
                if ($info['http_code'] == "200") {
                   
                            $ch = @curl_init($remoteurl);
                    $fp = fopen($localfile, "w");

                    @curl_setopt($ch, CURLOPT_FILE, $fp);
                    @curl_setopt($ch, CURLOPT_HEADER, 0);
                    @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    @curl_exec($ch);
                    @curl_close($ch);
                    fclose($fp);            
                    }else{
                        touch($localfile);
                    }
            }
        }
}else{
    $ch = @curl_init($remoteurl);
    $fp = fopen($localfile, "w");
    @curl_setopt($ch, CURLOPT_FILE, $fp);
    @curl_setopt($ch, CURLOPT_HEADER, 0);
    @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    @curl_exec($ch);
    @curl_close($ch);
    fclose($fp);    
}
	  
if ($d = fopen($localfile, "r")) {
        $gcsv = @fread($d, 50);
        @fclose($d);
        //echo "<br />CSV:".$gcsv;
        $tmp = explode(",", $gcsv);
        //print_r($tmp);
        $code     = $tmp[0];
        $Accuracy  = $tmp[1];
        $glatitude  = $tmp[2];
        $glongitude = $tmp[3];

		
      } else {
        $error = "NO_CONNECTION" ;
      }

?>
    <title>Google Maps JavaScript API Example: Simple Map</title>
    
    <script src="http://maps.google.com/maps?file=api&v=2.x&oe=utf8&key=ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBS3CkSPi3aKTtiOuwmOy6_GhXJFGxSPc3miXfruwYGlbR74XB975r5dgA"
            type="text/javascript"></script>
    <script type="text/javascript">
var map;
var geocoder;
var address;

function initialize() {
  map = new GMap2(document.getElementById("map_canvas"));
  map.setCenter(new GLatLng(<? echo($glatitude." , ".$glongitude); ?>), 16);
  map.addControl(new GLargeMapControl);
  newCenter=map.getCenter();

  //getAddress(map,new GLatLng(<? echo($glatitude." , ".$glongitude); ?>));
  geocoder = new GClientGeocoder();
  GEvent.addListener(map, "click", getAddress);
  //geocoder = new GClientGeocoder();
  getAddress(map,new GLatLng(<? echo($glatitude." , ".$glongitude); ?>));
}

function getAddress(overlay, latlng) {
  if (latlng != null) {
    address = latlng;
    geocoder.getLocations(latlng, showAddress);
  }
}

function showAddress(response) {
  map.clearOverlays();
  if (!response || response.Status.code != 200) {
    alert("Error:" + response.Status.code);
  } else {
    place = response.Placemark[0];
    point = new GLatLng(place.Point.coordinates[1],
                        place.Point.coordinates[0]);
	
    marker = new GMarker(point);
    map.addOverlay(marker);
	var html = "<table>" +
                         "<tr><td><a class='estilo2v3black'>Nombre:</a></td> <td><input type='text' id='name' class='boxboxlighte' size='45' /> </td> </tr>" +
                         "<tr><td><a class='estilo2v3black'>Direccion:</a></td> <td><input class='boxboxlighte' type='text' id='address' size='45' value='" +place.address+"'/></td> </tr>" +
						 "<tr><td><a class='estilo2v3black'>Localidad:</a></td> <td><input class='boxboxlighte' type='text' id='citz' size='45' value='" +place.AddressDetails.Country.AdministrativeArea.SubAdministrativeArea.Locality.LocalityName+"'/></td> </tr>" +
                         "<tr><td align='left'><a class='estilo2v3black'>Tipo:</a></td> <td><select id='type' class='boxboxlighte'>" +
						 <? $vertipos=mysql_query("SELECT * FROM tipos_locales WHERE activo = 'yes';");
						 while ($tiposv=mysql_fetch_array($vertipos)){
						 $nombre_t=$tiposv['nombre'];
						 $id_t=$tiposv['id'];
						 if($id_t=='2'){
						  print('"<option value='.$id_t.' SELECTED>'.$nombre_t.'</option>" +');	 
						 }else{
						  print('"<option value='.$id_t.'>'.$nombre_t.'</option>" +');
						 }
						 
						 
						 }
						 ?>
                         "</select> </td></tr>" +
						 "<tr><td align='left'><a class='estilo2v3black'>Cocina:</a></td> <td><select id='coc' class='boxboxlighte'>" +
						 <? $vertipos=mysql_query("SELECT * FROM tipos_cocina WHERE activo = 'yes';");
						 while ($tiposv=mysql_fetch_array($vertipos)){
						 $nombre_t=$tiposv['nombre'];
						 $id_t=$tiposv['id'];
						 if($id_t=='7'){
						  print('"<option value='.$id_t.' SELECTED>'.$nombre_t.'</option>" +');	 
						 }else{
						  print('"<option value='.$id_t.'>'.$nombre_t.'</option>" +');
						 }
						 
						 
						 }
						 ?>
                         "</select> </td></tr>" +
                         "<tr><td></td><td><input type='button' value='Guardar' onclick='saveData()'/></td></tr>";
    marker.openInfoWindowHtml(html)
  }
}




    function saveData() {
      var name = escape(document.getElementById("name").value);
      var address = escape(document.getElementById("address").value);
      var type = document.getElementById("type").value;
	  var citz = document.getElementById("citz").value;
	  var coc = document.getElementById("coc").value;
      var latlng = marker.getLatLng();
      var lat = latlng.lat();
      var lng = latlng.lng();
  
	  llamarasincrono2("pre_guardar.php?name=" + name + "&address=" + address + 
                "&type=" + type + "&lat=" + lat + "&lng=" + lng + "&citz=" + citz + "&coc=" + coc,'contenido2');
    }
    </script>

  </head>

  <body onload="initialize()" onunload="GUnload()">
<table width="100%" border="0">
  <tr>
    <td align="center"><a class="textofootres4" >Marca el lugar concreto, y haz click en el globo:</a></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">  <div align="center" style="width:100%">
    <div id="map_canvas" style="width: 720px; height: 350px"></div>
    <div id="message"></div>
  </div></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><div id="contenido2"></div></td>
  </tr>
</table>
<br />

  

</body>

</html>
