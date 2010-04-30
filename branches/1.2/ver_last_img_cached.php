<?php 

// include the package 
require_once("cachelite/Lite.php"); 

// set some variables 
$options = array( 
"cacheDir" => "cachelite/", 
"lifeTime" => 3600
); 

// create a Cache_Lite object 
$objCache = new Cache_Lite($options); 

// test if there exists a valid cache 
if ($page = $objCache->get("last_img")) 
{ 
// if so, display it 
echo $page; 

// add a message indicating this is cached output 
echo " <!-- Cache -->"; 
} 
else 
{ 
// no cache 
// so display the HTML output 
// and save it to a buffer 
ob_start(); 

include("ver_last_img.php");

// page generation complete 
// retrieve the page from the buffer 
$page = ob_get_contents(); 

// and save it in the cache for future use 
$objCache->save($page, "last_img"); 

// also display the buffer and then flush it 
ob_end_flush(); 

} 

?>