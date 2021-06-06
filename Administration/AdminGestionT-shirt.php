<?php
    include("AdminHead.php");
    if(empty($_SESSION["id"])){
        header("Location: ../ConnexionAdmin.php");
    }
?>
<body>
    <?php
        include("AdminHeader.html");
        if(!empty($_GET["success"])){
            if($_GET["success"] === "ok"){
                echo "<h1 class=\"text-center my-5\">Les modifications ont été enregistrées</h1>";
            }elseif($_GET["success"] === "ko"){
                echo "<h1 class=\"text-center my-5\">Un problème est survenu durant la modification. Veuillez recommencer.</h1>";
            }
        }
        $tshirt = $bdd->query('SELECT t.id, t.nom, t.Image, t.Quantite_stock FROM teeshirts AS t 
        WHERE t.date_supp IS NULL
        ');
        echo "<div class=\"container d-flex flex-column\">";
        echo "<div class=\"my-3 row justify-content-end mr-0\"><a class=\"color-light background py-1 px-2 rounded mb-3 mx-sm-3 mx-0\" href=\"gestionCTAM.php\">Gestion des auteurs, catégories,...</a>";
        echo "<a class=\"color-light background py-1 px-2 rounded mb-3\" href=\"CreationTshirt.php\">Ajouter un nouveau t-shirt</a></div>";
        while($list = $tshirt -> fetch()){
            echo "<div class=\"row container mx-auto mb-2 background align-items-center rounded\">
                    <div class=\"col-12 col-md-9 d-flex justify-content-between\">
                        <div class=\"pr-2 py-2 color-light w-50\">
                            <span class=\"align-middle\">".$list["nom"]."</span>
                        </div>
                        <div class=\"pr-2 py-2 color-light w-50\">
                            <span class=\"align-middle\"> Quantité : ".$list["Quantite_stock"]."</span>
                        </div>
                    </div>
                    <div class=\"col-12 col-md-3 d-flex justify-content-end\">
                        <a class=\"px-2 color-light\" href=\"CreationTshirt.php?id={$list["id"]}\">Modifier</a>
                        <a class=\"px-2 color-light\"href=\"SupprimerTshirt.php?id={$list["id"]}\">Supprimer</a>
                    </div>
            </div>";
        }
        echo "</div>";
    ?>
    
</body>
</html>