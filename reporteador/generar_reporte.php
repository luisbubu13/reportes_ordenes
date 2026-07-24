<?php

function generarReporte($conexion, $idSupervisor){

    //=========================================
    // OBTENER NOMBRE DEL SUPERVISOR
    //=========================================

    $sqlSupervisor = "

    SELECT supervisor

    FROM supervisor

    WHERE id = $idSupervisor

    LIMIT 1

    ";

    $resSupervisor = $conexion->query($sqlSupervisor);

    if(!$resSupervisor || $resSupervisor->num_rows == 0){

        return "Supervisor no encontrado.";

    }

    $sup = $resSupervisor->fetch_assoc();

    $mensaje =
        "Buen día ".$sup["supervisor"]." 👋\n\n".
        "🚍 REPORTE DE ÓRDENES PENDIENTES\n\n";


    //=========================================
    // EMPRESAS
    //=========================================

    $sqlEmpresas = "

    SELECT
        id,
        nombre

    FROM empresa

    WHERE eliminado = 0

    AND id BETWEEN 1 AND 4

    ORDER BY id

    ";

    $resEmpresas = $conexion->query($sqlEmpresas);

    $tieneOrdenGeneral = false;


    while($empresa = $resEmpresas->fetch_assoc()){

        $id_empresa = $empresa["id"];


        $sqlOrdenes = "

        SELECT

            cr.descripcion,
            a.unidad,
            o.fecha_apertura

        FROM orden o

        INNER JOIN autobus a
            ON a.id=o.id_autobus

        INNER JOIN catalogo_razones cr
            ON cr.id=o.id_razon

        INNER JOIN supervisor_razon sr
            ON sr.id_razon=o.id_razon

        WHERE

            a.id_empresa=$id_empresa

        AND sr.id_supervisor=$idSupervisor

        AND o.estado=1

        ORDER BY o.fecha_apertura ASC

        ";

        $resOrdenes = $conexion->query($sqlOrdenes);

        $razones = [];

        while($orden = $resOrdenes->fetch_assoc()){

            $razones[$orden["descripcion"]][] = $orden;

        }


        if(count($razones)==0){

            $mensaje .=

            "🏢 ".$empresa["nombre"]."\n".

            "✅ Sin órdenes pendientes actualmente.\n\n";

            continue;

        }

        $tieneOrdenGeneral = true;

        $mensaje .=

        "━━━━━━━━━━━━━━\n".

        "🏢 ".$empresa["nombre"]."\n\n";


        foreach($razones as $nombreRazon=>$ordenes){

            $criticas=[];
            $atencion=[];
            $recientes=[];

            foreach($ordenes as $orden){

                $horas = floor(

                    (time()-strtotime($orden["fecha_apertura"]))

                    /3600

                );

                if($horas>72){

                    $criticas[]=[

                        "unidad"=>$orden["unidad"],
                        "fecha"=>$orden["fecha_apertura"],
                        "horas"=>$horas

                    ];

                }
                elseif($horas>48){

                    $atencion[]=[

                        "unidad"=>$orden["unidad"],
                        "fecha"=>$orden["fecha_apertura"],
                        "horas"=>$horas

                    ];

                }
                else{

                    $recientes[]=[

                        "unidad"=>$orden["unidad"],
                        "fecha"=>$orden["fecha_apertura"],
                        "horas"=>$horas

                    ];

                }

            }


            $mensaje .=

            "🔧 ".$nombreRazon."\n".

            "Pendientes: ".count($ordenes)."\n\n";


            if(count($criticas)>0){

                $mensaje.="🔴 CRÍTICAS\n";

                foreach($criticas as $o){

                    $mensaje.=
                    $o["unidad"]." | ".
                    date("d/m/Y H:i",strtotime($o["fecha"])).
                    " | ".
                    $o["horas"].
                    " horas\n";

                }

                $mensaje.="\n";

            }


            if(count($atencion)>0){

                $mensaje.="🟠 ATENCIÓN\n";

                foreach($atencion as $o){

                    $mensaje.=
                    $o["unidad"]." | ".
                    date("d/m/Y H:i",strtotime($o["fecha"])).
                    " | ".
                    $o["horas"].
                    " horas\n";

                }

                $mensaje.="\n";

            }


            if(count($recientes)>0){

                $mensaje.="🟢 RECIENTES\n";

                foreach($recientes as $o){

                    $mensaje.=
                    $o["unidad"]." | ".
                    date("d/m/Y H:i",strtotime($o["fecha"])).
                    "\n";

                }

                $mensaje.="\n";

            }

        }

    }


    if(!$tieneOrdenGeneral){

        $mensaje.="✅ No existen órdenes pendientes asignadas.";

    }

    return $mensaje;

}