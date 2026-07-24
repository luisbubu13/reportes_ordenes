<?php

session_start();

$error = "";

if(isset($_SESSION["error"])){

    $error = $_SESSION["error"];

    unset($_SESSION["error"]);

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Kiosco de Productividad</title>

<link rel="stylesheet" href="css/productividad.css">

<link rel="icon" href="../fotos/logo.png" type="image/png">

</head>

<body>

<div class="login">

    <h2>Kiosco</h2>

    <?php
    if($error != ""){
    ?>

    <div class="error">

        <?= $error ?>

    </div>

    <?php
    }
    ?>

    <form action="validar.php" method="POST">

        <input
            type="number"
            name="id"
            placeholder="Ingrese su ID"
            autocomplete="off"
            required
        >

        <button type="submit">

            Ingresar

        </button>

    </form>

</div>

</body>

</html>