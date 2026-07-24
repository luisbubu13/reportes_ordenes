<?php

require_once("../funciones/conecta.php");

$conexion = conectar();

echo "<h2>Generando datos de prueba...</h2>";



/*
================================================
LIMPIAR DATOS
================================================
*/

$conexion->query(
    "SET FOREIGN_KEY_CHECKS=0"
);


$conexion->query(
    "DELETE FROM reparacion_historial"
);


$conexion->query(
    "DELETE FROM reparacion"
);


$conexion->query(
    "DELETE FROM orden"
);


$conexion->query(
    "ALTER TABLE reparacion_historial AUTO_INCREMENT=1"
);


$conexion->query(
    "ALTER TABLE reparacion AUTO_INCREMENT=1"
);


$conexion->query(
    "ALTER TABLE orden AUTO_INCREMENT=1"
);


$conexion->query(
    "SET FOREIGN_KEY_CHECKS=1"
);



/*
================================================
CONFIGURACIÓN
================================================
*/


$totalOrdenes = 100;



/*
================================================
RAZONES
================================================
*/


$razonesTroncal = [

    1,
    3,
    5,
    7,
    9,
    11

];


$razonesAlimentador = [

    2,
    4,
    6,
    8,
    10,
    12

];



/*
================================================
CATÁLOGO DE REPARACIONES
================================================
*/


$catalogoReparaciones = [


1 => [

    "Cambio de suspensión",
    "Revisión sistema eléctrico",
    "Cambio bomba hidráulica",
    "Cambio compresor",
    "Ajuste de frenos"

],


2 => [

    "Cambio de balatas",
    "Fuga de aire",
    "Cambio manguera neumática",
    "Revisión suspensión",
    "Ajuste puertas"

],


3 => [

    "Cambio de aceite",
    "Cambio de filtros",
    "Engrase general",
    "Revisión niveles",
    "Servicio preventivo"

],


4 => [

    "Lubricación",
    "Cambio aceite motor",
    "Revisión frenos",
    "Cambio filtros",
    "Servicio general"

],


5 => [

    "Reparar defensa",
    "Cambio parabrisas",
    "Reparar carrocería",
    "Revisión golpe frontal",
    "Cambio piezas dañadas"

],


6 => [

    "Reparar defensa lateral",
    "Cambio espejo",
    "Puerta dañada",
    "Reparar faldón",
    "Revisión accidente"

],


7 => [

    "Arrastre a taller",
    "Revisión eléctrica",
    "Cambio batería",
    "Revisión marcha",
    "Falla motor"

],


8 => [

    "Arrastre unidad",
    "Cambio batería",
    "Falla eléctrica",
    "Revisión alternador",
    "Revisión motor"

],


9 => [

    "Reparar faldón",
    "Cambio parabrisas",
    "Reparar defensa",
    "Reparar puerta",
    "Cambio piezas carrocería"

],


10 => [

    "Puerta servicio",
    "Cambio espejo",
    "Defensa trasera",
    "Reparación carrocería",
    "Ajuste puertas"

],


11 => [

    "Cambio de llanta",
    "Parchar llanta",
    "Cambio rin",
    "Balanceo",
    "Rotación llantas"

],


12 => [

    "Cambio de llanta",
    "Parchar llanta",
    "Cambio válvula",
    "Balanceo",
    "Revisión neumático"

]

];



/*
================================================
MECÁNICOS
================================================
*/


$mecanicos = [

    1 => "Julio Diaz",

    2 => "Israel Arevalos",

    3 => "Jaime Perez",

    4 => "Javier Eugenio",

    5 => "Antonio Arevalos"

];



/*
================================================
AGENDA DE MECÁNICOS

Aquí se almacenarán
los bloques de trabajo.

Ejemplo:

$mecanicosAgenda[1][] = [

    inicio => "2026-07-19 08:00:00",
    fin => "2026-07-19 09:00:00",
    reparacion => 25

];

================================================
*/


$mecanicosAgenda = [];

/*
================================================
CARGAR AUTOBUSES
================================================
*/


$autobuses = [];


$sql = "

SELECT

id,

unidad,

id_empresa

FROM autobus

WHERE eliminado = 0

AND id_empresa BETWEEN 1 AND 4

";


$res = $conexion->query($sql);


if(!$res){

    die(
        "Error cargando autobuses: "
        .
        $conexion->error
    );

}



while(
    $bus = $res->fetch_assoc()
){


    $empresa =
    $bus["id_empresa"];


    $unidad =
    strtoupper(
        $bus["unidad"]
    );



    /*
    ============================================
    AUTOBUSES TRONCALES
    ============================================

    Empresa 1:
    TM

    Empresa 2:
    TR

    ============================================
    */


    if(

        strpos($unidad,"TM") === 0

        ||

        strpos($unidad,"TR") === 0

    ){

        $autobuses[$empresa]["troncal"][] =
        $bus;

    }


    /*
    ============================================
    AUTOBUSES ALIMENTADORES
    ============================================

    AM
    AR
    CIM
    C112
    UM
    VU

    ============================================
    */


    else{


        $autobuses[$empresa]["alimentador"][] =
        $bus;


    }


}



/*
================================================
OBTENER AUTOBÚS ALEATORIO
================================================
*/


function obtenerAutobus(

    $autobuses,

    $empresa,

    $tipo

){


    if(

        empty(
            $autobuses[$empresa][$tipo]
        )

    ){

        return null;

    }



    $lista =

    $autobuses[$empresa][$tipo];



    return

    $lista[

        array_rand($lista)

    ];

}



/*
================================================
GENERADOR DE ÓRDENES
================================================
*/


$generadas = 0;



while(

    $generadas < $totalOrdenes

){



    /*
    ============================================
    EMPRESA ALEATORIA
    ============================================
    */


    $empresa =
    rand(1,4);



    /*
    ============================================
    SELECCIONAR RAZÓN
    ============================================
    */


    if(
        rand(0,1)
    ){


        $razon =

        $razonesTroncal[

            array_rand(
                $razonesTroncal
            )

        ];


        $tipo =
        "troncal";


    }
    else{


        $razon =

        $razonesAlimentador[

            array_rand(
                $razonesAlimentador
            )

        ];


        $tipo =
        "alimentador";


    }




    /*
    ============================================
    BUSCAR AUTOBÚS
    ============================================
    */


    $bus =

    obtenerAutobus(

        $autobuses,

        $empresa,

        $tipo

    );



    if(
        $bus === null
    ){

        continue;

    }



    $idAutobus =

    $bus["id"];



    /*
    ============================================
    SUPERVISOR

    Temporalmente usamos uno válido.

    ============================================
    */


    $idSupervisor = 1;



    /*
    ============================================
    ESTADO DE ORDEN
    ============================================
    */


    $r =
    rand(1,100);



    if(
        $r <= 35
    ){

        $estado = 1;

    }
    elseif(
        $r <= 60
    ){

        $estado = 2;

    }
    elseif(
        $r <= 90
    ){

        $estado = 3;

    }
    else{

        $estado = 4;

    }



    /*
    ============================================
    FECHA APERTURA
    ============================================
    */


    $dias =
    rand(0,7);



    $hora =
    rand(6,20);



    $minuto =
    rand(0,59);



    $fechaApertura = date(

        "Y-m-d H:i:s",

        strtotime(

            "-".$dias." days "
            .
            $hora
            .
            ":"
            .
            $minuto
            .
            ":00"

        )

    );



    /*
    ============================================
    FECHAS INICIALES
    ============================================
    */


    $fechaLiberacion = null;

    $fechaCierre = null;

    /*
    ================================================
    LIBERACIÓN

    Estados 2 y 3 tienen liberación.

    Estado 4 puede tener o no.

    ================================================
    */


    if(

        $estado == 2 ||

        $estado == 3

    ){

        $minutos = rand(
            30,
            1200
        );


        $fechaLiberacion = date(

            "Y-m-d H:i:s",

            strtotime(

                $fechaApertura
                .
                " +"
                .
                $minutos
                .
                " minutes"

            )

        );

    }



    if(
        $estado == 4
    ){

        if(
            rand(0,1)
        ){

            $minutos = rand(
                30,
                1200
            );


            $fechaLiberacion = date(

                "Y-m-d H:i:s",

                strtotime(

                    $fechaApertura
                    .
                    " +"
                    .
                    $minutos
                    .
                    " minutes"

                )

            );

        }

    }



    /*
    ================================================
    CIERRE

    Estados 3 y 4

    ================================================
    */


    if(

        $estado == 3 ||

        $estado == 4

    ){


        if(
            $fechaLiberacion != null
        ){

            $base =
            $fechaLiberacion;

        }
        else{

            $base =
            $fechaApertura;

        }



        $minutos = rand(
            20,
            300
        );



        $fechaCierre = date(

            "Y-m-d H:i:s",

            strtotime(

                $base
                .
                " +"
                .
                $minutos
                .
                " minutes"

            )

        );

    }



    /*
    ================================================
    INSERTAR ORDEN
    ================================================
    */


    $sql = "

    INSERT INTO orden

    (

        id_autobus,

        id_razon,

        id_supervisor,

        fecha_apertura,

        fecha_liberacion,

        fecha_cierre,

        estado

    )

    VALUES

    (

        $idAutobus,

        $razon,

        $idSupervisor,

        '$fechaApertura',

    ";



    $sql .=

    (
        $fechaLiberacion != null
        ?
        "'$fechaLiberacion'"
        :
        "NULL"
    );



    $sql .= ",";



    $sql .=

    (
        $fechaCierre != null
        ?
        "'$fechaCierre'"
        :
        "NULL"
    );



    $sql .= ",

    $estado

    )

    ";



    if(
        !$conexion->query($sql)
    ){

        echo "<br>Error orden: ".$conexion->error;

        continue;

    }



    $idOrden =

    $conexion->insert_id;



    $generadas++;



    echo "

    <br>

    Orden creada:

    ".$generadas."

    / ".$totalOrdenes;





    /*
    ================================================
    GENERAR REPARACIONES NORMALES

    Sin mecánico

    ================================================
    */


    $listaReparaciones =

    $catalogoReparaciones[$razon];



    shuffle(
        $listaReparaciones
    );



    $cantidad = rand(
        2,
        4
    );



    $contador = 0;



    foreach(

        $listaReparaciones

        as

        $descripcion

    ){


        if(
            $contador >= $cantidad
        ){

            break;

        }



        $descripcionSQL =

        $conexion->real_escape_string(

            $descripcion

        );



        $conexion->query("

        INSERT INTO reparacion

        (

            id_orden,

            id_mecanico,

            descripcion,

            fecha_inicio,

            fecha_fin,

            estado

        )

        VALUES

        (

            $idOrden,

            NULL,

            '$descripcionSQL',

            NULL,

            NULL,

            0

        )

        ");



        $contador++;

    }



    /*
    ================================================
    CREAR REPARACIÓN DE MANO DE OBRA

    Esta es la reparación que tendrá historial.

    ================================================
    */


    $idMecanico = rand(
        1,
        5
    );



    $descripcionSQL =

    $conexion->real_escape_string(

        $mecanicos[$idMecanico]

    );




    $fechaInicio = null;

    $fechaFin = null;



    /*
    ================================================
    INICIO DEL TRABAJO

    ================================================
    */


    if(
        rand(0,100) <= 80
    ){


        $fechaInicio = date(

            "Y-m-d H:i:s",

            strtotime(

                $fechaApertura
                .
                " +"
                .
                rand(20,240)
                .
                " minutes"

            )

        );



        /*
        Si la orden terminó,
        la mano de obra puede terminar.

        */

        if(

            $estado == 3 ||

            $estado == 4

        ){


            $fechaFin = date(

                "Y-m-d H:i:s",

                strtotime(

                    $fechaInicio
                    .
                    " +"
                    .
                    rand(30,300)
                    .
                    " minutes"

                )

            );


        }

    }





    /*
    ================================================
    INSERTAR REPARACIÓN MECÁNICO
    ================================================
    */


    $sql = "

    INSERT INTO reparacion

    (

        id_orden,

        id_mecanico,

        descripcion,

        fecha_inicio,

        fecha_fin,

        estado

    )

    VALUES

    (

        $idOrden,

        $idMecanico,

        '$descripcionSQL',

    ";



    $sql .=

    (
        $fechaInicio != null
        ?
        "'$fechaInicio'"
        :
        "NULL"
    );



    $sql .= ",";



    $sql .=

    (
        $fechaFin != null
        ?
        "'$fechaFin'"
        :
        "NULL"
    );



    $sql .= ",

    ";



    /*
    Estado reparación:

    0 pendiente

    1 trabajando

    3 terminada

    */


    if(
        $fechaFin != null
    ){

        $estadoReparacion = 3;

    }
    elseif(
        $fechaInicio != null
    ){

        $estadoReparacion = 1;

    }
    else{

        $estadoReparacion = 0;

    }



    $sql .= $estadoReparacion;



    $sql .= "

    )

    ";



    $conexion->query($sql);

}

/*
================================================
MOTOR DE AGENDA DE MECÁNICOS
PARTE 4.1

Preparación del sistema

================================================
*/


/*
================================================
LIMPIAR HISTORIAL ANTERIOR

Por seguridad

================================================
*/


$conexion->query("

DELETE FROM reparacion_historial

");



$conexion->query("

ALTER TABLE reparacion_historial AUTO_INCREMENT = 1

");





/*
================================================
AGENDA DE MECÁNICOS

Aquí se almacenarán los bloques ocupados.

Ejemplo:

$agendaMecanicos[1]

[
    inicio,
    fin,
    reparacion
]

================================================
*/


$agendaMecanicos = [];





/*
================================================
CARGAR MECÁNICOS ACTIVOS

================================================
*/


$mecanicosAgenda = [];



$sql = "

SELECT

id,

id_mecanico,

nombre

FROM mecanicos

WHERE eliminado = 0

ORDER BY id

";



$res = $conexion->query($sql);



while(

    $m = $res->fetch_assoc()

){


    $mecanicosAgenda[$m["id"]] = [

        "id_mecanico" =>
        $m["id_mecanico"],


        "nombre" =>
        $m["nombre"],


        "trabajos" => []

    ];


}





/*
================================================
FUNCIÓN:

CALCULAR MINUTOS ENTRE FECHAS

================================================
*/


function diferenciaMinutos(

    $inicio,

    $fin

){


    return floor(

        (

            strtotime($fin)

            -

            strtotime($inicio)

        )

        /

        60

    );


}





/*
================================================
FUNCIÓN:

VALIDAR SI EXISTE TRASLAPE

================================================

TRUE  = ocupado

FALSE = libre

================================================
*/


function existeTraslape(

    $agenda,

    $inicio,

    $fin

){



    foreach(

        $agenda

        as

        $bloque

    ){



        if(

            strtotime($inicio)

            <

            strtotime($bloque["fin"])

            &&


            strtotime($fin)

            >

            strtotime($bloque["inicio"])

        ){


            return true;


        }



    }



    return false;


}





/*
================================================
FUNCIÓN:

AGREGAR BLOQUE A AGENDA

================================================
*/


function agregarBloqueAgenda(

    &$agenda,

    $inicio,

    $fin,

    $idReparacion

){



    $agenda[] = [

        "inicio" =>
        $inicio,


        "fin" =>
        $fin,


        "reparacion" =>
        $idReparacion

    ];


}

/*
================================================
MOTOR DE AGENDA DE MECÁNICOS
PARTE 4.2

Crear jornadas laborales

================================================
*/


/*
================================================
CREAR JORNADA DE UN MECÁNICO

8 a 9 horas aproximadamente

================================================
*/


function crearJornadaMecanico(

    $fecha

){


    /*
    Entrada fija 08:00

    */

    $entrada = strtotime(

        $fecha
        .
        " 08:00:00"

    );



    /*
    Jornada:

    8 a 9 horas

    */

    $horas = rand(
        8,
        9
    );



    /*
    Algunos minutos extra
    para hacerlo más natural

    */

    $minutos = rand(
        0,
        45
    );



    $salida = $entrada

    +

    ($horas * 60 * 60)

    +

    ($minutos * 60);




    return [

        "inicio" => date(

            "Y-m-d H:i:s",

            $entrada

        ),


        "fin" => date(

            "Y-m-d H:i:s",

            $salida

        ),


        "trabajos" => []

    ];

}






/*
================================================
DETERMINAR DÍAS DE TRABAJO

Tomamos las fechas usadas
en las órdenes generadas.

================================================
*/


$diasTrabajo = [];



$sql = "

SELECT DISTINCT

DATE(fecha_apertura) AS dia

FROM orden

ORDER BY dia

";



$res = $conexion->query($sql);



while(

    $dia = $res->fetch_assoc()

){


    $diasTrabajo[] =

    $dia["dia"];


}





/*
================================================
CREAR CALENDARIO

Estructura:

$mecanicosCalendario

mecanico

    dia

        inicio

        fin

        trabajos


================================================
*/


$mecanicosCalendario = [];



foreach(

    $mecanicosAgenda

    as

    $id => $mecanico

){


    $mecanicosCalendario[$id] = [];



    foreach(

        $diasTrabajo

        as

        $dia

    ){



        $mecanicosCalendario[$id][$dia]

        =

        crearJornadaMecanico(

            $dia

        );


    }


}

/*
================================================
MOTOR DE AGENDA DE MECÁNICOS
PARTE 4.3

Asignación de trabajos

================================================
*/



/*
================================================
CARGAR REPARACIONES CON MANO DE OBRA

Solo las que tienen mecánico

================================================
*/


$reparacionesTrabajo = [];



$sql = "

SELECT

r.id,

r.id_orden,

r.id_mecanico,

r.descripcion,

DATE(o.fecha_apertura) AS dia


FROM reparacion r


INNER JOIN orden o

ON o.id = r.id_orden


WHERE r.id_mecanico IS NOT NULL


ORDER BY

o.fecha_apertura

";



$res = $conexion->query($sql);



while(

    $row = $res->fetch_assoc()

){


    $reparacionesTrabajo[] = $row;


}







/*
================================================
FUNCIÓN:

BUSCAR ESPACIO LIBRE

Dentro de la jornada del mecánico

================================================
*/


function buscarEspacioLibre(

    &$diaAgenda,

    $duracion,

    $idReparacion

){



    $inicioJornada =

    strtotime(

        $diaAgenda["inicio"]

    );



    $finJornada =

    strtotime(

        $diaAgenda["fin"]

    );



    /*
    Primer intento:

    inicio de jornada

    */

    $inicio = $inicioJornada;



    while(

        ($inicio + ($duracion*60))

        <=

        $finJornada

    ){



        $fin =

        $inicio

        +

        ($duracion*60);




        $ocupado = false;



        foreach(

            $diaAgenda["trabajos"]

            as

            $trabajo

        ){



            if(

                $inicio

                <

                strtotime($trabajo["fin"])


                &&


                $fin

                >

                strtotime($trabajo["inicio"])

            ){


                $ocupado = true;

                break;


            }



        }





        if(!$ocupado){



            return [

                "inicio" => date(

                    "Y-m-d H:i:s",

                    $inicio

                ),


                "fin" => date(

                    "Y-m-d H:i:s",

                    $fin

                )

            ];


        }




        /*
        Avanzar buscando hueco

        */

        $inicio +=

        15 * 60;



    }



    return null;


}







/*
================================================
ASIGNAR REPARACIONES

================================================
*/


foreach(

    $reparacionesTrabajo

    as

    $trabajo

){



    $idMecanico =

    $trabajo["id_mecanico"];



    $dia =

    $trabajo["dia"];





    /*
    Si no existe jornada

    */

    if(

        !isset(

            $mecanicosCalendario[$idMecanico][$dia]

        )

    ){

        continue;

    }





    /*
    Duración del trabajo

    30 minutos a 3 horas

    */

    $duracion = rand(

        30,

        180

    );




    /*
    Buscar espacio

    */

    $espacio =

    buscarEspacioLibre(

        $mecanicosCalendario[$idMecanico][$dia],

        $duracion,

        $trabajo["id"]

    );




    /*
    Si encontró lugar

    guardamos

    */

    if(

        $espacio != null

    ){



        $mecanicosCalendario[$idMecanico][$dia]["trabajos"][] = [

            "id_reparacion" =>

            $trabajo["id"],


            "inicio" =>

            $espacio["inicio"],


            "fin" =>

            $espacio["fin"]

        ];



    }


}

/*
================================================
MOTOR DE AGENDA DE MECÁNICOS
PARTE 4.4

Crear reparacion_historial

================================================
*/



/*
================================================
INSERTAR HISTORIAL

Recorremos todas las agendas

================================================
*/


foreach(

    $mecanicosCalendario

    as

    $idMecanico => $dias

){



    foreach(

        $dias

        as

        $dia => $agenda

    ){



        foreach(

            $agenda["trabajos"]

            as

            $trabajo

        ){



            $idReparacion =

            $trabajo["id_reparacion"];



            $inicio =

            $trabajo["inicio"];



            $fin =

            $trabajo["fin"];





            /*
            Insertar historial

            */

            $sql = "

            INSERT INTO reparacion_historial

            (

                id_reparacion,

                id_mecanico,

                fecha_inicio,

                fecha_fin,

                estado

            )

            VALUES

            (

                $idReparacion,

                $idMecanico,

                '$inicio',

                '$fin',

                1

            )

            ";




            if(

                !$conexion->query($sql)

            ){


                echo "

                <br>

                Error historial:

                "

                .

                $conexion->error;


            }



        }



    }


}

/*
================================================
MOTOR DE AGENDA DE MECÁNICOS
PARTE 4.5

Continuidad entre días

================================================
*/


/*
================================================
BUSCAR REPARACIONES SIN HISTORIAL COMPLETO

Calculamos cuánto trabajo quedó pendiente

================================================
*/


$sql = "

SELECT

r.id,

r.id_mecanico,

r.descripcion


FROM reparacion r


WHERE r.id_mecanico IS NOT NULL


AND NOT EXISTS

(

    SELECT 1

    FROM reparacion_historial h

    WHERE h.id_reparacion = r.id

)

";



$res = $conexion->query($sql);



while(

    $pendiente = $res->fetch_assoc()

){


    $idReparacion =

    $pendiente["id"];



    $idMecanico =

    $pendiente["id_mecanico"];




    /*
    Elegimos un día posterior

    */

    $diaNuevo = date(

        "Y-m-d",

        strtotime(

            "+1 day"

        )

    );




    /*
    Si no existe jornada,
    no hacemos nada

    */

    if(

        !isset(

            $mecanicosCalendario[$idMecanico][$diaNuevo]

        )

    ){

        continue;

    }




    /*
    Tiempo pendiente

    */

    $duracion = rand(

        30,

        120

    );




    $espacio =

    buscarEspacioLibre(

        $mecanicosCalendario[$idMecanico][$diaNuevo],

        $duracion,

        $idReparacion

    );




    if(

        $espacio != null

    ){



        $mecanicosCalendario[$idMecanico][$diaNuevo]["trabajos"][] = [

            "id_reparacion" =>

            $idReparacion,


            "inicio" =>

            $espacio["inicio"],


            "fin" =>

            $espacio["fin"]

        ];



        /*
        Insertar continuación

        */

        $conexion->query("

        INSERT INTO reparacion_historial

        (

            id_reparacion,

            id_mecanico,

            fecha_inicio,

            fecha_fin,

            estado

        )

        VALUES

        (

            $idReparacion,

            $idMecanico,

            '".$espacio["inicio"]."',

            '".$espacio["fin"]."',

            1

        )

        ");


    }



}

/*
================================================
RESUMEN FINAL
================================================
*/


$totalHistorial = 0;


$sql = "

SELECT COUNT(*) total

FROM reparacion_historial

";


$res = $conexion->query($sql);


if($res){

    $row = $res->fetch_assoc();

    $totalHistorial = $row["total"];

}



echo "

<hr>

<h2>
✅ Datos generados correctamente
</h2>


<ul>


<li>

Órdenes generadas:

<b>
$generadas
</b>

</li>



<li>

Empresas utilizadas:

<b>
1 a 4
</b>

</li>



<li>

Autobuses:

<b>

Troncales y alimentadores validados

</b>

</li>



<li>

Estados de orden:

<b>

Abierta,
Liberada,
Cerrada,
Cancelada

</b>

</li>



<li>

Reparaciones:

<b>

Fallas generadas por razón

</b>

</li>



<li>

Mano de obra:

<b>

Mecánicos asignados

</b>

</li>



<li>

Historial generado:

<b>

$totalHistorial registros

</b>

</li>



</ul>



<br>



<a href='index.php'>

Regresar al reporteador

</a>

";



$conexion->close();


?>