<?php
    include("AdminHead.php");
    if(empty($_SESSION["id"])){
        header("Location: ../ConnexionAdmin.php");
    }
    include("AdminHeader.html");
    $gestion_element = array("taille", "categorie", "modele", "auteur");
    print_r($_POST);
    if(!empty($_POST)){
        $seulementLestablesVoulus = false;
        foreach($_POST as $key => $value){
            $separateur = explode("_", $key);
            if($separateur[0] === "Supp"){
                foreach($gestion_element as $k=>$v){
                    if($separateur[1] == $v){
                        $seulementLestablesVoulus = true;
                    }
                }
                if($seulementLestablesVoulus){
                $table = $separateur[1]."s";
                $supprimer = $bdd->prepare("UPDATE ".$table." SET Flag_sup = true WHERE ID = :id");
                $supprimer->bindValue(':id', $value, PDO::PARAM_INT);
                $supprimer->execute();
                }

            }else{
                foreach($gestion_element as $k=>$v){
                    if($separateur[0] == $v){
                        $seulementLestablesVoulus = true;
                    }
                }
                if($seulementLestablesVoulus){
                    $table = $separateur[0]."s";
                    if($key === "modele"){
                        $supprimer = $bdd->prepare("INSERT INTO ".$table." (modele) VALUES (:modele)");
                        $supprimer->execute(array(":modele" => $value));
                    }else{
                        $supprimer = $bdd->prepare("INSERT INTO ".$table." (nom) VALUES (:nom)");
                        $supprimer->execute(array(":nom" => $value));
                    }
                }
            }
        }
        
    }
?>
<body>
    <section class="container">
        <h1>Gestion des tailles, modèles, catégories, auteurs</h1>
        <?php
        for($i=0; $i < count($gestion_element); $i++):?>
        <div class="mt-3 d-flex justify-content-between flex-wrap">
            <form method="POST" action="" class="my-2 d-flex justify-content-between">
                <label for="ajout_<?= $gestion_element[$i]; ?>">Ajouter <?= $gestion_element[$i] ?> : </label>
                <div class="mx-5">
                    <input type="text" name ="<?= $gestion_element[$i] ?>">
                    <input type="submit" value="Ajouter <?= $gestion_element[$i] ?>" class="btn btn-secondary mx-3" id="<?= $gestion_element[$i]; ?>">
                </div>
            </form>
            <form method="POST" action="" class="my-2 d-flex justify-content-between">
                <span class="mx-5">Supprimer <?= $gestion_element[$i]; ?> : </span>
                <?php
                    $nomtable = $gestion_element[$i]."s";
                    if($nomtable == "modeles"){
                        $element_de_tableau = $bdd ->query('SELECT id, modele AS nom FROM '.$nomtable);
                    }else{
                        $element_de_tableau = $bdd ->query('SELECT id, nom FROM '.$nomtable);
                    }
                    echo "<select name=\"Supp_".$gestion_element[$i]."\" id=\"\">";
                    while($e = $element_de_tableau -> fetch()):?>
                        <option value="<?= $e["id"]?>"><?= $e["nom"]?></option>
                    <?php endwhile; ?>
                    </select>

                <button class="btn btn-secondary ml-3">Supprimer</button>
            </form>
        </div>
        <?php endfor; ?>
        
    </section>
</body>