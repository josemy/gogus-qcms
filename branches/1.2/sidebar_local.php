
<div id="sidebar_container" >
  <div id="title_1"><span class="new2">Sitio descubierto por:</span></div>
  <div class="content_1"><table  border="0">
  <tr>
    <td><img src="<? echo($avatar_link); ?>" alt="Usuario"  title="Usuario" /></td>
    <td>&nbsp;</td>
    <td valign="middle"><span class="new5"><? print($mediouser); ?></span></td>
  </tr>
</table>
  </div>
  <?
$num_c=mysql_query("SELECT * FROM favoritos WHERE local_id = '$id' ;");
		$count_f=mysql_num_rows($num_c);
		
		if($count_f==1){
		$wordusu="usuario";
		$favo=true;
		}
		if($count_f>1){
		$wordusu="usuarios";
		}
		if($count_f>0){
		
		$ver_usf=mysql_query("SELECT * FROM `favoritos` WHERE `local_id` = '$id' LIMIT 3;");
		while($arr_ffa=mysql_fetch_array($ver_usf)){
		$newusu=$arr_ffa['username'];
		$usuarios=$usuarios." ".$newusu;
		}
		if($count_f>3){
		$count_neg=$count_f-3;
		$usuarios=$usuarios." y otros ".$count_neg." usuarios.";
		}else{
		$usuarios=$usuarios;
		}
		?>
  <div id="title_2"><span class="new2">Favorito de:</span></div>
  <div id="content_2">
 <table  border="0">
        <tr>
        <td><img src="images/normal/001_15.png" alt="Favoritos"  width="20" height="20"  title="Favoritos" /></td>
        <td>&nbsp;</td>
        <td valign="middle"><span class="new5" title="<? print($usuarios); ?>"><span class="new2"><? print($count_f); ?></span> <? print($wordusu); ?> </span></td>
        </tr>
    </table>
  </div><? }?>
  <div id="title_3"></div>
  <div id="content_3"><? include("ver_local_img.php"); ?></div>
  <div id="title_4"><span class="new2">Visitas:</span></div>
  <div id="content_4"><? include("stats_local.php"); ?></div>
  <div id="title_5"><span class="new2">Sitios Cercanos:</span></div>
  <div id="content_5" ><? include("sidebar_n2m.php"); ?></div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
