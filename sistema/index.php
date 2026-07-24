<?php
require_once("../funciones/conecta.php");
$conexion = conectar();

// CONSULTA DE AUTOBUSES
$sql_autobuses = "
SELECT
    a.id,
    a.unidad,
    e.nombre AS empresa
FROM autobus a
INNER JOIN empresa e
    ON a.id_empresa = e.id
WHERE a.eliminado = 0
ORDER BY a.unidad
";

$autobuses = $conexion->query($sql_autobuses);

// =====================
// FILTROS
// =====================
$desde   = $_GET['desde'] ?? "";
$hasta   = $_GET['hasta'] ?? "";
$estado  = $_GET['estado'] ?? "";
$autobus = $_GET['autobus'] ?? "";

$where = [];

if($desde != ""){
    $where[] = "DATE(o.fecha_apertura) >= '".$conexion->real_escape_string($desde)."'";
}

if($hasta != ""){
    $where[] = "DATE(o.fecha_apertura) <= '".$conexion->real_escape_string($hasta)."'";
}

if($estado != ""){
    $where[] = "o.estado = ".(int)$estado;
}

if($autobus != ""){
    $where[] = "o.id_autobus = ".(int)$autobus;
}

// CONSULTA DE ÓRDENES
$sql = "
SELECT
    o.id,
    e.nombre AS empresa,
    a.unidad AS autobus,
    o.fecha_apertura,
    o.fecha_liberacion,
    o.fecha_cierre,
    o.estado
FROM orden o
LEFT JOIN autobus a ON o.id_autobus = a.id
LEFT JOIN empresa e ON a.id_empresa = e.id
";

if(count($where) > 0){
    $sql .= " WHERE ".implode(" AND ", $where);
}

$sql .= " ORDER BY o.id DESC";

$ordenes = $conexion->query($sql);

if (!$ordenes) {
    die("Error SQL: " . $conexion->error);
}

// ESTADOS
function estadoTexto($estado){
    return match((int)$estado){
        1 => "abierta",
        2 => "liberada",
        3 => "cerrada",
        4 => "cancelada",
        default => "desconocido"
    };
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Órdenes</title>

    <link rel="stylesheet" href="css/sistema.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="icon" href="../fotos/logo.png" type="image/jpg" />

    <script src="js/acciones.js"></script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/select2.min.js"></script>
</head>

<body>

<div class="contenedor">

    <h1>Sistema de Órdenes de Reparación</h1>

    <!-- FILTROS (UI listo, luego lo activamos) -->
    <form method="GET">
        <div class="card filtros">

            <div class="campo">
                <label>Desde</label>
                <input type="date" name="desde" value="<?= htmlspecialchars($desde) ?>">
            </div>

            <div class="campo">
                <label>Hasta</label>
                <input type="date" name="hasta" value="<?= htmlspecialchars($hasta) ?>">
            </div>

            <div class="campo">
                <label>Estado</label>
                <select name="estado">

                    <option value="">Todo</option>

                    <option value="1" <?= $estado=="1"?"selected":"" ?>>
                        Abierta
                    </option>

                    <option value="2" <?= $estado=="2"?"selected":"" ?>>
                        Liberada
                    </option>

                    <option value="3" <?= $estado=="3"?"selected":"" ?>>
                        Cerrada
                    </option>

                    <option value="4" <?= $estado=="4"?"selected":"" ?>>
                        Cancelada
                    </option>

                </select>
            </div>

            <div class="campo">
                <label>Autobús</label>
                <select name="autobus">

                    <option value=""></option>

                    <?php while($bus = $autobuses->fetch_assoc()): ?>

                        <option
                            value="<?= $bus['id'] ?>"
                            <?= $autobus == $bus['id'] ? "selected" : "" ?>
                        >
                            <?= $bus['unidad'] ?> - <?= $bus['empresa'] ?>
                        </option>

                    <?php endwhile; ?>

                </select>
            </div>

            <button type="submit" class="btn buscar">Buscar</button>
            <button type="button" class="btn cancelar" onclick="location.href='index.php'">Limpiar</button>

        </div>
    </form>

    <!-- ACCIONES -->
    <div class="card acciones">

        <button class="btn nuevo" onclick="location.href='orden_alta.php'">
            Nueva
        </button>

        <button class="btn modificar" onclick="modificarOrden()">Modificar</button>
        <button class="btn liberar" onclick="liberar()">Liberar</button>
        <button class="btn reliberar" onclick="reliberar()">Reliberar</button>
        <button class="btn cerrar" onclick="cerrar()">Cerrar</button>
        <button class="btn cancelar" onclick="cancelar()">Cancelar</button>

    </div>

    <!-- TABLA -->
    <div class="card">

        <table>

            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Empresa</th>
                    <th>Autobús</th>
                    <th>Apertura</th>
                    <th>Liberación</th>
                    <th>Cierre</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>

            <?php if($ordenes->num_rows > 0): ?>

                <?php while($row = $ordenes->fetch_assoc()): ?>

                    <tr>
                        <td>
                            <input type="checkbox" class="chk-orden" value="<?= $row['id'] ?>">
                        </td>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['empresa'] ?></td>
                        <td><?= $row['autobus'] ?></td>
                        <td><?= $row['fecha_apertura'] ?></td>
                        <td><?= $row['fecha_liberacion'] ?? '-' ?></td>
                        <td><?= $row['fecha_cierre'] ?? '-' ?></td>

                        <td>
                            <span class="estado estado-<?= estadoTexto($row['estado']) ?>">
                                <?= estadoTexto($row['estado']) ?>
                            </span>
                        </td>
                    </tr>

                <?php endwhile; ?>

            <?php else: ?>

                <tr>
                    <td colspan="7" class="sinDatos">
                        No hay órdenes para mostrar
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<script>
    $(function(){

    $('select[name="autobus"]').select2({
        width:'100%',
        placeholder:'Todos los autobuses',
        allowClear:true
    });

});
</script>

</body>
</html>