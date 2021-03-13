<?php
    include("Connexion_bdd.php");
    /*-------------------------Style des articles t-shirt----------------------*/
    include("articles/Class_Article.php");
    include("Head.php");
    include("Header.php");
    ?>
<body>
    <?php
        if(isset($_GET["cat"])){
            if($categorie = $bdd->prepare('SELECT t.nom, t.URL, t.Image, t.Prix, a.nom as auteur_nom, a.prenom FROM teeshirts AS t 
                                      JOIN auteurs as a ON a.id = t.auteur
                                      JOIN categories as c on c.id = t.categorie
                                      WHERE c.nom = ? AND c.Flag_supp=0
                                      ')){
                $categorie -> execute(array($_GET["cat"]));
                if($categorie -> rowCount()){
                    echo "<h1 class=\"text-capitalize text-center my-5 color-green\">".$_GET["cat"]."</h1>
                    <div class=\"row\">";
                    while($e = $categorie -> fetch()){
                        include("articles/Creation_Article.php");
                    }
                    echo "</div>";
                }else{
                    echo "<p class=\"h1 text-center my-5\">Attendez... Quelle catégorie ?</p>";
                }
            }          
        }else{
            echo '<p class="h1 text-center my-5">Vous cherchez une catégorie ?</p>';
        }
        
        ?>
</body>
</html>