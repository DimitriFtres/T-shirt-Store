<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: ../ConnexionAdmin.php");
    }
    include("AdminHead.php");
    include("AdminHeader.html");
    if(!empty($_POST)){
        //TRAITER LES INFORMATIONS DE POUR CREER UN NOUVEAU ENREGISTREMENT 
    }
?>
<body>
    <p class="h1 text-center">Ajout de t-shirt</h1>
    <div class="row mt-5">
        <form class="col-3 m-auto" action="" method="">
            <div class="d-flex justify-content-between mb-3">
                <label for="reference">Numéro de référence :</label>
                <input type="text" id="reference" name="numero_de_reference">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <label for="nom">Nom du t-shirt :</label>
                <input type="text" id="nom" name="nom">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <label for="prix">Prix :</label>
                <input type="text" id="prix" name="prix">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <label for="description">Description : </label>
                <textarea id="description" name="description" rows="5" cols="23"></textarea>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <label for="image">Image du t-shirt :</label>
                <input type="file" id="image" name="image">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <label for="quantite">Quantité :</label>
                <input type="number" id="quantite" name="quantite">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <span>Taille possible :</span>
                <div>
                    <?php
                        $taille = $bdd ->query('SELECT nom FROM tailles');
                        while($t = $taille -> fetch()){
                            echo "<input type=\"checkbox\" id=\"taille".$t["nom"]."\" name=\"taille".$t["nom"]."\" value=\"".$t["nom"]."\">
                                  <label for=\"taille".$t["nom"]."\">".$t["nom"]."</label>";
                        }
                    ?>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <span>Modèle possible :</span>
                <div>
                    <?php
                        $modele = $bdd ->query('SELECT modele FROM modeles');
                        while($m = $modele -> fetch()){
                            echo "<input type=\"checkbox\" id=\"".$m["modele"]."\" name=\"".$m["modele"]."\" value=\"".$m["modele"]."\">
                                  <label for=\"".$m["modele"]."\">".$m["modele"]."</label>";
                        }
                    ?>
                </div>
            </div>
            <input class="" type="submit" value="Créer un nouveau t-shirt">
        </form>
    </div>
</body>