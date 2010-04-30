<?
$location["Latitude"];
$location["Longitude"];
?>
    <script src="http://maps.google.com/maps/api/js?sensor=false"
            type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[
			   
	var markersArray = [];
    //1 bar 2 restaurante
	
    var customIcons = {
	6: { //Comida para llevar
        icon: 'http://quecom.es/desarrollo/n2m/markers_icon/takeaway.png',
        shadow: 'http://quecom.es/desarrollo/n2m/markers_icon/shadow.png'
      },
	5: { //Restaurante Tematico
        icon: 'http://quecom.es/desarrollo/n2m/markers_icon/restaurantmexican.png',
        shadow: 'http://quecom.es/desarrollo/n2m/markers_icon/shadow.png'
      },
	4: { //Buffet
        icon: 'http://quecom.es/desarrollo/n2m/markers_icon/restaurant-buffet.png',
        shadow: 'http://quecom.es/desarrollo/n2m/markers_icon/shadow.png'
      },
	3: { //Comida rapida
        icon: 'http://quecom.es/desarrollo/n2m/markers_icon/fastfood.png',
        shadow: 'http://quecom.es/desarrollo/n2m/markers_icon/shadow.png'
      },
      2: {
        //icon: 'http://quecom.es/desarrollo/n2m/markers_icon/restaurantgourmet.png',
		icon: 'http://quecom.es/desarrollo/n2m/markers_icon/restaurant.png',
        shadow: 'http://quecom.es/desarrollo/n2m/markers_icon/shadow.png'
      },
      1: {
        icon: 'http://quecom.es/desarrollo/n2m/markers_icon/bar.png',
        shadow: 'http://quecom.es/desarrollo/n2m/markers_icon/shadow.png'
      },
	  7: {
        icon: 'http://quecom.es/desarrollo/n2m/markers_icon/home.png',
        shadow: 'http://quecom.es/desarrollo/n2m/markers_icon/shadow.png'
      }
    };

    function loadmap() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(<? echo($location["Latitude"]); ?>,<? echo($location["Longitude"]); ?>),
		//center: new google.maps.LatLng(40.4670445, -3.6928294),
        zoom: 15,
        mapTypeId: 'roadmap',
		mapTypeControl: false,
		mapTypeControlOptions: {
		mapTypeIds: ['coordinate', google.maps.MapTypeId.ROADMAP],
        }
		  });
      var infoWindow = new google.maps.InfoWindow;
	  //Listeners (espera un evento del mapa), para agregar mas marcadores al mapa.
	  var newCenter;
	  google.maps.event.addListener(map, 'dragend', function(event) {
      newCenter=map.getCenter();
	  //alert(newCenter);
	  getn2mmarkers(map,newCenter);
      });
	  		//NOTA: Revisar rendimiento, puede llegar a cargar demasiados marcadores.****
			// Quizá, descargar los marcadores no visibles
	  google.maps.event.addListener(map, 'zoom_changed', function(event) {
      newCenter=map.getCenter();
	  //alert(newCenter);
	  getn2mmarkers(map,newCenter);
      });
	  		//NOTA: habria que hacer que el zoom ampliara el rango de busqueda.****
	  //Fin listeners
	  var jslan='<? echo($location["Latitude"]); ?>';
	  var jslon='<? echo($location["Longitude"]); ?>';
      // Change this depending on the name of your PHP file
      downloadUrl("n2m/n2m.php?lat=" + jslan + "&lon=" + jslon , function(data) {
        var xml = parseXml(data);
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
		  var image = markers[i].getAttribute("img");
		  var lnk = markers[i].getAttribute("lnk");
          var address = markers[i].getAttribute("address");
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          //var html = "<b>" + name + "</b> <br/>" + address;
		  				  if (image==""){
				  image="random.jpg";  
				  }
		  var html = "<table border='0' cellspacing='2' cellpadding='2'><tr><td><img height='50' width='50' src='../resize_image.php?image=" + image + "&amp;new_width=50&amp;new_height=50'></td><td valign='middle'><a class='textofootres3' href='sitio/" + lnk + "'><u>" + name + "</u></a><br /> <a class='textofootres2'><strong>" + address + "</strong></a></td>  </tr></table>";
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon,
            shadow: icon.shadow
          });
		  				  //Prueba Borrar markers
				 
				  markersArray.push(marker);
				  //
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request.responseText, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }
	
	//Borra los markers necesita que se guarden los markers en un array asi: markersArray.push(marker); cuando se crean
	function clearOverlays() {
	  if (markersArray) {
		for (i in markersArray) {
		  markersArray[i].setMap(null);
		}
			//La siguiente linea es la diferencia entre "Ocultar" y "eliminar"	
		markersArray.length = 0;
	  }
	}
	//
	
	function getn2mmarkers(mapa,jcoord){
		
			//Prueba para borrar los markers
			clearOverlays();
			
			//
			// Removes the overlays from the map, but keeps them in the array
			//If checks are checked
			
			//
			  // Change this depending on the name of your PHP file
			  var infoWindow = new google.maps.InfoWindow;
			  downloadUrl("n2m/n2m.php?flat=" + jcoord , function(data) {
				var xml = parseXml(data);
				var markers = xml.documentElement.getElementsByTagName("marker");
				for (var i = 0; i < markers.length; i++) {
				  var name = markers[i].getAttribute("name");
				  var image = markers[i].getAttribute("img");
				  var lnk = markers[i].getAttribute("lnk");
				  var address = markers[i].getAttribute("address");
				  var type = markers[i].getAttribute("type");
				  var point = new google.maps.LatLng(
					  parseFloat(markers[i].getAttribute("lat")),
					  parseFloat(markers[i].getAttribute("lng")));
				  //var html = "<b>" + name + "</b> <br/>" + address;
				  if (image==""){
				  image="random.jpg";  
				  }
				  var html = "<table border='0' cellspacing='2' cellpadding='2'><tr><td><img height='50' width='50' src='../resize_image.php?image=" + image + "&amp;new_width=50&amp;new_height=50'></td><td valign='middle'><a class='textofootres3' href='sitio/" + lnk + "'><u>" + name + "</u></a><br /> <a class='textofootres2'><strong>" + address + "</strong></a></td>  </tr></table>";
				  var icon = customIcons[type] || {};
				  var marker = new google.maps.Marker({
					map: mapa,
					position: point,
					icon: icon.icon,
					shadow: icon.shadow
				  });
				  //Prueba Borrar markers
				  
				  markersArray.push(marker);
				  //
				  bindInfoWindow(marker, mapa, infoWindow, html);
				}
			  });			
	}
    function parseXml(str) {
      if (window.ActiveXObject) {
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
      } else if (window.DOMParser) {
        return (new DOMParser).parseFromString(str, 'text/xml');
      }
    }

	//prueba de filtros
	function filterMarkers(mapa,jcoord,tipofiltro){
		
			//Prueba para borrar los markers
			clearOverlays();
			
			//
			// Removes the overlays from the map, but keeps them in the array
			//
			var jcoord=google.maps.Map(document.getElementById("map")).getCenter();
			var mapa = new google.maps.Map(document.getElementById("map"));
			
			  // Change this depending on the name of your PHP file
			  var infoWindow = new google.maps.InfoWindow;
			  downloadUrl("n2m/n2m.php?flat=" + jcoord + "&filter=" + tipofiltro , function(data) {
				var xml = parseXml(data);
				var markers = xml.documentElement.getElementsByTagName("marker");
				for (var i = 0; i < markers.length; i++) {
				  var name = markers[i].getAttribute("name");
				  var image = markers[i].getAttribute("img");
				  var lnk = markers[i].getAttribute("lnk");
				  var address = markers[i].getAttribute("address");
				  var type = markers[i].getAttribute("type");
				  var point = new google.maps.LatLng(
					  parseFloat(markers[i].getAttribute("lat")),
					  parseFloat(markers[i].getAttribute("lng")));
				  //var html = "<b>" + name + "</b> <br/>" + address;
				  if (image==""){
				  image="random.jpg";  
				  }
				  var html = "<table border='0' cellspacing='2' cellpadding='2'><tr><td><img height='50' width='50' src='../resize_image.php?image=" + image + "&amp;new_width=50&amp;new_height=50'></td><td valign='middle'><a class='textofootres3' href='sitio/" + lnk + "'><u>" + name + "</u></a><br /> <a class='textofootres2'><strong>" + address + "</strong></a></td>  </tr></table>";
				  var icon = customIcons[type] || {};
				  var marker = new google.maps.Marker({
					map: mapa,
					position: point,
					icon: icon.icon,
					shadow: icon.shadow
				  });
				  //Prueba Borrar markers
				  
				  markersArray.push(marker);
				  //
				  bindInfoWindow(marker, mapa, infoWindow, html);
				}
			  });			
	}	
	//
    function doNothing() {}

    //]]>
  </script>

    
    <div id="map" style="width: 850px; height: 300px">buscando sitios cercanos a ti...</div>
