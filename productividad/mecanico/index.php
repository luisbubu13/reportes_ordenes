<?php

require_once("../funciones/valida_mecanico.php");
require_once("../../funciones/conecta.php");

$conexion = conectar();

$idMecanico = $_SESSION["id"];
$nombre = $_SESSION["nombre"];



$sql = "

SELECT

    r.id,

    r.estado,

    a.unidad,

    rh.motivo_pausa


FROM reparacion r


INNER JOIN orden o

ON o.id = r.id_orden


INNER JOIN autobus a

ON a.id = o.id_autobus



LEFT JOIN reparacion_historial rh

ON rh.id = (

    SELECT

        id

    FROM reparacion_historial

    WHERE

        id_reparacion = r.id

    ORDER BY id DESC

    LIMIT 1

)



WHERE

    r.id_mecanico = $idMecanico

AND r.estado <> 3

AND o.estado IN (1,2)



ORDER BY

    a.unidad

";



$res = $conexion->query($sql);

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>Productividad Mecánico</title>

<link rel="stylesheet" href="css/estilos.css">

<link rel="icon" href="../../fotos/logo.png" type="image/png">

</head>


<body>


<div class="contenedor">


<header>


    <div class="bienvenido">

        Bienvenido <?= htmlspecialchars($nombre) ?>

    </div>


    <a

        href="../cerrar_sesion.php"

        class="btnSalir">

        Cerrar sesión

    </a>


</header>



<main>


<?php


if($res->num_rows==0){


    echo "

    <div class='vacio'>

        No tienes autobuses asignados.

    </div>

    ";


}



while($fila=$res->fetch_assoc()){


?>


<div class="card">


    <div class="unidad">

        <?= htmlspecialchars($fila["unidad"]) ?>

    </div>



    <?php if($fila["estado"] == 2){ ?>


    <div class="estadoPausa">


        ⏸ Reparación pausada


        <br><br>


        <strong>

            Motivo:

        </strong>


        <br>


        <?php


        $motivo = $fila["motivo_pausa"] ?? "otro";


        switch($motivo){


            case "material":

                echo "📦 Falta de material";

            break;



            case "comida":

                echo "🍔 Hora de comida";

            break;



            case "banio":

                echo "🚻 Ir al baño";

            break;



            case "unidad":

                echo "🚌 Reparar otra unidad";

            break;



            case "otro":

                echo "📝 Otro";

            break;



            default:

                echo "Sin especificar";

            break;


        }


        ?>


    </div>


    <?php } ?>




    <div class="acciones">


    <?php


    if($fila["estado"]==0){


    ?>


        <a

            href="iniciar.php?id=<?= $fila["id"] ?>"

            class="btn iniciar">


            ▶ Iniciar


        </a>



    <?php


    }


    elseif($fila["estado"]==1){


    ?>


        <a

            href="#"

            class="btn pausar btnPausar"

            data-id="<?= $fila["id"] ?>">


            ⏸ Pausar


        </a>



        <a

            href="terminar.php?id=<?= $fila["id"] ?>"

            class="btn terminar">


            ✔ Terminar


        </a>



    <?php


    }


    elseif($fila["estado"]==2){


    ?>


        <a

            href="reanudar.php?id=<?= $fila["id"] ?>"

            class="btn iniciar">


            ▶ Reanudar


        </a>



        <a

            href="terminar.php?id=<?= $fila["id"] ?>"

            class="btn terminar">


            ✔ Terminar


        </a>



    <?php


    }


    ?>


    </div>



</div>



<?php


}


?>


</main>


</div>





<div id="modalPausa" class="modal">


<div class="modalContenido">


<h2>

    Motivo de la pausa

</h2>



<label class="opcionMotivo">


<input

type="radio"

name="motivo"

value="material">


<span>

📦 Falta de material

</span>


</label>




<label class="opcionMotivo">


<input

type="radio"

name="motivo"

value="comida">


<span>

🍔 Hora de comida

</span>


</label>




<label class="opcionMotivo">


<input

type="radio"

name="motivo"

value="banio">


<span>

🚻 Ir al baño

</span>


</label>




<label class="opcionMotivo">


<input

type="radio"

name="motivo"

value="unidad">


<span>

🚌 Reparar otra unidad

</span>


</label>




<label class="opcionMotivo">


<input

type="radio"

name="motivo"

value="otro">


<span>

📝 Otro

</span>


</label>




<div class="botonesModal">


<button id="cancelarPausa">

    Cancelar

</button>


<button id="aceptarPausa">

    Aceptar

</button>


</div>


</div>


</div>





<script src="js/mecanico.js"></script>


</body>

</html>