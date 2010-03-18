<?
session_start();
include("config.php");
$id=$_GET['id'];
date_default_timezone_set('Europe/London'); 
$ver_todoo=mysql_query("SELECT * FROM markers WHERE id = '$id' ;");
while ($prodroww=mysql_fetch_array($ver_todoo)){
	$nombree=$prodroww['name'];
	$titulof=$prodroww['titulo_f'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ver historial en <? print($titulo_corto); ?></title>
<link href="css/general.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 00px;
	margin-right: 0px;
	margin-bottom: 0px;
	height:100%;
}
	#apDiv1 {	position:absolute;
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
    <td style="">&nbsp;</td>
    <td colspan="2" bgcolor="#ffffff" style=""><table width="100%" border="0">
  <tr>
    <td class="textores2">Ver historial de <? echo($nombree);?>&nbsp;-&nbsp;<a class="invitado_home" href="sitio/<? echo($titulof); ?>">volver</a></td>
  </tr>
<?php
//Ver historial de un articulo


$ver_todo=mysql_query("SELECT * FROM markers_journaling WHERE id_real = '$id' ORDER BY id DESC ;");
while ($prodrow=mysql_fetch_array($ver_todo)){
	$user=$prodrow['user_modif'];
	$ip=$prodrow['ip_modif'];
	$time=$prodrow['save_time'];
	$motiv=$prodrow['motivo'];
	if($user=="Anonimo"){
	$user=$user." (".$ip.")";	
	}
	date_default_timezone_set('Europe/London'); 
	$time=date("j-m-Y H:i A",$time);
?>

  <tr>
    <td><span class="textofootres3">(ver) - </span><span class="textofootres2"><? echo($time); ?> - <? echo($user);?> </span><span class="textofootres3">- <? echo($motiv);?> -</span> <span class="textofootres3">reportar abuso </span></td>
  </tr>
  
  <?
  }
  ?>
</table></td>
    <td style="">&nbsp;</td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td colspan="2" style="">&nbsp;</td>
    <td style="">&nbsp;</td>
  </tr>
</table>
    <? include("new_foot.php"); ?>

</body>
</html>