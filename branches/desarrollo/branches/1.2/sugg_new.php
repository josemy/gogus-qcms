<? 
header("Content-Type: text/html; charset=utf8\n");
include("config.php");
//que detecte los kms a los que estoy?
$q=$_GET['q'];
if(strlen($q)>2){
	
	if($modo1){
				//Modo de busqueda 1 - (por nombre de restaurante)
						$res=mysql_query("SELECT * FROM markers WHERE name LIKE '$q%%' ORDER BY priority DESC LIMIT 5");
						$num=mysql_num_rows($res);
						if($num>0){
						?>
						<div style="filter:alpha(opacity=95); opacity: 0.95;z-index: 1;	border: 3px solid  #FFFFFF;	background-color:#EEEEEE;border-top: 3px solid  #EEEEEE; padding:2px;" >
						<?
						
						while($verr=mysql_fetch_array($res)){
						$nombre=$verr['name'];	
						$adr=$verr['address'];	
						$titu=$verr['titulo_f'];	
						$nombre = eregi_replace( "".htmlentities($q)."", "<b>".htmlentities($q)."</b>", $nombre );
						//$nombre = str_replace ( htmlentities($q), "<b>$q</b>", htmlentities($nombre)); 
						print("<a href='sitio/".$titu."' class='nowp4'><u>".$nombre."</u></a><br><a class='nowp2'>".$adr."</a><br><br>");
						}
						
						?>
						</div>
						<?
						}
				//FIN
	}else{
			//Modo de busqueda 2 - (por otras busquedas)
						$res=mysql_query("SELECT count(*),busqueda FROM `busquedas` WHERE `busqueda` LIKE '$q%' GROUP BY busqueda ORDER BY count(*) DESC LIMIT 5");
						$num=mysql_num_rows($res);
						if($num>0){
						?>
						<div id="suggest" style="filter:alpha(opacity=95); opacity: 0.95;z-index: 1;	border: 3px solid  #FFFFFF;	background-color:#EEEEEE; border-top: 3px solid  #EEEEEE; padding:2px;">
						<?
						
						while($verr=mysql_fetch_array($res)){
						$nombre=$verr['busqueda'];	
						$adr=$verr['count(*)'];	
						
						//$nombre = eregi_replace( "".htmlentities($q)."", "<b>".htmlentities($q)."</b>", $nombre );
						//$nombre = str_replace ( htmlentities($q), "<b>$q</b>", htmlentities($nombre)); 
						if($adr>1){
						$cadena="personas buscaron esto";	
						}else{
						$cadena="persona busco esto";		
						}
						?>
                        <div id='sugg1' class="suggClass2" onmouseover="this.className='suggClass'" onmouseout="this.className='suggClass2'" style="padding:2px;" onclick="document.location.href='buscando.php?p=<? echo($nombre); ?>'">
                        <?
						print("<a href='buscando.php?p=".$nombre."' class='nowp4'><u>".$nombre."</u></a><br><a class='nowp2'>".$adr." ".$cadena.".</a>");
						?>
                        </div>
                        
                        <?
						}
						
						?>
						</div>
						<?
						}
				//FIN		
		
		
	}
}
		?>