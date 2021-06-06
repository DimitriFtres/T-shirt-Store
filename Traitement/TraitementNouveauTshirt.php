<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: ../ConnexionAdmin.php");
    }
    require('../Function/Fonctiondonnee.php');
    if((!empty($_GET["id"])) AND (is_numeric($_GET["id"]))){ 
        header("Location: ../Traitement/traitementModificationTshirt.php?id=".htmlspecialchars($_GET["id"]));
    }

    if(test_tout_est_remplie($_POST)){
    //TRAITER LES INFORMATIONS DE POUR CREER UN NOUVEAU ENREGISTREMENT
        $nouveau = $bdd->prepare("INSERT INTO teeshirts (Nom, Quantite_stock, Auteur, Image, Description, Categorie, Prix)
                                VAlUES (?,?,?,?,?,?,?)");
        numerique($_POST["quantite"]);
        numerique($_POST['prix']);
        if((is_numeric($_POST["quantite"])) AND (rendre_le_prix_float($_POST["prix"]) !== 0)){
            if($retour = imagetest($_FILES["image"])){
                if($nouveau ->execute(array($_POST["nom"], $_POST["quantite"], $_POST["auteur"], $retour[1], $_POST["description"], $_POST["categorie"], $_POST["prix"]))){
                    $max = $bdd->query("SELECT max(ID) FROM teeshirts");
                    $max = $max->fetch();
                    $NouvelleTaille = $bdd->prepare("INSERT INTO tailles_disponible (ID_Taille, ID_Teeshirt)
                                  VAlUES (:taille, :teeshirt)");
                    foreach($_POST["taille"] as $key => $value){
                        $NouvelleTaille ->execute(array(":taille" => $value, ":teeshirt" => $max[0]));
                    }
                    $NouveauModele = $bdd->prepare("INSERT INTO modele_disponible (ID_modele, ID_teeshirt)
                                  VAlUES (:modele, :teeshirt)");
                    foreach($_POST["modele"] as $key => $value){
                        $NouveauModele ->execute(array(":modele" => $value, ":teeshirt" => $max[0]));
                    }
                    header('Location: ../Administration/AdminGestionT-shirt.php');
                }else{
                    header("Location: ../Administration/CreationTshirt.php?error=3");
                }
            }else{
                header("Location: ../Administration/CreationTshirt.php?error=4");
            }
        }else{
        header('Location: ../Administration/CreationTshirt.php?error=1');
        }
    }else{
    header('Location: ../Administration/CreationTshirt.php?error=2');
    }

?>