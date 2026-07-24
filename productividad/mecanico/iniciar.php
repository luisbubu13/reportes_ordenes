<?php

require_once("../funciones/valida_mecanico.php");
require_once("../../funciones/conecta.php");

$conexion = conectar();

$id = intval($_GET["id"]);

$idMecanico = $_SESSION["id"];



/*
================================================
VALIDAR SI YA TIENE UNA REPARACIÓN ACTIVA
================================================
*/


$sql = "

SELECT id

FROM reparacion_historial

WHERE

id_mecanico = $idMecanico

AND fecha_fin IS NULL

LIMIT 1

";


$res = $conexion->query($sql);



if($res && $res->num_rows > 0){


    echo "

    <script>

    alert(
    'Ya tienes una reparación en proceso. Pausa o termina la actual antes de iniciar otra.'
    );

    window.location='index.php';

    </script>

    ";


    exit;

}




/*
================================================
ACTUALIZAR REPARACIÓN
================================================
*/


$sql = "

UPDATE reparacion

SET

estado = 1,

fecha_inicio = IF(

    fecha_inicio IS NULL,

    NOW(),

    fecha_inicio

)

WHERE

id = $id

AND id_mecanico = $idMecanico

AND estado <> 3

";


$conexion->query($sql);



if($conexion->affected_rows == 0){


    echo "

    <script>

    alert(
    'No se pudo iniciar la reparación.'
    );

    window.location='index.php';

    </script>

    ";


    exit;

}




/*
================================================
CREAR BLOQUE DE HISTORIAL
================================================
*/


$sql = "

INSERT INTO reparacion_historial

(

id_reparacion,

id_mecanico,

fecha_inicio,

estado

)

VALUES

(

$id,

$idMecanico,

NOW(),

1

)

";


$conexion->query($sql);




/*
================================================
REGRESAR AL KIOSKO
================================================
*/


header("Location:index.php");

exit;

?>