<?
$ahora=time();
$er=$_SESSION['e'];
$error="Error de localizacion";
if($er=="1"){
$error="Error de acceso, clave erronea";	
}
mysql_query("INSERT INTO `quecome_quecomes`.`errores` (
`id` ,
`username` ,
`error` ,
`timestamp` ,
`tratado`
)
VALUES (
NULL , '$username', '$error', '$ahora', '0'
);");
$_SESSION['e']="";
?>