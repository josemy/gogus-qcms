<?
$email=$_GET['email'];
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

?>