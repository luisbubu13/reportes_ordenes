<?php

require_once("../funciones/valida_mecanico.php");
require_once("../../funciones/conecta.php");

$conexion = conectar();

$id = intval($_GET["id"]);

$idMecanico = $_SESSION["id"];



/*
================================================
RECIBIR MOTIVO DE PAUSA
================================================
*/


$motivo = isset($_GET["motivo"])

    ? $conexion->real_escape_string($_GET["motivo"])

    : "otro";




/*
================================================
CAMBIAR ESTADO DE REPARACIÓN
================================================
*/


$sql = "

UPDATE reparacion

SET

estado = 2

WHERE

id = $id

AND id_mecanico = $idMecanico

AND estado = 1

";


$conexion->query($sql);




/*
================================================
CERRAR BLOQUE ACTUAL DE TRABAJO
GUARDANDO MOTIVO DE PAUSA
================================================

Busca el último historial abierto
del mecánico en esa reparación

================================================
*/


$sql = "

UPDATE reparacion_historial

SET

fecha_fin = NOW(),

estado = 2,

motivo_pausa = '$motivo'

WHERE

id_reparacion = $id

AND id_mecanico = $idMecanico

AND fecha_fin IS NULL

ORDER BY id DESC

LIMIT 1

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