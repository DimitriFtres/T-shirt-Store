<?php
    session_start();
    include('Connexion_bdd.php');
    if(empty($_SESSION["etredeconnecter"])){
        unset($_SESSION['idUtilisateur']);
        unset($_SESSION['Nom']);
        unset($_SESSION['Prenom']);
        unset($_SESSION['Email']);
        unset($_SESSION['Adresse']);
        unset($_SESSION['CP']);
        unset($_SESSION['MDP']);
        unset($_SESSION['Ville']);
        unset($_SESSION['Numero']);
    }
    $_SESSION["etredeconnecter"] = 1;


?>
<!DOCTYPE html>
<html class="h-100" lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <title>T-shirt Store</title>
    </head>