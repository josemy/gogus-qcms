<?
//Guardar IMG
session_start();
$username=$_SESSION['username'];
require("config.php");
$filefile=$_FILES['foto']['name'];
$urrl="local_img/".$filefile;
$time=time();
$id=$_GET['id'];

//Borra la cache de las fotos:
require_once("cachelite/Lite.php");
$options = array( 
"cacheDir" => "cachelite/", 
"lifeTime" => 0
); 
$objCache = new Cache_Lite($options); 
$objCache->remove("last_img");
//
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

mysql_query("INSERT INTO  `markers_foto` (
`id` ,
`local_id` ,
`image` ,
`username` ,
`timestamp`
)
VALUES (
NULL ,  '".$id."',  '".$urrl."',  '".$username."',  '".$time."'
);");
$ver_todoo=mysql_query("SELECT * FROM markers WHERE id = '$id' ;");
while ($prodroww=mysql_fetch_array($ver_todoo)){
	$iddd=$prodroww['id'];
	$tit=$prodroww['titulo_f'];
}
print("<script>document.location.href='sitio/".$tit."'</script>");


?>