<?php
$load = sys_getloadavg();
if ($load[0] > 0.10) {
    header('HTTP/1.1 500 Too busy, try again later');
    die('El servidor est� ocupado. Intentalo de nuevo mas tarde.');
}
?>
