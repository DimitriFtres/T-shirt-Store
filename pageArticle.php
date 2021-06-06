<?php
    include("Head.php");
?>
</head>
<body>
<?php
    include("Header.php");
?>

<?php
    if((!empty($_GET["idArticle"])) AND (is_numeric($_GET["idArticle"]))){
        $article = $bdd->prepare("SELECT t.Nom, t.Prix, t.Image, t.Description, t.Auteur, CONCAT(a.nom, ' ', a.prenom) AS nomComplet FROM teeshirts as t
                        JOIN auteurs AS a ON t.auteur = a.id
                        WHERE t.ID = :id AND Date_supp IS NULL AND quantite_stock > 0");
        if($article->execute(array(':id' => $_GET["idArticle"]))){
            if($a = $article->fetch()){
                echo "<div class=\"row m-0\">
                    <div class=\"col-9 col-sm-7 col-md-5 col-lg-4 col-xl-3 mx-auto text-center\">
                    <img src=\"".$a["Image"]."\" alt=\"\" class=\"img-fluid\">
                    <h1 class=\"color-green\">".$a["Nom"]."</h1>
                    <h2 class=\"color-green\">".$a["nomComplet"]."</h2>
                    <p class=\"\">".$a["Prix"]."€</p>
                    <form action=\"Traitement/TraitementPanier.php?idArticle=".$_GET["idArticle"]."\" method=\"POST\" class=\"text-left align-self-center\">
                    <div class=\"row mb-2 justify-content-center\">
                    <label for=\"taille\" class=\"col-6\">Taille :</label>
                    <select name=\"taille\" id=\"taille\" class=\"col-3\">";
                $taille = $bdd->prepare("SELECT t.id, t.Nom FROM tailles AS t
                                        JOIN tailles_disponible AS td ON td.ID_taille = t.ID
                                        WHERE ID_Teeshirt = :id AND Flag_sup = 0");
                $taille->execute(array(':id' => $_GET["idArticle"]));
                    while($t = $taille->fetch()){
                    echo "<option value=\"".$t["id"]."\">".$t["Nom"]."</option>";
                    }
                    echo"</select>
                        </div>
                        <div class=\"row mb-2 justify-content-center\">
                        <label for=\"modele\" class=\"col-6\">Modèle :</label>
                        <select name=\"modele\" id=\"modele\" class=\"col-3\">";
                $modele = $bdd->prepare("SELECT m.id, m.modele FROM modeles AS m
                                        JOIN modele_disponible AS md ON md.ID_modele = m.ID
                                        WHERE ID_Teeshirt = :id AND Flag_sup = 0");
                $modele->execute(array(':id' => $_GET["idArticle"]));
                    while($m = $modele->fetch()){
                    echo "<option value=\"".$m["id"]."\">".$m["modele"]."</option>";
                    }
                    echo"</select>
                        </div>
                        <div class=\"row mb-2 justify-content-center\">
                        <label for=\"quantite\" class=\"col-6\">Quantité souhaitée :</label>
                        <input type=\"number\" name=\"quantite\" id=\"quantite\" class=\"col-3\" max=\"4\" min=\"1\" value=\"1\"/>
                        </div>
                        <input type=\"submit\" value=\"Mettre dans mon panier\" class=\"d-block mx-auto btn btn-outline-secondary mb-5\"/>
                        </form>";
                        if(!empty($_GET["quantite"])){
                            echo "<p class=\"text-warning\">La quantité maximal acceptée pour un t-shirt est dépassé ou il n'y plus assez en stock pour répondre à votre demande.</p>";
                        }
                        if(!empty($_GET["error"])){
                            echo "<p class=\"text-warning\">Il manque une information pour ajouter le t-shirt à votre panier.</p>";
                        }
                        echo "</div>
                        </div>";
                        
            }
        }
    }
?>
</body>
</html>
