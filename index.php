<? 
session_start();
//Si hay que crear la cookie de inicio de sesion automatico, creala:
if(isset($_SESSION['createcookie'])){
setcookie("quecomes",$_SESSION['unique'],time() + 31536000);				   
}
//
include("config.php");
include("geo_km.php");
//
$portada=true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="google-site-verification" content="10UyYn8oMwGuRitubasG0_qB8a3hBSq_tSnzCE_I2w0" />

<title><? echo($titulo_web); ?></title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link type="image/x-icon" href="favicon.ico" rel="icon" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 00px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFF;
	height:100%;
}
.new_error {
	font-family: Helvetica, sans-serif;
	color: #FFFFFF;
	background-color: #CC3333;
	border: 1px outset #FFFFFF;
	border-style:solid;
	font-size: 12px;
	font-weight: bold;
}
-->
</style>

<style type="text/css">
.new2 {font-size: 13px; font-family:arial,sans-serif; color: #0066cc;font-weight:bold;text-decoration:none;}
.new3 {font-size: 13px;  font-family:arial,sans-serif; color: #777eb3;text-decoration:none;}
.new4 {color: #090; font-family: arial,sans-serif; font-size: 11px; text-decoration: none; }
.new5 {font-size: 11px;  font-family:arial,sans-serif; color: #333;text-decoration:none;font-weight:bold;}
</style>
<?

//Si no se intentó la GEO, intentarla
if($_COOKIE["qcms_geo"]==""){
printf("<script type='text/javascript'>document.location.href='pre_index.php'</script>");
}
//


//Recoger cookie de inicio de sesion automático
$haycookie=$_COOKIE["quecomes"];
if(isset($haycookie) && !$_SESSION['username'] ){
$userc=mysql_query("SELECT * FROM `usuarios` WHERE `unique` = '$haycookie' LIMIT 1");	
$muserc=mysql_fetch_array($userc);
$username=$muserc['username'];
$_SESSION['username']=$username;
	
}
//
$username=$_SESSION['username'];

//Si hay sesion iniciada, busca sus datos:
if($username){
	$verdirecc=mysql_query("SELECT * FROM `usuarios` WHERE username = '$username' LIMIT 1");
	$mira=mysql_fetch_array($verdirecc);
	$uname=$mira['name'];
	$smstype=$mira['sms_type'];
	$_SESSION['sms_type']=$smstype;
	$sitio=$mira['direccion'];
	
		//Si el usuario tiene direccion establecida, buscala
		if($sitio){
					$location["CountryCode"]="ES";
					include('get_coord_gl.php');
					$ver_city = ver_citt($sitio);
					$city=$ver_city["LocalityNamee"];
					$precoord=$ver_city["coordinates"];
					$tsp = explode(",", $precoord);
					$new_lat=$tsp[1];
					$new_long=$tsp[0];
					if($_GET['mode']=="debug"){
					echo($new_lat."-".$new_long);
					}
					$location['City']=$city;
					$location["Longitude"]=$new_long;
					$location["Latitude"]=$new_lat;
						if($new_lat==''){
							include("logerror.php");	
						}else{
							$haydirec=true;
						}
		}
		//
}
//

//Si el usuario no tiene direccion o si no la encontró por GEO, intentar localizar ip.
if(!$haydirec && $_COOKIE["qcms_geo"]=="no"){
	include('locate_ip_cache.php');
	$location_data = get_ip_location($ip);
	$location['City']=$location_data['City'];
	$location["CountryCode"]=$location_data["CountryCode"];
	$location["Longitude"]=$location_data["Longitude"];
	$location["Latitude"]=$location_data["Latitude"];
}
//

//Si hay direccion por GEO, procesala:
if($_COOKIE["qcms_lat"] && !$haydirec){
	$location["Latitude"]=$_COOKIE["qcms_lat"];
	$location["Longitude"]=$_COOKIE["qcms_lon"];
	include('get_city_gl.php');
	$ver_city = ver_cit($location["Latitude"],$location["Longitude"]);
	$location['City']=$ver_city["LocalityNamee"];
}
//

//Declarar las coordenadas como variables session
$_SESSION['Longitude']=$location["Longitude"];
$_SESSION['Latitude']=$location["Latitude"];
//
?>


<script language="javascript" src="codigo2.js" type="text/javascript"></script>
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
<div id="cargando" style="position:fixed; top:0px; left:0px; width:110px; height:25px; padding-top:2px;"><a class="textores2">&nbsp;<span class="textouserstopv3">Cargando...</span></a></div>
<div id="testdiv" style=" visibility:hidden;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <? include("new_header.php"); ?>
  </tr>

  <tr>
    <td style=""></td>
    <td colspan="2" style=" height:10px; "></td>
    <td style=""></td>
  </tr>
    <tr>
    <td style=""></td>
    <td colspan="2" style=" height:10px;padding-top:10px;padding-bottom:3px; " align="center">  <table width="850"  border="0" cellpadding="2" cellspacing="2" class="roudlite_g_b" style=" left:2px;" >

    <tr>
      <td class="roudlite_g_a" height="12px" ><a class="headert">Parece que estas en: <strong><? print($location['City']); ?></strong></a><a class="headert" name="incorrect_loc" id="incorrect_loc" style="cursor:pointer;">&nbsp;&nbsp;&nbsp;<u>&iquest;incorrecto?</u></a> </td>
    </tr>
  </table></td>
    <td style=""></td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" bgcolor="" style=" "><table width="90%" border="0" cellpadding="2">
   
    </table>
    <div class="roudlite_fon">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <td colspan="2" align="center"><div align="center" style="position:relative; z-index:2;" class="roudlite2">
              <? include("gmaps_new.php"); ?><div style="position:absolute; bottom: 0%; left:175px;" align="center">
  <? include("searcher.php"); ?></div></div>
          
          <div><? include("content_register_new.php"); ?></div>
          &nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><table width="850" border="0" align="center">
            <tr>
                       <td width="40%" valign="top"><? include("ach.php"); ?></td>
          <td width="2%" valign="top">&nbsp;</td>
          <td width="60%" valign="top"><? include("val_portada_new.php"); ?></td>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td valign="top">&nbsp;</td>
              <td valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td valign="top"><? include("ver_last_img_cached.php"); ?></td>
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
    <td colspan="2" style=""><? include("new_foot.php"); ?>
&nbsp;</td>
    <td style="">&nbsp;</td>
  </tr>
</table>
</div>
<script type="text/javascript">
 	<?
	if(!$username){
	?>
	T$('testclick1').onclick = function(){TINY.box.show('login.php',1,400,200,1,90)}
	T$('testclick2').onclick = function(){TINY.box.show('reg_form.php',1,600,500,1,600)}
	T$('registrar2').onclick = function(){TINY.box.show('reg_form.php',1,600,500,1,600)}
	<?
	}
	?>
	T$('incorrect_loc').onclick = function(){TINY.box.show('change_loc.php?city=<? print($location['City']); ?>',1,600,200,1,90)}
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
if($result=='REG_KO'){
$reg_error=$_GET['reg_error'];
	print_r("<script>TINY.box.show('reg_form.php?c=".$reg_error."',1,600,500,1,600)</script>");
}
if($_GET['error']=="NO_NEW_LOC"){
	print_r("<script>TINY.box.show('mensa_box.php?c=<br>Ha ocurrido un error al guardar la localización<br>Por favor, vuelve a intentarlo',1,450,90,1,7)</script>");
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