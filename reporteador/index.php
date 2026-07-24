<?php
require_once("../funciones/conecta.php");
$conexion = conectar();

//==============================
// EMPRESA ACTUAL
//==============================
$id_empresa = isset($_GET['empresa']) ? intval($_GET['empresa']) : 1;

if($id_empresa < 1 || $id_empresa > 4){
    $id_empresa = 1;
}

//==============================
// NOMBRE DE LA EMPRESA
//==============================
$sql = "
SELECT nombre
FROM empresa
WHERE id = $id_empresa
LIMIT 1
";

$resEmpresa = $conexion->query($sql);

if(!$resEmpresa || $resEmpresa->num_rows == 0){
    die("Empresa no encontrada.");
}

$empresa = $resEmpresa->fetch_assoc();


//==============================
// PROMEDIO HISTÓRICO POR RAZÓN
// (Solo órdenes liberadas)
//==============================
$sqlPromedios = "
SELECT

    o.id_razon,

    AVG(
        TIMESTAMPDIFF(
            MINUTE,
            o.fecha_apertura,
            o.fecha_liberacion
        )
    ) AS promedio

FROM orden o

INNER JOIN autobus a
    ON a.id = o.id_autobus

WHERE
    a.id_empresa = $id_empresa
AND o.fecha_liberacion IS NOT NULL

GROUP BY
    o.id_razon
";

$resPromedios = $conexion->query($sqlPromedios);

$promedios = [];

if($resPromedios){

    while($fila = $resPromedios->fetch_assoc()){

        $promedios[$fila['id_razon']] = $fila['promedio'];

    }

}


//==============================
// RAZONES Y ÓRDENES ABIERTAS
//==============================
$sql = "
SELECT

    cr.id,

    cr.descripcion,

    COUNT(o.id) AS total,

    GROUP_CONCAT(

        CONCAT(

            a.unidad,

            ' | ',

            DATE_FORMAT(
                o.fecha_apertura,
                '%d/%m %H:%i'
            )

        )

        ORDER BY o.fecha_apertura DESC

        SEPARATOR '||'

    ) AS detalle

FROM catalogo_razones cr

LEFT JOIN (

    SELECT

        o.id,

        o.id_razon,

        o.fecha_apertura,

        a.unidad

    FROM orden o

    INNER JOIN autobus a
        ON a.id = o.id_autobus

    WHERE
        o.estado = 1
    AND a.id_empresa = $id_empresa

) o
ON o.id_razon = cr.id

LEFT JOIN autobus a
    ON a.unidad = o.unidad

GROUP BY

    cr.id,

    cr.descripcion

ORDER BY

    cr.id
";

$razones = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Reporteador</title>

<link rel="stylesheet" href="css/reporteador.css">

<link rel="icon" href="../fotos/logo.png" type="image/png">

</head>

<body>

<div class="contenedor">

    <div class="encabezado">

        <div id="reloj"></div>

        <h1><?= htmlspecialchars($empresa['nombre']) ?></h1>

    </div>

    <div class="grid">

        <?php while($r = $razones->fetch_assoc()): ?>

            <?php

                $clase = "verde";

                if($r['total'] >= 4){

                    $clase = "rojo";

                }elseif($r['total'] >= 1){

                    $clase = "amarillo";

                }

                $textoPromedio = "Sin historial";

                $promedio = $promedios[$r['id']] ?? null;

                if($promedio != null){

                    $min = round($promedio);

                    $dias = floor($min / 1440);

                    $horas = floor(($min % 1440) / 60);

                    $minutos = $min % 60;

                    $textoPromedio = "";

                    if($dias > 0){
                        $textoPromedio .= $dias . " d ";
                    }

                    if($horas > 0){
                        $textoPromedio .= $horas . " h ";
                    }

                    $textoPromedio .= $minutos . " min";

                }

            ?>

            <div class="card <?= $clase ?>">

                <div class="titulo">

                    <?= htmlspecialchars($r['descripcion']) ?>

                </div>

                <div class="numero">

                    <?= $r['total'] ?>

                </div>

                <div class="detalle">

                    <?php

                    if(!empty($r['detalle'])){

                        $items = explode("||",$r['detalle']);

                        foreach($items as $item){

                            echo "<div>".htmlspecialchars($item)."</div>";

                        }

                    }

                    ?>

                </div>

                <div class="promedio">

                    ⏱ Promedio: <?= $textoPromedio ?>

                </div>

            </div>

        <?php endwhile; ?>

    </div>

    <div class="footer">

        <div></div>

        <div></div>

    </div>

</div>

<script src="js/reporteador.js"></script>

</body>
</html>