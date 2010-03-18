<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin título</title>
</head>

<body>
<p><a class="new1">Incluir en tu web:</a></p>
<p><span class="estilo2v3">Copia y pega en tu web (en el codigo fuente) el siguiente texto:</span></p>
<?
$ti=$_GET['title'];
$link='<iframe src="http://quecom.es/mini_local.php?title='.$ti.'" name="quecomes'.$ti.'" width="300" height="177" frameborder="0" scrolling="auto"></iframe>';
?>
<form id="form1" name="form1" method="post" action="">
  <label>
    <input name="textfield" type="text" id="textfield" value='<? print($link); ?>' class="boxboxlighte" size="95" />
  </label>
</form>

<div align="right" onClick="javascript:TINY.box.hide()" style="cursor:
pointer; padding-top:10px;" class="estilo2v3black"><u>cerrar</u></div>
</body>
</html>