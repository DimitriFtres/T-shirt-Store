<?php
    session_start();
    include("Connexion_bdd.php");
    $_POST["email"];
    $_POST["mdp"];
    print_r($_POST);

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
                    header("Location: Administration/AdminGestionT-shirt.php");
                }else{
                    header("Location: ConnexionAdmin.php?error");
                    exit;
                }
            }
        }else{
            header("Location: ConnexionAdmin.php?error");
            exit;
        }
    }else{
        echo "<p class=\"h1 text-center my-5\">Vous vous êtes perdu ? Retournez sur la page d'acceuil <a href=\"index.php\"><\a></p>";
    }
        
?>