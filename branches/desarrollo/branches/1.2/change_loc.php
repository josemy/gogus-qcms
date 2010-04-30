<?
include("config.php");
$loc=$_GET['city'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin título</title>
</head>

<body>
<p><a class="invitado_home2">Actualmente parece que estas en <? print($loc); ?>, ¿donde estas realmente?:</a></p>
<form method="post" id="form1" name="form1" enctype="multipart/form-data" action="guardar_loc.php">
  <p>
    <label class="estilo2v3black">
    introduce el nombre de tu ciudad o pueblo: 
      <input type="text" name="newloc" id="newloc" />
    </label>
  </p>
  <table width="90%" border="0">
    <tr>
      <td> <label>
      <input type="submit" name="button" id="button" value="Guardar" />
    </label>
</td>
      <td>    <div align="right">
        <input type="button" name="button2" id="button2" value="Cancelar" onClick="javascript:TINY.box.hide()" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>
   
  </p>
</form>
</body>
</html>