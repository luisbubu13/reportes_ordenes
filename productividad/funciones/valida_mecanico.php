<?php

session_start();

if(
    !isset($_SESSION["tipo"]) ||
    $_SESSION["tipo"] != "mecanico"
){

    header("Location:../index.php");
    exit;

}

?>