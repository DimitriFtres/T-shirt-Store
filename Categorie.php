<?php
    $host = "localhost";
    $user = "root";
    $password = "root";
    $table_name = "tshirt_store";
    try {
        $bdd = new mysqli($host, $user, $password, $table_name);
    } 
    catch(Exception $e) {
        die('Erreur ; ' .$e->getMessage());
    }
    /*-------------------------Style des articles t-shirt----------------------*/
    $classDivEtiquette = 'class="col-10 offset-1 col-sm-5 offset-sm-1 col-lg-3 card offset-lg-1 mb-5"';/*mettre les class de la div*/
    $classAEtiquette = 'class="color-green text-decoration-none couleur-smooth"';
    $classimgEtiquette = 'class="card-img-top"';
    $classNomTShirtEtiquette = 'class="text-capitalize text-center card-title h2"';
    $classAuteurEtiquette = 'class="text-capitalize text-center card-title h3"';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_GET["cat"])){
            $cat = strip_tags($_GET["cat"]);
            $cat = str_replace(";", "/*", $cat);
            $categorie = $bdd->query('SELECT t.nom, t.URL, t.Image, t.Prix, a.nom as auteur_nom, a.prenom FROM teeshirts AS t 
                                      JOIN Teeshirt_Commande AS tc ON tc.ID_teeshirt = t.id
                                      JOIN auteurs as a ON a.id = t.auteur
                                      JOIN categories as c on c.id = t.categorie
                                      WHERE c.nom = "'.$cat.'" AND c.Flag_supp=0
                                      ');
            if($categorie->fetch_array() == NULL OR $categorie->fetch_array() == ""){?>
                <p class="h1 text-center my-5">Attendez... Quelle catégorie ?</p>
                <?php
            }else{?>
                <!-----header-------->
                <h1 class="text-capitalize text-center my-5 color-green"><?=$cat?></h1>
                <div class="row">
                <?php
                    while($e = $categorie -> fetch_array()){
                        echo "<div ".$classDivEtiquette.">
                        <a href=\""/*mettre l'url de où cela mène*/."#\" ".$classAEtiquette.">
                        <img ".$classimgEtiquette." src=\"".$e['Image']."\">
                        <p ".$classNomTShirtEtiquette.">".$e['nom']."</p>
                        <p ".$classAuteurEtiquette.">".$e['auteur_nom']." ".$e['prenom']."</p>
                        </a></div>";
                    } ?>
                </div><?php

            }            
        }else{
            echo '<p class="h1 text-center my-5">Vous cherchez une catégorie ?</p>';
        }
        
        ?>
</body>
</html>