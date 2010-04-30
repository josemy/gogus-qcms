<?
//Modificar los datos del usuario.
session_start();
include_once("config.php");
$user_check=$_SESSION['username'];
if(!$user_check){
die("Su sesión ha caducado");
//redirigir a pagina de login
}
$getuser=mysql_query("SELECT * FROM usuarios WHERE username = '$user_check'");
$datauser=mysql_fetch_array($getuser);
$usern=$datauser['username'];
$nombre=$datauser['name'];
$direccion=$datauser['direccion'];
$mail=$datauser['mail'];


if($_POST['modif']){
//Nombre
$name_g=$_POST['username2'];
$guarda=mysql_query("UPDATE `usuarios` SET `name` = '$name_g' WHERE `username` = '$usern'");
//Direccion
$direcc_g=$_POST['username3'];
$guarda=mysql_query("UPDATE `usuarios` SET `direccion` = '$direcc_g' WHERE `username` = '$usern'");
//Mail
$mail_g=$_POST['username7'];
$guarda=mysql_query("UPDATE `usuarios` SET `mail` = '$mail_g' WHERE `username` = '$usern'");
printf("<script>document.location.href='index.php?pre=modif_data.php?item=Sus datos han sido modificados.'</script>;");

}
$mensa_modif=$_GET['item'];

?>
    <form id="formmo" name"formmo" method="POST" action="modif_data2.php">

<table width="100%" border="0">
  <tr>
    <td colspan="2" align="left" valign="middle"><div align="left"><a class="textoartistarec3_peq">Modificar mis datos de acceso</a><br />
      <span class="nowp2" style="font-size: 11px;">modifica tus datos en quecomes</span>
    </div></td>
  </tr>
  <tr>
    <td><div align="right"></div></td>
    <td><div align="right"><a class="textomensaje"><? echo($mensa_modif); ?></a></div></td>
  </tr>
  <tr>
    <td><div align="right"><a class="estilo2v3">usuario:</a></div></td>
    <td>
      <label>
        <input name="username" type="text" disabled="disabled" class="textbox" id="username" value="<? echo($usern);?>" />
      </label>
   </td>
  </tr>
  <tr>
    <td><div align="right"><a class="estilo2v3">nombre:</a></div></td>
    <td><input type="text" name="username2" class="textbox" id="username2" value="<? echo($nombre);?>" /></td>
  </tr>
  <tr>
    <td><div align="right"><a class="estilo2v3">ciudad:</a></div></td>
    <td><input type="text" name="username3" class="textbox" id="username3" value="<? echo($direccion);?>" /></td>
  </tr>

  <tr>
    <td><div align="right"><a class="estilo2v3">email:</a></div></td>
    <td><input type="text" name="username7" class="textbox" id="username7" value="<? echo($mail);?>" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div align="left">
      <label>
        <input type="submit" name="modif" id="modif" class="textbox" value="Guardar" />
&nbsp;&nbsp;  </label>
     
      <input name="submit2" type="button" class="textbox" value="Volver" onclick="document.location.href='index.php';" />
    </div></td>
  </tr>
</table>
 </form>
