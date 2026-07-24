<?php

date_default_timezone_set("America/Mexico_City");

require_once("../../../funciones/conecta.php");

$conexion = conectar();

session_start();


/*
==========================================================
    VALIDAR SUPERVISOR
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
    CARGAR FILTROS
==========================================================
*/

require_once("filtros.php");



/*
==========================================================
    MECÁNICOS ACTIVOS
==========================================================

Un mecánico está activo si:

- Tiene historial iniciado dentro del periodo
- Todavía no tiene fecha_fin

==========================================================
*/


$sql = "

SELECT

COUNT(DISTINCT rh.id_mecanico) AS total


FROM reparacion_historial rh


WHERE

DATE(rh.fecha_inicio)

BETWEEN '$inicio' AND '$fin'


AND rh.fecha_fin IS NULL

"

.obtenerFiltroMecanico("rh.id_mecanico");



$res = $conexion->query($sql);


$mecanicosActivos = 0;


if($res){

    $fila = $res->fetch_assoc();

    $mecanicosActivos =
        intval($fila["total"]);

}





/*
==========================================================
    REPARACIONES ACTIVAS
==========================================================

Contamos reparaciones únicas que tienen
trabajo iniciado dentro del periodo.

==========================================================
*/


$sql = "

SELECT

COUNT(DISTINCT rh.id_reparacion) AS total


FROM reparacion_historial rh


WHERE


DATE(rh.fecha_inicio)

BETWEEN '$inicio' AND '$fin'


AND rh.fecha_fin IS NULL

"

.obtenerFiltroMecanico("rh.id_mecanico");



$res = $conexion->query($sql);


$activas = 0;


if($res){

    $fila = $res->fetch_assoc();

    $activas =
        intval($fila["total"]);

}





/*
==========================================================
    REPARACIONES TERMINADAS
==========================================================

Se toma la fecha de cierre real
de la reparación.

==========================================================
*/


$sql = "

SELECT

COUNT(r.id) AS total


FROM reparacion r


WHERE


r.estado = 3


AND DATE(r.fecha_fin)

BETWEEN '$inicio' AND '$fin'

"

.obtenerFiltroMecanico("r.id_mecanico");



$res = $conexion->query($sql);


$terminadas = 0;


if($res){

    $fila = $res->fetch_assoc();

    $terminadas =
        intval($fila["total"]);

}





/*
==========================================================
    TIEMPO TRABAJADO
==========================================================

Solo contamos bloques de historial
que comenzaron dentro del periodo.

==========================================================
*/


$sql = "

SELECT


COALESCE(

SUM(

TIMESTAMPDIFF(

MINUTE,

rh.fecha_inicio,

rh.fecha_fin

)

),

0

) AS minutos


FROM reparacion_historial rh


WHERE


DATE(rh.fecha_inicio)

BETWEEN '$inicio' AND '$fin'


AND rh.fecha_fin IS NOT NULL

"

.obtenerFiltroMecanico("rh.id_mecanico");



$res = $conexion->query($sql);


$minutos = 0;


if($res){

    $fila = $res->fetch_assoc();

    $minutos =
        intval($fila["minutos"]);

}





/*
==========================================================
    TOTAL MECÁNICOS PARA JORNADA
==========================================================
*/


if(count($mecanicos)>0){


    $totalMecanicos =
        count($mecanicos);


}
else{


    $sql = "

    SELECT

    COUNT(id) AS total


    FROM mecanicos


    WHERE eliminado = 0

    ";


    $res = $conexion->query($sql);


    $totalMecanicos = 0;


    if($res){

        $fila = $res->fetch_assoc();

        $totalMecanicos =
            intval($fila["total"]);

    }


}





/*
==========================================================
    JORNADA DISPONIBLE
==========================================================
*/


$jornada =

$totalMecanicos *

obtenerJornadaPeriodo();





/*
==========================================================
    PRODUCTIVIDAD
==========================================================
*/


$productividad = 0;


if($jornada > 0){


    $productividad = round(

        ($minutos / $jornada)

        *

        100

    );


    if($productividad > 100){

        $productividad = 100;

    }

}

/*
==========================================================
    RESPUESTA JSON
==========================================================
*/

$textoFecha = $inicio;


if($inicio != $fin){

    $textoFecha = 

        $inicio
        .
        " al "
        .
        $fin;

}

echo json_encode([


    "fecha"=>$textoFecha,


    "periodo"=>$periodo,


    "inicio"=>$inicio,


    "fin"=>$fin,


    "mecanicos_activos"=>$mecanicosActivos,


    "activas"=>$activas,


    "terminadas"=>$terminadas,


    "productividad"=>$productividad


]);


?>