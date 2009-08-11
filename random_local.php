<?

$ver_id=mysql_query("SELECT * FROM recomendado WHERE id = '1';");
$gett=mysql_fetch_array($ver_id);
$r_id=$gett['r_id'];
$ver_todo=mysql_query("SELECT * FROM markers WHERE id = '$r_id' ;");
    while ($prodrow=mysql_fetch_array($ver_todo)){
$direcc=$prodrow['address'];
$descri=$prodrow['name'];
$coord=$prodrow['lat'];
$coord=$coord.",".$prodrow['lng'];
$latt=$prodrow['lat'];
$lonn=$prodrow['lng'];
$long=$prodrow['descripcion'];
$vlong=$prodrow['desc_long'];
$img=$prodrow['image'];
if($img==''){
$img="random.jpg";	
}
$ph=$prodrow['phone'];
	}
	
	$vlong=substr($vlong,0,400);

?>
<table width="100%" border="0" cellpadding="4" cellspacing="4">
  <tr>
    <td colspan="2" align="left"><a class="invitado_home2"><strong>quecomes! recomienda:</strong></a><br />
</td>
  </tr>
  <tr>
    <td width="19%" rowspan="2"><img src="resize_image.php?image=<? echo($img);?>&amp;new_width=130&amp;new_height=130"></td>
    <td width="81%" align="left"><a class="invitado_home2" href="ver_local.php?id=<? echo($r_id);?>"><strong><? echo($descri);?></strong></a></td>
  </tr>
  <tr>
    <td align="left" valign="top"><span class="textorecpeq"><? echo($vlong);?></span><br /><span class="textofootres3"><? echo($direcc."&nbsp;&nbsp;&nbsp;".$ph);?></span>
</td>
  </tr>

</table>
