<?php
/*
==========================================================
    FILTROS GENERALES
==========================================================

Variables disponibles:

$fecha
$mecanicos
$periodo
$inicio
$fin
$filtroFecha


Funciones disponibles:

obtenerFiltroMecanico($campo)
obtenerJornadaPeriodo()

==========================================================
*/


/*
==========================================================
    FECHA
==========================================================
*/

$fecha = isset($_GET["fecha"])
    ? $_GET["fecha"]
    : date("Y-m-d");



$fechaDesde = isset($_GET["fechaDesde"])
    ? $_GET["fechaDesde"]
    : $fecha;



$fechaHasta = isset($_GET["fechaHasta"])
    ? $_GET["fechaHasta"]
    : "";

/*
==========================================================
    MECÁNICOS
==========================================================
*/


$mecanicos = [];


if(isset($_GET["mecanico"])){


    if(is_array($_GET["mecanico"])){


        $mecanicos = $_GET["mecanico"];


    }
    else{


        $mecanicos = [
            $_GET["mecanico"]
        ];


    }

}



/*
==========================================================
    LIMPIAR IDS
==========================================================
*/


$mecanicos = array_map(
    "intval",
    $mecanicos
);


$mecanicos = array_filter(
    $mecanicos
);



/*
==========================================================
    PERIODO
==========================================================
*/

$periodo = isset($_GET["periodo"])
    ? $_GET["periodo"]
    : "dia";

/*
==========================================================
    RANGO DE FECHAS
==========================================================
*/


/*
==========================================================
    SI EXISTE RANGO PERSONALIZADO
==========================================================
*/


if(

    !empty($fechaDesde)

    &&

    !empty($fechaHasta)

    &&

    $fechaHasta >= $fechaDesde

){


    $inicio = $fechaDesde;


    $fin = $fechaHasta;



    /*
        ignoramos periodo

    */


}

else{


    switch($periodo){



        case "quincena":


            $dia = intval(
                date("d", strtotime($fecha))
            );


            if($dia <= 15){


                $inicio = date(
                    "Y-m-01",
                    strtotime($fecha)
                );


                $fin = date(
                    "Y-m-15",
                    strtotime($fecha)
                );


            }
            else{


                $inicio = date(
                    "Y-m-16",
                    strtotime($fecha)
                );


                $fin = date(
                    "Y-m-t",
                    strtotime($fecha)
                );


            }


        break;




        case "mes":


            $inicio = date(
                "Y-m-01",
                strtotime($fecha)
            );


            $fin = date(
                "Y-m-t",
                strtotime($fecha)
            );


        break;




        default:


            $inicio=$fecha;

            $fin=$fecha;


        break;


    }


}

/*
==========================================================
    FILTRO FECHA
==========================================================
*/


$filtroFecha = "

DATE(r.fecha_fin)

BETWEEN '$inicio'

AND '$fin'

";





/*
==========================================================
    FUNCIÓN:
    FILTRO DE MECÁNICOS
==========================================================
*/


function obtenerFiltroMecanico($campo){


    global $mecanicos;



    if(count($mecanicos) > 0){


        $ids = implode(
            ",",
            $mecanicos
        );



        return "

        AND $campo IN ($ids)

        ";


    }


    return "";


}






/*
==========================================================
    FUNCIÓN:
    JORNADA SEGÚN PERIODO
==========================================================
*/


function obtenerJornadaPeriodo(){


    global $periodo, $fecha, $inicio, $fin;



    $dias =

    (

        strtotime($fin)

        -

        strtotime($inicio)

    )

    /

    86400;


    $dias++;



    return 480 * $dias;


}

?>