<?php
require_once("../funciones/conecta.php");

$conexion = conectar();

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// AUTOBUSES con empresa incluida
$sql_autobus = "
    SELECT 
        a.id,
        a.unidad,
        e.nombre AS empresa,
        e.id AS id_empresa
    FROM autobus a
    INNER JOIN empresa e ON a.id_empresa = e.id
    WHERE a.eliminado = 0
";
$autobuses = $conexion->query($sql_autobus);

// CATALOGO RAZONES
$razones = $conexion->query("SELECT id, descripcion FROM catalogo_razones");

// SUPERVISORES
$supervisores = $conexion->query("SELECT id, supervisor FROM supervisor");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Orden</title>

    <link rel="stylesheet" href="css/orden_alta.css">
    <link rel="stylesheet" href="css/select2.min.css">

    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/select2.min.js"></script>

    <link rel="icon" href="../fotos/logo.png" type="image/jpg" />

</head>

<body>

<div class="contenedor-form">

    <h1>Nueva Orden de Reparación</h1>

    <form method="POST" action="guardar_orden.php" class="card formulario">

        <!-- AUTOBUS -->
        <div class="campo full">
            <label>Autobús</label>
            <select name="id_autobus" id="id_autobus" required>
                <option value="">Seleccione un autobús</option>

                <?php while($row = $autobuses->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>">
                        <?= $row['unidad'] ?> - <?= $row['empresa'] ?>
                    </option>
                <?php endwhile; ?>

            </select>
        </div>

        <!-- EMPRESA (solo informativa visual) -->
        <div class="campo">
            <label>Empresa</label>
            <input type="text" id="empresa" disabled placeholder="Seleccione un autobus">
        </div>

        <!-- SUPERVISOR -->
        <div class="campo">
            <label>Supervisor</label>
            <select name="id_supervisor" required>
                <option value="">Seleccione supervisor</option>

                <?php while($row = $supervisores->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>">
                        <?= $row['supervisor'] ?>
                    </option>
                <?php endwhile; ?>

            </select>
        </div>

        <!-- RAZÓN -->
        <div class="campo full">
            <label>Razón de reparación</label>
            <select name="id_razon" required>
                <option value="">Seleccione razón</option>

                <?php while($row = $razones->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>">
                        <?= $row['descripcion'] ?>
                    </option>
                <?php endwhile; ?>

            </select>
        </div>

        <!-- FECHA (auto hoy) -->
        <div class="campo">
            <label>Fecha apertura</label>
            <input type="datetime-local" name="fecha_apertura" value="<?= date('Y-m-d\TH:i') ?>" required>
        </div>

        <!-- BOTONES -->
        <div class="campo full">
            <button type="submit" class="btn nuevo">Guardar Orden</button>
            <a href="index.php" class="btn cerrar">Cancelar</a>
        </div>

    </form>

</div>

<script>
$(document).ready(function() {

    $('select[name="id_autobus"]').select2({
        width: '100%',
        placeholder: "Selecciona autobús"
    });

    $('select[name="id_supervisor"]').select2({
        width: '100%',
        placeholder: "Selecciona supervisor"
    });

    $('select[name="id_razon"]').select2({
        width: '100%',
        placeholder: "Selecciona razón"
    });

    // 🚍 AUTOBUS → EMPRESA
    $('#id_autobus').on('change', function() {

        let texto = $('#id_autobus option:selected').text();

        // formato esperado: "UNIDAD - EMPRESA"
        let partes = texto.split(' - ');

        if(partes.length === 2){
            $('#empresa').val(partes[1]);
        } else {
            $('#empresa').val('');
        }

    });

});
</script>

</body>
</html>