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
$uname=$mira['name'];

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
<link href="css/general.css" rel="stylesheet" type="text/css">
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
	position:absolute;
	visibility:hidden;
	
}
.suggClass{
	background-color:#FF9;
	cursor:pointer;
	font-weight:bold;
}
.suggClass2{
	background-color:#EEEEEE;
	cursor:default;
	font-weight:normal;
}
.roudlite_fon {

	background-color: #FFFFFF;
	border: 1px solid #c2d0da;
	 border-radius: 3px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	
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
	
	llamarasincrono2('sugg_new.php?q=' +  buscaa , 'apDiv5');
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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="" bgcolor="#CC3333" style="">&nbsp;</td>
    <td bgcolor="#CC3333" width="480" ><img src="images/logo_qcms.png" onclick="document.location.href='index.php'" style="cursor:pointer;" width="255" height="36" alt="logo" /></span></td>
    <td width="480" height="50" bgcolor="#CC3333" ><div align="right"> </a> </div></td>
    <td width="" bgcolor="#CC3333" style="">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#E5E5E5" style="">&nbsp;</td>
        <td align="left" bgcolor="#E5E5E5" class="nowp1" style=" border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; "> &nbsp;<? include("quotes.php"); ?></td>
    <td bgcolor="#E5E5E5" align="right" style=" border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; "><? if($username) { ?><a  class="estilo2v3black">¡Hola! <strong><? echo($uname); ?> </strong></a>&nbsp;&nbsp;<a href="/micuenta"  class="estilo2v3black" style="cursor:pointer; text-decoration:underline;">Mi Cuenta</a>&nbsp;&nbsp;<a href="logout.php"  class="estilo2v3black" style="cursor:pointer; text-decoration:underline;">Salir</a><? }else{ ?><a id="testclick1" class="estilo2v3black" style="cursor:pointer;">iniciar sesion</a> - <a id="testclick2"  class="estilo2v3black" style="cursor:pointer;">crear cuenta</a><? } ?></td>

    <td bgcolor="#E5E5E5" style="">&nbsp;</td>
  </tr>
  <tr>
    <td style=""></td>
    <td colspan="2" style=" height:10px; "></td>
    <td style=""></td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" bgcolor="" style=" "><table width="90%" border="0" cellpadding="2">
   
    </table>
    <div class="roudlite_fon">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <td colspan="2" align="center"><div align="center" style="position:relative; z-index:2;" class="roudlite2"><br />
              <div class="textologo" id="apDiv2" style="position:absolute; width:20px; height:20px; top:0px; left:100%;  cursor:pointer; vertical-align:middle; text-align:center;" onclick="location.href='buscando.php?lo=<? echo($location["Longitude"]); ?>&amp;la=<? echo($location["Latitude"]); ?>&amp;city=<? echo($location["City"]); ?>'"><img src="images/normal/001_08.png" height="24px" width="24px" title="Buscar cerca de mi" alt="Buscar cerca de mi" /></div>
<? include("gmaps_new.php"); ?><div style="position:absolute; bottom: 0%; left:175px;" align="center">
  <? include("searcher.php"); ?></div></div>
          
          <div><? include("content_register_new.php"); ?></div>
          &nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><table width="700" border="0" align="center">
            <tr>
                       <td width="30%" valign="top"><? include("ach.php"); ?></td>
          <td width="2%" valign="top">&nbsp;</td>
          <td width="70%" valign="top"><? include("val_portada_new.php"); ?></td>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td valign="top">&nbsp;</td>
              <td valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td valign="top">&nbsp;</td>
              <td valign="top"><? include("random_local_new.php"); ?></td>
            </tr>
          </table></td>
        </tr>
        <tr>

        </tr>
        <tr>
          <td colspan="2" valign="top">&nbsp;</td>
          </tr>
      </table></div></td>
    <td style="">&nbsp;</td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" style=""><table width="100%" border="0">
<td width="91%" valign="top" class="nowp1" ><?
echo($foot);
echo($prefoot);
echo($location['City']." "); 
echo("(".$location["CountryCode"].")");

?></td>
<td width="9%" align="right" class="nowp1" ><img src="gogus.PNG" width="82" height="26" alt="gogus" /></td>
</table>
&nbsp;</td>
    <td style="">&nbsp;</td>
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
	var wt = document.getElementById('busca').offsetWidth
	
	document.getElementById('apDiv5').style.top = topo + 27 + "px";
	document.getElementById('apDiv5').style.left =lefto + "px";
	document.getElementById('apDiv5').style.Width =wt + 4 + "px";
	</script>


</body>
</html>