<?php

require_once("../funciones/conecta.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

// =====================
// CAPTURAR DATOS
// =====================
$id_autobus     = $_POST['id_autobus'] ?? null;
$id_supervisor  = $_POST['id_supervisor'] ?? null;
$id_razon       = $_POST['id_razon'] ?? null;
$fecha_apertura = $_POST['fecha_apertura'] ?? null;

if (!$id_autobus || !$id_supervisor || !$id_razon || !$fecha_apertura) {
    die("Faltan datos obligatorios");
}

// =====================
// BLOQUEO DE ORDEN ABIERTA
// =====================
$stmt = $conexion->prepare("
SELECT id
FROM orden
WHERE id_autobus = ?
AND estado = 1
LIMIT 1
");

$stmt->bind_param("i", $id_autobus);
$stmt->execute();

$res = $stmt->get_result();

if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();

    echo "
    <script>
        alert('Este autobús ya tiene una orden abierta: #{$row['id']}');
        window.location.href = 'index.php';
    </script>
    ";
    exit;
}

// =====================
// INSERTAR ORDEN
// =====================
$stmt = $conexion->prepare("
INSERT INTO orden 
(id_autobus, id_supervisor, id_razon, fecha_apertura, estado)
VALUES (?, ?, ?, ?, 1)
");

$stmt->bind_param(
    "iiis",
    $id_autobus,
    $id_supervisor,
    $id_razon,
    $fecha_apertura
);

if ($stmt->execute()) {
    header("Location: index.php?msg=ok");
    exit;
}

die("Error al guardar la orden: " . $conexion->error);
?>  