<?php
    include("Head.php");
    include("articles/Class_Article.php");
    ?>
<body>
    <?php
        include("Header.php");
        if(isset($_GET["cat"])){
            if($categorie = $bdd->prepare('SELECT t.nom, t.URL, t.Image, t.Prix, a.nom as auteur_nom, a.prenom FROM teeshirts AS t 
                                      JOIN auteurs as a ON a.id = t.auteur
                                      JOIN categories as c on c.id = t.categorie
                                      WHERE c.nom = ? AND c.Flag_supp is NULL AND t.Date_supp IS NULL
                                      ')){
                $categorie -> execute(array($_GET["cat"]));
                if($categorie -> rowCount()){
                    echo "<h1 class=\"text-capitalize text-center my-5 color-green\">".$_GET["cat"]."</h1>
                    <div class=\"container mt-5 pt-5\">
                    <div class=\"row\">";
                    while($e = $categorie -> fetch()){
                        require("articles/Creation_Article.php");
                    }
                    echo "</div></div>";
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