<?
//Script para obtener la prioridad de en la cola de busqueda.
//
//
include("config.php");
echo("<h3>CALCULO DE PRIORIDAD PARA BUSCADOR - QueComes!?</h3>");
$ver_todo=mysql_query("SELECT * FROM markers ORDER BY ID ASC;");
		 while ($prodrow=mysql_fetch_array($ver_todo)){
				$id=$prodrow['id'];
				$direcc=$prodrow['address'];
				$descri=$prodrow['name'];
				$coord=$prodrow['lat'];
				$coord=$coord.",".$prodrow['lng'];
				$latt=$prodrow['lat'];
				$lonn=$prodrow['lng'];
				$long=$prodrow['descripcion'];
				$vlong=$prodrow['desc_long'];
				$img=$prodrow['image'];
				$tipoco=$prodrow['tipo_cocina'];
				$tags=$prodrow['tags'];
				$punt=$prodrow['puntuacion'];
				
echo("iniciando el calculo de prioridad  al sitio ".$descri." ".$id."<br>");
$prioridad=1;
//Segun lo completo del sitio suma puntos
		if (strlen($long)>1){
		$prioridad=$prioridad+1;
		}
		if (strlen($img)>1){
		$prioridad=$prioridad+1;
		}
 		if (strlen($vlong)>1){
		$prioridad=$prioridad+1;
		}
 		if (strlen($tags)>1){
		$prioridad=$prioridad+1;
		}
		$prioridad=$prioridad+$punt;
 echo(" + Puntuacion de contenido: ".$prioridad."<br>");
		 $ver_log=mysql_query("SELECT * FROM logs WHERE motivo = '$id' ;");
		 $num_log=mysql_num_rows($ver_log);
		 echo($num_log);
					 if($num_log>5){
					 $prioridad=$prioridad+1;
					 }
					  if($num_log>10){
					 $prioridad=$prioridad+4;
					 }
					  if($num_log>100){
					 $prioridad=$prioridad+10;
					 }
  echo(" + Puntuacion de visitas: ".$prioridad."<br>");
 		 $ver_fav=mysql_query("SELECT * FROM favoritos WHERE local_id = '$id' ;");
		 $num_fav=mysql_num_rows($ver_fav);
		 echo($num_fav);
					 if($num_fav>5){
					 $prioridad=$prioridad+1;
					 }
					  if($num_fav>10){
					 $prioridad=$prioridad+4;
					 }
					  if($num_fav>100){
					 $prioridad=$prioridad+10;
					 }
   echo(" + Puntuacion de favoritos: ".$prioridad."<br>");
 
 echo(" Total:".$prioridad."<br>");
 
 //Ahora subelo.
 mysql_query("UPDATE `quecome_quecomes`.`markers` SET `priority` = '$prioridad' WHERE `markers`.`id` ='$id' LIMIT 1 ;");
 
 		}


?>