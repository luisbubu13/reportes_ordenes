<?php

date_default_timezone_set('America/Mexico_City');

function conectar() {

    $host = "db";
    $user = "root";
    $pass = "root";
    $db   = "reportes_ordenes";

    $conexion = new mysqli($host, $user, $pass, $db);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $conexion->set_charset("utf8");

    return $conexion;
}