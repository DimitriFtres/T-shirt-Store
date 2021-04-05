<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: ../ConnexionAdmin.php");
    }
    include("Head.php");
    include("AdminHeader.html");
?>
<?php
    $ancienID = '';
    $commande = $bdd->query("SELECT c.ID AS commandeID, c.ID_Utilisateur, c.Date_Livraison, c.Etat_Livraison, c.Date_commande, u.id, CONCAT(u.Nom, ' ', u.prenom) as utilisateurNom, t.Numero_de_reference, t.Nom, t.prix FROM commandes AS c 
                             JOIN utilisateurs AS u ON u.id = c.ID_Utilisateur
                             JOIN teeshirt_commande AS tc ON tc.ID_commande = c.ID
                             JOIN teeshirts AS t ON t.id = tc.ID_teeshirt");
    echo "<div class=\"d-flex flex-column container m-auto\">";
    while($c = $commande ->fetch()){
        if($ancienID !== $c["commandeID"]){
            echo "<div class=\"d-flex justify-content-around mb-0 background align-items-center\">";
            echo "<div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-light\">".$c["commandeID"]."</p></div>";
            echo "<div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-light\">".$c["Date_commande"]."</p></div>";
            echo "<div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-light\">".$c["utilisateurNom"]."</p></div>";
            echo "<div class=\"col\">
                    <form action=\"\" method=\"POST\" class=\"pl-2 py-1 mb-0 color-light d-flex align-items-center justify-content-around\">
                        <label for=\"livrer\" class=\"my-0\">Livrée</label>
                        <input type=\"checkbox\" name=\"livrer\" id=\"livrer\" value=\"livrer\">
                        <input type=\"submit\" class=\"btn btn-light py-0\">
                    </form>
                </div>";
            echo "</div>";
            echo "  <div class=\"d-flex justify-content-around mb-0 background-light align-items-center border\">
                        <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["Numero_de_reference"]."</p></div>
                        <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["Nom"]."</p></div>
                        <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["prix"]."€</p></div>
                    </div>";
        }else{
            echo "  <div class=\"d-flex justify-content-around mb-0 background-light align-items-center border\">
                        <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["Numero_de_reference"]."</p></div>
                        <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["Nom"]."</p></div>
                        <div class=\"col\"><p class=\"pl-2 py-1 mb-0 color-green\">".$c["prix"]."€</p></div>
                    </div>";
        }
        $ancienID = $c["commandeID"];
    }
    echo "</div>";






?>
    <!--<article class="d-flex flex-column container m-auto">
        <div class="row">
            <div class="col"><p>Numéro de commandes</p></div>
            <div class="col"><p>Date de création de la commande</p></div>
            <div class="col"><p>Nom du client</p></div>
            <div class="col">
                <form action="" method="POST">
                <label for="livrer">Livrée</label>
                <input type="checkbox" name="livrer" id="livrer" value="livrer">
                <input type="submit">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col"><p>Numéro de référence t-shirt</p></div>
            <div class="col"><p>Nom du t-shirt</p></div>
        </div>-->
