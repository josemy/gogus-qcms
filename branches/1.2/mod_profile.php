<?
session_start();
include("config.php");
$username=$_SESSION['username'];
if(!$username){
die("Error: no has iniciado sesion.");	
}
$ver_datos=mysql_query("SELECT * FROM usuarios WHERE username = '$username' LIMIT 1");
$ver_user=mysql_fetch_array($ver_datos);
$nombre=$ver_user['name'];
$email=$ver_user['mail'];
$dir=$ver_user['direccion'];
$phone=$ver_user['telf'];


$avatar=$ver_user['avatar_img'];
$avatar_old=$avatar;
//Get avatar image
if($avatar==''){
$avatar="avatars/pq_default.PNG";

}

?>
<link href="css/general.css" rel="stylesheet" type="text/css">
<style type="text/css">
.new2 {font-size: 13px; font-family:arial,sans-serif; color: #0066cc;font-weight:bold;text-decoration:none;}
.new3 {font-size: 13px;  font-family:arial,sans-serif; color: #777eb3;text-decoration:none;}
.new4 {color: #090; font-family: arial,sans-serif; font-size: 11px; text-decoration: none; }
.new5 {font-size: 11px;  font-family:arial,sans-serif; color: #333;text-decoration:none;font-weight:bold;}
</style>
<p class="new1">Modificar tu perfil:</span></p>
<form action="guardar_profile.php" method="post" id="form1" name="form1" enctype="multipart/form-data">

    <label>
      <span class="new2">Nombre:</span></span><br>
      <input name="name" type="text" class="boxboxlighte" id="name" value="<? print($nombre); ?>">
      <br>
  </label>
    <br>
    <span class="new2">email:</span><br>
    <input type="text" name="email" id="email" class="boxboxlighte" value="<? print($email); ?>">
    </label>
    
    <label><br>
  </label>
    <br>
    <span class="new2">Ciudad:</span><br>
  <input type="text" name="city" id="city" class="boxboxlighte" value="<? print($dir); ?>">
  </label>
  <label><br>
  </label>
  <br>
    <span class="new2">Telf:</span><br>
  <input type="text" name="phone" id="phone" class="boxboxlighte" value="<? print($phone); ?>">
  </label>
  
  <p><span class="new2">Avatar:</span><br>
    <br>
    <img src="resize_image.php?image=<? echo($avatar);?>&amp;new_width=48&amp;new_height=48">
    <br>
    <br>
<input type="file" name="foto" id="foto" class="boxboxlighte">
  <input type="text" name="avatar_old" id="avatar_old" class="boxboxlighte" value="<? print($avatar_old); ?>" style="visibility:hidden;" />
  </p>
  <p>
    <label>
      <input type="submit" name="button" id="button" value="Guardar" />
    </label>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <label>
    <input type="button" name="button2" id="button2" value="Cancelar" onClick="javascript:TINY.box.hide()"/>
  </label>
  </p>
</form>
<p>&nbsp;</p>
