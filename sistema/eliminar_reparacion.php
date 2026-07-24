<?php
require_once("../funciones/conecta.php");
$conexion = conectar();

// =====================
// RECIBIR DATOS
// =====================
$ids = $_GET['id'] ?? "";
$id_orden = $_GET['id_orden'] ?? "";

if (trim($ids) == "" || !$id_orden) {
    die("Datos incompletos.");
}

// =====================
// LIMPIAR IDS
// =====================
$ids = explode(",", $ids);
$ids = array_map('intval', $ids);
$ids = array_filter($ids);

if (count($ids) == 0) {
    die("IDs inválidos.");
}

$lista = implode(",", $ids);

// =====================
// ELIMINAR REPARACIONES
// =====================
$sql = "
DELETE FROM reparacion
WHERE id IN ($lista)
AND id_orden = ?
";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_orden);

if ($stmt->execute()) {

    header("Location: orden_detalle.php?id=".$id_orden);
    exit;

} else {

    die("Error al eliminar las reparaciones: ".$conexion->error);

}
?>