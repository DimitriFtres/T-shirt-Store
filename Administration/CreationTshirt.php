<?php
    include("AdminHead.php");
    if(empty($_SESSION["id"])){
        header("Location: ../ConnexionAdmin.php");
    }
    $idValide = false;
?>
<body>
    <?php
        include("AdminHeader.html");
    ?>
    <p class="h1 text-center"><?php if((!empty($_GET["id"])) AND (is_numeric($_GET["id"]))) echo "Modification de t-shirt"; else echo "Ajout de T-shirt" ?></p>
    <?php
        if(isset($_GET["error"])){
            echo "<p class=\"h4 text-center\">Une ou des information(s) encodée(s) est(sont) incorrecte(s)</p>";
        }
                $tailledispo = [];
                $modeledispo = [];
                $categoriedispo = '';
                $auteurdispo = '';
                if((!empty($_GET["id"])) AND (is_numeric($_GET["id"]))){
                    $idValide = true;
                    $id = htmlspecialchars($_GET["id"]);
                    $modification = $bdd->prepare('SELECT * FROM teeshirts WHERE ID = :id');

                    $modification -> execute(array(':id' => $id));
                    if($modification = $modification ->fetch()){
                        
                        $modificationTaille = $bdd->prepare('SELECT ID_Taille FROM tailles_disponible WHERE ID_Teeshirt = :id');
                        $modificationTaille -> execute(array(':id' => $id));
                        while($m = $modificationTaille ->fetch()){
                            $tailledispo[] = $m["ID_Taille"];
                        }

                        $modificationModele = $bdd->prepare('SELECT ID_modele FROM modele_disponible WHERE ID_teeshirt = :id');
                        $modificationModele -> execute(array(':id' => $id));
                        while($m = $modificationModele ->fetch()){
                            $modeledispo[] = $m["ID_modele"];
                        }
                        $modificationCategorie = $bdd->prepare('SELECT Categorie FROM teeshirts WHERE ID = :id');
                        $modificationCategorie -> execute(array(':id' => $id));
                        $categories = $modificationCategorie ->fetch();
                        $categoriedispo = $categories["Categorie"];

                        $modificationAuteur = $bdd->prepare('SELECT Auteur FROM teeshirts WHERE ID = :id');
                        $modificationAuteur -> execute(array(':id' => $id));
                        $auteurs = $modificationAuteur ->fetch();
                        $auteurdispo = $auteurs["Auteur"];
                    }
                    }else{
                        $modification = [
                            'ok' => 'ok',
                            'Nom' => '',
                            'Prix' => '',
                            'Description' => '',
                            'Image' => '',
                            'Quantite_stock' => ''
                        ];
                }

                
    ?>
    <div class="row mt-4 container mx-auto">
        <form class="col-12 col-md-9 col-lg-6 m-auto" action="<?php echo (!empty($_GET["id"])) ? "../traitement/traitementModificationTshirt.php?id=".htmlspecialchars($_GET["id"]) : "traitementNouveauTshirt.php";  ?>" method="post" enctype="multipart/form-data">
            <div class="d-flex justify-content-between mb-3">
                <label for="nom">Nom du t-shirt :</label>
                <input type="text" id="nom" name="nom" value="<?= $modification["Nom"] ?>">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <label for="prix">Prix :</label>
                <input type="text" id="prix" name="prix" value="<?= $modification["Prix"] ?>">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <label for="description">Description : </label>
                <textarea id="description" name="description" rows="5" cols="23"><?= $modification["Description"] ?></textarea>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <label for="image">Image du t-shirt :</label>
                <input type="file" id="image" name="image">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <label for="quantite">Quantité :</label>
                <input type="number" min="1" value="<?= $modification["Quantite_stock"] ?>" id="quantite" name="quantite">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <span>Taille possible :</span>
                <div>
                    <?php
                        $taille = $bdd ->query('SELECT id, nom FROM tailles WHERE flag_sup = 0');
                        while($t = $taille -> fetch()){
                            echo "<input type=\"checkbox\" id=\"taille".$t["nom"]."\" name=\"taille[]\" value=\"".$t["id"]."\"";
                            foreach($tailledispo as $k => $v){
                                if($v === $t["id"]){
                                    echo "checked";
                                }
                            }
                            echo"><label for=\"taille".$t["nom"]."\">".$t["nom"]."</label>";
                        }
                    ?>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <span>Modèle possible :</span>
                <div>
                    <?php
                        $modele = $bdd ->query('SELECT id, modele FROM modeles WHERE flag_sup = 0');
                        while($m = $modele -> fetch()){
                            echo "<input type=\"checkbox\" id=\"".$m["modele"]."\" name=\"modele[]\" value=\"".$m["id"]."\"";
                            foreach($modeledispo as $k => $v){
                                if($v === $m["id"]){
                                    echo "checked";
                                }
                            }
                            echo "><label for=\"".$m["modele"]."\">".$m["modele"]."</label>";
                        }
                    ?>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-3">
                    <label for="categorie">Catégorie :</label>
                    <select id="categorie" name="categorie">
                    <?php
                        $categorie = $bdd ->query('SELECT id, nom FROM categories WHERE Flag_sup = 0');
                        while($c = $categorie -> fetch()){
                                echo "<option value=\"".$c['id']."\"";
                                if($categoriedispo === $c['id']){
                                    echo "selected";
                                }
                                echo ">".$c['nom']."</option>";
                        }
                    ?>
                    </select>
            </div>
            <div class="d-flex justify-content-between mb-3">
                    <label for="auteur">Auteur :</label>
                    <select id="auteur" name="auteur">
                    <?php
                        $auteur = $bdd ->query('SELECT id, nom FROM auteurs WHERE flag_sup = 0');
                        while($a = $auteur -> fetch()){
                                echo "<option value=\"".$a['id']."\"";
                                if($auteurdispo === $a['id']){
                                    echo "selected";
                                }
                                echo">".$a['nom']."</option>";
                        }
                    ?>
                    </select>
            </div>
            <div class="d-flex justify-content-end">
                <input class="d-none" type="submit" value="Créer un nouveau t-shirt" id="submit">
                <label for="submit" class="input-perso px-2 py-1 btn btn-outline-dark"><?php if((!empty($_GET["id"])) AND (is_numeric($_GET["id"]))) echo "Modifier le t-shirt"; else echo "Ajouter le T-shirt" ?></label>
            </div>
        </form>
    </div>
</body>
</html>