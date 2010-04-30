<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps AJAX + mySQL/PHP Example</title>
    <script src="http://maps.google.com/maps/api/js?sensor=false"
            type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[
    //1 bar 2 restaurante
    var customIcons = {
      2: {
        icon: 'http://quecom.es/desarrollo/n2m/markers_icon/restaurantgourmet.png',
        shadow: 'http://quecom.es/desarrollo/n2m/markers_icon/shadow.png'
      },
      1: {
        icon: 'http://quecom.es/desarrollo/n2m/markers_icon/restaurantgourmet.png',
        shadow: 'http://quecom.es/desarrollo/n2m/markers_icon/shadow.png'
      },
	  7: {
        icon: 'http://quecom.es/desarrollo/n2m/markers_icon/home.png',
        shadow: 'http://quecom.es/desarrollo/n2m/markers_icon/shadow.png'
      }
    };

    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(40.4670445, -3.6928294),
        zoom: 13,
        mapTypeId: 'roadmap',
		mapTypeControl: false,
		mapTypeControlOptions: {
		mapTypeIds: ['coordinate', google.maps.MapTypeId.ROADMAP],
        }
		  });
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
      downloadUrl("phpmysql.php", function(data) {
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
		  var html = "<table border='0' cellspacing='2' cellpadding='2'><tr><td><img height='50' width='50' src='../resize_image.php?image=" + image + "&amp;new_width=50&amp;new_height=50'></td><td valign='middle'><a class='textofootres3' href='sitio/" + lnk + "'><u>" + name + "</u></a><br /> <a class='textofootres2'><strong>" + address + "</strong></a></td>  </tr></table>";
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon,
            shadow: icon.shadow
          });
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

    function parseXml(str) {
      if (window.ActiveXObject) {
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
      } else if (window.DOMParser) {
        return (new DOMParser).parseFromString(str, 'text/xml');
      }
    }

    function doNothing() {}

    //]]>
  </script>
  </head>

  <body onload="load()">
    <div id="map" style="width: 850px; height: 300px"></div>
  </body>
</html>