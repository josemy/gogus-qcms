<div id="menu_chachi">
<table border="0" cellpadding="2" cellspacing="5">
  <tr>
    <td align="center" ><a href="add_local.php" ><img src="images/normal/001_01.png" height="24px" width="24px" title="Añadir Local" alt="Añadir Local" style=" cursor:pointer; border:none;" /></a></td>
    <td align="center"><a href="micuenta"><img src="images/normal/001_55.png" onclick="location.href='add_local.php'" height="24px" width="24px" title="Buscar" alt="Buscar" style=" cursor:pointer; border:none;" / /></a></td>
    <td align="center"><a href="favoritos"><img src="images/normal/001_15.png" height="24" width="24" title="Buscar" alt="Buscar" style=" cursor:pointer; border:none;"  /></a></td>
    <td align="center"><img src="images/normal/001_07.png" height="24" width="24" title="Buscar" alt="Buscar" id="sorpre1" style="cursor:pointer;" /></td>
  </tr>
  <tr>
    <td align="center"><a class="textofootres3" href="add_local.php">añadir restaurante</a></td>
    <td align="center"><a href="micuenta" class="textofootres3">mi cuenta</a></td>
    <td align="center"><a class="textofootres3"  href="favoritos">mis favoritos</a></td>
    <td align="center"><a class="textofootres3" id="sorpre2" style="cursor:pointer;">sorprendeme!</a></td>
  </tr>
</table>
</div>
<script type="text/javascript">
T$('sorpre1').onclick = function(){TINY.box.show('sorpreme.php',1,600,150,1,600)}
T$('sorpre2').onclick = function(){TINY.box.show('sorpreme.php',1,600,150,1,600)}
</script>