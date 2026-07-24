<?php

session_start();

require_once("../funciones/conecta.php");

$conexion = conectar();

$id = isset($_POST["id"])
    ? trim($_POST["id"])
    : "";

if($id == ""){

    header("Location:index.php?e=1");
    exit;

}

/*====================================
    BUSCAR MECÁNICO
====================================*/

$sql = "

SELECT

    id,
    id_mecanico,
    nombre

FROM mecanicos

WHERE id_mecanico = '$id'
AND eliminado = 0

LIMIT 1

";

$res = $conexion->query($sql);

if($res && $res->num_rows > 0){

    $m = $res->fetch_assoc();

    $_SESSION["tipo"] = "mecanico";

    $_SESSION["id"] = $m["id"];

    $_SESSION["clave"] = $m["id_mecanico"];

    $_SESSION["nombre"] = $m["nombre"];

    header("Location:mecanico/index.php");
    exit;

}


/*====================================
    BUSCAR SUPERVISOR
====================================*/

$sql = "

SELECT

    id,
    id_supervisor,
    supervisor

FROM supervisor

WHERE id_supervisor = '$id'
AND eliminado = 0

LIMIT 1

";

$res = $conexion->query($sql);

if($res && $res->num_rows > 0){

    $s = $res->fetch_assoc();

    $_SESSION["tipo"] = "supervisor";

    $_SESSION["id"] = $s["id"];

    $_SESSION["id_supervisor"] = $s["id_supervisor"];

    $_SESSION["clave"] = $s["id_supervisor"];

    $_SESSION["nombre"] = $s["supervisor"];

    header("Location:supervisor/index.php");
    exit;

}

/*====================================
    NO EXISTE
====================================*/

header("Location:index.php?e=1");
exit;

?>