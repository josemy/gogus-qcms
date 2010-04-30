<?php

header( "Content-type: image/gif" );

// Obtenemos la imagen original
$imagen = imagecreatefromjpeg( include("flickr_back.php") );

// Convertimos la imagen a indexada
imagetruecolortopalette( $imagen, true, 256 );

// Esta será la imagen para la escala de grises
$escala = imagecreatefromgif( "images/escala.gif" );

// Copiamos la paleta de escala a la imagen
imagepalettecopy( $imagen, $escala );

imagedestroy( $escala );

imagegif( $imagen );

imagedestroy( $imagen );

?>