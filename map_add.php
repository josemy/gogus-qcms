<? include("db.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API Example: Simple Map</title>
    <script src="http://maps.google.com/maps?file=api&v=2.x&key=ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBS3CkSPi3aKTtiOuwmOy6_GhXJFGxSPc3miXfruwYGlbR74XB975r5dgA"
            type="text/javascript"></script>
    <script type="text/javascript">

    var marker;

    function initialize() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map_canvas"));
        map.setCenter(new GLatLng(40.432314, -3.703766), 13);
	    map.addControl(new GSmallMapControl());
		map.enableContinuousZoom();
	


        GEvent.addListener(map, "click", function(overlay, latlng) {
          if (latlng) {
            marker = new GMarker(latlng, {draggable:true});
            GEvent.addListener(marker, "click", function() {
              var html = "<table>" +
                         "<tr><td>Nombre:</td> <td><input type='text' id='name'/> </td> </tr>" +
                         "<tr><td>Direccion:</td> <td><input type='text' id='address'/></td> </tr>" +
                         "<tr><td>Tipo:</td> <td><select id='type'>" +
						 <? $vertipos=mysql_query("SELECT * FROM tipos_locales WHERE activo = 'yes';");
						 while ($tiposv=mysql_fetch_array($vertipos)){
						 $nombre_t=$tiposv['nombre'];
						 $id_t=$tiposv['id'];
						 print('"<option value='.$id_t.' SELECTED>'.$nombre_t.'</option>" +');
						 }
						 ?>
                         "</select> </td></tr>" +
                         "<tr><td></td><td><input type='button' value='Guardar' onclick='saveData()'/></td></tr>";

              marker.openInfoWindow(html);
            });
            map.addOverlay(marker);
          }
        });

      }
    }

    function saveData() {
      var name = escape(document.getElementById("name").value);
      var address = escape(document.getElementById("address").value);
      var type = document.getElementById("type").value;
      var latlng = marker.getLatLng();
      var lat = latlng.lat();
      var lng = latlng.lng();


      var url = "guardar.php?name=" + name + "&address=" + address + 
                "&type=" + type + "&lat=" + lat + "&lng=" + lng;
      GDownloadUrl(url, function(data, responseCode) {
        if (responseCode == 200 && data.length <= 1) {
          marker.closeInfoWindow();
          document.getElementById("message").innerHTML = "Añadido!.";
        }
      });
    }
    </script>

  </head>

  <body onload="initialize()" onunload="GUnload()">
    <div id="map_canvas" style="width: 500px; height: 300px"></div>
    <div id="message"></div>
  </body>

</html>
