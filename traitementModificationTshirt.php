<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: ConnexionAdmin.php");
    }
    $table = "teeshirts";
    require 'fonctiondonnee.php';
    if(empty($_GET["id"])){
        header('Location: traitementNouveauTshirt.php');
        exit;
    }elseif($_GET["id"] > maximumBDD($bdd, $table)){
        header('Location: AdminGestionT-shirt.php?success=ko');  
        exit;
    }
    if((test_tout_est_remplie($_POST)) AND (empty($_FILES["image"])) OR (test_tout_est_remplie($_POST)) AND (is_numeric($_GET["id"]))){
        $nouveau = $bdd->prepare("UPDATE teeshirts SET
                                  Nom = ?,
                                  Numero_de_reference = ?,
                                  Prix = ?,
                                  Quantite_Stock = ?,
                                  Description = ?,
                                  Categorie = ?,
                                  Auteur = ?
                                  WHERE ID = ?
                                  ");
        numerique($_POST["quantite"]);
        numerique($_POST['prix']);
        if($nouveau ->execute(array($_POST["nom"], $_POST["numero_de_reference"], $_POST["prix"], $_POST["quantite"], $_POST["description"], $_POST["categorie"], $_POST["auteur"], $_GET["id"]))){
            $t = "tailles_disponible";
            $id = $_GET["id"];
            $tab = $_POST["taille"];
            $champT = "ID_Taille";
            $champTee = "ID_Teeshirt";
            modifierBDD($bdd, $t, $id, $tab, $champT, $champTee);
            $m = "modele_disponible";
            $tab = $_POST["modele"];
            $champM = "ID_modele";
            $champTee = "ID_teeshirt";
            modifierBDD($bdd, $m, $id, $tab, $champM, $champTee);
            if(!empty($_FILES["image"])){
                $retour = imagetest($_FILES["image"]);
                if($retour){
                    $nouveau = $bdd->prepare("UPDATE teeshirts SET
                                            Image = ?
                                            WHERE ID = ?
                                            ");
                    $nouveau->execute(array($retour[1], $_GET["id"]));
                
                }
            }
            header("Location: AdminGestionT-shirt.php?success=ok");
            exit;
        }else{
            header("Location: CreationTshirt.php?error2=&id=".htmlspecialchars($_GET["id"]));
            exit;
        }
    }else{
        header("Location: CreationTshirt.php?error=1&id=".htmlspecialchars($_GET["id"]));
        exit;
    }