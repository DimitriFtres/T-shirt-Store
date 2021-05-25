<?php
include('../Function/Fonctiondonnee.php');
if(isset($_POST["Changer"])){
    if((VerifCodePostal($_POST["CodePostal"])) AND (VerifNumero($_POST["Numero"])) AND (VerifNom ($_POST["Nom"])) AND (VerifNom ($_POST["Prenom"])) AND (VerifNom ($_POST["Rue"])) AND (VerifNom ($_POST["Ville"])) AND (filter_var($_POST["Mail"], FILTER_VALIDATE_EMAIL))){
        $StockRestantSuffisant = true;
        $numero_du_tshirt_a_probleme = NULL;
        $sql = "UPDATE utilisateurs SET ";
        $sql .= "Nom = ?, ";
        $sql .= "Prenom = ?, ";
        $sql .= "Email = ?, ";
        $sql .= "Adresse = ?, ";
        $sql .= "CP= ?, ";
        $sql .= "Ville= ?, ";
        $sql .= "Numero= ? ";
        $sql .= "WHERE ID = ?";
        $changement = $bdd->prepare($sql);
        $changement->execute(array($_POST["Nom"], $_POST["Prenom"], $_POST["Mail"], $_POST["Rue"], $_POST["CodePostal"], $_POST["Ville"], $_POST["Numero"] , $_SESSION["idUtilisateur"]));
        if((!empty($_SESSION["idArticle"])) AND (!empty($_SESSION["taille"])) AND (!empty($_SESSION["modele"])) AND (!empty($_SESSION["quantite"])) AND(!empty($_SESSION["nombreArticle"]))){
            foreach($_SESSION["idArticle"] as $k => $v){
                if($StockRestantSuffisant){
                    $reVerifQuantite = $bdd->prepare("SELECT Quantite_stock FROM teeshirts  WHERE id = :id");
                    $reVerifQuantite->execute(array(':id' => $v));
                    $reVerifQuantite = $reVerifQuantite->fetch();
                    if(!verif_stock($_SESSION["quantite"][$k], $reVerifQuantite["Quantite_stock"])){
                        $StockRestantSuffisant = false;
                        $numero_du_tshirt_a_probleme = $v;
                    }
                }
            }
            if($StockRestantSuffisant === true){
                // fonction retirer du stock
                $Stockpositif = true;
                $moins = "-";
                foreach($_SESSION["idArticle"] as $k => $v){
                    modifier_stock_tshirt($bdd, $moins, $_SESSION["quantite"][$k], $_SESSION["idArticle"][$k]);
                }
                if($Stockpositif){
                    //fontion creer une commande
                    creationCommande($bdd, $_SESSION["idUtilisateur"], $_SESSION["modele"], $_SESSION["idArticle"], $_SESSION["taille"], $_SESSION["quantite"]);
                    
                    header('Location: ../Paiement.php');
                }else{

                }
            }else{
                $tshirtmanquant = $bdd->prepare("SELECT Nom FROM teeshirts WHERE ID = :id");
                $tshirtmanquant->execute(array(":id" => $numero_du_tshirt_a_probleme));
                $tshirtmanquant = $tshirtmanquant->fetch();
                header("Location: ../ValidationPanier.php?connecte=ok&inscription=error&error=tshirt&tshirt=".urldecode($tshirtmanquant["Nom"]));
            }
        }else{
            header("Location: ../ValidationPanier.php?connecte=ok&inscription=error&error=panier");
        }
    }else{
        header("Location: ../ValidationPanier.php?connecte=ok&inscription=error&error=modification");
    }
}else{
    header("Location: ../Index.php");
}