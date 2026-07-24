<?php

date_default_timezone_set("America/Mexico_City");


/*
==================================================
CONSULTA UNA ORDEN COMPLETA

Comando:

/orden ID_ORDEN

Ejemplo:

/orden 1523

==================================================
*/


function buscarOrden(

    $conexion,

    $idOrden

){


    $idOrden = intval($idOrden);



    if($idOrden <= 0){


        return

        "⚠ Uso correcto:\n\n".

        "/orden NUMERO_ORDEN\n\n".

        "Ejemplo:\n".

        "/orden 1523";


    }



    /*
    ==============================================
    DATOS GENERALES DE LA ORDEN
    ==============================================
    */


    $sql = "

    SELECT


        o.id,

        o.fecha_apertura,

        o.fecha_liberacion,

        o.fecha_cierre,

        o.estado,


        a.unidad,


        e.nombre AS empresa,


        cr.descripcion AS razon,


        s.supervisor



    FROM orden o



    INNER JOIN autobus a

        ON a.id = o.id_autobus



    INNER JOIN empresa e

        ON e.id = a.id_empresa



    INNER JOIN catalogo_razones cr

        ON cr.id = o.id_razon



    INNER JOIN supervisor s

        ON s.id = o.id_supervisor



    WHERE


        o.id = $idOrden



    LIMIT 1


    ";



    $res = $conexion->query($sql);



    if(

        !$res

        ||

        $res->num_rows == 0

    ){


        return

        "❌ No existe la orden ".$idOrden.".";


    }



    $orden = $res->fetch_assoc();





    /*
    ==============================================
    TRADUCIR ESTADO ORDEN
    ==============================================
    */


    switch($orden["estado"]){


        case 1:

            $estadoOrden = "🟢 Abierta";

        break;



        case 2:

            $estadoOrden = "🔵 Liberada";

        break;



        case 3:

            $estadoOrden = "🔴 Cerrada";

        break;



        case 4:

            $estadoOrden = "⚫ Cancelada";

        break;



        default:

            $estadoOrden = "❓ Desconocido";

        break;


    }



    /*
    ==============================================
    FECHAS
    ==============================================
    */


    $liberacion =

    $orden["fecha_liberacion"]

    ?

    $orden["fecha_liberacion"]

    :

    "--";



    $cierre =

    $orden["fecha_cierre"]

    ?

    $orden["fecha_cierre"]

    :

    "--";



    /*
    ==============================================
    BUSCAR REPARACIONES
    ==============================================
    */

    $sql = "

    SELECT


        r.id,

        r.descripcion,

        r.estado,


        m.nombre AS mecanico



    FROM reparacion r



    LEFT JOIN mecanicos m

        ON m.id = r.id_mecanico



    WHERE


        r.id_orden = $idOrden



    ORDER BY


        r.id


    ";



    $resRep = $conexion->query($sql);



    $reparaciones = [];



    if($resRep){


        while($rep = $resRep->fetch_assoc()){


            $reparaciones[] = $rep;


        }


    }



    /*
    ==============================================
    CONTINÚA PARTE 2
    ==============================================
    */

    
    /*
    ==============================================
    FORMATEAR REPARACIONES
    ==============================================
    */


    $textoReparaciones = "";



    if(count($reparaciones) == 0){


        $textoReparaciones =

        "No existen reparaciones registradas.";


    }
    else{


        $contador = 1;



        foreach($reparaciones as $rep){



            switch($rep["estado"]){


                case 0:

                    $estadoRep = "⚪ Pendiente";

                break;



                case 1:

                    $estadoRep = "🟢 Trabajando";

                break;



                case 2:

                    $estadoRep = "⏸ Pausada";

                break;



                case 3:

                    $estadoRep = "✔ Terminada";

                break;



                default:

                    $estadoRep = "❓ Desconocido";

                break;


            }



            $mecanico =

            $rep["mecanico"]

            ?

            $rep["mecanico"]

            :

            "Sin asignar";



            $textoReparaciones .=


            $contador.
            ") ".
            $rep["descripcion"].
            "\n".

            "👨‍🔧 ".
            $mecanico.
            "\n".

            $estadoRep.
            "\n\n";



            $contador++;


        }


    }





    /*
    ==============================================
    MENSAJE FINAL
    ==============================================
    */


    $mensaje =


    "📋 ORDEN DE MANTENIMIENTO\n\n".



    "🆔 Orden:\n".

    $orden["id"].

    "\n\n".



    "🚌 Unidad:\n".

    $orden["unidad"].

    "\n\n".



    "🏢 Empresa:\n".

    $orden["empresa"].

    "\n\n".



    "📌 Estado:\n".

    $estadoOrden.

    "\n\n".



    "📅 Apertura:\n".

    $orden["fecha_apertura"].

    "\n\n".



    "📤 Liberación:\n".

    $liberacion.

    "\n\n".



    "✅ Cierre:\n".

    $cierre.

    "\n\n".



    "🛠 Razón:\n".

    $orden["razon"].

    "\n\n".



    "👷 Supervisor:\n".

    $orden["supervisor"].

    "\n\n".



    "🔧 REPARACIONES\n\n".

    $textoReparaciones;



    return $mensaje;


}


?>