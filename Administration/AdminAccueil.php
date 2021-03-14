<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: ../ConnexionAdmin.php");
    }
    include("AdminHead.php");
    include("AdminHeader.html");
?>
