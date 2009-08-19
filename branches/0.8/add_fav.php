<?
//Añadir a Favoritos.
session_start();
include("config.php");
$favid=$_GET['fid'];
$username=$_SESSION['username'];
$ver_si=mysql_query("SELECT * FROM favoritos WHERE local_id = '$favid' AND username = '$username';");
$n_ver=mysql_num_rows($ver_si);
if($n_ver < 1){
//Ok, añadir
mysql_query("INSERT INTO `quecomes`.`favoritos` (`id` ,`local_id` ,`username` ,`comentario`)VALUES('' , '$favid', '$username', '');");
?>
<img src="images/normal/001_15.png" height="16" width="16" title="Es de mis favoritos!" alt="Es de mis favoritos!">
<?																								   }else{
//Fail, ya lo tienes en favoritos

}

?>