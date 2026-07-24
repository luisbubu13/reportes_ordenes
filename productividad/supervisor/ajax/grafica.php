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
    CONSULTA
==========================================================

Productividad basada en historial real.

==========================================================
*/


$sql = "

SELECT


    m.id,

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

m.nombre



ORDER BY


m.nombre


";





$res = $conexion->query($sql);





$labels = [];

$datos = [];

$promedio = 0;



/*
==========================================================
    JORNADA
==========================================================
*/


$jornada = obtenerJornadaPeriodo();





if($res){


    while($row=$res->fetch_assoc()){



        $minutos = intval(

            $row["minutos"]

        );



        $productividad = 0;




        if($jornada > 0){


            $productividad = round(

                ($minutos / $jornada)

                *

                100

            );


        }




        if($productividad > 100){

            $productividad = 100;

        }



        if($productividad < 0){

            $productividad = 0;

        }




        $labels[] = $row["nombre"];


        $datos[] = $productividad;



    }


}

/*
==========================================================
    PROMEDIO GENERAL
==========================================================
*/

if(count($datos)>0){

    $promedio = round(

        array_sum($datos)

        /

        count($datos)

    );

}



/*
==========================================================
    RESPUESTA
==========================================================
*/


echo json_encode([

    "fecha"=>$fecha,

    "periodo"=>$periodo,

    "inicio"=>$inicio,

    "fin"=>$fin,

    "labels"=>$labels,

    "datos"=>$datos,

    "promedio"=>$promedio

]);


?>