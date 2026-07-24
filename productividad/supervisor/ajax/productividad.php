<?php

date_default_timezone_set("America/Mexico_City");

require_once("../../../funciones/conecta.php");

$conexion = conectar();

session_start();


/*
==========================================================
    VALIDAR SESIÓN
==========================================================
*/

if(!isset($_SESSION["id_supervisor"])){

    echo json_encode([

        "error"=>"Sesión no válida"

    ]);

    exit;

}


/*
==========================================================
    FILTROS
==========================================================
*/

require_once("filtros.php");



/*
==========================================================
    JORNADA
==========================================================
*/

$jornada = obtenerJornadaPeriodo();





/*
==========================================================
    CONSULTA PRODUCTIVIDAD
==========================================================

Ahora usamos:

reparacion_historial

porque representa trabajo real.

==========================================================
*/


$sql = "

SELECT


    m.id,

    m.id_mecanico,

    m.nombre,


    COUNT(DISTINCT rh.id_reparacion) AS reparaciones,


    COALESCE(

        SUM(

            TIMESTAMPDIFF(

                MINUTE,

                rh.fecha_inicio,

                rh.fecha_fin

            )

        ),

    0) AS minutos



FROM mecanicos m



LEFT JOIN reparacion_historial rh


ON rh.id_mecanico = m.id


AND rh.fecha_fin IS NOT NULL


AND DATE(rh.fecha_inicio)

BETWEEN '$inicio' AND '$fin'





WHERE


m.eliminado = 0





";


/*
==========================================================
    FILTRO MECÁNICOS
==========================================================
*/


$sql .= obtenerFiltroMecanico(
    "m.id"
);



/*
==========================================================
    AGRUPAR
==========================================================
*/


$sql .= "

GROUP BY


m.id,

m.id_mecanico,

m.nombre



ORDER BY


m.nombre


";





$res = $conexion->query($sql);



$datos = [];





if($res){


    while($row=$res->fetch_assoc()){


        $minutos = intval(
            $row["minutos"]
        );



        /*
        ==============================================
            PRODUCTIVIDAD
        ==============================================
        */


        $productividad = 0;



        if($jornada > 0){


            $productividad = round(

                ($minutos / $jornada) * 100

            );


        }



        $productividad = max(

            0,

            min(

                100,

                $productividad

            )

        );





        /*
        ==============================================
            FORMATO TIEMPO
        ==============================================
        */


        $horas = floor(
            $minutos / 60
        );


        $mins = $minutos % 60;



        $tiempo = "";



        if($horas > 0){

            $tiempo .= $horas . " h ";

        }



        $tiempo .= $mins . " min";






        /*
        ==============================================
            RESPUESTA MECÁNICO
        ==============================================
        */


        $datos[] = [


            "id" =>
                intval($row["id"]),


            "id_mecanico" =>
                intval($row["id_mecanico"]),


            "mecanico" =>
                $row["nombre"],


            "reparaciones" =>
                intval($row["reparaciones"]),


            "minutos" =>
                $minutos,


            "tiempo" =>
                $tiempo,


            "productividad" =>
                $productividad


        ];



    }


}





/*
==========================================================
    JSON
==========================================================
*/


echo json_encode([


    "fecha"=>$fecha,


    "periodo"=>$periodo,


    "inicio"=>$inicio,


    "fin"=>$fin,


    "jornada"=>$jornada,


    "mecanicos"=>$datos


]);


?>