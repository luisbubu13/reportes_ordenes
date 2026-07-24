<?php

date_default_timezone_set("America/Mexico_City");

/*
==================================================
PRODUCTIVIDAD DE UN MECÁNICO

Comando:

/productividad ID_MECANICO

Ejemplo:

/productividad 15

==================================================
*/

function productividadMecanico(
    $conexion,
    $idMecanico
){

    /*
    ==========================================
    FECHA DE LA CONSULTA
    ==========================================
    */

    $fecha = date("Y-m-d");


    /*
    ==========================================
    VALIDAR MECÁNICO
    ==========================================
    */

    $sql = "

    SELECT

        id,
        nombre

    FROM mecanicos

    WHERE

        id = $idMecanico

    AND eliminado = 0

    LIMIT 1

    ";

    $res = $conexion->query($sql);

    if(
        !$res
        ||
        $res->num_rows == 0
    ){

        return

        "❌ No existe un mecánico con ID ".$idMecanico.".";

    }

    $mecanico =
    $res->fetch_assoc();



    /*
    ==========================================
    REPARACIONES DEL DÍA

    Se cuentan las reparaciones donde
    el mecánico tuvo actividad.
    ==========================================
    */

    $sql = "

    SELECT

        COUNT(
            DISTINCT id_reparacion
        ) AS total

    FROM reparacion_historial

    WHERE

        id_mecanico = $idMecanico

    AND DATE(fecha_inicio) = '$fecha'

    ";

    $res = $conexion->query($sql);

    $reparaciones = 0;

    if($res){

        $fila = $res->fetch_assoc();

        $reparaciones =
        intval($fila["total"]);

    }



    /*
    ==========================================
    MINUTOS TRABAJADOS

    Se suman todos los bloques
    registrados en el historial.

    Si el mecánico sigue trabajando
    se calcula hasta NOW().

    ==========================================
    */

    $sql = "

    SELECT

        COALESCE(

            SUM(

                TIMESTAMPDIFF(

                    MINUTE,

                    fecha_inicio,

                    COALESCE(

                        fecha_fin,

                        NOW()

                    )

                )

            ),

        0)

        AS minutos

    FROM reparacion_historial

    WHERE

        id_mecanico = $idMecanico

    AND DATE(fecha_inicio) = '$fecha'

    ";

    $res = $conexion->query($sql);

    $minutos = 0;

    if($res){

        $fila = $res->fetch_assoc();

        $minutos =
        intval($fila["minutos"]);

    }



    /*
    ==========================================
    PRODUCTIVIDAD

    Jornada = 8 horas

    ==========================================
    */

    $productividad = 0;

    if($minutos > 0){

        $productividad = round(

            ($minutos / 480) * 100

        );

        if($productividad > 100){

            $productividad = 100;

        }

    }



    /*
    ==========================================
    FORMATO DEL TIEMPO
    ==========================================
    */

    $horas = floor(
        $minutos / 60
    );

    $mins =
    $minutos % 60;

    $tiempo =

    $horas.
    " h ".
    $mins.
    " min";



    /*
    ==========================================
    ¿ESTÁ TRABAJANDO?

    Buscamos un historial abierto.

    ==========================================
    */

    $sql = "

    SELECT

        a.unidad

    FROM reparacion_historial rh

    INNER JOIN reparacion r
        ON r.id = rh.id_reparacion

    INNER JOIN orden o
        ON o.id = r.id_orden

    INNER JOIN autobus a
        ON a.id = o.id_autobus

    WHERE

        rh.id_mecanico = $idMecanico

    AND rh.fecha_fin IS NULL

    LIMIT 1

    ";

    $res = $conexion->query($sql);

    if(
        $res
        &&
        $res->num_rows > 0
    ){

        $fila =
        $res->fetch_assoc();

        $estado =
        "🟢 Trabajando";

        $unidad =
        $fila["unidad"];

    }
    else{

        $estado =
        "⚪ Sin actividad";

        $unidad = "-";

    }



    /*
    ==========================================
    MENSAJE

    (Continúa en la Parte 2)

    ==========================================
    */

    $mensaje =

    "👨‍🔧 PRODUCTIVIDAD DEL MECÁNICO\n\n".

    "👤 Mecánico:\n".

    $mecanico["nombre"]."\n\n".

    "📅 Fecha:\n".

    $fecha."\n\n".

    "🔧 Reparaciones:\n".

    $reparaciones."\n\n".

    "⏱ Tiempo trabajado:\n".

    $tiempo."\n\n".

    "📈 Productividad:\n".

    $productividad."%\n\n".

    "📍 Estado:\n".

    $estado."\n\n".

    "🚌 Unidad actual:\n".

    $unidad;

    return $mensaje;

}

?>