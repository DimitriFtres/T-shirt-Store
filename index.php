<?php
    include("Head.php");
?>
<body>
<?php
    include("Header.php");
?>
<div class="container mt-5 pt-5">
            <div class="row">
                <?php
                    /*-------------------------Style des articles t-shirt----------------------*/
                    include("Articles/Style_Article.php");
                    
                    /*--------------------------------Création des articles t-shirt------------------------*/

                    $etiquette = $bdd->query('SELECT t.id, t.nom, t.URL, t.Image, t.Prix, a.nom as auteur_nom, a.prenom, COUNT(tc.ID_teeshirt) AS position FROM teeshirts AS t 
                                              JOIN Teeshirt_Commande AS tc ON tc.ID_teeshirt = t.id
                                              JOIN auteurs as a ON a.id = t.auteur
                                              WHERE t.Date_supp IS NULL AND Quantite_stock > 0
                                              GROUP BY tc.ID_teeshirt ASC 
                                              LIMIT 3');
                    $article_Deja_Cree = 0;
                    while($e = $etiquette -> fetch()){
                        include("Articles/Creation_article.php");
                        $article_Deja_Cree++;
                    }
                    $article_A_Creer = 6-$article_Deja_Cree;
                    $max = $bdd->query('SELECT MAX(id) AS maxi FROM teeshirts');
                    $max  = $max -> fetch();
                    $max = $max['maxi'];
                    $nombreTshirt = $bdd->query('SELECT count(id) as nombre FROM teeshirts WHERE Date_supp IS NULL');
                    $nombreTshirt = $nombreTshirt->fetch();
                    $nombreTshirt = $nombreTshirt['nombre'];
                        $sql = "SELECT t.id, t.nom, t.URL, t.Image, t.Prix, a.nom as auteur_nom, a.prenom FROM teeshirts AS t 
                                JOIN auteurs as a ON a.id = t.auteur
                                WHERE t.Date_supp IS NULL AND Quantite_stock > 0 AND t.id != (SELECT t.id   FROM teeshirts AS t 
                                                                                                JOIN Teeshirt_Commande AS tc ON tc.ID_teeshirt = t.id
                                                                                                JOIN auteurs as a ON a.id = t.auteur
                                                                                                WHERE t.Date_supp IS NULL AND Quantite_stock > 0
                                                                                                GROUP BY tc.ID_teeshirt ASC 
                                                                                                LIMIT 0,1)";
                        $sql .= "AND t.id != (SELECT t.id   FROM teeshirts AS t 
                        JOIN Teeshirt_Commande AS tc ON tc.ID_teeshirt = t.id
                        JOIN auteurs as a ON a.id = t.auteur
                        WHERE t.Date_supp IS NULL AND Quantite_stock > 0
                        GROUP BY tc.ID_teeshirt ASC 
                        LIMIT 1,1)";
                        $sql .= "AND t.id != (SELECT t.id   FROM teeshirts AS t 
                        JOIN Teeshirt_Commande AS tc ON tc.ID_teeshirt = t.id
                        JOIN auteurs as a ON a.id = t.auteur
                        WHERE t.Date_supp IS NULL AND Quantite_stock > 0
                        GROUP BY tc.ID_teeshirt ASC 
                        LIMIT 2,1)";
                        $sql .= "ORDER BY RAND()
                                LIMIT ".$article_A_Creer;
                        $aleatoire = $bdd-> query($sql);
                        while($e = $aleatoire->fetch()){
                            include("Articles/Creation_article.php");
                        }
                    echo "</div>";
                    /*fermer la connexion a la bdd*/
                ?>
        </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>