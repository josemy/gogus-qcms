
<?php
require("config.php");

// Gets data from URL parameters
$name = $_GET['name'];
$address = $_GET['address'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$type = $_GET['type'];

//echo($name.$address.$lat.$lng.$type);

?>
<form action="guardar.php?lat=<? echo($lat); ?>&lng=<? echo($lng); ?>&type=<? echo($type); ?>" method="post" id="form1" name="form1" enctype="multipart/form-data">
<table border="0" align="center" class="boxboxlighte" style=" background-color:#FFE">
  <tr>
    <td colspan="2"><a class="buscanew">Nombre:</a></td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <input type="text" name="nombre" id="nombre" class="boxboxlighte" value="<? echo($name); ?>">
    </label></td>
  </tr>
  <tr>
    <td colspan="2"><a class="buscanew">Direccion:</a></td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <input type="text" name="direcc" id="direcc" class="boxboxlighte" value="<? echo($address); ?>">
    </label></td>
  </tr>
  <tr>
    <td colspan="2"><a class="buscanew">Pequeña descripcion:</a></td>
  </tr>
  <tr>
    <td colspan="2"><input name="desc" type="text" id="desc" size="70" class="boxboxlighte" ></td>
  </tr>
   <tr>
    <td colspan="2"><a class="buscanew">Foto:</a></td>
  </tr>
   <tr>
    <td colspan="2"><input type="file" name="foto" id="foto" class="boxboxlighte" /></td>
  </tr>
  <tr>
    <td colspan="2"><a class="buscanew">Descripcion Larga:</a></td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <textarea name="ldesc" id="ldesc" cols="67" rows="5" class="boxboxlighte"></textarea>
    </label></td>
  </tr>
  <tr>
    <td ><a class="buscanew">Precio Medio:</a></td>
    <td><a class="buscanew">Sitio Web:</a></td>
  </tr>
  <tr>
    <td><input name="precio" type="text" id="precio" size="5" class="boxboxlighte"></td>
    <td><input type="text" name="web" id="web" class="boxboxlighte"></td>
  </tr>
  <tr>
    <td><a class="buscanew">Tipo de Cocina:</a></td>
    <td><a class="buscanew">Etiquetas (separadas por comas):</a></td>
  </tr>
  <tr>
    <td><input type="text" name="tipo_co" id="tipo_co" class="boxboxlighte"></td>
    <td><input name="etiq" type="text" id="etiq" size="55" class="boxboxlighte"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label>
      <input type="submit" name="guardar" id="guardar" value="Guardar">
    </label></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
