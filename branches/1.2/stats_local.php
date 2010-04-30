<?
//Estadisticas de un local:
$time=time()-604800;
if($id){
$verid=mysql_query("SELECT * FROM logs WHERE motivo = '$id';");
$count_total=mysql_num_rows($verid);

print('<div><span class="new5">Visitas totales: '.$count_total.'</span></div>');

$cers=mysql_query("SELECT * FROM logs WHERE motivo = '$id' AND timestamp > '$time';");
$count_semana=mysql_num_rows($cers);

print('<div><span class="new5">Ultima semana: '.$count_semana.'</span></div>');
}
?>