<?
//Cache
//Ver imagenes subidas por usuarios de un sitio
$cols=4;
$i=0;
$verim=mysql_query("SELECT id,local_id, image, username, timestamp FROM markers_foto ORDER BY id DESC LIMIT 12;");
$numim=mysql_num_rows($verim);
if($numim>0){
?>

<?

print("<p><span class='new2'>Ultimas fotos subidas:</span></p>");
    while ($ima=mysql_fetch_array($verim)){
		$id_img=$ima['id'];
		$local_id=$ima['local_id'];
		$ruta_img=$ima['image'];
		$user_img=$ima['username'];
		$time_img=$ima['timestamp'];
			$vername=mysql_query("SELECT titulo_f, name, city FROM markers WHERE id = '$local_id' LIMIT 1");
			$nam=mysql_fetch_array($vername);
			$ti=$nam['titulo_f'];
			$lnam=$nam['name'];
			$ci=$nam['city'];
		if(fmod($i,$cols)==0 && $i>0){
		print("<br/><br/>");	
		}
		
		?>
        <a>
        <img id="imag<? echo($id_img);?>" src="resize_image.php?image=<? echo($ruta_img);?>&amp;new_width=50&amp;new_height=50" style="cursor:pointer;border:1px solid #ccc;margin:5px 5px 5px 5px;"  onclick="document.location.href='sitio/<? print($ti); ?>'" title="<? print($lnam); ?> en <? print($ci); ?>">&nbsp;
        </a>
<?
$i++;
    }
}

?>