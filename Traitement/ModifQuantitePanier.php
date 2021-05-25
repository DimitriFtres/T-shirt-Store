<?php
include('../Function/Fonctiondonnee.php');
if((!empty($_POST["modifQ"])) AND (is_numeric($_POST["modifQ"])) AND isset($_GET["key"]) AND (isset($_POST["key"])) AND ($_POST["key"] === $_GET["key"])){
    $quantite_dispo = $bdd->prepare("SELECT Quantite_stock FROM teeshirts WHERE id = :id");
    $quantite_dispo->execute(array(':id' => $_SESSION["idArticle"][$_POST["key"]]));
    $quantite_dispo = $quantite_dispo->fetch();
        if(verif_Stock($_POST["modifQ"], $quantite_dispo["Quantite_stock"])){
            $_SESSION["quantite"][$_POST["key"]] = $_POST["modifQ"];
            header('Location: ../Panier.php');
        }else{
            header("Location: ../Panier.php?errorQ=true");

        }
}else{
    header("Location: ../Index.php");
}