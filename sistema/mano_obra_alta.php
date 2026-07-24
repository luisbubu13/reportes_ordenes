<?php
require_once("../funciones/conecta.php");
$conexion = conectar();

$ids = $_GET['id'] ?? "";
$id_orden = $_GET['id_orden'] ?? "";

if (trim($ids) === "") {
    die("No se seleccionaron reparaciones.");
}

if ($id_orden === "") {
    die("Orden no recibida.");
}

$ids = explode(",", $ids);
$ids = array_map('intval', $ids);
$ids = array_filter($ids);

if (count($ids) === 0) {
    die("IDs inválidos.");
}

$lista = implode(",", $ids);

// Reparaciones
$sql = "
SELECT id, descripcion
FROM reparacion
WHERE id IN ($lista)
ORDER BY descripcion
";

$reparaciones = $conexion->query($sql);

// Mecánicos
$sql = "
SELECT id, nombre
FROM mecanicos
ORDER BY nombre
";

$mecanicos = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Asignar Mano de Obra</title>

<link rel="stylesheet" href="css/mano_obra_alta.css">
<link rel="stylesheet" href="css/select2.min.css">

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/select2.min.js"></script>

<link rel="icon" href="../fotos/logo.png" type="image/jpg"/>

</head>

<body>

<div class="contenedor">

    <h1>Asignar Mano de Obra</h1>

    <form action="guardar_mano_obra.php" method="POST">

        <?php foreach($ids as $id): ?>

            <input type="hidden" name="reparaciones[]" value="<?= $id ?>">

        <?php endforeach; ?>

        <div class="card">

            <h2>Reparaciones seleccionadas</h2>

            <ul class="lista">

                <?php while($rep = $reparaciones->fetch_assoc()): ?>

                    <li><?= htmlspecialchars($rep['descripcion']) ?></li>

                <?php endwhile; ?>

            </ul>

        </div>

        <div class="card">

            <input type="hidden" name="id_orden" value="<?= $id_orden ?>">

            <label>Mecánico</label>

            <select name="id_mecanico" required>

                <option value="">Seleccione un mecánico</option>

                <?php while($m = $mecanicos->fetch_assoc()): ?>

                    <option value="<?= $m['id'] ?>">
                        <?= $m['nombre'] ?>
                    </option>

                <?php endwhile; ?>

            </select>

        </div>

        <div class="botones">

            <button class="btn guardar">
                Guardar
            </button>

            <button
                type="button"
                class="btn cancelar"
                onclick="history.back()">

                Cancelar

            </button>

        </div>

    </form>

</div>

<script>

$(function(){

    $('select').select2({
        width:'100%'
    });

});

</script>

</body>
</html>