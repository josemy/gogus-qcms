<?
//Mini local para incluirlo en otra web:
session_start();
include("config.php");
$id=$_GET['id'];
$tit=$_GET['title'];

$ver_todo=mysql_query("SELECT * FROM markers WHERE titulo_f = '$tit' LIMIT 1 ;");
    while ($prodrow=mysql_fetch_array($ver_todo)){
$direcc=$prodrow['address'];
$descri=$prodrow['name'];
$phone=$prodrow['phone'];
$web=$prodrow['web'];
$coord=$prodrow['lat'];
$coord=$coord.",".$prodrow['lng'];
$latt=$prodrow['lat'];
$lonn=$prodrow['lng'];
$titulo_f=$prodrow['titulo_f'];
$img=$prodrow['image'];
	}
if($img==''){
$img="random.jpg";	
}
if($img=='local_img/'){
$img="random.jpg";	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href = "<? echo $_URL_BASE; ?>" target="_top" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>QueCom.es!?</title>
<link href="http://quecom.es/css/general.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.new4 {color: #090; font-family: arial,sans-serif; font-size: 11px; text-decoration: none; }

-->
</style></head>

<body>
<table width="300" border="0" class="boxboxlighte">
  <tr>
    <td width="220" height="20"><a href="http://quecom.es/sitio/<? print($titulo_f); ?>" class="estilo2v3link"><? print($descri); ?></a><br />
      <span class="estilo2v3"><? print($direcc); ?></span><br />
      <span class="estilo2v3"><? print($phone); ?></span><br />
    <span class="new4"><a href="http://<? print($web); ?>" class="new4"><? print($web); ?></a></span></td>
    <td width="70"><img src="http://quecom.es/resize_image.php?image=<? echo($img);?>&amp;new_width=70&amp;new_height=70"></td>
  </tr>
  <tr>
    <td height="20" colspan="2"><img src="http://maps.google.com/staticmap?center=<? print($latt); ?>,<? print($lonn); ?>&amp;zoom=15&amp;size=300x80&amp;format=png8&amp;maptype=roadmap&amp;markers=<? print($latt); ?>,<? print($lonn); ?>,midred&amp;key=ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBS3CkSPi3aKTtiOuwmOy6_GhXJFGxSPc3miXfruwYGlbR74XB975r5dgA" alt="" height="78" width="298" /></td>
  </tr>
  <tr>
    <td height="20" colspan="2"><img src="http://quecom.es/logo_test2.png" alt="logo" width="100" height="19" style="cursor:pointer;" onClick="document.location.href='http://quecom.es'" /></td>
  </tr>
</table>
</body>
</html>