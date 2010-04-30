<table width="220">
<tr>
<td>
<?
if($descrilarga==true){
$limitel=5;
}else{
$limitel=2;
}

$ver_todo=mysql_query("SELECT *,(acos(sin(radians(lat)) * sin(radians(".$latt.")) + 
cos(radians(lat)) * cos(radians(".$latt.")) * cos(radians(lng) - radians(".$lonn."))) * 6378) as 'AA' FROM `markers` WHERE (acos(sin(radians(lat)) * sin(radians(".$latt.")) + cos(radians(lat)) * cos(radians(".$latt.")) * cos(radians(lng) - radians(".$lonn."))) * 6378) < '3000' AND `id`  NOT LIKE '".$id."' ORDER BY `AA` ASC LIMIT ".$limitel.";");

 while ($prodrow=mysql_fetch_array($ver_todo)){
		$iid_n=$prodrow['id'];
$direcc_n=$prodrow['address'];
$citz_n=$prodrow['city'];
$descri_n=$prodrow['name'];
$coord_n=$prodrow['lat'];
$coord_n=$coord_n.",".$prodrow['lng'];
$sitio_latt_n=$prodrow['lat'];
$sitio_lonn_n=$prodrow['lng'];
$city_n=$prodrow['city'];
if($city_n){
$get_prov_n=mysql_query("SELECT provincia FROM localidades WHERE localidad = '$city_n' LIMIT 1");
$get_prova_n=mysql_fetch_array($get_prov_n);
$provincia_n=$get_prova['provincia'];
}
$long_n=$prodrow['descripcion'];
$vlong_n=$prodrow['desc_long'];
if($vlong_n){
		if(strlen($vlong_n)>200){
			$vlong=mb_substr($vlong_n,0,200)."...";
		}else{
			$vlong_n=$vlong_n;
		}
}
if($vlong_n==''){
$vlong_n="Este local aun no tiene descripci&oacute;n. &iquest;Lo conoces? Entra y comentalo.";
}
$vlong_n=str_replace("<br>","",$vlong_n);
$web_n=$prodrow['web'];
$punt_n=$prodrow['puntuacion'];
$img_n=$prodrow['image'];
$telf_n=$prodrow['phone'];
$titulo_f_n=$prodrow['titulo_f'];

if($img_n==''){
$img_n="random.jpg";	
}
if($img_n=='local_img/'){
$img_n="random.jpg";	
}
	if(strlen($web_n)>1){
		if(strlen($web_n)>50){
			$webl_n=substr($web_n,0,47)."...";
		}else{
			$webl_n=$web_n;
		}
		$web_n=str_replace("http://","",$web_n);
	}else{
		$webl_n="";
	}
	
	$distancia_n=geo_distance($sitio_latt_n,$sitio_lonn_n,$latt,$lonn);
	if($distancia_n<1){
	$distancia_n=round(($distancia_n*1000),0)." metros";		
	}else{
	$distancia_n=$distancia_n." kms";	
	}

if($long_n!=""){
	
		if(strlen($long_n)>30){
			$long=substr($long_n,0,27)."...";
		}

$divtit_n='<div style="height:15px;" class="estilo2v3"><b>'.$long_n.'</b></div>';
}else{
$divtit_n="";	
}
$type_n=$prodrow['type'];
if($vlong_n!=""){
	
		if(strlen($vlong_n)>30){
			$vlong_n=substr($vlong_n,0,27)."...";
		}
}
if($type_n){
	$verty_n=mysql_query("SELECT * FROM tipos_locales WHERE id = '$type_n'");
	$vertya_n=mysql_fetch_array($verty_n);
	$typen_n=$vertya['nombre'];
	if($typen_n!=""){
	$divtip_n='<div style="height:18px;"><b><a class="estilo2v3">Categoria: '.$typen_n.'</a></b></div>';
	}
}

//
if(strlen($direcc_n)>50){
	$direcc_n=substr($direcc_n,0,47)."...";
}
//sitios
?>
<table onmouseover="this.className='over'" onmouseout="this.className='norm'" onclick="document.location.href('http://quecom.es/sitio/<? print($titulo_f_n);?>');">
  <tr  >
  <td width="7%" rowspan="3" valign="top" onMouseOver="" style="cursor:pointer;">  <? print('<img src="resize_image.php?image='.$img_n.'&amp;new_width=75&amp;new_height=75" alt="" style="cursor:pointer;"'); ?> onclick="document.location.href='sitio/<? echo($titulo_f_n); ?>'" /></td>
    <td style="cursor:pointer;"><? print('<a class="estilo2v3" href="sitio/'.$titulo_f_n.'"><strong>'.$descri_n.'</strong></a><br><span class="new2"><a class="new2" href="buscando.php?p='.$city_n.'" target="_blank">'.$city_n.'</a>&nbsp;<a href="buscando.php?p='.$provincia_n.'">'.$provincia_n.'</a></span>'); ?></td>
  </tr>
  <tr>
    <td width="93%" style="cursor:pointer;"><? print('<span class="textofootres3">'.$direcc_n.'</span><br><a class="estilo2v3"><strong>'.$telf_n.'</strong></a>'); ?></td>
  </tr>
  <tr>
    <td style="cursor:pointer;"><? print('<a class="textofootres6"><strong>a '.$distancia_n.'</a>'); ?></td>
  </tr>
  <tr>
    <td colspan="2" style="cursor:pointer;"></td>
  </tr>
</table>
<?



//Fin





 }
?>
</td>
</tr>
<tr>
<td><a class="new2" href="buscando.php?lo=<? echo($lonn); ?>&la=<? echo($latt); ?>&city=<? echo($location["City"]); ?>" target="_blank"><u>ver mas</u></a></td>
</tr>
</table>