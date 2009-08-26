<?
//Revisa las ultimas busquedas para extraer las mas comunes

$get_bus=mysql_query("SELECT COUNT( `busqueda` ) , `busqueda` FROM `busquedas` GROUP BY `busqueda` ORDER BY COUNT( `busqueda` ) DESC LIMIT 0 , 12 ");
$i==0;
while($fbus=mysql_fetch_array($get_bus)){
$tbus=$fbus['busqueda'];
			if($tbus!=''){
			printf('<a class="invitado_home" id="tag'.$i.'" href="buscando.php?p='.$tbus.'">'.$tbus.'</a>&nbsp;');
			$i++;
			}

}
?>
