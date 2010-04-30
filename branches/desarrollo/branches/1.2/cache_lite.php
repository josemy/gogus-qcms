<?php
require_once("cachelite/Lite.php");
 
$options = array(
    'cacheDir' => '/cachelite/',
    'lifeTime' => 7200
);
 
$SESSION['cache'] = $Cache_Lite = new Cache_Lite($options );
$SESSION['id'] = $id ='page'.str_replace(array('/', '.'), array('', '' ),$_SERVER['REQUEST_URI']); 
 
if ($data = $Cache_Lite->get($id)){
	print $data.'<!-- Cache -->';
	exit;
}
 
?>

<?php
 ob_start();
 ob_implicit_flush(0);
 $datos = ob_get_clean();
 $SESSION['cache']->save($datos, $SESSION['id']); //Agregado 
 print $datos; 
?>