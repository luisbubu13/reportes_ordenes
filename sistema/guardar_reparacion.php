<?php
require_once("../funciones/conecta.php");

$conexion = conectar();

// =====================
// VALIDAR MÉTODO
// =====================
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit;
}

// =====================
// CAPTURAR DATOS
// =====================
$id_orden   = isset($_POST['id_orden']) ? (int)$_POST['id_orden'] : 0;
$reparacion = trim($_POST['reparacion'] ?? "");

// =====================
// VALIDAR
// =====================
if ($id_orden <= 0 || $reparacion == "") {
    die("Faltan datos obligatorios.");
}

// =====================
// INSERTAR REPARACIÓN
// =====================
$sql = "INSERT INTO reparacion (id_orden, descripcion)
        VALUES (?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("is", $id_orden, $reparacion);

if ($stmt->execute()) {

    header("Location: orden_detalle.php?id=".$id_orden);
    exit;

} else {

    die("Error al guardar la reparación: " . $conexion->error);

}

$stmt->close();
$conexion->close();
?>