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
    <title>T-shirt Store</title>
</head>
<body>
<div class="container mt-5 pt-5">
            <div class="row">
                <?php
                    /*-------------------------Style des articles t-shirt----------------------*/
                    $classDivEtiquette = 'class="col-10 offset-1 col-sm-5 offset-sm-1 col-lg-3 card offset-lg-1 mb-5"';/*mettre les class de la div*/
                    $classAEtiquette = 'class="color-green text-decoration-none couleur-smooth"';
                    $classimgEtiquette = 'class="card-img-top"';
                    $classNomTShirtEtiquette = 'class="text-capitalize text-center card-title h2"';
                    $classAuteurEtiquette = 'class="text-capitalize text-center card-title h3"';
                    
                    /*--------------------------------Création des articles t-shirt------------------------*/

                    $etiquette = $bdd->query('SELECT t.id, t.nom, t.URL, t.Image, t.Prix, a.nom as auteur_nom, a.prenom, COUNT(tc.ID_teeshirt) AS position FROM teeshirts AS t 
                                              JOIN Teeshirt_Commande AS tc ON tc.ID_teeshirt = t.id
                                              JOIN auteurs as a ON a.id = t.auteur
                                              GROUP BY tc.ID_teeshirt ASC 
                                              LIMIT 3');
                    $article_Deja_Cree = 0;
                    while($e = $etiquette -> fetch_array()){
                        echo "<div ".$classDivEtiquette.">
                        <a href=\""/*mettre l'url de où cela mène*/."#\" ".$classAEtiquette.">
                        <img ".$classimgEtiquette." src=\"".$e['Image']."\">
                        <p ".$classNomTShirtEtiquette.">".$e['nom']."</p>
                        <p ".$classAuteurEtiquette.">".$e['auteur_nom']." ".$e['prenom']."</p>
                        </a></div>";
                        $article_Deja_Cree++;
                    }
                    $max = $bdd->query('SELECT MAX(id) AS maxi FROM teeshirts');
                    $max  = $max -> fetch_array()['maxi'];
                    for($i = 0; $i < (6-$article_Deja_Cree); $i++){
                        $rand = rand(1, $max);
                        $aleatoire = $bdd-> query("SELECT t.id, t.nom, t.URL, t.Image, t.Prix, a.nom as auteur_nom, a.prenom FROM teeshirts AS t 
                                                   JOIN auteurs as a ON a.id = t.auteur
                                                   WHERE t.id =".$rand);
                        if($e = $aleatoire -> fetch_array()){
                            echo "<div ".$classDivEtiquette.">
                            <a href=\""/*mettre l'url de où cela mène*/."#\" ".$classAEtiquette.">
                            <img ".$classimgEtiquette." src=\"".$e['Image']."\">
                            <p ".$classNomTShirtEtiquette.">".$e['nom']."</p>
                            <p ".$classAuteurEtiquette.">".$e['auteur_nom']." ".$e['prenom']."</p>
                            </a></div>";
                        }
                    }
                    echo "</div>";
                ?>
        </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>