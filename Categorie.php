<?php
    include("Head.php");
    include("Articles/Style_Article.php");
    
    ?>
<body>
    <?php
        include("Header.php");
        if(isset($_GET["cat"])){
            $compteur = $bdd->prepare("SELECT count(t.id) as maxi FROM teeshirts as t
                                     JOIN categories as c on c.id = t.categorie
<<<<<<< HEAD
                                     JOIN tailles_disponible AS td ON td.ID_Teeshirt = t.ID
                                     JOIN tailles AS ta ON ta.id = td.ID_Taille
                                     WHERE c.nom = :cat AND c.Flag_sup = 0 AND t.Date_supp IS NULL
                                     GROUP BY td.ID_Teeshirt");
=======
                                     WHERE c.nom = :cat AND c.Flag_supp is NULL AND t.Date_supp IS NULL");
>>>>>>> parent of 623e19a (mise au point)
            $compteur->execute(array(":cat" => $_GET["cat"]));
            $nombre_de_Tshirt = $compteur->fetch();
            $nombre_de_page = ceil($nombre_de_Tshirt["maxi"]/6);
            $debut_Selection_Tshirt = 0;
            echo "<div class=\"container mt-5 d-flex justify-content-end\">";
            for($i = 0; $i < $nombre_de_page; $i++){
                $e = $i+1;
                echo "<a href=\"?cat=".$_GET["cat"]."&page=".$i."\" class=\"btn btn-outline-secondary btn-sm ml-2\" value=\"$i\">".$e."</a>";
            }
            echo "</div>";
            if(!empty($_GET["page"])){
                $debut_Selection_Tshirt = intval($_GET["page"])*6;
            }
<<<<<<< HEAD
            $categorie = $bdd->prepare("SELECT t.id, t.nom, t.Image, t.Prix, a.nom as auteur_nom FROM teeshirts AS t 
                                        JOIN auteurs as a ON a.id = t.Auteur
                                        JOIN categories as c on c.id = t.Categorie
                                        WHERE c.nom = :cat AND c.Flag_sup = 0 AND t.Date_supp IS NULL
                                        LIMIT :num ,6
=======
            $categorie = $bdd->prepare("SELECT t.id, t.nom, t.URL, t.Image, t.Prix, a.nom as auteur_nom, a.prenom FROM teeshirts AS t 
                                      JOIN auteurs as a ON a.id = t.auteur
                                      JOIN categories as c on c.id = t.categorie
                                      WHERE c.nom = :cat AND c.Flag_supp is NULL AND t.Date_supp IS NULL
                                      LIMIT :num ,6
>>>>>>> parent of 623e19a (mise au point)
                                      ");
            $categorie->bindValue(':cat', $_GET["cat"], PDO::PARAM_STR);
            $categorie->bindValue(':num', $debut_Selection_Tshirt, PDO::PARAM_INT);
            $categorie->execute();
            if($categorie -> rowCount()){
                echo "<h1 class=\"text-capitalize text-center my-5 color-green\">".$_GET["cat"]."</h1>
                <div class=\"container mt-5 pt-5\">
                <div class=\"row\">";
                while($e = $categorie -> fetch()){
                    require("articles/Creation_Article.php");
                }
                echo "</div></div>";
            }else{
                echo "<p class=\"h1 text-center my-5\">Catégorie vide.</p>";
            }
                      
        }else{
            echo '<p class="h1 text-center my-5">Vous cherchez une catégorie ?</p>';
        }
        
        ?>
</body>
</html>