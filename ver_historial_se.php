<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
<?php
//Ver historial de un articulo
require("config.php");
$id=$_GET['id'];
$ver_todo=mysql_query("SELECT * FROM markers_journaling WHERE id_real = '$id' ;");
while ($prodrow=mysql_fetch_array($ver_todo)){
	$user=$prodrow['user_modif'];
	$ip=$prodrow['ip_modif'];
	$time=$prodrow['save_time'];
	if($user=="Anonimo"){
	$user=$user." (".$ip.")";	
	}
	date_default_timezone_set('Europe/London'); 
	$time=date("j-m-Y H:i A",$time);
?>

  <tr>
    <td>(ver) - <? echo($time); ?> - <? echo($user);?> - reportar abuso </td>
  </tr>
  
  <?
  }
  ?>
</table>