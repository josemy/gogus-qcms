<div id="masterr" >

<table width="100%" border="0" align="center">
<tr>
<td>        
<!--[if IE 6]>
<table width="100%" border="0">
        <tr>
          <td><span class="textofootres3"><img src="images/normal/001_30.png" height="24px" width="24px" title="Error" alt="Error" /></span></td>
          <td class="textofootres3"><b> Su navegador no est&aacute; soportado.</b><br />
Estas usando un navegador con mas de 8 años de antig&uuml;edad, por favor actualizalo.</td>
        </tr>
</table>
<![endif]-->
</td>
</tr>
  <tr>
    <td><div class="roudlite" style="padding:4px 0 4px 0;" align="center">
    <? if($username) {
		include("menu_user.php");
	}else{
	?>
    <a class="invitado_home2">¡Hola! ¡</a><a class="invitado_home" id="registrar2" style="cursor:pointer;">Registrate</a><a class="invitado_home2"> aqui para participar!</a>
    <? } ?></div></td>
  </tr>


    <tr>
    <td align="center" valign="middle" bgcolor="#ffffff" style="padding:4px;">
      <? include('last_searchs.php'); ?></td>
  </tr>   
  <tr>
      <td align="center" valign="bottom" bgcolor="#ffffff" class="invitado_home2" style="padding-bottom:1px; color:#000;"><div id="apDiv5" style="text-align:left;"></div><div class="roudlite" style="padding:4px; padding-top:8px; padding-bottom: 8px;">busca restaurantes de cualquier ciudad<br />      <input name="busca" type="text" class="cajabox" id="busca" style="height:20px; padding:2px;" OnKeyUp="javascript:busca(event);" onclick="this.className=(this.className=='cajaboxclick') ? 'cajabox':'cajaboxclick'" size="41" maxlength="42"/></div></td>
  </tr>
  </table>
<div class="textologo" id="apDiv3" style="position:relative; width:22px; height:22px; top:-38px; left:428px; filter:alpha(opacity=75); -moz-opacity:0.99; 9; cursor:pointer; vertical-align:middle; text-align:center;" ><img src="images/normal/001_37.png" onclick="javascript:busca(event);" style="cursor:pointer;" height="22" width="22" title="Buscar" alt="Buscar" /></div>
</div>