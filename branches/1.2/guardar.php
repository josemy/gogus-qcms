<?php
session_start();
$username=$_SESSION['username'];
require("config.php");
$filefile=$_FILES['foto']['name'];
$urrl="local_img/".$filefile;

if ($urrl!="local_img/"){
	$ran = rand(1,999999);
	$urrl="local_img/".$ran.$filefile;
}
//echo($filefile.$urrl);
echo("Guardando...");
if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
   
   //copy($HTTP_POST_FILES['filename']['foto'], $HTTP_POST_FILES['filename']['tmp_name']);
   
     copy($_FILES['foto']['tmp_name'], $urrl);
     $subio = true;
   }
// Gets data from URL parameters
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
$citz=$_POST['citz'];
$punt="0";
$res_on="si";
$image=$urrl;
$titulo_f=urls_amigables($name);
$time=time();
// Opens a connection to a MySQL server


// Insert new row with user data
$query = sprintf("INSERT INTO markers " .
         " (`id`, `name`, `address`, `lat`, `lng`, `type`, `image`, `precio_medio`, `puntuacion`, `descripcion`, `desc_long`, `reserva_onl`, `tipo_cocina`, `web`, `tags`, `medio_user` , `titulo_f` , `city`, `phone` , `time`) " .
         " VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' , '%s' , '%s' , '%s' , '%s' , '%s', '%s');",
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
		 mysql_real_escape_string($username),
		 mysql_real_escape_string($titulo_f),
		 mysql_real_escape_string($citz),
		 mysql_real_escape_string($phone),
		 mysql_real_escape_string($time));

$result = mysql_query($query);

if (!$result) {
  die('Invalid query: ' . mysql_error());
}
$ver_todoo=mysql_query("SELECT * FROM markers WHERE medio_user = '$username' ;");
while ($prodroww=mysql_fetch_array($ver_todoo)){
	$iddd=$prodroww['id'];
	$tit=$prodroww['titulo_f'];
}
print("<script>document.location.href='sitio/".$tit."'</script>");
?>
