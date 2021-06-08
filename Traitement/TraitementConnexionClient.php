<?php
    include("../Function/Fonctiondonnee.php");
    if(!empty($_POST["connecter"])){
        // verifier que l'utilisateur se trouve dans la db
        $mdpCrypter = hash("sha256", $_POST["MDP"]);
        $utilisateur = $bdd->prepare("SELECT id as idUtilisateur, Nom, Prenom, Email, Adresse, CP, Ville, Numero FROM utilisateurs WHERE Email = ? AND MDP = ?");
        $utilisateur->execute(array($_POST["Mail"], $mdpCrypter));
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