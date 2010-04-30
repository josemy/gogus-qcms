<?
//Mail Send
//
//Enviar reseñas por mail
session_start();
include("config.php");
$dest = $_POST['mail'];
$local_id = $_GET['id'];
$time=time();
$username=$_SESSION['username'];
$verlocal=mysql_query("SELECT * FROM markers WHERE id = '$local_id' LIMIT 1");
$dato=mysql_fetch_array($verlocal);
$nombre=$dato['name'];
$direcc=$dato['address'];
$city=$dato['city'];
$titulo_f=$dato['titulo_f'];

//Envia el mail!
$to = $email;
$subject = "Reseña de sitio en QueComes!?";
$cabeceras .= "From: quecom.es <info@quecom.es>\n";
$cabeceras .= "MIME-Version: 1.0\n";
$cabeceras .= "Content-type: text/html; charset=UTF-8\n"; 
$body='<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
</head>

<body>
<p  style="font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;">Hola!!!</p>
<p  style="font-family: Arial, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 14px;">Estos son los datos del sitio que has pedido:</p>
<p  style="font-family: Arial, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 14px;">&nbsp;</p>
<p  style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 14px;">'.$nombre.'</p>
<p  style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;">'.$direcc.' - '.$city.'</p>
<p  style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;">www.quecom.es/sitio/'.$titulo_f.'</p>
<p  style="font-family: Arial, Helvetica, sans-serif;  font-size: 14px;">&nbsp;</p>
<p>&nbsp;</p>
<table width="100%" border="0" bgcolor="#CC3333">
  <tr>
    <td><img src="http://quecom.es/des/images/logo_qcms.png" alt="quecom.es" /></td>
  </tr>
</table>
</body>
</html>
';
mail($dest, $subject, $body, $cabeceras);
mysql_query("INSERT INTO `mail_log` (
`id` , `destino` ,
`mensaje` ,
`time` ,
`user`
)
VALUES (
NULL , '$dest' , '$titulo_f', '$time', '$username'
);");
printf("<script>document.location.href='pre_mail.php?status=OK'</script>;");
?>