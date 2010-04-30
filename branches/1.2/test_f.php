<?PHP
include 'flickr.php';
$a = new flickr('b6ca3b2b79a0f2d14e80fef09cd19de7');
echo 'SEARCH:<BR>';
$photos=$a->search('restaurante');
$photo_a=$photos[img];
//Ver el maximo de fotos y obtener uno al azar
$max=100;
echo($max);
$rnd = rand(1,$max); 
echo("rnd: ".$rnd);
//
$photo_b=$photo_a[$rnd];
$photo_id=$photo_b['id'];
//print_r($photos);
//print_r($photos);
//print_r($photo_b);
echo($photo_id);

//echo 'getRecent:<BR>';
//print_r($a->getRecent(1));

echo 'getInfo:<BR>';
//print_r($a->getInfo(142796681));
print_r($a->getInfo($photo_id));

echo 'getSizes:<BR>';
//print_r($a->getInfo(142796681));
print_r($a->getSizes($photo_id));
$get_url=$a->getSizes($photo_id);
$url=$get_url[4];
$fin=$url[source];
echo($fin);

?>