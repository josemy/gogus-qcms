<? 
session_start();
include("db.php");

?>

<script language="javascript" src="codigo2.js"></script>
<div id="recpass2" align="center">

<table width="90%" border="0">
  <tr>
    <td><a class="invitado_home2">introduce tus datos para iniciar sesión:</a><br /><span class="nowp2" style="font-size: 11px;"><a>si has olvidado tu contraseña, </a><a href="javascript:llamarasincrono2('get_pass.php','recpass2');" class="nowp4"  style="font-size: 11px;">haz click aqui.</a></span><br />
<br />

</td>
  </tr>
</table>
<table width="90%" border="0" class="boxboxlighte">
  <tr>
    <td><form id="submit" name="submit" method="post" action="userlogin.php"><table width="100%" border="0" cellpadding="2" cellspacing="2">
      <tr>
        <td width="20%"><div align="right"><a class="estilo2v3black">usuario: </a></div></td>
        <td width="32%" valign="top">
          <label>
          <input name="userpost" type="text" id="userpost" tabindex="1"  class="boxboxlighte" />
            </label>        </td>
        
      </tr>
      <tr>
        <td width="20%"><div align="right"><a class="estilo2v3black">contraseña:</a></div></td>
        <td valign="top">
          <label>
            <input name="clavepost" type="password" tabindex="2" id="clavepost"  class="boxboxlighte" />
          </label>        </td>
        </tr>
      <tr>
        <td width="20%">&nbsp;</td>
        <td valign="top"><div align="left">
          <label></label>
          <label class="estilo2v3black">
            <input type="checkbox" name="recordar" value="recordar"  class="estilo2v3black" />
            recordar contraseña&nbsp;&nbsp;</label>
          <br />
          
          <input type="submit" name="submit" class="textbox" value="entrar" />
          &nbsp;&nbsp;<input name="submit23" type="button" class="textbox" value="cerrar" onclick="javascript:function(){TINY.box.hide}" /></div></td>
        </tr>
     
    </table> 
    </form></td>
  </tr>
  <tr>
    <td>
    </td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
<table width="90%" border="0">
  <tr>
    <td><div id="recpass"><? $mensa=$_GET['c']; 
	if($mensa=='r'){
		print_r("<a class='textonormalazulcloud'>El registro ha sido correcto, por favor inicia sesion.</a>");
		
	}
	?></div></td>
  </tr>
</table>
