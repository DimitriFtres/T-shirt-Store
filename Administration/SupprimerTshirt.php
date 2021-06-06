<?php 
    require '../Function/Fonctiondonnee.php';
    if(!isset($_SESSION["id"])){
        header("Location: ../ConnexionAdmin.php");
    }
    include("../AdminHead.php");
    include("AdminHeader.html");
    $table = "teeshirts";
    if(empty($_GET["id"])){
        header('Location: AdminGestionT-shirt.php');
    }elseif($_GET["id"] > maximumBDD($bdd, $table)){
        header('Location: AdminGestionT-shirt.php?success=ko');  
    }
    if(is_numeric($_GET["id"])){
        $supprimer = $bdd->prepare("UPDATE teeshirts SET
                                    Date_supp = NOW()
                                    WHERE ID = ?
                                    ");
        $supprimer -> execute(array($_GET["id"]));
        header('Location: AdminGestionT-shirt.php?success=ok');
    }