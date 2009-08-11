<?php
  session_start();
  include("db.php");
  $username=$_SESSION['_username'];
   $regerr=$_SESSION['error'];
   $ip=$_SERVER['REMOTE_ADDR'];
   $getac=mysql_query("SELECT * FROM lastlogon WHERE ip = '$ip'");
   $getip=mysql_num_rows($getac);
   $getw=mysql_query("SELECT * FROM whitelistip WHERE ip = '$ip'");
   $getwi=mysql_num_rows($getw);
   if($getwi < '1'){
			   if($getip > '2'){
				   //echo("full");
			echo('<div align="center" class="boxwarn" ><img src="images/alert1.gif" width="16" height="16" />&nbsp;&nbsp;<a class="estilo2v3black">Demasiados usuarios registrados con esta IP.</a> </div>');
			die();
			   }
   }

  ?>
 <div align="center">

    <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0" >


     <tr>
       <td><form id="formu" name"formu" method="POST" action="reg_process.php"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="center">          <a class="textonormalgran">1.  rellena todos los campos siguientes: </a><br /><br />
          <table width="90%" height="25" border="0" class="boxwarn">
            <tr>
              <td valign="middle"> <div align="center"><img src="images/alert1.gif" width="16" height="16" />&nbsp;&nbsp;<a class="estilo2v3black"> tus datos solo seran usados para detectar que sitios te interesan mas</a> </div></td>
            </tr>
          </table>
          <br />
          <table width="90%"  border="0" cellpadding="0" cellspacing="5">
            <tr>
              <td width="233"><div align="right"><a class="estilo2v3">usuario:</a></div></td>
              <td width="80">&nbsp;</td>
              <td width="455">
                <div align="left">
                  <input name="username" type="text" class="textbox" id="username" onChange="javascript:buscaUser();" size="26">
                </div>                <div align="center" id="contenidos3"></div></td>
            </tr>
            <tr>
              <td><div align="right"><a class="estilo2v3">password:</a></div></td>
              <td>&nbsp;</td>
              <td>
                  <div align="left">
                    <input type="password" class="textbox" name="password" size="26">
                  </div></td>
            </tr>
            <tr>
              <td><div align="right"><a class="estilo2v3">repite password:</a></div></td>
              <td>&nbsp;</td>
              <td>
                  <div align="left">
                    <input type="password" class="textbox" name="confirmpassword" size="26">
                  </div></td>
            </tr>
            <tr>
              <td><div align="right"><a class="estilo2v3">Nombre:</a></div></td>
              <td>&nbsp;</td>
              <td>
                  <div align="left">
                    <input type="text" class="textbox" name="name" size="26">
                  </div></td>
            </tr>


            <tr>
              <td><div align="right"><a class="estilo2v3">C&oacute;digo Postal:</a></div></td>
              <td>&nbsp;</td>
              <td><div align="left">
                <input name="cp" type="text" class="textbox" id="cp" size="26">
              </div></td>
            </tr>
            
            
            <tr>
              <td><div align="right"><a class="estilo2v3">email:</a></div></td>
              <td>&nbsp;</td>
              <td>
                  <div align="left">
                    <input type="text" class="textbox" name="email" size="26">
                  </div></td>
            </tr>
          </table>
          <table width="90%" border="0" cellpadding="0" cellspacing="0">
            <tr>
            <td height="44" class="textonormalmedio"><font face="Arial">&nbsp; </font><font face="Arial">&nbsp; </font></td>
            <td height="44" colspan="3" class="textonormalmedio"><div align="center"><font face="Arial">            </font></div>              <div align="center"></div>              
              <div align="center" class="textonormalgran">2. inserta el codigo que aparece en la imagen  </div></td>
            </tr>
          <tr>
            <td height="38" class="textonormalmedio">&nbsp;</td>
            <td class="textonormalmedio"><div align="right"><font face="Arial"><font face="Arial"><font face="Arial">
              <font face="Arial"><font face="Arial"><font face="Arial">
			  <? 
			if ($regerr=="antispam"){
			printf("<a class='errortext'>El codigo antispam es incorrecto </a>");
			$estilo="errorbox";
			}else{
			$estilo="textbox";
			}
			 
			
			?>
              <input name="texto_ingresado" type="text" class="<? echo($estilo);?>" id="texto_ingresado" value="<? echo($_SESSION['captchatxt']); ?>" size="20" />
&nbsp;&nbsp;&nbsp;&nbsp; </font></font></font> </font> </font> </font></div></td>
            <td class="textonormalmedio" align="center"><font face="Arial"> <font face="Arial"><font face="Arial"><img src="nuevo_captcha/captcha.php" id="captcha" /></font> </font> </font></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="27" class="textonormalmedio">&nbsp;</td>
			
	
            <td class="textonormalmedio">
</td>
            <td class="textonormalmedio" valign="top" align="center"><a style=" text-decoration:underline;" class="nowp2" href="#" onclick="
    document.getElementById('captcha').src='nuevo_captcha/captcha.php?'+Math.random();
    document.getElementById('captcha-form').focus();"
    id="change-image">&iquest;texto ilegible? Cambiar</a>&nbsp;</td>
              
          
            <td rowspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td height="28" class="textonormalmedio">&nbsp;</td>
            <td colspan="2" class="textonormalmedio">			
			    <div align="center">
			      <input name="acepto" type="checkbox" value="acepto" onclick="javascript:activaboton();" />   
		        <span class="estilo2v3">ATENCION: debes aceptar, conocer y cumplir las </span>		       <span class="estilo2v3"><a href="tos.php" target="_blank" class="estilo2v3">condiciones de servicio</a> </span></div>&nbsp;</td>
            </tr>
          <tr>
            <td height="55" class="textonormalmedio">&nbsp;</td>
            <td class="textonormalmedio"><div align="center">
              <input id="submit" name="submit" type="submit" class="textbox" value="registrar" />
            </div></td>
            <td class="textonormalmedio"><div align="center">
              <input name="submit2" type=button class="textbox" value="cerrar" onClick="javascript:cierracontactar();">
            </div></td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </div></td>
    </tr>
  </table>
       </form></td>
     </tr>
   </table>
 </div>
<? 
unset($_SESSION['error']);
unset($_SESSION['item']);
?>

 
