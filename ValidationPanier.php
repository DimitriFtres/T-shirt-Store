<?php
    include("Head.php");
?>
    </head>
    <body>
<?php
    if(empty($_SESSION["idArticle"])){
        header("Location: index.php");
    }
    include("Header.php");
    $connecte = false;
    $message = false;
    if((!empty($_GET["connecte"])) AND ($_GET["connecte"] === "ok") AND (!empty($_SESSION["idUtilisateur"]))){
        $connecte = true;
    }
    if((!empty($_GET["inscription"])) AND ($_GET["inscription"] === "error")){
        switch ($_GET["error"]){
            case "adresse" :
                $message = "Il y a une erreur dans votre adresse.";
                break;
            case "nom" : 
                $message = "Il y a une erreur dans votre nom ou prénom.";
                break;
            case "numero" :
                $message = "Il y a une erreur dans votre numero d'adresse.";
                break;
            case "cp" :
                $message = "Il y a une erreur dans votre code postal.";
                break;
            case "present" :
                $message = "Cette adresse mail est déjà utilisée.";
                break;
            case "tshirt" :
                $message = "Il n'y a plus assez de stock pour le t-shirt ".$_GET["tshirt"].".";
                break;
            case "panier" :
                $message = "Il y a un problème dans votre panier. Veuillez vérifer que toutes les informations nécessaires soit présentes.";
                break;
            case "modification" :
                $message = "Il y a une erreur dans vos informations entrées.";
                break;
            default : 
                $message = "Le système à rencontrer un problème.";
                break;
        }
    }
?>
    <div class="d-flex justify-content-around my-5 container flex-wrap">
        <form method="POST" action="<?php echo ($connecte) ? "Traitement/TraitementCréationDeCommande.php" : "Traitement/TraitementNouveauCompte.php" ?>" class="d-flex flex-column background-light p-3 mb-4 border rounded">
            <h2 class="align-self-center color-green">Vos coordonnées</h2>
            <?php
            if($message) echo "<span>".$message."</span>";
            if((!empty($_GET["erreur"])) AND $_GET["erreur"] == 1){
                echo "<h4>Vos informations sont incorrectes</h4>";
            }
            ?>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Mail">Adresse mail :</label>
                <input type="text" name="Mail" id="Mail" class="ml-2" value="<?php if($connecte) echo $_SESSION["Email"]; ?>">
            </div>
            <?php if(!$connecte): ?>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="MDP">Mot de passe :</label>
                <input type="password" name="MDP" id="MDP" class="ml-2" value="">
            </div>
            <?php endif; ?>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Nom">Nom :</label>
                <input type="text" name="Nom" id="Nom" value="<?php if($connecte) echo $_SESSION["Nom"]; ?>">
            </div>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Prenom">Prénom :</label>
                <input type="text" name="Prenom" id="Prenom" value="<?php if($connecte) echo $_SESSION["Prenom"]; ?>">
            </div>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Rue">Rue :</label>
                <input type="text" name="Rue" id="Rue" value="<?php if($connecte) echo $_SESSION["Adresse"]; ?>">
            </div>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Numero">Numéro :</label>
                <input type="text" name="Numero" id="Numero" value="<?php if($connecte) echo $_SESSION["Numero"]; ?>">
            </div>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Ville">Ville :</label>
                <input type="text" name="Ville" id="Ville" value="<?php if($connecte) echo $_SESSION["Ville"]; ?>">
            </div>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="CodePostal">Code postal :</label>
                <input type="text" name="CodePostal" id="CodePostal" value="<?php if($connecte) echo $_SESSION["CP"]; ?>">
            </div>
            <div class="d-flex justify-content-end my-1 bold color-green">
                <input type="submit" name="<?php echo ($connecte) ? "Changer" : "Créer"; ?>" value="<?php echo ($connecte) ? "Valider ma commande et changer mes informations" : "Créer un compte"; ?>">
            </div>
            <?php if($connecte): ?>
             <a href="index.php">Retourner à la page d'acceuil</a>
             <?php endif; ?>
        </form>
        <?php
            if(!$connecte){
        ?>
        <div class="d-flex flex-column">
            <form method="POST" action="Traitement/TraitementConnexionClient.php" class="d-flex flex-column background-light p-3 border rounded align-self-start">
                <h2 class="align-self-center color-green">Déjà membre</h2>
                <div class="d-flex justify-content-between my-1 bold color-green">
                    <label class="m-0" for="Mail2">Adresse mail :</label>
                    <input type="text" name="Mail" id="Mail2" class="ml-2">
                </div>
                <div class="d-flex justify-content-between my-1 bold color-green">
                    <label class="m-0" for="MDP2">Mot de passe :</label>
                    <input type="password" name="MDP" id="MDP2" class="ml-2">
                </div>
                <div class="d-flex justify-content-end my-1 bold color-green">
                    <input type="submit"  name="connecter" value="Se connecter">
                </div>
                <a href="RecupMDP.php">Mot de passe oublié</a>
                <?php
                }
                if((isset($_GET["connecte"])) AND ($_GET["connecte"] == "ko")){
                    ?>
                    <span class="text-danger">Vous vous êtes trompé dans vos identifiants</span>
            <?php
                }
            ?>
            </form>

            <?php if(!$connecte): ?>
             <a href="index.php">Retourner à la page d'acceuil</a>
             <?php endif;?>
        </div>

    </div> 
</body>
</html>