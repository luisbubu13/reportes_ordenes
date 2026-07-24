<?php
require_once("../funciones/conecta.php");
$conexion = conectar();

$id_orden = $_GET['id_orden'] ?? 0;

if(!$id_orden){
    die("Orden no especificada.");
}

$sql = "
SELECT
    o.id,
    a.unidad AS autobus
FROM orden o
INNER JOIN autobus a
    ON o.id_autobus = a.id
WHERE o.id = $id_orden
";


$resultado = $conexion->query($sql);

if($resultado->num_rows == 0){
    die("La orden no existe.");
}

$orden = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <title>Nueva Reparación</title>

    <link rel="stylesheet" href="css/reparacion_alta.css">
    <link rel="icon" href="../fotos/logo.png" type="image/jpg" />

</head>

<body>

<div class="contenedor">

    <h1>Nueva Reparación</h1>

    <div class="card">

        <div class="info">

            <div>
                <strong>Orden:</strong><br>
                #<?= $orden['id'] ?>
            </div>

            <div>
                <strong>Autobús:</strong><br>
                <?= $orden['autobus'] ?>
            </div>

        </div>

        <form action="guardar_reparacion.php" method="POST">

            <input
                type="hidden"
                name="id_orden"
                value="<?= $orden['id'] ?>"
            >

            <div class="campo">

                <label>Reparación</label>

                <input
                    type="text"
                    name="reparacion"
                    maxlength="255"
                    required
                    autofocus
                >

            </div>

            <div class="botones">

                <button type="submit" class="btn guardar">
                    Guardar
                </button>

                <button
                    type="button"
                    class="btn cancelar"
                    onclick="location.href='orden_detalle.php?id=<?= $orden['id'] ?>'"
                >
                    Cancelar
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>