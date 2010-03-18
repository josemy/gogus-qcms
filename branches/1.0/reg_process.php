<?php
session_start();   //start the session for the page
error_reporting(0);
include("config.php");


//Check if page was entered by a submit button
$username=$_POST['username']; //Get username                                                   !!FROM FORM!!
$username = ereg_replace(" ", "", $username); //take away all spaces from username (if any)    !!FROM FORM!!
$username = strtolower($username);
$name=$_POST['name']; //Get name                                                               !!FROM FORM!!
$email=$_POST['email']; //Get email                                                            !!FROM FORM!!
$email = ereg_replace(" ", "", $email); //take away all spaces from email (if any)             !!FROM FORM!!
$password=$_POST['password']; //Get password
$confirmpassword=$_POST['confirmpassword']; //Get confirmpassword
$direccion=$_POST['cp'];
$provin=$_POST['prov'];
$cpost=$_POST['cp'];

$telf=$_POST['telf'];
$paypal=$_POST['paypal'];
$local=$_SESSION['ezopin_local'];
$_SESSION['_username']=$_POST['username'];
$_SESSION['_email']=$_POST['email'];
$_SESSION['_name']=$_POST['name'];
if (isset($_POST['submit'])){
$_SESSION['captchatxt']=$_POST["texto_ingresado"];
$_SESSION['usering']=$_POST['username'];
$_SESSION['maili']=$_POST['email'];
$_SESSION['nombree']=$_POST['name'];
$_SESSION['promocode']=$_POST['promocode'];
$_SESSION['cp']=$_POST['cp'];
$_SESSION['telf']=$_POST['telf'];
$_SESSION['paypal']=$_POST['paypal'];
$num_carac=strlen($username);
if ($num_carac > 2) {
		//echo "Usted ingreso el codigo correctamente.";
	} else {
		  printf("<script>document.location.href='index.php?item=REG_KO&reg_error=TOO_SHORT'</script>;");
	die("");
	}
//Logins prohibidos
$logpro=mysql_query("SELECT * FROM blacklogins WHERE login='$username'");
$logproh=mysql_num_rows($logpro);
if ($logproh > 0){
			  printf("<script>document.location.href='index.php?item=REG_KO&reg_error=ALREADY_REG'</script>;");
	die("");
	}
//Validación de email
include('EmailAddressValidator.php');
$validator = new EmailAddressValidator;
if ($validator->check_email_address($email)) { 
    // Email address is technically valid 
} else {
    // Email not valid
	printf("<script>document.location.href='index.php?item=REG_KO&reg_error=INVALID_MAIL'</script>;");
	die("");
}
//fin
//Logins prohibidos

	$texto_ingresado = $_POST["texto_ingresado"];
	//$captcha_texto = $_SESSION["captcha_texto_session"];
	$security=$_SESSION['captcha'];

	if ($texto_ingresado == $security) {
		//echo "Usted ingreso el codigo correctamente.";
	} else {
	printf("<script>document.location.href='index.php?item=REG_KO&reg_error=CAPTCHA_ERROR'</script>;");
	die("");
	}
  //if all required feilds have been entered, continue
  if($username && $email && $password && $confirmpassword){
   if($password == $confirmpassword){
    $sql="SELECT * FROM usuarios WHERE username='$username'"; //get rows where the username or email address is allready registered
    $secondsql="SELECT * FROM usuarios WHERE email='$email'"; //get rows where the username or email address is allready registered
    $result=mysql_query($sql);
    $secondresult=mysql_query($secondsql);
      if (mysql_num_rows($secondresult) > 0){
	  printf("<script>document.location.href='index.php?item=REG_KO&reg_error=EMAIL_ALREADY_REG'</script>;");
      die();
      }
            if (mysql_num_rows($result) > 0){
	      printf("<script>document.location.href='index.php?item=REG_KO&reg_error=USERNAME_ALREADY_REG'</script>;");
      die();
      }
      $password=md5($password.$mdkey);
      srand ((double) microtime( )*1000000);
      $random=rand(10000,100000000);
	  $hoy = date("d.m.y"); 
	$fecha =  $hoy;
   mysql_query("INSERT INTO `usuarios` (`id` ,`username` ,`password` ,`active` ,`name` ,`mail` ,`telf` ,`direccion` ,`timestamp` ,`unique` ,`locale` ,`changepwd` ) VALUES ('', '$username' , '$password', 'yes', '$name' , '$email' , '$telf' ,'$direccion' , '$fecha' , '$random' , 'ES' , 'no');");

	
$tiempom=time();

   //simula un login para no confundira compruebausers.php
    $hoyo = date("y.m.d"); 
	$fechaa =  $hoyo;
	$times=time();
	mysql_query("INSERT INTO `lastlogon` ( `username` , `last`) VALUES ('$username', '$fechaa') ON DUPLICATE KEY UPDATE  last='$fechaa';");
   //
//mensaje de bienvenida
$to = $email;
$subject = "Bienvenido a QueComes!?";
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
	font-size: 14px;">Bienvenido a Quecom.es!!</p>
<p  style="font-family: Arial, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 14px;">Gracias por probar el nuevo sistema de busqueda de restaurantes.</p>
<p>&nbsp;</p>
<p  style="font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;">Aun estamos en pruebas, por favor, si encuentras algun fallo, comunicalo a</p> <p  style="font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;
	color:#0033CC">info@quecom.es </p>
	
<table width="100%" border="0" bgcolor="#0066a7">
  <tr>
    <td><img src="http://quecom.es/des/images/logo_qcms.png" alt="quecom.es" /></td>
  </tr>
</table>
</body>
</html>
';
mail($to, $subject, $body, $cabeceras);

//Crear directorio del usuario con permisos 777

  printf("<script>document.location.href='index.php?item=Ok.'</script>;");
	   }else{
  	printf("<script>document.location.href='index.php?item=REG_KO&reg_error=PASS_ERROR'</script>;");
	die("");
  die();
  }
  }else{
  printf("<script>document.location.href='index.php?item=REG_KO&reg_error=UNHANDLED_ERROR'</script>;");
   //echo "Debe rellenar todos los campos para poder continuar!";
  die();
  }
}
$regerr=$_GET['error'];
$menos3=$_GET['menos3'];
$passs=$_GET['nopass'];


?>


