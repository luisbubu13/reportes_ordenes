<?php

date_default_timezone_set("America/Mexico_City");

require_once("../../../funciones/conecta.php");

$conexion = conectar();

session_start();


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
    MECÁNICO
==========================================================
*/

$id_mecanico = isset($_GET["id_mecanico"])

    ? intval($_GET["id_mecanico"])

    : 0;



if($id_mecanico <= 0){

    echo json_encode([

        "error"=>"Mecánico no válido"

    ]);

    exit;

}





/*
==========================================================
    DETALLE POR AUTOBÚS
==========================================================

Fuente:

reparacion_historial

porque representa tiempo real.

==========================================================
*/


$sql = "

SELECT


    a.id,

    a.unidad,


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




FROM reparacion_historial rh



INNER JOIN reparacion r

ON r.id = rh.id_reparacion



INNER JOIN orden o

ON o.id = r.id_orden



INNER JOIN autobus a

ON a.id = o.id_autobus





WHERE


rh.id_mecanico = $id_mecanico


AND rh.fecha_fin IS NOT NULL


AND DATE(rh.fecha_inicio)

BETWEEN '$inicio' AND '$fin'




GROUP BY


a.id,

a.unidad




ORDER BY


minutos DESC




";





$res = $conexion->query($sql);



$autobuses = [];





if($res){


    while($row=$res->fetch_assoc()){


        $autobuses[] = [


            "id" => intval($row["id"]),


            "unidad" => $row["unidad"],


            "reparaciones" => intval(

                $row["reparaciones"]

            ),


            "minutos" => intval(

                $row["minutos"]

            )


        ];



    }


}





/*
==========================================================
    RESPUESTA JSON
==========================================================
*/


echo json_encode([


    "fecha"=>$fecha,


    "periodo"=>$periodo,


    "inicio"=>$inicio,


    "fin"=>$fin,


    "id_mecanico"=>$id_mecanico,


    "autobuses"=>$autobuses


]);


?>