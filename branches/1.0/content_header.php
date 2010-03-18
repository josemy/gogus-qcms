
    <td width="" bgcolor="#CC3333" style="">&nbsp;</td>
    <td bgcolor="#CC3333" width="480" style="border-top-width:1px; "><img src="logo_test2.png" onclick="document.location.href='index.php'" style="cursor:pointer;"  width="268" height="50" alt="logo" /></td>
    <td width="480" height="50" bgcolor="#CC3333" style="border-top-width:1px;"><div align="center"><a class="tindex">busca restaurantes de cualquier ciudad</a>
            <input name="busca" type="text" class="cajabox" style="border: 2px solid #ffffff;" id="busca" size="45" value="<? echo($rpat);?>"  onkeypress="javascript:busca(event);"/>
    </div></td>
    <td width="" bgcolor="#CC3333" style="">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#E5E5E5" style="">&nbsp;</td>
    <td bgcolor="#E5E5E5" class="invitado_home" style="border-top-width:1px;border-top-width:1px; border-top-style:solid;border-top-color:#E3ECF3; border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3; "><? echo($page_name); ?></td>
    <td bgcolor="#E5E5E5" align="right" style=" border-bottom-width:1px; border-bottom-style:solid;border-bottom-color:#E3ECF3;border-left-style:solid;border-left-width:1px; border-left-color:#E3ECF3;border-right-style:solid;border-right-width:1px; border-right-color:#E3ECF3;"><? if($username) { ?>
        <a  class="estilo2v3black" title="Este eres tu">¡Hola! <strong><? echo($uname); ?> </strong></a>&nbsp;&nbsp;<a href="/micuenta"  class="estilo2v3black" style="cursor:pointer; text-decoration:underline;">Mi Cuenta</a>&nbsp;&nbsp;<a href="logout.php"  class="estilo2v3black" style="cursor:pointer; text-decoration:underline;">Salir</a>
      <? }?></td>
    <td bgcolor="#E5E5E5" style="">&nbsp;</td>

