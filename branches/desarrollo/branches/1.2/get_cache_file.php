<?
$page_to_load=$_GET['file'];
$life_time=$_GET['t'];

if($life_time==''){
$life_time='3600';
		
}
// Set a id for this cache
$cid = 'cached_file_'.$page_to_load;
// include the package 
require_once("cachelite/Lite.php"); 

// set some variables 
$options = array( 
"cacheDir" => "cachelite/", 
"lifeTime" => $life_time
); 

// create a Cache_Lite object 
$objCache = new Cache_Lite($options); 

// test if there exists a valid cache 
if ($page = $objCache->get($cid)) 
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

include($page_to_load);

// page generation complete 
// retrieve the page from the buffer 
$page = ob_get_contents(); 

// and save it in the cache for future use 
$objCache->save($page, $cid); 

// also display the buffer and then flush it 
ob_end_flush(); 

} 

?>