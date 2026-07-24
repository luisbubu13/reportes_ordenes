<?php

date_default_timezone_set("America/Mexico_City");

require_once(__DIR__ . "/../funciones/conecta.php");
require_once(__DIR__ . "/generar_reporte.php");

$conexion = conectar();

$token = "8513892776:AAEZ7rj0pgLBcbUdUORzXpblUxtZS-nh91Y";


//==================================================
// OBTENER SUPERVISORES
//==================================================

$sql = "

SELECT

    id,
    supervisor,
    chat_id

FROM supervisor

WHERE eliminado = 0

AND chat_id <> ''

ORDER BY supervisor

";

$res = $conexion->query($sql);

if(!$res){

    die("Error consultando supervisores.");

}



//==================================================
// ENVIAR REPORTE A CADA SUPERVISOR
//==================================================

while($sup = $res->fetch_assoc()){

    $mensaje = generarReporte(

        $conexion,

        $sup["id"]

    );



    $url =

    "https://api.telegram.org/bot".$token."/sendMessage";



    $datos = [

        "chat_id" => $sup["chat_id"],

        "text" => $mensaje

    ];



    $opciones = [

        "http" => [

            "method"  => "POST",

            "header"  =>

            "Content-Type: application/x-www-form-urlencoded",

            "content" => http_build_query($datos)

        ]

    ];



    $contexto = stream_context_create($opciones);



    $respuesta = @file_get_contents(

        $url,

        false,

        $contexto

    );



    if($respuesta){

        echo "Reporte enviado a ".$sup["supervisor"].PHP_EOL;

    }

    else{

        echo "Error enviando a ".$sup["supervisor"].PHP_EOL;

    }

}



echo PHP_EOL;

echo "========================================".PHP_EOL;

echo "Proceso terminado correctamente.".PHP_EOL;

echo "Fecha: ".date("d/m/Y H:i:s").PHP_EOL;

echo "========================================".PHP_EOL;

?>