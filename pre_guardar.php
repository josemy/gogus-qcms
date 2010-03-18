
<?php
require("config.php");

// Gets data from URL parameters
$name = $_GET['name'];
$address = $_GET['address'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$type = $_GET['type'];
$citz = $_GET['citz'];
//Solucion Issue 3
// ATENCION: No funciona en balanku
$name = mb_convert_encoding($name, "UTF-8");
$address = mb_convert_encoding($address, "UTF-8");
//
//echo($name.$address.$lat.$lng.$type);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<form action="guardar.php?lat=<? echo($lat); ?>&lng=<? echo($lng); ?>&type=<? echo($type); ?>" method="post" id="form1" name="form1" enctype="multipart/form-data">
<table border="0" align="center" class="boxboxlighte" style=" background-color:#FFE">
  <tr>
    <td colspan="2" align="left"><a class="buscanew">Nombre:</a></td>
  </tr>
  <tr>
    <td colspan="2" align="left"><label>
      <input type="text" name="nombre" id="nombre" class="boxboxlighte" value="<? echo($name); ?>">
    </label></td>
  </tr>
  <tr>
    <td align="left"><a class="buscanew">Direccion:</a></td>
    <td align="left"><a class="buscanew">Localidad:</a></td>
  </tr>
  <tr>
    <td align="left"><label>
      <input type="text" name="direcc" id="direcc" class="boxboxlighte" value="<? echo($address); ?>">
    </label></td>
    <td align="left"><input type="text" name="citz" id="citz" class="boxboxlighte" value="<? echo($citz); ?>" /></td>
  </tr>
  <tr>
    <td colspan="2" align="left"><a class="buscanew">Pequeña descripcion:</a></td>
  </tr>
  <tr>
    <td colspan="2" align="left"><input name="desc" type="text" id="desc" size="70" class="boxboxlighte" ></td>
  </tr>
   <tr>
    <td colspan="2" align="left"><a class="buscanew">Foto:</a></td>
  </tr>
   <tr>
    <td colspan="2" align="left"><input type="file" name="foto" id="foto" class="boxboxlighte" /></td>
  </tr>
  <tr>
    <td colspan="2" align="left"><a class="buscanew">Descripcion Larga:</a></td>
  </tr>
  <tr>
    <td colspan="2" align="left"><label>
      <textarea name="ldesc" id="ldesc" cols="67" rows="5" class="boxboxlighte"></textarea>
    </label></td>
  </tr>
  <tr>
    <td align="left"><a class="buscanew">Precio Medio:</a></td>
    <td align="left"><a class="buscanew">Sitio Web:</a></td>
  </tr>
  <tr>
    <td align="left"><input name="precio" type="text" id="precio" size="5" class="boxboxlighte"></td>
    <td align="left"><input type="text" name="web" id="web" class="boxboxlighte"></td>
  </tr>
  <tr>
    <td align="left"><a class="buscanew">Tipo de Cocina:</a></td>
    <td align="left"><a class="buscanew">Etiquetas (separadas por comas):</a></td>
  </tr>
  <tr>
    <td align="left"><input type="text" name="tipo_co" id="tipo_co" class="boxboxlighte"></td>
    <td align="left"><input name="etiq" type="text" id="etiq" size="55" class="boxboxlighte"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><label>
      <input type="submit" name="guardar" id="guardar" value="Guardar">
    </label></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
