<?
$lat=$_GET['lat'];
$lon=$_GET['lon'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Como Llegar</title>
<link href="css/general.css" rel="stylesheet" type="text/css">
    <script src="http://maps.google.com/maps?file=api&v=2.x&key=ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBS3CkSPi3aKTtiOuwmOy6_GhXJFGxSPc3miXfruwYGlbR74XB975r5dgA"
            type="text/javascript"></script>
<script type="text/javascript" language="javascript"><!--
    var map = null;
    var gdir = null;
    var geocoder = null;
    var addressMarker;
    function load() {
      if (GBrowserIsCompatible()) {      
        map = new GMap2(document.getElementById("google_map"));
        map.setMapType(G_NORMAL_MAP);
        // Centramos el mapa en las coordenadas con zoom 15
        map.setCenter(new GLatLng(<? echo($lat); ?>, <? echo($lon); ?>), 15);
        // Creamos el punto.
        var point = new GLatLng(<? echo($lat); ?>, <? echo($lon); ?>);
        // Pintamos el punto
        map.addOverlay(new GMarker(point));
        // Controles que se van a ver en el mapa
        map.addControl(new GLargeMapControl());
        var mapControl = new GMapTypeControl();
        map.addControl(mapControl);
        // Asociamos el div 'direcciones' a las direcciones que devolveremos a Google
        gdir = new GDirections(map, document.getElementById("direcciones"));
        // Para recoger los errores si los hubiera
        GEvent.addListener(gdir, "error", handleErrors);
      }
    }
    // Esta función calcula la ruta con el API de Google Maps
    function setDirections(Address) {
      gdir.load("from: " + Address + " to: @ <? echo($lat); ?>, <? echo($lon); ?>",
                { "locale": "es" });
      //Con la opción locale:es hace que la ruta la escriba en castellano.
    }
    // Se han producido errores
    function handleErrors(){
       if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS)
         alert("Direccion desconocida");
       else if (gdir.getStatus().code == G_GEO_SERVER_ERROR)
         alert("Error de Servidor");
       else if (gdir.getStatus().code == G_GEO_MISSING_QUERY)
         alert("Falta la direccion inicial");
       else if (gdir.getStatus().code == G_GEO_BAD_KEY)
         alert("Clave de Google Maps incorrecta");
       else if (gdir.getStatus().code == G_GEO_BAD_REQUEST)
         alert("No se ha encontrado la direccion de llegada");
       else alert("Error desconocido");
    }
    function onGDirectionsLoad(){ 
    }
// --></script>

</head>

<body onload="load()" onunload="GUnload()" >
<span class="textofootres4">¿Desde donde?</span>
<form action="#" onsubmit="setDirections(this.from.value); return false">
  
<input name="from" type="text" class="boxboxlighte" id="fromAddress" value="" size="43"/>
            <input type="submit" value="Calcula la ruta">
</form><br />

    <div id="google_map" style="width: 600px; height: 400px;"></div>
       
        <div id="direcciones" style="width: 500px;"></div>
</body>
</html>