<?php

$token = "8513892776:AAEZ7rj0pgLBcbUdUORzXpblUxtZS-nh91Y";
$chat_id = "7014982858";

$mensaje = "🚍 Hola Reaper\n\nTu sistema de Reportes de Órdenes ya puede enviar mensajes por Telegram. 😎";

$url = "https://api.telegram.org/bot$token/sendMessage";

$datos = [
    "chat_id" => $chat_id,
    "text" => $mensaje
];

$options = [
    "http" => [
        "header"  => "Content-type: application/x-www-form-urlencoded\r\n",
        "method"  => "POST",
        "content" => http_build_query($datos)
    ]
];

$contexto = stream_context_create($options);

$resultado = file_get_contents($url, false, $contexto);

echo $resultado;