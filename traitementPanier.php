<?php
    session_start();
    include("fonctiondonnee.php");
    if((!empty($_POST)) AND (!empty($_GET)) AND (is_numeric($_GET["idArticle"]))){
        $valeurKey = NULL;            
        $quantite_dispo = $bdd->prepare("SELECT Quantite_stock FROM teeshirts WHERE id = :id");
        $quantite_dispo->execute(array(':id' => $_GET["idArticle"]));
        $quantite_dispo = $quantite_dispo->fetch();
        if(empty($_SESSION["idArticle"])){
            if((!empty($_POST["taille"])) AND (!empty($_POST["modele"])) AND (!empty($_POST["quantite"]))){
                if(verif_Stock($_POST["quantite"], $quantite_dispo["Quantite_stock"])){
                    $_SESSION["idArticle"][] = $_GET["idArticle"];
                    $_SESSION["taille"][] = $_POST["taille"];
                    $_SESSION["modele"][] = $_POST["modele"];
                    $_SESSION["quantite"][] = $_POST["quantite"];
                    $_SESSION["nombreArticle"] = count($_SESSION["idArticle"]);
                    header('Location: index.php?123');
                }else{
                    header("Location: pageArticle.php?idArticle=".$_GET["idArticle"]."&quantite=5");
                }
            }else{
                header("Location: pageArticle.php?idArticle=".$_GET["idArticle"]."&error=12");
            }
        }else{
            if((!empty($_POST["taille"])) AND (!empty($_POST["modele"])) AND (!empty($_POST["quantite"]))){
                foreach($_SESSION["idArticle"] as $key => $value){
                    if($value == $_GET["idArticle"]){
                        $valeurKey = $key;
                        
                    }
                }
                if($valeurKey === NULL){
                    if(verif_Stock($_POST["quantite"], $quantite_dispo["Quantite_stock"])){
                        $_SESSION["idArticle"][] = $_GET["idArticle"];
                        $_SESSION["taille"][] = $_POST["taille"];
                        $_SESSION["modele"][] = $_POST["modele"];
                        $_SESSION["quantite"][] = $_POST["quantite"];
                        $_SESSION["nombreArticle"] = count($_SESSION["idArticle"]);
                        header('Location: index.php?123');
                    }
                }else{
                    if(($_SESSION["modele"][$valeurKey] === $_POST["modele"]) AND ($_SESSION["taille"][$valeurKey] === $_POST["taille"])){
                        $totalcommande = $_POST["quantite"] + $_SESSION["quantite"][$valeurKey];
                        if(verif_Stock($totalcommande, $quantite_dispo["Quantite_stock"])){
                            $_SESSION["quantite"][$valeurKey] = $_SESSION["quantite"][$valeurKey] + $_POST["quantite"];
                            header('Location: index.php?2');
                        }else{
                            header("Location: pageArticle.php?idArticle=".$_GET["idArticle"]."&quantite=5");
                        }
                    }elseif(verif_Stock($_POST["quantite"], $quantite_dispo["Quantite_stock"])){
                        $_SESSION["idArticle"][] = $_GET["idArticle"];
                        $_SESSION["taille"][] = $_POST["taille"];
                        $_SESSION["modele"][] = $_POST["modele"];
                        $_SESSION["quantite"][] = $_POST["quantite"];
                        header('Location: index.php?3');
                    }else{
                        header("Location: pageArticle.php?idArticle=".$_GET["idArticle"]."&quantite=5");

                    }
                }
            }else{
                header("Location: pageArticle.php?idArticle=".$_GET["idArticle"]."&error=13");
            }
        }
    }

?>