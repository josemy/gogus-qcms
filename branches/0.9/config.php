<?
//Proyecto QCMS	
//Base de datos

include("db.php");

// Archivo de Configuracion
$prefoot=" - Parece que estas en: ";
$titulo_web="QueComes!? - food social network";
$titulo_corto="que comes!?";
$mdkey="gogussystem";
$foot="Que Comes!? - v0.8.090818 - Gogus 2009 - Bajo licencia <a href='http://creativecommons.org/licenses/by-sa/3.0/'>CreativeCommons CC-BY-SA</a> - some rights reserved ";
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




?>