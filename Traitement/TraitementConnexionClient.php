<?php
    include("../Function/Fonctiondonnee.php");
    if(!empty($_POST["connecter"])){
        // verifier que l'utilisateur se trouve dans la db
        $utilisateur = $bdd->prepare("SELECT id as idUtilisateur, Nom, Prenom, Email, Adresse, CP, MDP, Ville, Numero FROM utilisateurs WHERE Email = ? AND MDP = ?");
        $utilisateur->execute(array($_POST["Mail"], $_POST["MDP"]));
        if($utilisateur->rowCount() == 1){
            $u = $utilisateur->fetch();
            foreach($u as $key=>$value){
                $_SESSION[$key] = $u[$key];
            }
            header('Location: ../ValidationPanier.php?connecte=ok');
        }else{
            header('Location: ../ValidationPanier.php?connecte=ko');

        }
        //remplir les input de creer pour qu'il puisse modifier les champs ?faire une autre page?
    }

?>