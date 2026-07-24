<?php

session_start();

if(
    !isset($_SESSION["tipo"]) ||
    $_SESSION["tipo"] != "supervisor" ||
    !isset($_SESSION["id_supervisor"])
){

    header("Location:../index.php");
    exit;

}

?>