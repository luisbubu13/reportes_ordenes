<?php
date_default_timezone_set("America/Mexico_City");

require_once("../funciones/valida_supervisor.php");
require_once("../../funciones/conecta.php");

$conexion = conectar();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Productividad</title>

<link rel="stylesheet" href="css/supervisor.css">

<link rel="stylesheet" href="css/select2.min.css">

<link rel="icon" href="../../fotos/logo.png" type="image/png">

</head>

<body>

<div class="contenedor">

<!--====================================
    ENCABEZADO
=====================================-->

<div class="encabezado">

    <div class="bienvenido">

        Bienvenido

        <strong>

            <?= htmlspecialchars($_SESSION["nombre"]) ?>

        </strong>

    </div>

    <a href="../cerrar_sesion.php" class="btnSalir">

        Cerrar sesión

    </a>

</div>

<!--====================================
    TITULO
=====================================-->

<h1 class="tituloPrincipal">

    Productividad del día

</h1>

<div class="fechaReporte">

    Fecha:

    <strong id="fechaReporte">

        <?= date("Y-m-d") ?>

    </strong>

</div>

<!--====================================
    FILTROS
=====================================-->

<div class="filtros">

    <!-- FECHA DESDE -->

    <div>

    <label>

    Desde

    </label>

    <input

        type="date"

        id="fechaDesde"

        value="<?= date("Y-m-d") ?>"

    >

    </div>


    <!-- FECHA HASTA -->

    <div>

    <label>

    Hasta

    </label>

    <input

        type="date"

        id="fechaHasta"

        value=""

    >

    </div>

    <!-- MECÁNICOS -->

    <div>

        <label>

            Mecánicos

        </label>

        <select

            id="mecanico"

            name="mecanico[]"

            multiple

            style="width:260px;"

        >

            <option></option>

            <?php

            $sql = "

            SELECT

                id,

                nombre

            FROM mecanicos

            WHERE eliminado = 0

            ORDER BY nombre

            ";

            $res = $conexion->query($sql);

            if($res){

                while($m = $res->fetch_assoc()){

            ?>

            <option value="<?= $m["id"] ?>">

                <?= htmlspecialchars($m["nombre"]) ?>

            </option>

            <?php

                }

            }

            ?>

        </select>

    </div>

    <!-- PERIODO -->

    <div>

        <label>

            Periodo

        </label>

        <select id="periodo">

            <option value="dia">

                Día

            </option>

            <option value="quincena">

                Quincena

            </option>

            <option value="mes">

                Mes

            </option>

        </select>

    </div>

</div>

<!--====================================
    RESUMEN GENERAL
=====================================-->

<div class="resumen">

    <div class="cardResumen">

        <h3>

            Mecánicos activos

        </h3>

        <span id="mecanicosActivos">

            0

        </span>

    </div>

    <div class="cardResumen">

        <h3>

            Reparaciones activas

        </h3>

        <span id="reparacionesActivas">

            0

        </span>

    </div>

    <div class="cardResumen">

        <h3>

            Terminadas hoy

        </h3>

        <span id="terminadasHoy">

            0

        </span>

    </div>

    <div class="cardResumen">

        <h3>

            Productividad promedio

        </h3>

        <span id="productividadPromedio">

            0%

        </span>

    </div>

</div>

<!--====================================
    PRODUCTIVIDAD MECÁNICOS
=====================================-->

<div

    id="contenedorProductividad"

    class="cardsProductividad"

>

</div>

<!--====================================
    GRAFICA
=====================================-->

<div class="grafica">

    <h2>

        Rendimiento

    </h2>

    <div class="zonaGrafica">

        <canvas id="graficaProductividad"></canvas>

    </div>

</div>

</div>

<!--====================================
    MODAL DETALLE MECÁNICO
=====================================-->

<div id="modalDetalle" class="modal">

    <div class="contenidoModal">

        <span class="cerrarModal">

            &times;

        </span>

        <h2 id="tituloDetalle">

            Detalle mecánico

        </h2>

        <div id="contenidoDetalle">

            Cargando...

        </div>

    </div>

</div>

<script src="js/jquery-3.1.1.min.js"></script>

<script src="js/select2.min.js"></script>

<script src="js/chart.umd.min.js"></script>

<script src="js/supervisor.js"></script>

</body>

</html>