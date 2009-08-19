<? 
if (isset($_POST['submit'])){
include("db.php");

$username=$_POST['usu'];
  $sql="SELECT * FROM usuarios WHERE username='$username'"; //get rows where the username feild matches the username or email feild in the database with same password
      $result=mysql_query($sql);
      //check to see if the account is activated
      $moorow=mysql_fetch_array($result);
	  $email=$moorow['mail'];
	  $act=$moorow['unique'];
	  $act=md5($act);
	   if (mysql_num_rows($result) > 0){
	   $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$cabeceras .= 'From: ezopin.com@ezopin.com' . "\r\n" .
    'Reply-To: info@ezopin.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	$to = "$email";
$subject = "recuperar contraseña // ezopin.com";
  $body = "para recuperar la contraseña del usuario $username debe visitar este enlace: http://ezopin.com/ezopin/recupass.php?var=$username&cod=$act";
  //send confirmation email to the user to activate their account via a link
 mail($to, $subject, $body, $cabeceras);
//echo"tu clave de acceso ha sido enviada a $email";
printf("<script>document.location.href='index.php?action=info&item=Se ha enviado un email a (".$email.") para cambiar el password.'</script>;");

//echo "$body";
}else{
//echo "el usuario no existe";
printf("<script>document.location.href='index.php?action=info&item=El usuario (".$username.") no existe en ezopin.'</script>;");

 }
 }
 ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ezopin | recuperar contraseña |</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="stylepeta.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0" class="boxboxlighte">
  <tr>
    <td><div align="left" class="invitado_home2">recuperar password de acceso </div></td>
  </tr>
  <tr>
    <td><div align="left">
        <span class="nowp2" style="font-size: 11px;">introduce tu nombre de usuario y pulsa enviar </span></div></td>
  </tr>
    <tr>
  <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">
      <form n method="POST" action="get_pass.php">
        <input name="usu" type="text" class="textbox" id="usu">
        &nbsp;
        <input name="submit" type="submit" class="textbox" id="submit" value="Enviar">
&nbsp;&nbsp;
        </form>
    &nbsp;</div></td>
  </tr>
</table>
</body>
</html>
