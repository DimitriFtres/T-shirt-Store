<?php
    include("../Function/Fonctiondonnee.php");
    if((!empty($_POST)) AND (!empty($_GET)) AND (is_numeric($_GET["idArticle"]))){
        $valeurKey = NULL;            
        $info_Tshirt = $bdd->prepare("SELECT Quantite_stock, Nom, prix FROM teeshirts WHERE id = :id");
        $info_Tshirt->execute(array(':id' => $_GET["idArticle"]));
        $info_Tshirt = $info_Tshirt->fetch();
        if(empty($_SESSION["idArticle"])){
            if((!empty($_POST["taille"])) AND (!empty($_POST["modele"])) AND (!empty($_POST["quantite"]))){
                if(verif_Stock($_POST["quantite"], $info_Tshirt["Quantite_stock"])){
                    $_SESSION["idArticle"][] = $_GET["idArticle"];
                    $_SESSION["taille"][] = $_POST["taille"];
                    $_SESSION["modele"][] = $_POST["modele"];
                    $_SESSION["quantite"][] = $_POST["quantite"];
                    $_SESSION["NomTshirt"][] = $info_Tshirt["Nom"];
                    $_SESSION["PrixTshirt"][] = $info_Tshirt["prix"];
                    $_SESSION["nombreArticle"] = count($_SESSION["idArticle"]);
                    header('Location: ../Index.php?123');
                }else{
                    header("Location: ../PageArticle.php?idArticle=".$_GET["idArticle"]."&quantite=5");
                }
            }else{
                header("Location: ../PageArticle.php?idArticle=".$_GET["idArticle"]."&error=12");
            }
        }else{
            if((!empty($_POST["taille"])) AND (!empty($_POST["modele"])) AND (!empty($_POST["quantite"]))){
                foreach($_SESSION["idArticle"] as $key => $value){
                    if($value == $_GET["idArticle"]){
                        $valeurKey = $key;
                        
                    }
                }
                if($valeurKey === NULL){
                    if(verif_Stock($_POST["quantite"], $info_Tshirt["Quantite_stock"])){
                        $_SESSION["idArticle"][] = $_GET["idArticle"];
                        $_SESSION["taille"][] = $_POST["taille"];
                        $_SESSION["modele"][] = $_POST["modele"];
                        $_SESSION["quantite"][] = $_POST["quantite"];
                        $_SESSION["NomTshirt"][] = $info_Tshirt["Nom"];
                        $_SESSION["PrixTshirt"][] = $info_Tshirt["prix"];
                        $_SESSION["nombreArticle"] = count($_SESSION["idArticle"]);
                        header('Location: ../Index.php?123');
                    }
                }else{
                    if(($_SESSION["modele"][$valeurKey] === $_POST["modele"]) AND ($_SESSION["taille"][$valeurKey] === $_POST["taille"])){
                        $totalcommande = $_POST["quantite"] + $_SESSION["quantite"][$valeurKey];
                        if(verif_Stock($totalcommande, $info_Tshirt["Quantite_stock"])){
                            $_SESSION["quantite"][$valeurKey] = $_SESSION["quantite"][$valeurKey] + $_POST["quantite"];
                            header('Location: ../Index.php?2');
                        }else{
                            header("Location: ../PageArticle.php?idArticle=".$_GET["idArticle"]."&quantite=5");
                        }
                    }elseif(verif_Stock($_POST["quantite"], $info_Tshirt["Quantite_stock"])){
                        $_SESSION["idArticle"][] = $_GET["idArticle"];
                        $_SESSION["taille"][] = $_POST["taille"];
                        $_SESSION["modele"][] = $_POST["modele"];
                        $_SESSION["NomTshirt"][] = $info_Tshirt["Nom"];
                        $_SESSION["PrixTshirt"][] = $info_Tshirt["prix"];
                        $_SESSION["quantite"][] = $_POST["quantite"];
                        $_SESSION["nombreArticle"] = count($_SESSION["idArticle"]);
                        header('Location: ../Index.php?3');
                    }else{
                        header("Location: ../PageArticle.php?idArticle=".$_GET["idArticle"]."&quantite=5");

                    }
                }
            }else{
                header("Location: ../PageArticle.php?idArticle=".$_GET["idArticle"]."&error=13");
            }
        }
    }

?>