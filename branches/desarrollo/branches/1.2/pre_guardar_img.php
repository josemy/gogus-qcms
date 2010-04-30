<?
include("config.php");
$id=$_GET['id'];
$verid=mysql_query("SELECT * FROM markers WHERE id = '$id' ;");
    while ($idp=mysql_fetch_array($verid)){
		$name=$idp['name'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin título</title>
</head>

<body>
<p><a class="new1">Subir foto para el sitio <? echo($name); ?>:</a></p>
<form method="post" id="form1" name="form1" enctype="multipart/form-data" action="guardar_img.php?id=<? echo($id); ?>">
  <p>
    <label>
      <input type="file" name="foto" id="foto" />
    </label>
  </p>
  <p>
    <label>
      <input type="submit" name="button" id="button" value="Guardar" />
    </label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" name="button2" id="button2" value="Cancelar" onClick="javascript:TINY.box.hide()" />
  </p>
</form>
<p><img src="images/normal/001_11.png"/> <span class="estilo2v3"><strong>Atencion:</strong> La foto debe ser libre, y pasará a tener licencia <a href='http://creativecommons.org/licenses/by-sa/3.0/' target='_blank'>CreativeCommons CC-BY-SA</a></span></p>
</body>
</html>