<?php
require("config.php");
$filefile=$_FILES['foto']['name'];
$urrl="local_img/".$filefile;
echo($filefile.$urrl);
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
$punt="0";
$res_on="si";
$image=$urrl;

// Opens a connection to a MySQL server


// Insert new row with user data
$query = sprintf("INSERT INTO markers " .
         " (`id`, `name`, `address`, `lat`, `lng`, `type`, `image`, `precio_medio`, `puntuacion`, `descripcion`, `desc_long`, `reserva_onl`, `tipo_cocina`, `web`, `tags`) " .
         " VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' , '%s');",
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
         mysql_real_escape_string($etiq));

$result = mysql_query($query);

if (!$result) {
  die('Invalid query: ' . mysql_error());
}
print("<script>document.location.href='index.php?estado=ok'</script>");
?>
