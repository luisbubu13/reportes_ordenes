<?php
require_once("../funciones/conecta.php");
$conexion = conectar();

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Orden no especificada");
}

$sql = "
SELECT 
    o.id,
    o.fecha_apertura,
    o.fecha_liberacion,
    o.fecha_cierre,
    o.estado,
    a.unidad AS autobus,
    e.nombre AS empresa,
    r.descripcion AS razon,
    s.supervisor
FROM orden o
LEFT JOIN autobus a ON o.id_autobus = a.id
LEFT JOIN empresa e ON a.id_empresa = e.id
LEFT JOIN catalogo_razones r ON o.id_razon = r.id
LEFT JOIN supervisor s ON o.id_supervisor = s.id
WHERE o.id = $id
";

$res = $conexion->query($sql);

$sqlReparaciones = "
SELECT
    r.id,
    r.descripcion,
    m.nombre AS mecanico
FROM reparacion r
LEFT JOIN mecanicos m ON r.id_mecanico = m.id
WHERE r.id_orden = $id
ORDER BY r.id
";

$reparaciones = $conexion->query($sqlReparaciones);

if (!$res || $res->num_rows == 0) {
    die("Orden no encontrada");
}

$orden = $res->fetch_assoc();

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
    <title>Detalle Orden</title>

    <link rel="stylesheet" href="css/orden_detalle.css">
    <link rel="icon" href="../fotos/logo.png" type="image/jpg" />
</head>

<body>

<div class="contenedor">

    <a href="index.php" class="btn regresar">← Volver</a>
    
    <h1>Detalle de Orden #<?= $orden['id'] ?></h1>

    <!-- ================= HEADER INFO ================= -->
    <div class="card grid">

        <div><b>Autobús:</b><br><?= $orden['autobus'] ?></div>
        <div><b>Empresa:</b><br><?= $orden['empresa'] ?></div>
        <div><b>Razón:</b><br><?= $orden['razon'] ?></div>
        <div><b>Supervisor:</b><br><?= $orden['supervisor'] ?></div>

        <div><b>Fecha apertura:</b><br><?= $orden['fecha_apertura'] ?></div>
        <div><b>Fecha liberación:</b><br><?= $orden['fecha_liberacion'] ?? '-' ?></div>
        <div><b>Fecha cierre:</b><br><?= $orden['fecha_cierre'] ?? '-' ?></div>

        <div>
            <b>Estado:</b><br>
            <span class="estado estado-<?= estadoTexto($orden['estado']) ?>">
                <?= estadoTexto($orden['estado']) ?>
            </span>
        </div>

    </div>

    <!-- ================= ACCIONES ================= -->
        <?php if($orden['estado'] == 1 || $orden['estado'] == 2): ?>

            <div class="card acciones">

                <button class="btn nueva"
                    onclick="location.href='reparacion_alta.php?id_orden=<?= $orden['id'] ?>'">
                    Agregar reparación
                </button>

                <button class="btn mano" onclick="enviarManoObra()">
                    Agregar mano de obra
                </button>

                <button class="btn eliminar" onclick="eliminarReparaciones()">
                    Eliminar reparación
                </button>

            </div>

        <?php endif; ?>
    
    <div class="card">

        <?php if($reparaciones->num_rows > 0): ?>

            <table class="tabla-reparaciones">

                <thead>
                    <tr>
                        <th></th>
                        <th><h2>Reparación</h2></th>
                        <th><h2>Mano de obra</h2></th>
                    </tr>
                </thead>

                <tbody>

                <?php while($rep = $reparaciones->fetch_assoc()): ?>

                    <tr>

                        <td class="col-check">
                            <input
                                type="checkbox"
                                class="chk-reparacion"
                                value="<?= $rep['id'] ?>"
                            >
                        </td>

                        <td>
                            <?= htmlspecialchars($rep['descripcion']) ?>
                        </td>

                        <td>
                            <?= $rep['mecanico'] ? htmlspecialchars($rep['mecanico']) : 'Sin asignar' ?>
                        </td>

                    </tr>

                <?php endwhile; ?>

                </tbody>
            </table>

        <?php else: ?>

            <p class="vacio">
                No existen reparaciones registradas.
            </p>

        <?php endif; ?>

    </div>

</div>

<script>
    function enviarManoObra(){

        let seleccionados = [];

        document.querySelectorAll('.chk-reparacion:checked').forEach(chk => {
            seleccionados.push(chk.value);
        });

        if(seleccionados.length === 0){
            alert("Selecciona al menos una reparación");
            return;
        }

        let ids = seleccionados.join(',');

        window.location.href = "mano_obra_alta.php?id=" + ids + "&id_orden=<?= $orden['id'] ?>";
    }

    function eliminarReparaciones(){

        let seleccionados = [];

        document.querySelectorAll('.chk-reparacion:checked').forEach(chk=>{
            seleccionados.push(chk.value);
        });

        if(seleccionados.length === 0){
            alert("Selecciona al menos una reparación.");
            return;
        }

        if(!confirm("¿Deseas eliminar las reparaciones seleccionadas?")){
            return;
        }

        let ids = seleccionados.join(",");

        window.location.href =
            "eliminar_reparacion.php?id=" +
            ids +
            "&id_orden=<?= $orden['id'] ?>";
    }
</script>

</body>
</html>