
<?php
require("config.php");

// Gets data from URL parameters
$name = $_GET['name'];
$address = $_GET['address'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$type = $_GET['type'];
$id = $_GET['id'];
$newid=$id/69;
//echo($newid);
$ver_todo=mysql_query("SELECT * FROM markers WHERE id = '$newid' ;");
    while ($prodrow=mysql_fetch_array($ver_todo)){
$address=$prodrow['address'];
$name=$prodrow['name'];
$coord=$prodrow['lat'];
$coord=$coord.",".$prodrow['lng'];
$latt=$prodrow['lat'];
$lonn=$prodrow['lng'];
$long=$prodrow['descripcion'];
$vlong=$prodrow['desc_long'];
$img=$prodrow['image'];

$web=$prodrow['web'];
$precio=$prodrow['precio_medio'];

$tipo=$prodrow['tipo_cocina'];
$tags=$prodrow['tags'];
$phone=$prodrow['phone'];
//$tags = explode(", ", $tags);
}

//echo($name.$address.$lat.$lng.$type);

?>
<form action="editar.php?lat=<? echo($lat); ?>&lng=<? echo($lng); ?>&type=<? echo($type); ?>" method="post" id="form1" name="form1" enctype="multipart/form-data">
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
    <td colspan="2"><input name="desc" type="text" id="desc" size="70" class="boxboxlighte" value="<? echo($long); ?>" ></td>
  </tr>
   <tr>
    <td><a class="buscanew">Foto:</a></td>
    <td><a class="buscanew">Foto Actual:</a></td>
   </tr>
   <tr>
    <td><input type="file" name="foto" id="foto" class="boxboxlighte" /></td>
    <td><img src="resize_image.php?image=<? echo($img);?>&amp;new_width=100&amp;new_height=100">&nbsp;</td>
   </tr>
  <tr>
    <td colspan="2"><a class="buscanew">Descripcion Larga:</a></td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <textarea name="ldesc" id="ldesc" cols="67" rows="5" class="boxboxlighte"><? echo($vlong); ?></textarea>
    </label></td>
  </tr>
  <tr>
    <td ><a class="buscanew">Precio Medio:</a></td>
    <td><a class="buscanew">Sitio Web:</a></td>
  </tr>
  <tr>
    <td><input name="precio" type="text" id="precio" size="5" class="boxboxlighte" value="<? echo($precio); ?>"></td>
    <td><input type="text" name="web" id="web" class="boxboxlighte" value="<? echo($web); ?>"></td>
  </tr>
  <tr>
    <td><a class="buscanew">Tipo de Cocina:</a></td>
    <td><a class="buscanew">Etiquetas (separadas por comas):</a></td>
  </tr>
  <tr>
    <td><input type="text" name="tipo_co" id="tipo_co" class="boxboxlighte" value="<? echo($tipo); ?>"></td>
    <td><input name="etiq" type="text" id="etiq" size="55" class="boxboxlighte" value="<? echo($tags); ?>"></td>
  </tr>
      <tr>
    <td><a class="buscanew">Telefono:</a></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td><input type="text" name="phone" id="phone" class="boxboxlighte" value="<? echo($phone); ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Motivo de la edicion:</td>
    </tr>
    <tr>
    <td colspan="2"><input name="motiv" type="text" id="motiv" size="70" class="boxboxlighte" value="" /></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label>
      <input type="submit" name="guardar" id="guardar" value="Guardar">
    </label></td>
    <td><input name="nid" type="text" id="nid" size="5" class="boxboxlighte" value="<? echo($newid); ?>"  style="visibility:hidden;"/></td>
  </tr>
</table>
</form>
