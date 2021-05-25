<?php
    session_start();
    include("../BDD/Connexion_bdd.php");

    /*connexion a la base de donnée
    comparé les données entre elles
    si les données sont les memes creer une session*/
    if((isset($_POST["email"])) AND (isset($_POST["mdp"]))){
        if(stristr($_POST["email"], '@')){
            if($admin = $bdd->prepare('SELECT ID FROM administrateurs 
                WHERE Email = ? AND Password = ?')){
                $admin -> execute(array($_POST["email"], $_POST["mdp"]));
                if($admin -> rowCount() == 1){
                    $_SESSION["id"] = $admin->fetch();
                    header("Location: ../Administration/AdminGestionT-shirt.php");
                }else{
                    header("Location: ../ConnexionAdmin.php?error");
                }
            }
        }else{
            header("Location: ../ConnexionAdmin.php?error");
        }
    }else{
        header("Location: ../Index.php");
    }
        
?>