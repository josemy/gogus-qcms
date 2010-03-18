<html>
<head>
<title>QueComes!? | consola </title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<style type="text/css">
<!--
.Estilo1 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
</head>
<body>
<span class="Estilo1">
<? 

include("config.php");

$base = mysql_query("SELECT * FROM `usuarios`  ORDER BY id DESC LIMIT 20");


echo"<h3>ultimos 20 usuarios registrados</h3>";
while($result = mysql_fetch_array($base)) 
   	{

echo("- ".$result['username']."<br>");
}



echo"<h3>Ultimos Sitios subidos  </h3>";
$basepart = mysql_query("SELECT * FROM `markers`  ORDER BY id DESC LIMIT 20");
while($resulta = mysql_fetch_array($basepart)) {
$prod_id=$resulta['id'];
$user_id=$resulta['name'];
$status=$resulta['medio_user'];
$urr=$resulta['titulo_f'];

echo($prod_id." - ".$user_id." por:".$status."<a href='sitio/".$urr."'> ver </a><br>");
}
echo"<h3>Estadisticas totales</h3>";

 $hoy = date("d.m.y"); 

 $resultaa = mysql_query("SELECT * FROM usuarios WHERE timestamp='$hoy'");
$num_rowsaaa = mysql_num_rows($resultaa);
$userss=$num_rowsau;
 $resultata = mysql_query("SELECT * FROM usuarios");
$num_user_tot = mysql_num_rows($resultata);
	echo "$num_user_tot usuarios registrados ($num_rowsaaa) hoy";
	 $sms = mysql_query("SELECT * FROM sms_log");
$num_sms = mysql_num_rows($sms);
$precio="0.17";
$tottal=$num_sms*$precio;
	echo("<br>".$num_sms. " SMS Enviados. - Eres ".$tottal." € mas pobre.");
echo"<br>
<h3>Ultimos Movimientos</h3>";	
	  $resultaao = mysql_query("SELECT * FROM logs ORDER BY id DESC LIMIT 30 ");
while($resulta = mysql_fetch_array($resultaao)) {
$mo=$resulta['motivo'];
$us=$resulta['username'];
$ti=$resulta['timestamp'];
$ip=$resulta['ip'];
$host=$resulta['host'];
$vername=mysql_query("SELECT * FROM markers WHERE id = '$mo'");
$verna=mysql_fetch_array($vername);
$titulod=$verna['titulo_f'];
echo("<br>".$us." - ".$mo."(<a href='sitio/".$titulod."'>".$titulod."</a>) - ".$ti." - ".$ip." - ".$host);
}
	
	 $hoy = date("y.m.d"); 
 // $playshoy = mysql_query("select plays , count(*) as count FROM plays24 WHERE date = '$hoy' GROUP BY date  order by count ");
 $lastWeek = time() - (1 * 24 * 60 * 60);


	
echo"<h3>Informacion Tecnica</h3>";

?>
<pre>
<b>Uptime:</b>
<?php system("uptime"); ?>

<b>Informacion del sistema:</b>
<?php system("uname -a"); ?>

<b>Memoria (MB):</b>
<?php system("free -m"); ?>

<b>Uso de Disco:</b>
<?php system("df -h"); ?>

<b>CPU Info:</b>
<?php system("cat /proc/cpuinfo | grep \"model name\\|processor\""); ?>
<b>Procesos mySQL</b>
<? 

$enlace = mysql_connect('localhost', 'quecome_ezopin', 'ena10llo');
$status = explode('  ', mysql_stat($enlace));
print_r($status);

?>
</pre>
</span>
</body>
</html>
