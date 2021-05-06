<?php
    include("Connexion_bdd.php");
    // verifie que nom,prenom,rue,ville soit que des lettres et que numero et codePOstal soit des nombres et verifie l'email
    if((is_numeric($_POST["Numero"])) AND (is_numeric($_POST["CodePostal"])) AND (ctype_alpha($_POST["Nom"])) AND (ctype_alpha($_POST["Prenom"])) AND (ctype_alpha($_POST["Rue"])) AND (ctype_alpha($_POST["Ville"])) AND (filter_var($_POST["Mail"], FILTER_VALIDATE_EMAIL))){
        $NClient = $bdd->prepare("INSERT INTO utilisateurs (Nom, Prenom, Email, Adresse, CP, MDP, Ville) VALUES (?,?,?,?,?,?,?)");
        $NClient->execute(array($_POST["Nom"], $_POST["Prenom"], $_POST["Mail"], $_POST["Rue"], $_POST["CodePostal"], $_POST["MDP"], $_POST["Ville"]));
    }else{
        //header("Location: ValidationPanier.php?erreur=1");
    }