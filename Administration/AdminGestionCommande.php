<?php
    include("../Head.php");
    if(!isset($_SESSION["id"])){
        header("Location: ../ConnexionAdmin.php");
    }
    $annuler = false;
?>
<body>
<?php
    include("AdminHeader.html");
    if(!empty($_POST["oui"])){
        $comAnnule = $bdd->prepare("UPDATE teeshirt_commande SET flag_annule = 1 WHERE ID_commande = :id");
        $comAnnule = $comAnnule->execute(array("id" => $_GET["com"]));
    }
    if((!empty($_POST["livrer"])) AND (!empty($_GET["com"]))){
        $idAnnuler = $bdd->query("SELECT ID FROM etat_livraison WHERE Nom = \"Annuler\"");
        if($idAnnuler = $idAnnuler->fetch()){
            if(($_POST["livrer"] === $idAnnuler["ID"])){
                $annuler = true;
            }
        }
            $nouvelEtat = $bdd->prepare("UPDATE commandes SET Etat_Livraison = ? WHERE ID = ?");
            $nouvelEtat->execute(array($_POST["livrer"], $_GET["com"]));
    }
    $ancienID = '';
    $i = 0;
    $commande = $bdd->query("SELECT tc.Quantite_commande, ta.Nom AS nomT_shirt, tc.ID_commande AS commandeID, tc.ID_Utilisateur, c.Date_Livraison, c.Etat_Livraison, c.Date_commande, u.id, CONCAT(u.Nom, ' ', u.prenom) as utilisateurNom, u.Email, u.Adresse, u.CP, u.ville, u.Numero, t.Numero_de_reference, t.Nom, t.prix FROM commandes AS c 
                             JOIN teeshirt_commande AS tc ON tc.ID_commande = c.ID
                             JOIN teeshirts AS t ON t.id = tc.ID_teeshirt
                             JOIN utilisateurs AS u ON u.id = tc.ID_Utilisateur
                             JOIN tailles AS ta ON ta.id = tc.ID_taille
                             WHERE tc.flag_annule = 0");
    echo "<div class=\"d-flex flex-column container mx-auto mb-5\">";
    while($c = $commande ->fetch()){
        if($ancienID !== $c["commandeID"]){
            echo "<div class=\"d-flex justify-content-around mb-0 background align-items-center\">";
            echo "<div class=\"col-1\"><p class=\"pl-2 py-1 mb-0 color-light\">".$c["commandeID"]."</p></div>";
            echo "<div class=\"col-3\"><p class=\"pl-2 py-1 mb-0 color-light\">".$c["Date_commande"]."</p></div>";
            echo "<div class=\"col-5\">
                    <form action=\"?com=".$c["commandeID"]."\" method=\"POST\" class=\"pl-2 py-1 mb-0 color-light d-flex align-items-center justify-content-around flex-wrap\">
                        <select name=\"livrer\" id=\"livrer\">";
                        $etatCommande = $bdd->query("SELECT ID, Nom FROM etat_livraison");
                        while($e = $etatCommande->fetch()){
                            echo "<option value=\"".$e["ID"]."\"";
                            if($c["Etat_Livraison"] === $e["ID"]){
                                echo "selected";
                            }
                            echo ">".$e["Nom"]."</option>";
                        }
                        echo "</select>";
                        echo "<input type=\"submit\" value=\"Appliquer\" class=\"btn btn-light py-0\">
                    </form>
                </div>";
            echo "</div>";
            if(($annuler) AND ($_GET["com"] === $c["commandeID"])){
                echo "<div class=\"d-flex justify-content-around mb-0 background align-items-center\">
                        <form method=\"POST\" action=\"\">
                            <span class=\"color-light\"> Êtes-vous sure de vouloir annuler cette commande ?</span>
                            <input type=\"submit\" class=\"btn btn-light py-0\" value=\"oui\" name=\"oui\">
                            <input type=\"submit\" class=\"btn btn-light py-0\" value=\"non\" name=\"non\">
                        </form>
                      </div>";
            }
            echo "<div class=\"d-flex flex-wrap justify-content-around mb-0 background align-items-center\">";
            echo "<div class=\"col-4 col-lg-2\"><p class=\"pl-2 py-1 mb-0 color-light\">".$c["utilisateurNom"]."</p></div>";
            echo "<div class=\"col-5 col-lg-3\"><p class=\"pl-2 py-1 mb-0 color-light\">".$c["Email"]."</p></div>";
            echo "<div class=\"col-3 col-lg-2\"><p class=\"pl-2 py-1 mb-0 color-light\">".$c["ville"]."</p></div>";
            echo "<div class=\"col-2 col-lg-1\"><p class=\"pl-2 py-1 mb-0 color-light\">".$c["CP"]."</p></div>";
            echo "<div class=\"col-8 col-lg-3\"><p class=\"pl-2 py-1 mb-0 color-light\">".$c["Adresse"]."</p></div>";
            echo "<div class=\"col-2 col-lg-1\"><p class=\"pl-2 py-1 mb-0 color-light\">".$c["Numero"]."</p></div>";
            echo "</div>";
            echo "  <div class=\"d-flex justify-content-around mb-0 background-light align-items-center border\">
                        <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["Quantite_commande"]."X ".$c["Numero_de_reference"]."</p></div>
                        <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["Nom"]."</p></div>
                        <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["prix"]."€</p></div>
                        <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["nomT_shirt"]."</p></div>
                    </div>";
        }else{
                echo "  <div class=\"d-flex justify-content-around mb-0 background-light align-items-center border\">
                <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["Quantite_commande"]."X ".$c["Numero_de_reference"]."</p></div>
                <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["Nom"]."</p></div>
                <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["prix"]."€</p></div>
                <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["nomT_shirt"]."</p></div>
                </div>";    
        }
        $ancienID = $c["commandeID"];
    }
    
    echo "</div>";






?>
</body>
</html>

