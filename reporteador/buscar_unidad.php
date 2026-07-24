<?php

function buscarUnidad($conexion, $unidad){


    //==================================================
    // LIMPIAR UNIDAD
    //==================================================

    $unidad = strtoupper(trim($unidad));


    if($unidad==""){

        return
        "⚠️ Debes indicar una unidad.\n\n".
        "Ejemplo:\n".
        "/buscar TM-041";

    }



    //==================================================
    // BUSCAR UNIDAD
    //==================================================

    $sql="
    
    SELECT

        id,
        unidad

    FROM autobus

    WHERE UPPER(unidad)=?

    LIMIT 1

    ";


    $stmt=$conexion->prepare($sql);
    $stmt->bind_param("s",$unidad);
    $stmt->execute();

    $res=$stmt->get_result();



    if($res->num_rows==0){

        return
        "❌ La unidad \"".$unidad."\" no existe.\n\n".
        "Verifica la clave e inténtalo nuevamente.";

    }


    $bus=$res->fetch_assoc();

    $id_autobus=$bus["id"];




    //==================================================
    // BUSCAR ORDEN ABIERTA
    //==================================================

    $sql="

    SELECT

        o.id,
        cr.descripcion razon,
        s.supervisor,
        o.fecha_apertura

    FROM orden o


    INNER JOIN catalogo_razones cr
        ON cr.id=o.id_razon


    INNER JOIN supervisor s
        ON s.id=o.id_supervisor


    WHERE

        o.id_autobus=?

    AND o.estado=1


    ORDER BY o.fecha_apertura DESC

    LIMIT 1

    ";



    $stmt=$conexion->prepare($sql);
    $stmt->bind_param("i",$id_autobus);
    $stmt->execute();

    $res=$stmt->get_result();




    //==================================================
    // ORDEN ABIERTA
    //==================================================


    if($res->num_rows>0){


        $orden=$res->fetch_assoc();



        //==============================================
        // TIEMPO ABIERTA
        //==============================================

        $segundos=time()-strtotime($orden["fecha_apertura"]);


        $dias=floor($segundos/86400);

        $horas=floor(
            ($segundos%86400)/3600
        );

        $minutos=floor(
            ($segundos%3600)/60
        );



        if($dias>0){

            $tiempo=
            $dias." días ".
            $horas." horas ".
            $minutos." minutos";

        }
        else{

            $tiempo=
            $horas." horas ".
            $minutos." minutos";

        }




        //==============================================
        // PRIORIDAD
        //==============================================


        $horasTotal=floor($segundos/3600);


        if($horasTotal>72){

            $prioridad="🔴 Crítica";

        }
        elseif($horasTotal>48){

            $prioridad="🟠 Atención";

        }
        else{

            $prioridad="🟢 Normal";

        }




        //==============================================
        // REPARACIONES
        //==============================================

        $sqlRep="

        SELECT

            r.descripcion,

            m.nombre mecanico

        FROM reparacion r

        LEFT JOIN mecanicos m

            ON m.id=r.id_mecanico

        WHERE

            r.id_orden=?

        ORDER BY r.id

        ";


        $stmtRep=$conexion->prepare($sqlRep);

        $stmtRep->bind_param(
            "i",
            $orden["id"]
        );

        $stmtRep->execute();


        $resRep=$stmtRep->get_result();





        $mensaje=

        "🚌 Unidad: ".$unidad."\n\n".

        "🟢 ORDEN ABIERTA\n\n".

        "🚨 Prioridad:\n".
        $prioridad."\n\n".

        "📄 Orden:\n".
        "#".$orden["id"]."\n\n".

        "🔧 Razón:\n".
        $orden["razon"]."\n\n".

        "👨‍💼 Supervisor:\n".
        $orden["supervisor"]."\n\n".

        "📅 Apertura:\n".
        date(
            "d/m/Y H:i",
            strtotime($orden["fecha_apertura"])
        )."\n\n".

        "⏱ Tiempo abierta:\n".
        $tiempo."\n\n".

        "━━━━━━━━━━━━━━\n\n".

        "🔩 Reparaciones (".$resRep->num_rows.")\n\n";





        if($resRep->num_rows==0){

            $mensaje .=
            "Sin reparaciones registradas.";

        }
        else{


            $i=1;


            while($rep=$resRep->fetch_assoc()){


                $mensaje .=

                $i."️⃣ ".
                $rep["descripcion"];


                if(!empty($rep["mecanico"])){

                    $mensaje .=
                    "\n👨‍🔧 ".
                    $rep["mecanico"];

                }


                $mensaje .= "\n\n";


                $i++;

            }

        }


        return $mensaje;


    }







    //==================================================
    // SIN ORDEN ABIERTA
    // BUSCAR ULTIMA ORDEN
    //==================================================



    $sql="

    SELECT


        o.id,

        o.estado,

        cr.descripcion razon,

        s.supervisor,

        o.fecha_apertura,

        o.fecha_cierre


    FROM orden o


    INNER JOIN catalogo_razones cr

        ON cr.id=o.id_razon


    INNER JOIN supervisor s

        ON s.id=o.id_supervisor


    WHERE

        o.id_autobus=?


    ORDER BY

        o.fecha_apertura DESC


    LIMIT 1


    ";



    $stmt=$conexion->prepare($sql);

    $stmt->bind_param(
        "i",
        $id_autobus
    );

    $stmt->execute();


    $res=$stmt->get_result();




    if($res->num_rows==0){


        return

        "🚌 Unidad: ".$unidad."\n\n".

        "No existe historial de órdenes.";


    }




    $orden=$res->fetch_assoc();



    switch($orden["estado"]){


        case 1:
            $estado="ABIERTA";
        break;

        case 2:
            $estado="LIBERADA";
        break;

        case 3:
            $estado="CERRADA";
        break;

        case 4:
            $estado="CANCELADA";
        break;


        default:

            $estado="DESCONOCIDO";

    }





    return


    "🚌 Unidad: ".$unidad."\n\n".

    "✅ Actualmente sin órdenes abiertas.\n\n".

    "━━━━━━━━━━━━━━\n\n".

    "📄 Última orden\n\n".

    "Orden: #".
    $orden["id"]."\n\n".

    "Estado:\n".
    $estado."\n\n".

    "🔧 Razón:\n".
    $orden["razon"]."\n\n".

    "👨‍💼 Supervisor:\n".
    $orden["supervisor"]."\n\n".

    "📅 Apertura:\n".
    date(
        "d/m/Y H:i",
        strtotime($orden["fecha_apertura"])
    )."\n\n".

    "📅 Cierre:\n".
    (
        $orden["fecha_cierre"]
        ?
        date(
            "d/m/Y H:i",
            strtotime($orden["fecha_cierre"])
        )
        :
        "Sin cierre"
    );

}

?>