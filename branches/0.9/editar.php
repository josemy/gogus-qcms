<?php
require("config.php");
$filefile=$_FILES['foto']['name'];
$urrl="local_img/".$filefile;
echo("Guardando...");
if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
   
   //copy($HTTP_POST_FILES['filename']['foto'], $HTTP_POST_FILES['filename']['tmp_name']);
   
     copy($_FILES['foto']['tmp_name'], $urrl);
     $subio = true;
   }
   
   $name = $_POST['nombre'];
$address = $_POST['direcc'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$type = $_GET['type'];
$desc=$_POST['desc'];
$ldesc=str_replace(chr(13),"<br>",$_POST['ldesc']);
$precio=$_POST['precio'];
$web=$_POST['web'];
$tipo_co=$_POST['tipo_co'];
$etiq=$_POST['etiq'];
$phone=$_POST['phone'];
$image=$urrl;
$ip=$_SERVER['REMOTE_ADDR'];
$time=time();
$user=$_SESSION['username'];
$idd=$_POST['nid'];
$motiv=$_POST['motiv'];
if($user==''){
$user="Anonimo";	
}
		$ver_todo=mysql_query("SELECT * FROM markers WHERE id = '$idd' ;");
			while ($prodrow=mysql_fetch_array($ver_todo)){
				$images=$prodrow['image'];
			}
if($image=="local_img/"){
$image=$images;
}
//Guardamos la version anterior en el journaling

$query = sprintf("INSERT INTO markers_journaling " .
         " (`id`, `ip_modif` , `user_modif` , `save_time` , `id_real`, `name`, `address`, `lat`, `lng`, `type`, `image`, `precio_medio`, `puntuacion`, `descripcion`, `desc_long`, `reserva_onl`, `tipo_cocina`, `web`, `tags` , `phone` , `motivo`) " .
         " VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' , '%s' , '%s', '%s', '%s', '%s', '%s' , '%s');",
         mysql_real_escape_string($ip),
         mysql_real_escape_string($user),
         mysql_real_escape_string($time),
		 mysql_real_escape_string($idd),
         mysql_real_escape_string($name),
         mysql_real_escape_string($address),
         mysql_real_escape_string($lat),
         mysql_real_escape_string($lng),
         mysql_real_escape_string($type),
		 mysql_real_escape_string($image),
		 mysql_real_escape_string($precio),
		 mysql_real_escape_string($punt),
         mysql_real_escape_string($desc),
         mysql_real_escape_string($ldesc),
         mysql_real_escape_string($res_on),
		 mysql_real_escape_string($tipo_co),
         mysql_real_escape_string($web),
         mysql_real_escape_string($etiq),
		 mysql_real_escape_string($phone),
		 mysql_real_escape_string($motiv));

$result = mysql_query($query);

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

//Ahora guarda la nueva version

$resulta=mysql_query("UPDATE `markers` SET `descripcion` = '$desc', `reserva_onl` = 'si' , `desc_long` = '$ldesc' , `precio_medio` = '$precio' , `web` = '$web' , `tipo_cocina` = '$tipo_co' , `tags` = '$etiq' , `phone` = '$phone' , `image` = '$image' WHERE `markers`.`id` ='$idd' LIMIT 1 ;");
   
if (!$resulta) {
  die('Invalid query: ' . mysql_error());
}

print("<script>document.location.href='ver_local.php?id=".$idd."'</script>");
?>