<?php
require_once("../funciones/conecta.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$reparaciones = $_POST['reparaciones'] ?? [];
$id_mecanico  = $_POST['id_mecanico'] ?? null;
$id_orden     = $_POST['id_orden'] ?? null;

if (!$id_mecanico || !$id_orden || empty($reparaciones)) {
    die("Datos incompletos");
}

$reparaciones = array_map('intval', $reparaciones);
$reparaciones = array_filter($reparaciones);

if (count($reparaciones) === 0) {
    die("Reparaciones inválidas");
}

$lista = implode(",", $reparaciones);

$sql = "
UPDATE reparacion
SET id_mecanico = ?
WHERE id IN ($lista)
AND id_orden = ?
";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("ii", $id_mecanico, $id_orden);

if ($stmt->execute()) {
    header("Location: orden_detalle.php?id=" . $id_orden);
    exit;
}

die("Error: " . $conexion->error);
?>