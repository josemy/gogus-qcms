<? 
session_start();
include("db.php");

include('geoLocateIp.class.php');
$geo = new geoLocateIp();
$location = $geo -> getLocationFromIp();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>que comes!? - food social network</title>
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
	left:45px;
	top:0px;
	width:224px;
	height:47px;
	z-index:1;
}
-->
</style>
<script language="javascript" src="codigo2.js"></script>
<script type="text/javascript" src="tinybox.js"></script>
</head>

<body>
<div id="testdiv">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top:18px;">
<tr>
<td></td>
<td></td>
<td></td>
</tr>
  <tr>
    <td align="center" width="25%">&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF"><div id="principal" style=" position:relative;height:550px; width:960px;border-top-width:1px; border-top-style:solid;border-top-color:#E3ECF3;border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; " align="center">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom-width:2px; border-bottom-style:solid;border-bottom-color:#E3ECF3;">
        <tr>
          <td width="50%" bgcolor="#0066a7">&nbsp;</td>
          <td width="50%" bgcolor="#0066a7" class="minindex2"><div align="right" style="padding-right:2px;"><a id="testclick1" style="cursor:pointer;">iniciar sesion</a> - crear cuenta</div></td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%" height="0"><? include("gmaps.php"); ?>
<div class="textologo" id="apDiv1" style=" top:21px;filter:alpha(opacity=75);-moz-opacity:0.75; background-color:#333">que comes!?</div>
      </td>
          <td width="50%" align="left" valign="top"><? include("content_register.php"); ?></td>
        </tr>
                <tr>
          <td height="0" colspan="2">&nbsp;</td>
          </tr>
          
        <tr>
          <td height="0" colspan="2"><div id="master">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%"><div id="mini_cont" align="center"></div></td>
          <td width="50%" valign="top"><? include("random_local.php"); ?></td>
        </tr>
        <tr>
        <td colspan="2" ></td>
        </tr>
                <tr>
                
          <td colspan="2" >&nbsp;</td>
        </tr>

      </table>
    </div></td>
          </tr>
      </table>
      
    </div></td>
    <td align="center" width="25%">&nbsp;</td>
  </tr>
  <tr>
<td></td>
<td></td>
<td></td>
  </tr>
</table>
<? 
echo("quecomes alpha version 0.145");
echo($location['City']); 
echo($location['Latitude'].$location['Longitude']);
echo($location["CountryCode"]);
?>

</div>
<p></p>
<script type="text/javascript">
	T$('testclick1').onclick = function(){TINY.box.show('login.php',1,300,150,1)}

</script>

</body>
</html>