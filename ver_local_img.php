<?
//Ver imagenes subidas por usuarios de un sitio
$cols=3;
$i=0;
$verim=mysql_query("SELECT * FROM markers_foto WHERE local_id = '$id' ;");
$numim=mysql_num_rows($verim);
if($numim>0){
?>

<?

print("<p><span class='new2'>Fotos de usuarios:</span></p>");
    while ($ima=mysql_fetch_array($verim)){
		$id_img=$ima['id'];
		$ruta_img=$ima['image'];
		$user_img=$ima['username'];
		$time_img=$ima['timestamp'];
		if(fmod($i,$cols)==0 && $i>0){
		print("<br/><br/>");	
		}
		
		?>
        <a>
        <img id="imag<? echo($id_img);?>" src="resize_image.php?image=<? echo($ruta_img);?>&amp;new_width=50&amp;new_height=50" style="cursor:pointer;border:1px solid #ccc;margin:5px 5px 5px 5px;"  onclick="javascript:MM_openBrWindow('<? echo($ruta_img);?>' , 'imagen' , 'left=20,top=20,width=450,height=450,toolbar=0,resizable=1,scrollbars=yes');" title="Subida por <? print($user_img); ?>">&nbsp;
        </a>
<?
$i++;
    }
?>

<?
}

?>