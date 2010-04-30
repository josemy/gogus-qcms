<?
//Gogus QueComes - www.quecom.es
//
//GoGus CB - 2009 - Codigo bajo licencia GPLv3. - Contenido bajo licencia CC BY-SA


//Conexion con la Base de datos
include("db.php");
include("urls.php");
include("version.php");
//Variables del sistema
$quecomespath="/"; //Ruta para desarrollo, para produccion poner "/"
$prefoot=" - Parece que estas en: ";
$titulo_web="QueComes!? - Bares y Restaurantes cerca de ti.";
$titulo_corto="que comes!?";
$mdkey="gogussystem";
$foot="Que Comes!? - ".$qcmsVersion." - Gogus 2009 - Contenido bajo licencia <a href='http://creativecommons.org/licenses/by-sa/3.0/' target='_blank'>CreativeCommons CC-BY-SA</a> - Codigo: <a href='http://code.google.com/p/gogus-qcms/source/browse/#svn/branches/1.0' target='_blank'>GPLv3</a> - some rights reserved ";
//
//Key para Google Maps
$domain=$_SERVER["SERVER_NAME"];
if($domain=="quecom.es"){
$key ="ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBS3CkSPi3aKTtiOuwmOy6_GhXJFGxSPc3miXfruwYGlbR74XB975r5dgA";
}
if($domain=="www.quecom.es"){
$key ="ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBS3CkSPi3aKTtiOuwmOy6_GhXJFGxSPc3miXfruwYGlbR74XB975r5dgA";
}
if($domain=="gogus.es"){
$key ="ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBTpYdA6vlzFBbD-h4s9c4BsanCnkxSXoJUTdIDU_wJIOQf_igJYnuf8fA";
}	
if($domain=="www.gogus.es"){
$key ="ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBTpYdA6vlzFBbD-h4s9c4BsanCnkxSXoJUTdIDU_wJIOQf_igJYnuf8fA";
}
if($domain=="m.quecom.es"){
$key="ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBQMq2_6NR7ZO0Qis3TR969wbM_g2RTxQt3c1tiq3rMb_1mIg64QFtNIFw";
}
//
//Variables para el servicio SMS.
$max_sms=3; //Maximo por usuario/mes
$max_sms_month=50; // Maximo mensual del servicio
//Reporte de errores
error_reporting(0); // Para produccion "0" , para desarrollo E_ALL

//
//Variables generales de funcionamiento

$sms_reg=false; //Si es necesario estar registrado para mandar un sms
$vote_reg=false; //Si es necesario estar registrado para mandar votar
$anon_edit=false; //Si se permiten ediciones anónimas.
$foto_reg=true; //Si es necesario estar registrado para subir fotos

//otras variables
$_URL_BASE="http://quecom.es/";

?>