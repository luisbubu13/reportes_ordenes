<?php

require_once("../funciones/valida_mecanico.php");
require_once("../../funciones/conecta.php");

$conexion = conectar();

$id = intval($_GET["id"]);

$idMecanico = $_SESSION["id"];



/*
================================================
VALIDAR QUE NO TENGA OTRO TRABAJO ACTIVO
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
    'Ya tienes una reparación trabajando.'
    );

    window.location='index.php';

    </script>

    ";


    exit;

}




/*
================================================
CAMBIAR ESTADO DE REPARACIÓN
DE PAUSA A ACTIVA
================================================
*/


$sql = "

UPDATE reparacion

SET

estado = 1

WHERE

id = $id

AND id_mecanico = $idMecanico

AND estado = 2

";


$conexion->query($sql);



if($conexion->affected_rows == 0){


    echo "

    <script>

    alert(
    'La reparación no puede reanudarse.'
    );

    window.location='index.php';

    </script>

    ";


    exit;

}




/*
================================================
CREAR NUEVO BLOQUE DE HISTORIAL
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