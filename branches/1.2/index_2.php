<? 
session_start();
if(isset($_SESSION['createcookie'])){
setcookie("quecomes",$_SESSION['unique'],time() + 31536000);				   
}
include("config.php");
include("geo_km.php");
$haycookie=$_COOKIE["quecomes"];
if(isset($haycookie) && !$_SESSION['username'] ){
$userc=mysql_query("SELECT * FROM `usuarios` WHERE `unique` = '$haycookie' LIMIT 1");	
$muserc=mysql_fetch_array($userc);
$username=$muserc['username'];
$_SESSION['username']=$username;
	
}
$username=$_SESSION['username'];
if($username){
$verdirecc=mysql_query("SELECT * FROM `usuarios` WHERE username = '$username' LIMIT 1");
$mira=mysql_fetch_array($verdirecc);
$sitio=$mira['direccion'];
	if($sitio){
			include("getcoord.php");
			$GoogleMapsApiKey = 'ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBTIu1KiFe28F4Nw1cnpSoAJjSwXMBR-1y-kGIMTRpZ6_A71qPiaPPz16g';
				$ga = new googleRequest(' ', $sitio, ' ', ' ');
				//$ga->country="ES";
				$ga->setGoogleKey($GoogleMapsApiKey);
				$ga->GetRequest();
				$new_lat=$ga->getVar('latitude'); 
				$new_long=$ga->getVar('longitude'); 
				$location['City']=$ga->getVar('city'); 
				$location["CountryCode"]="ES";
				$location["Longitude"]=$new_long;
				$location["Latitude"]=$new_lat;
					if($new_lat==''){
					include("logerror.php");	
					}else{
					$haydirec=true;
					}
	}
}
if(!$haydirec){
//include('locate_ip.php');
include('locate_ip_cache.php');
$location_data = get_ip_location($ip);
$location['City']=$location_data['City'];
$location["CountryCode"]=$location_data["CountryCode"];
$location["Longitude"]=$location_data["Longitude"];
$location["Latitude"]=$location_data["Latitude"];
}
$_SESSION['Longitude']=$location["Longitude"];
$_SESSION['Latitude']=$location["Latitude"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="verify-v1" content="mnXJpe9JPA8BUHyF9gJ35jglv/0lAulfzbvjIjl68t0=" />
<title><? echo($titulo_web); ?></title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 00px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #c2d0da;
	height:100%;
}
-->
</style>
<link href="css/general.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
#apDiv1 {
	position:absolute;
	left:55px;
	top:0px;
	width:255px;
	height:37px;
	z-index:1;
}
-->
#testdiv { margin:0 auto; border:1px solid #ccc; padding:0px 0px; }

#tinybox {position:absolute; display:none; padding:10px; background:#fff url(images/preload.gif) no-repeat 50% 50%; border:10px solid #e3e3e3; z-index:2000}
#tinymask {position:absolute; display:none; top:0; left:0; height:100%; width:100%; background:#000; z-index:1500}
#tinycontent {background:#fff}

.button {font:14px Georgia,Verdana; margin-bottom:10px; padding:8px 10px 9px; border:1px solid #ccc; background:#eee; cursor:pointer}
.button:hover {border:1px solid #bbb; background:#e3e3e3}
#apDiv4 {
	position:relative;
	left:29px;
	top:556px;
	width:222px;
	height:22px;
	z-index:3;
}
#apDiv5 {
	position:relative;
	width:428px;
	height:43px;
	visibility:hidden;
	
}
.suggClass{
	background-color:#FF9;
	cursor:pointer;
	font-weight:bold;
}
.suggClass2{
	background-color:#FFFFFF;
	cursor:default;
	font-weight:normal;
}
</style>
<script language="javascript" src="codigo2.js"></script>
<script type="text/javascript" src="tinybox.js"></script>
<script language="javascript" type="text/javascript">

function Oculta() {
document.getElementById("testdiv").style.visibility = "hidden";

}
function Muestra() {
document.getElementById("testdiv").style.visibility = "visible";
document.getElementById("cargando").style.visibility = "hidden";

}
function busca(e) {
	buscaa = document.getElementById("busca").value;
	
	llamarasincrono2('sugg.php?q=' +  buscaa , 'apDiv5');
document.getElementById("apDiv5").style.visibility = "visible";
tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13){
document.location.href='buscando.php?p='+buscaa;
  }
}

function cierracontactar(){


}
</script>

</head>

<body onload="Muestra()">

<div id="cargando" style="position:fixed; top:0px; left:0px; width:110px; height:25px; padding-top:2px;" class="boxboxlighte"><a class="textores2">&nbsp;cargando...</a></div>
<div id="testdiv" style=" visibility:hidden;">

<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" style="padding-top:18px;">
<tr>
<td></td>
<td colspan="2"></td>
<td></td>
</tr>
  <tr>
    <td align="center" width="0%">&nbsp;</td>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><div id="principal" style=" position:relative;height:550px; width:960px;border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3;border-top-style:solid;border-top-width:1px; border-top-color:#E3ECF3;" align="center">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom-width:2px; border-bottom-style:solid;border-bottom-color:#E3ECF3;">
        <tr>
          <td width="50%" bgcolor="#CC3333" >&nbsp;</td>
          <td width="50%" bgcolor="#CC3333" class="minindex2"><div align="right" style="padding-right:2px;"><? if($username) { ?><a>bienvenido <? echo($username); ?> (<a href="logout.php" style="cursor:pointer; text-decoration:none; color:#FFF;">cerrar sesion</a>)</a> <? }else{ ?><a id="testclick1" style="cursor:pointer;">iniciar sesion</a> - <a id="testclick2" style="cursor:pointer;">crear cuenta</a><? } ?></div></td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%" height="0" valign="top"><? include("gmaps.php"); ?>
<div class="textologo" id="apDiv1" style="top:21px; filter:alpha(opacity=85); -moz-opacity:0.85; cursor:pointer; border-top-width:1px; border-top-style:solid; border-top-color:#E3ECF3; border-bottom-width:1px; border-bottom-style:solid; border-bottom-color:#E3ECF3; border-left-style:solid; border-left-width:1px; border-left-color:#E3ECF3; border-right-style:solid; border-right-width:1px; border-right-color:#E3ECF3;" onclick="location.href='index.php'"><img src="images/logo_qcms.png" width="255" height="37" alt="logo" /></div>
<div class="textologo" id="apDiv2" style="position:absolute; width:20px; height:20px; top:21px; left:390px; filter:alpha(opacity=75); -moz-opacity:0.99; 9; cursor:pointer; vertical-align:middle; text-align:center;" onclick="location.href='buscando.php?lo=<? echo($location["Longitude"]); ?>&la=<? echo($location["Latitude"]); ?>&city=<? echo($location["City"]); ?>'"><img src="images/normal/001_08.png" height="24px" width="24px" title="Buscar cerca de mi" alt="Buscar cerca de mi" /></div>


      </td>
          <td width="50%" align="left" valign="top"><div id="conts" style="position:relative;"><? include("content_register.php"); ?></div></td>
        </tr>
                <tr>
          <td height="0">&nbsp;</td>
          <td height="0">&nbsp;</td>
            </tr>
          
        <tr>
          <td height="0" colspan="2"><div id="master">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%" valign="top"><? include("val_portada.php"); ?></td>
          <td width="50%" valign="top"><? include("random_local.php"); ?></td>
        </tr>
        <tr>
        <td colspan="2" ></td>
        </tr>
                <tr>
                
          <td colspan="2"></td>
        </tr>

      </table>
    </div></td>
          </tr>
      </table>
      <?
	  $error=$_GET['item'];
	  if($error=='generic'){
		include("errorbox.php");  
	  }
	  ?>      
    </div></td>
    <td align="center" width="0%">&nbsp;</td>
  </tr>
  <tr>
<td width="0%"></td>
<td colspan="2"></td>
<td width="0%"></td>
  </tr>
  <tr>
<td width="0%"></td>
<td width="91%" valign="top" class="nowp1" ><?
echo($foot);
echo($prefoot);
echo($location['City']." "); 
echo("(".$location["CountryCode"].")");

?></td>
<td width="9%" align="right" class="nowp1" ><img src="gogus.PNG" width="82" height="26" alt="gogus" /></td>
<td width="0%"></td>
  </tr>
</table>
</div>
<script type="text/javascript">
	T$('testclick1').onclick = function(){TINY.box.show('login.php',1,400,200,1,90)}
	T$('testclick2').onclick = function(){TINY.box.show('reg_form.php',1,600,500,1,600)}
	T$('registrar2').onclick = function(){TINY.box.show('reg_form.php',1,600,500,1,600)}
	</script>
<?
$result=$_GET['item'];
if($result=='Ok.'){
	print_r("<script>TINY.box.show('login.php?c=r',1,400,250,1,15)</script>");
}

if($result=='passerror'){
	print_r("<script>TINY.box.show('mensa_box.php?c=<br>No se ha podido iniciar su sesion<br>compruebe los datos y vuelva a intentarlo',1,450,90,1,7)</script>");

}

if($result=='acterror'){
	print_r("<script>TINY.box.show('mensa_box.php?c=<br>No se ha podido iniciar su sesion<br>Su cuenta esta inactiva',1,450,90,1,7)</script>");
}
if($result=='f'){
	print_r("<script>TINY.box.show('login.php?c=f',1,400,250,1,15)</script>");
}
?>

<script type="text/javascript">
	var lefto = document.getElementById('busca').offsetLeft; 
	var topo = document.getElementById('busca').offsetTop;
	
	document.getElementById('apDiv5').style.top = topo + 27 + "px";
	document.getElementById('apDiv5').style.left = -3 + "px";
	</script>



</body>
</html>