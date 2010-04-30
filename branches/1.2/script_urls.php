<?
session_start();
include("config.php");
$ver_todo=mysql_query("SELECT * FROM markers ;");
    while ($prodrow=mysql_fetch_array($ver_todo)){
		$id=$prodrow['id'];
		$titulo_f=$prodrow['name'];
		$titulo_f=urls_amigables($titulo_f);
		$vsi=mysql_query("SELECT * FROM markers WHERE titulo_f = '$titulo_f' ;");
   		$nu=mysql_num_rows($vsi);
		if($nu > 0){
		$titulo_f=$titulo_f."-".$nu;	
		}
		mysql_query("UPDATE `quecome_quecomes`.`markers` SET `titulo_f` = '$titulo_f' WHERE `markers`.`id` ='$id' LIMIT 1 ;");
		echo("actualizado: ".$id." :".$titulo_f."<br>");
	}
?>