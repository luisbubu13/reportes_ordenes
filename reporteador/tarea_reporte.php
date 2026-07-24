<?php

date_default_timezone_set("America/Mexico_City");

ob_start();

require_once("enviar_reporte.php");


$log = ob_get_clean();


file_put_contents(

    "logs_reportes.txt",

    date("Y-m-d H:i:s").
    " - ".
    $log.
    "\n",

    FILE_APPEND

);


?>