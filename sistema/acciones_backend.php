<?php

require_once("../funciones/conecta.php");
$conexion = conectar();

header('Content-Type: application/json');

// ==========================
// LEER JSON
// ==========================
$data = json_decode(file_get_contents("php://input"), true);

$accion = $data["accion"] ?? null;
$ids    = $data["ids"] ?? [];

if (!$accion || empty($ids)) {
    echo json_encode(["ok" => false, "msg" => "Datos inválidos"]);
    exit;
}

$ids = array_map('intval', $ids);
$in = implode(',', $ids);

$now = date("Y-m-d H:i:s");

// ==========================
// OBTENER ESTADOS ACTUALES
// ==========================
$sql = "SELECT id, estado FROM orden WHERE id IN ($in)";
$res = $conexion->query($sql);

if (!$res) {
    echo json_encode(["ok" => false, "msg" => $conexion->error]);
    exit;
}

$ordenes = [];
while ($row = $res->fetch_assoc()) {
    $ordenes[$row["id"]] = (int)$row["estado"];
}

// ==========================
// LÓGICA POR ACCIÓN
// ==========================

$updates = [];

switch ($accion) {

    // ================= LIBERAR =================
    case "liberar":

        foreach ($ordenes as $id => $estado) {

            if ($estado == 3 || $estado == 4) {
                echo json_encode([
                    "ok" => false,
                    "msg" => "No se puede liberar orden $id (cerrada o cancelada)"
                ]);
                exit;
            }

            $updates[] = "UPDATE orden 
                          SET estado = 2, fecha_liberacion = '$now'
                          WHERE id = $id";
        }

        break;

    // ================= CERRAR =================
    case "cerrar":

        foreach ($ordenes as $id => $estado) {

            if ($estado != 2) {
                echo json_encode([
                    "ok" => false,
                    "msg" => "Solo se pueden cerrar órdenes liberadas (error en $id)"
                ]);
                exit;
            }

            $updates[] = "UPDATE orden 
                          SET estado = 3, fecha_cierre = '$now'
                          WHERE id = $id";
        }

        break;

    // ================= CANCELAR =================
    case "cancelar":

        foreach ($ordenes as $id => $estado) {

            $updates[] = "UPDATE orden 
                          SET estado = 4, fecha_cierre = '$now'
                          WHERE id = $id";
        }

        break;

    // ================= RELIBERAR =================
    case "reliberar":

        foreach ($ordenes as $id => $estado) {

            if ($estado == 4) {
                echo json_encode([
                    "ok" => false,
                    "msg" => "No se puede reliberar una orden cancelada ($id)"
                ]);
                exit;
            }

            if ($estado == 3) {
                $updates[] = "UPDATE orden 
                              SET estado = 2, fecha_liberacion = '$now'
                              WHERE id = $id";
            }
        }

        break;

    default:
        echo json_encode(["ok" => false, "msg" => "Acción no válida"]);
        exit;
}

// ==========================
// EJECUTAR UPDATES
// ==========================
foreach ($updates as $sql) {

    if (!$conexion->query($sql)) {
        echo json_encode([
            "ok" => false,
            "msg" => "Error SQL: " . $conexion->error
        ]);
        exit;
    }
}

// ==========================
// RESPUESTA FINAL
// ==========================
echo json_encode(["ok" => true]);

?>