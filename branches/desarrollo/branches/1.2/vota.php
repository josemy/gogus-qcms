<?
session_start();
include("config.php");
include("getcoord.php");
$username=$_SESSION['username'];

$id=$_GET['id_local'];
$tipo=$_GET['tipo'];
$ver_todo=mysql_query("SELECT * FROM markers WHERE id = '$id' ;");
    while ($prodrow=mysql_fetch_array($ver_todo)){
$direcc=$prodrow['address'];
$descri=$prodrow['name'];
$coord=$prodrow['lat'];
$coord=$coord.",".$prodrow['lng'];
$long=$prodrow['descripcion'];
$vlong=$prodrow['desc_long'];
//$vlong=substr($vlong,0,100)."...";
$web=$prodrow['web'];
$precio=$prodrow['precio_medio'];
$punt=$prodrow['puntuacion'];

	}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo($rpat); ?> en <? print($titulo_corto); ?></title>
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
</head>

<body>
<form id="form1" name="form1" method="post" action="ver_local.php?id=<? echo($id); ?>&tipo=<? echo($tipo); ?>">
<table width="100%" border="0">
  <tr>
    <td class="textores2">Comenta el sitio</td>
  </tr>
  <tr>
    <td>
      <label>
        <span class="textofootres3">titulo del comentario:</span><br />
        <input name="titulo" type="text" class="boxboxlighte" id="titulo" size="45" maxlength="50" />
      </label>
      <select id='type' name='type' class='boxboxlighte'>
      <? if($tipo=="1"){
	print_r('<option value="5" SELECTED>5 - Aceptable</option>');
		print_r('<option value="6" >6 - Bueno</option>');
			print_r('<option value="7" >7 - Bastante Bueno</option>');
				print_r('<option value="8" >8 - Muy Bueno</option>');
					print_r('<option value="9" >9 - Excelente</option>');
					print_r('<option value="10" >10 - Increible</option>');
					
	  }
	  
	  if($tipo=="0"){
	print_r('<option value="4" SELECTED>4 - Regular</option>');
		print_r('<option value="3" >3 - Mediocre</option>');
			print_r('<option value="2" >2 - Malo</option>');
				print_r('<option value="1" >1 - Muy Malo</option>');
					print_r('<option value="0" >0 - Horrible</option>');
					  
	  }
	  
	  if($tipo=="3"){
		print_r('<option value="0" >0 - Horrible</option>');
		print_r('<option value="1" >1 - Muy Malo</option>');
		print_r('<option value="2" >2 - Malo</option>');  
		print_r('<option value="3" >3 - Mediocre</option>');
	  	print_r('<option value="4" >4 - Regular</option>');
		print_r('<option value="5" SELECTED>5 - Aceptable</option>');
		print_r('<option value="6" >6 - Bueno</option>');
		print_r('<option value="7" >7 - Bastante Bueno</option>');
		print_r('<option value="8" >8 - Muy Bueno</option>');
		print_r('<option value="9" >9 - Excelente</option>');
		print_r('<option value="10" >10 - Increible</option>');					  
	  }
	  ?>
      </select>
    </td>
  </tr>
  <tr>
    <td><label>
      <span class="textofootres3">comentario:</span><br />
      <textarea name="comentario" cols="50" rows="5" class="boxboxlighte" id="comentario"></textarea>
      <br />
      <input type="submit" name="Votar" id="Votar" value="votar" />
    </label></td>
  </tr>
</table>
</form>
</body>
</html>