<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Que Comes?!</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 00px;
	margin-right: 0px;
	margin-bottom: 0px;
	height:100%;
}
-->
</style>
<link href="css/general.css" rel="stylesheet" type="text/css">

<script>  

  if (navigator.geolocation) {  
     /* geolocation is available */  
	 navigator.geolocation.getCurrentPosition(function(position) {
	  document.cookie='qcms_lat='+position.coords.latitude;
		document.cookie='qcms_lon='+position.coords.longitude;
		document.cookie='qcms_geo=si';
		document.location.href='index.php';
});

   } else {  
   document.cookie='qcms_geo=no';
       document.location.href='index.php';
	   
    }  
function PasoDelAviso(){
document.cookie='qcms_geo=no';
document.location.href='index.php';

}
setTimeout("PasoDelAviso()",5000);   
 
</script>
<style type="text/css">
<!--
.style1 {
	font-size: 24px
}
-->
</style>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td width="45%"><a class="invitado_home2">Acepta el aviso que ves aqui, para que QueComes!? sepa que sitios ofrecerte.</a>
</td>
    <td width="55%" rowspan="3">&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="estilo2v3link">Para mas informacion haz click <a href="http://www.mozilla.com/es/firefox/geolocation" target="_blank" class="estilo2v3link"><u>aqui</u></a></span></td>
  </tr>
</table>
</body>
</html>
