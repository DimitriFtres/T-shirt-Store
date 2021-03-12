<?php
    include("Connexion_bdd.php");
    /*-------------------------Style des articles t-shirt----------------------*/
    include("articles/Class_Article.php");
    include("Head.php");
    ?>
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
            if($categorie->num_rows < 1){
                echo "<p class=\"h1 text-center my-5\">Attendez... Quelle catégorie ?</p>";
            }else{
                echo "<h1 class=\"text-capitalize text-center my-5 color-green\">".$cat."</h1>
                <div class=\"row\">";
                while($e = $categorie -> fetch_array()){
                    include("articles/Creation_Article.php");
                }
                echo "</div>";
            }            
        }else{
            echo '<p class="h1 text-center my-5">Vous cherchez une catégorie ?</p>';
        }
        
        ?>
</body>
</html>