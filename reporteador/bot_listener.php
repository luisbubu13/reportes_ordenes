<?php

set_time_limit(0);

date_default_timezone_set("America/Mexico_City");

require_once(__DIR__."/../funciones/conecta.php");
require_once(__DIR__."/generar_reporte.php");
require_once(__DIR__."/buscar_unidad.php");
require_once(__DIR__."/productividad.php");
require_once(__DIR__."/orden.php");

$conexion = conectar();

$token = "8513892776:AAEZ7rj0pgLBcbUdUORzXpblUxtZS-nh91Y";

$offset = 0;

echo "Bot iniciado...\n";

while(true){

    $url =
    "https://api.telegram.org/bot".$token.
    "/getUpdates?timeout=30&offset=".$offset;

    $respuesta = @file_get_contents($url);

    if($respuesta === false){

        sleep(2);

        continue;

    }

    $datos = json_decode(
        $respuesta,
        true
    );

    if(
        !$datos
        ||
        !$datos["ok"]
    ){

        sleep(1);

        continue;

    }

    foreach(
        $datos["result"]
        as $update
    ){

        $offset =
        $update["update_id"] + 1;

        if(
            !isset(
                $update["message"]
            )
        ){

            continue;

        }

        $chat_id =
        $update["message"]["chat"]["id"];

        /*
        ==========================================
        TEXTO RECIBIDO

        Evita errores con fotos,
        stickers, audios, etc.

        ==========================================
        */

        $texto = trim(

            $update["message"]["text"] ?? ""

        );

        echo
        date("H:i:s")
        ." -> "
        .$texto
        ."\n";

        /*
        ==========================================
        OBTENER COMANDO Y ARGUMENTO

        Ejemplos

        /reporte

            comando:
            /reporte

            argumento:
            ""

        /buscar TM-041

            comando:
            /buscar

            argumento:
            TM-041

        ==========================================
        */

        $partes = preg_split(

            "/\s+/",

            $texto,

            2

        );

        $comando = strtolower(

            $partes[0] ?? ""

        );

        $argumento = trim(

            $partes[1] ?? ""

        );

        /*
        ==========================================
        LIMPIAR MENSAJE

        Evita reutilizar un mensaje
        anterior.

        ==========================================
        */

        unset($mensaje);

        //==================================================
        // VALIDAR SUPERVISOR
        //==================================================

        $chat_id_sql = $conexion->real_escape_string(
            $chat_id
        );

        $sqlSupervisor = "

        SELECT

            id,
            supervisor

        FROM supervisor

        WHERE chat_id='$chat_id_sql'

        AND eliminado=0

        LIMIT 1

        ";

        $resSupervisor =
        $conexion->query(
            $sqlSupervisor
        );

        $supervisorRegistrado = false;

        $id_supervisor = null;

        $nombre_supervisor = null;

        if(

            $resSupervisor

            &&

            $resSupervisor->num_rows > 0

        ){

            $sup =
            $resSupervisor->fetch_assoc();

            $supervisorRegistrado = true;

            $id_supervisor =
            $sup["id"];

            $nombre_supervisor =
            $sup["supervisor"];

        }

        //==================================================
        // /START
        //==================================================

        if($comando == "/start"){

            $mensaje =

            "🤖 Bienvenido al Reporteador de Órdenes\n\n".

            "Este bot permite consultar información de mantenimiento.\n\n".

            "Para ver comandos escribe:\n\n".

            "📖 /ayuda";

        }

        //==================================================
        // /AYUDA
        //==================================================

        elseif($comando == "/ayuda"){

            $mensaje =

            "📖 AYUDA | Reporteador de Órdenes\n\n".

            "Comandos disponibles:\n\n".

            "📋 /reporte\n".
            "Reporte de órdenes pendientes.\n\n".

            "🔎 /buscar UNIDAD\n".
            "Consulta el estado de un autobús.\n".
            "Ejemplo:\n".
            "/buscar TM-041\n\n".

            "👨‍🔧 /productividad ID_MECANICO\n".
            "Consulta la productividad diaria de un mecánico.\n".
            "Ejemplo:\n".
            "/productividad 15\n\n".

            "📋 /orden NUMERO_ORDEN\n".
            "Consulta información detallada de una orden.\n".
            "Ejemplo:\n".
            "/orden 1523";

        }

        //==================================================
        // /REPORTE
        //==================================================

        elseif($comando == "/reporte"){

            if(!$supervisorRegistrado){

                $mensaje =

                "❌ Tu chat no está registrado con ningún supervisor.\n\n".

                "Solicita al administrador registrar tu Telegram.";

            }
            else{

                $mensaje = generarReporte(

                    $conexion,

                    $id_supervisor

                );

            }

        }



        //==================================================
        // /BUSCAR
        //==================================================

        elseif($comando == "/buscar"){

            if(!$supervisorRegistrado){

                $mensaje =

                "❌ Tu chat no está registrado con ningún supervisor.\n\n".

                "Solicita al administrador registrar tu Telegram.";

            }
            else{

                $mensaje = buscarUnidad(

                    $conexion,

                    $argumento

                );

            }

        }

        //==================================================
        // /PRODUCTIVIDAD
        //==================================================

        elseif($comando == "/productividad"){

            if(!$supervisorRegistrado){

                $mensaje =

                "❌ Tu chat no está registrado con ningún supervisor.\n\n".

                "Solicita al administrador registrar tu Telegram.";

            }
            else{

                /*
                ==============================
                VALIDAR ID DEL MECÁNICO
                ==============================
                */

                if($argumento == ""){

                    $mensaje =

                    "⚠ Uso correcto:\n\n".

                    "/productividad ID_MECANICO\n\n".

                    "Ejemplo:\n".

                    "/productividad 15";

                }
                else{

                    $mensaje = productividadMecanico(

                        $conexion,

                        intval($argumento)

                    );

                }

            }

        }

        //==================================================
        // /ORDEN
        //==================================================

        elseif(strpos($texto,"/orden") === 0){


            if(!$supervisorRegistrado){


                $mensaje =

                "❌ Tu chat no está registrado con ningún supervisor.\n\n".

                "Solicita al administrador registrar tu Telegram.";


            }
            else{


                $numeroOrden = trim(

                    str_replace(

                        "/orden",

                        "",

                        $texto

                    )

                );



                $mensaje = buscarOrden(

                    $conexion,

                    $numeroOrden

                );


            }

        }

        //==================================================
        // COMANDO DESCONOCIDO
        //==================================================

        elseif($texto != ""){

            $mensaje =

            "❌ Comando no reconocido.\n\n".

            "Escribe /ayuda para consultar los comandos disponibles.";

        }



        //==================================================
        // ENVIAR RESPUESTA
        //==================================================

        if(isset($mensaje)){

            file_get_contents(

                "https://api.telegram.org/bot".$token.
                "/sendMessage?".
                http_build_query([

                    "chat_id"=>$chat_id,

                    "text"=>$mensaje

                ])

            );

        }

    }

}