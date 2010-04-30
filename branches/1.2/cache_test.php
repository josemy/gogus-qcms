<?
/* Include the class */
require_once '../../cache_lite/Lite.php';
 
/* Set a key for this cache item */
$id = 'newsitem1';
 
/* Set a few options */
$options = array(
    'cacheDir' => '/cache_lite/',
    'lifeTime' => 3600
);
 
/* Create a Cache_Lite object */
$Cache_Lite = new Cache_Lite($options);
 
/* Test if there is a valid cache-entry for this key */
if ($data = $Cache_Lite->get($id)) {
    /* Cache hit! We've got the cached content stored in $data! */
} else {
    /* Cache miss! Use ob_start to catch all the output that comes next*/
    ob_start();
 
    /* The original content, which is now saved in the output buffer */
    include "index.php";
       
    /* We've got fresh content stored in $data! */
    $data = ob_get_contents();
       
    /* Let's store our fresh content, so next
     * time we won't have to generate it! */
    $Cache_Lite->save($data, $id);
    ob_get_clean();
}
echo $data;


?>