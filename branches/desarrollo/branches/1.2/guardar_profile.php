<?php
session_start();
$username=$_SESSION['username'];
require("config.php");
$filefile=$_FILES['foto']['name'];
$urrl="avatars/".$filefile;

if ($urrl!="avatars/"){
	$ran = rand(1,999999);
	$urrl="avatars/".$ran.$filefile;
}else{
$urrl=$_POST['avatar_old'];
	
}
//echo($filefile.$urrl);
echo("Guardando...");
if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
   
   //copy($HTTP_POST_FILES['filename']['foto'], $HTTP_POST_FILES['filename']['tmp_name']);
   
     copy($_FILES['foto']['tmp_name'], $urrl);
     $subio = true;
   }
// Gets data from URL parameters
$name = $_POST['name'];
$address = $_POST['city'];
$email=$_POST['email'];
$phone=$_POST['phone'];

$time=time();
// Opens a connection to a MySQL server



$resulta=mysql_query("UPDATE `usuarios` SET `name` = '$name', `direccion` = '$address' , `mail` = '$email' , `telf` = '$phone' , `avatar_img` = '$urrl'  WHERE `username` ='$username' LIMIT 1 ;");
   
if (!$resulta) {
  die('Invalid query: ' . mysql_error());
}

print("<script>document.location.href='/micuenta'</script>");
?>
