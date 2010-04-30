<?
session_start();
$username=$_SESSION['username'];
include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo($descri); ?> en <? print($titulo_corto); ?></title>
<link href="css/general.css" rel="stylesheet" type="text/css">
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
<script language="javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
window.open(theURL,winName,features); }

function GuardaFav(nu){
llamarasincrono2('add_fav.php?fid='+nu,'cargafav');	
}

</script>
<?
if (!$_POST['nombre']){
?>
<link href="style" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
tabla {
	background-color: #CCCCCC;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
<br />
<table width="85%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bordecajas">
  <tr>
    <td><form action="contactar.php" method="post" name="contactar.php" id="contactar.php">
<p align="center" class="textonormalgran">Contactar con QueComes!? </p>
<table width="90%" border="0" align="center" name="tabla">
  <tr>
    <td class="textonormalazul">Nombre: </td>
    <td colspan="2" valign="top"><input name="nombre" type=text class="textbox" size=26></td>
    </tr>
  <tr>
    <td class="textonormalazul">Email: </td>
    <td colspan="2"><input name="email" type=text class="textbox" size=26></td>
  </tr>
  <tr>
    <td valign="top"><span class="textonormalazul">Mensaje: </span><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
    </font></td>
    <td colspan="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
      <textarea name="coment" cols="25" rows="6" class="textbox"></textarea>
    </font></td>
  </tr>
</table>
<div align="right"><br>
  <input name="submit" type=submit class="textbox" value="Enviar">
  &nbsp;&nbsp;<br>
  &nbsp;</div>
    </form>
      <div align="right"><br>
    </div>
      <div align="right"></div></td>
  </tr>
</table>





<?

}else{

//Estoy recibiendo el formulario, compongo el cuerpo

$cuerpo = "Formulario enviado desde quecom.es\n";

$cuerpo .= "Nombre: " . $_POST["nombre"] . "\n";

$cuerpo .= "Email: " . $_POST["email"] . "\n";

$cuerpo .= "Mensaje: " . $_POST["coment"] . "\n";



//mando el correo...

mail("rebrok@gmail.com","QueComes!? - Formulario recibido",$cuerpo);



//doy las gracias por el envío
//printf("<script>document.location.href='index.php?action=info&item=mensaok<br>'</script>;");
	//die("");
echo "Gracias por rellenar el formulario. Se ha enviado correctamente.";

}

?> 
<div align="center"></div>

</body>
</html>