<?php
//
// Mensajes aleatorios para QueComes!?
$quotes[] = "¿Donde cenamos hoy?¿Hay algun telepizza cerca?¿Que tal se comerá aqui?";
$quotes[] = "¿Donde la llevo a cenar?¿Donde habrá un McDonalds?¿Comemos aqui?";
$quotes[] = "¿Te apetece cenar aqui?¿Donde habrá un italiano?¿Cenamos fuera?";
$quotes[] = "¿Donde comemos hoy?¿Tendran menu del dia?¿Comemos fuera?";


srand ((double) microtime() * 1000000);
$randomquote = rand(0,count($quotes)-1);
echo($quotes[$randomquote]);
?> 