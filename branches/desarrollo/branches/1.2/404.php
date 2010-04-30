<?
include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin título</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.nowp1w {
	font-family: Verdana, sans-serif;
	font-size: 9px;
	color: #FFFFFF;
	text-decoration: none;
	
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
<script type="text/javascript" src="tinybox.js"></script>
<script type="text/javascript">
function borrabusca(){
if(document.getElementById('busca').value=="buscar..."){
document.getElementById('busca').value="";
}
}
    </script>
</head>


<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
<td width="" bgcolor="#CC3333" style="border-bottom-width:4px; border-bottom-style:solid;border-bottom-color:#CCCCCC;">&nbsp;</td>
    <td bgcolor="#CC3333" width="480"  style="border-bottom-width:4px; border-bottom-style:solid;border-bottom-color:#CCCCCC; padding-top:2px;"><img src="logo_test2.png" alt="logo" width="240" height="45" style="cursor:pointer;" onClick="document.location.href='<? echo($_URL_BASE); ?>'" /><br />
<span class="nowp1w">
      <? include("quotes.php"); ?>
    </span></td>
    <td width="480" height="50" bgcolor="#CC3333" style="border-bottom-width:4px; border-bottom-style:solid;border-bottom-color:#CCCCCC;"  align="center"><? if(!$portada){ ?><div align="center">
            <input name="busca" type="text" class="cajabox" style="border: 2px solid #ffffff;" id="busca" size="45" value="buscar..." onclick="javascript:borrabusca();"  onkeypress="javascript:busca(event);"/><br /><div align="center"><? if($username) { ?><a  class="nowp1w" title="Este eres tu">¡Hola! <strong><? echo($uname); ?> </strong></a>&nbsp;&nbsp;<a href="/micuenta"  class="nowp1w" style="cursor:pointer; text-decoration:underline;">Mi Cuenta</a>&nbsp;&nbsp;<a href="logout.php?return=<? print($pre_url); ?>"  class="nowp1w" style="cursor:pointer; text-decoration:underline;">Salir</a><? }else{ ?><a id="testclick1" class="nowp1w" style="cursor:pointer;"><strong>iniciar sesion</strong> -</a><a id="testclick2"  class="nowp1w" style="cursor:pointer;">&nbsp;<strong>crear cuenta</strong></a><? } ?></div>
    </div><? }else{ ?>
    <div align="right"><? if($username) { ?><a  class="estilo2v3blackw" title="Este eres tu">¡Hola! <strong><? echo($uname); ?> </strong></a>&nbsp;&nbsp;<a href="/micuenta"  class="estilo2v3blackw" style="cursor:pointer; text-decoration:underline;">Mi Cuenta</a>&nbsp;&nbsp;<a href="logout.php?return=<? print($pre_url); ?>"  class="estilo2v3blackw" style="cursor:pointer; text-decoration:underline;">Salir</a><? }else{ ?><a id="testclick1" class="estilo2v3blackw" style="cursor:pointer;"><strong>iniciar sesion</strong> -</a><a id="testclick2"  class="estilo2v3blackw" style="cursor:pointer;">&nbsp;<strong>crear cuenta</strong></a><? } ?>	</div>
    <? } ?>	</td>
    <td width="" bgcolor="#CC3333" style="border-bottom-width:4px; border-bottom-style:solid;border-bottom-color:#CCCCCC;">&nbsp;		</td>
    </tr>
    <tr>
    <td></td>
    <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td colspan="2"><div>
        <p><span class="textorojo3">Vaya! La pagina que buscas no existe.<br />
        </span><span class="estilo2v3black">Quizas te sirva con esto: </span></p>
        <p><span class="textorojo3">
          <? include("last_searchs_cached.php"); ?>
          <br />
        </span></p>
      </div></td>
    </tr>
    </table>
<script type="text/javascript">
	T$('testclick1').onclick = function(){TINY.box.show('login.php?return=<? print($pre_url); ?>',1,400,200,1,90)}
	T$('testclick2').onclick = function(){TINY.box.show('reg_form.php',1,600,500,1,600)}
	T$('registrar2').onclick = function(){TINY.box.show('reg_form.php',1,600,500,1,600)}
	</script>
</body>
</html>