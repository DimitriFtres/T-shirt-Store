<?php
    include("Head.php");
    include("Header.php");
    if(empty($_SESSION["idArticle"])){
        header("Location: index.php");
    }
?>
<body>
    <div class="d-flex justify-content-around my-5 container flex-wrap">
        <form method="POST" action="traitementNouveauCompte.php" class="d-flex flex-column background-light p-3 mb-4 border rounded">
            <h2 class="align-self-center color-green">Vos coordonnées</h2>
            <?php
            if((!empty($_GET["erreur"])) AND $_GET["erreur"] == 1){
                echo "<h4>Vos informations sont incorrectes</h4>";
            }
            ?>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Mail">Adresse mail :</label>
                <input type="text" name="Mail" id="Mail" class="ml-2">
            </div>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="MDP">Mot de passe :</label>
                <input type="password" name="MDP" id="MDP" class="ml-2">
            </div>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Nom">Nom :</label>
                <input type="text" name="Nom" id="Nom">
            </div>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Prenom">Prénom :</label>
                <input type="text" name="Prenom" id="Prenom">
            </div>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Rue">Rue :</label>
                <input type="text" name="Rue" id="Rue">
            </div>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Numero">Numéro :</label>
                <input type="text" name="Numero" id="Numero">
            </div>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Ville">Ville :</label>
                <input type="text" name="Ville" id="Ville">
            </div>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="CodePostal">Code postal :</label>
                <input type="text" name="CodePostal" id="CodePostal">
            </div>
            <div class="d-flex justify-content-end my-1 bold color-green">
                <input type="submit" value="Créer un compte">
            </div>
        </form>
        <form method="POST" action="TraitementConnexionClient.php" class="d-flex flex-column background-light p-3 border rounded align-self-start">
            <h2 class="align-self-center color-green">Déjà membre</h2>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Mail">Adresse mail :</label>
                <input type="text" name="Mail" id="Mail" class="ml-2">
            </div>
            <div class="d-flex justify-content-between my-1 bold color-green">
                <label class="m-0" for="Mail">Mot de passe :</label>
                <input type="password" name="MDP" id="MDP" class="ml-2">
            </div>
            <div class="d-flex justify-content-end my-1 bold color-green">
                <input type="submit" value="Se connecter">
            </div>
        </form>
    </div>  
</body>
