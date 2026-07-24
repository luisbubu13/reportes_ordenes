<?php

require_once("../funciones/valida_mecanico.php");
require_once("../../funciones/conecta.php");

$conexion = conectar();

$id = intval($_GET["id"]);

$idMecanico = $_SESSION["id"];



/*
================================================
CAMBIAR ESTADO DE REPARACIÓN
Y CERRARLA
================================================
*/


$sql = "

UPDATE reparacion

SET

estado = 3,

fecha_fin = NOW()

WHERE

id = $id

AND id_mecanico = $idMecanico

AND estado <> 3

";


$conexion->query($sql);




/*
================================================
CERRAR ÚLTIMO BLOQUE DE TRABAJO
================================================

Busca el último historial abierto
del mecánico en esa reparación

================================================
*/


$sql = "

UPDATE reparacion_historial

SET

fecha_fin = NOW(),

estado = 3

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