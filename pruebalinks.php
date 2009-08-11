<?php
$url=$_GET['u'];
  // Leemos el codigo HTML de la pagina
  $dataCad = file_get_contents($url)
                                or die ("No se puede abrir la URL");

  // Buscamos por URLs
  // Definimos una cadena que empieza con http/https/ftp
  preg_match_all("/(http|https|ftp):\/\/[^<>[:space:]]
                        +[[:alnum:]#?\/&=+%_]/", $dataCad, $matches);

  // Salvamos la coincidencias en un Array
  $urlLista = $matches[0];

  // Imprimimos el Array
  print_r($urlLista);

?>
