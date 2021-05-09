<?php
    include("fonctiondonnee.php");
    // verifie que nom,prenom,rue,ville soit que des lettres et que numero et codePOstal soit des nombres et verifie l'email
    if(isset($_POST["Créer"])){
        if((isset($_POST["Numero"])) AND (isset($_POST["CodePostal"])) AND (isset($_POST["Nom"])) AND (isset($_POST["Prenom"])) AND (isset($_POST["Rue"])) AND (isset($_POST["Ville"])) AND (filter_var($_POST["Mail"], FILTER_VALIDATE_EMAIL))){
            if(VerifCodePostal($_POST["CodePostal"])){
                if(VerifNumero($_POST["Numero"])){
                    if((VerifNom ($_POST["Nom"])) AND (VerifNom ($_POST["Prenom"]))){
                        if((VerifNom ($_POST["Rue"])) AND (VerifNom ($_POST["Ville"]))){
                            $verifMail = $bdd->prepare("SELECT id FROM utilisateurs WHERE Email = :mail");
                            $verifMail->execute(array(":mail" => $_POST["Mail"]));
                            if($verifMail->rowCount() == 0){
                                $NClient = $bdd->prepare("INSERT INTO utilisateurs (Nom, Prenom, Email, Adresse, CP, Numero, MDP, Ville) VALUES (?,?,?,?,?,?,?,?)");
                                $NClient->execute(array($_POST["Nom"], $_POST["Prenom"], $_POST["Mail"], $_POST["Rue"], $_POST["CodePostal"], $_POST["Numero"], $_POST["MDP"], $_POST["Ville"]));       
                                $nomtable = "utilisateurs";
                                $_SESSION["idUtilisateur"] = maximumBDD ($bdd, $nomtable);
                                $utilisateur = $bdd->query("SELECT Nom, Prenom, Email, Adresse, CP, MDP, Ville, Numero FROM utilisateurs WHERE id = ".$_SESSION["idUtilisateur"]);
                                if($utilisateur->rowCount() == 1){
                                    $u = $utilisateur->fetch();
                                    foreach($u as $key=>$value){
                                        $_SESSION[$key] = $u[$key];
                                    }
                                }   
                                header("Location: ValidationPanier.php?connecte=ok");
                            }else{
                                header("Location: ValidationPanier.php?inscription=error&error=present");
                            }
                        }else{
                            header("Location: ValidationPanier.php?inscription=error&error=adresse");
                        }
                    }else{
                        header("Location: ValidationPanier.php?inscription=error&error=nom");
                    }
                }else{
                    header("Location: ValidationPanier.php?inscription=error&error=numero");
                }
            }else{
                header("Location: ValidationPanier.php?inscription=error&error=cp");
            }
        }else{
            header("Location: ValidationPanier.php?erreur=1");
        }
    }else{
        echo "hello";
        //header("Location: index.php");
    }
