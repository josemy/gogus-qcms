<table  border="0" cellpadding="4" cellspacing="0" style=" left:2px" >
  <tr>
    <td width="50%" class="bordecajas"><a class="invitado_home2"><strong>Cerca de mi</strong></a></td>
    <td align="right" class="bordecajas"><img src="images/normal/001_08.png" style="cursor:pointer;" onclick="location.href='buscando.php?lo=<? echo($location["Longitude"]); ?>&la=<? echo($location["Latitude"]); ?>&city=<? echo($location["City"]); ?>'" height="24px" width="24px" title="Buscar cerca de mi" alt="Buscar cerca de mi" /></td>
  </tr>
  <tr>
    <td colspan="2" valign="top" align="left">
    <?
	$new_long=$location["Longitude"];
	$new_lat=$location["Latitude"];
	$city=$location["City"];
	$new_lat=substr($new_lat,0,3);
	$new_long=substr($new_long,0,4);
	$ver_todo=mysql_query("SELECT * FROM markers WHERE (lat LIKE '$new_lat%%' AND lng LIKE '$new_long%%') LIMIT 3 ;");
	
	$cuantos_re=mysql_num_rows($ver_todo);
	if($cuantos_re=="0"){
	print('
<table width="100%" border="0">
        <tr>
          <td><span class="textofootres3"><img src="images/normal/001_30.png" height="24px" width="24px" title="Error" alt="Error" /></span></td>
          <td class="textofootres3"><b> No hay sitios cercanos.</b><br />
Si conoces algun sitio que concuerde con esta zona, puedes subirlo </a><a class="textofootres4" href="add_local.php"><u>aqui</u></a>&nbsp;</td>
        </tr>
</table>
');
	}else{
	
				while ($prodrow=mysql_fetch_array($ver_todo)){
							$iid=$prodrow['id'];
							$direcc=$prodrow['address'];
							$descri=$prodrow['name'];
							$coord=$prodrow['lat'];
							$coord=$coord.",".$prodrow['lng'];
							$long=$prodrow['descripcion'];
							$vlong=$prodrow['desc_long'];
							$vlong=substr($vlong,0,100)."...";
							$web=$prodrow['web'];
							$precio=$prodrow['precio_medio'];
							$punt=$prodrow['puntuacion'];
					print_r("<p><a class='textofootres4' href='ver_local.php?id=".$iid."'><u><b>".$descri."</b></u></a><a class='textofootres3'> en ".$direcc."</a></p>");
					
				}
				
	}

	
	?>
	</td>
  </tr>
</table>
