<?php
session_start();
include('../BDD/Connexion_bdd.php');
function test_tout_est_remplie($val){
    $cestRemplie = true;
    foreach($val as $key => $v){
        if(empty($v)){
            $cestRemplie = false;
        }
    }
    return $cestRemplie;
}
function numerique($number){
    return str_replace('e', 'a', $number);
}

function rendre_le_prix_float($prix) {
    number_format($prix, 2, ".", "");
    return $prix;
}
function modifierBDD($bdd, $nomtable, $id, $tableauAChanger, $champautre, $champteeshirt){
    $champsBdd = $bdd->prepare("SELECT * FROM ".$nomtable." WHERE ".$champteeshirt." = ?");
    $champsBdd ->execute(array($id));
    $ancien_resultat = array();
    while($reponse = $champsBdd ->fetch()){
        $ancien_resultat[] = $reponse[$champautre];
    }
    $tableau_ajouter = array_diff($tableauAChanger, $ancien_resultat); // si tableau_diff a une valeur cela veut dire qu'il faut ajouter
    $tableau_supprimer = array_diff($ancien_resultat, $tableauAChanger); // si tableau_diff a une valeur cela veut dire qu'il faut supprimer
    if($tableau_supprimer){
        foreach($tableau_supprimer as $val){
            $supprimer = $bdd->prepare("DELETE FROM ".$nomtable." WHERE ".$champautre." = ? AND ".$champteeshirt." = ?");
            $supprimer -> execute(array($val, $id));
        }
    }
    if($tableau_ajouter){
        foreach($tableau_ajouter as $val){
            $ajouter = $bdd->prepare("INSERT INTO ".$nomtable." (".$champautre.", ".$champteeshirt.") VALUES (?,?)");
            $ajouter -> execute(array($val, $id));
        }
    }
}
function imagetest($image){
    $target_dir = "../Uploads/";
    $target_file = $target_dir . basename($image["name"]);
    $uploadOk = 1;
    $retour = 0;
    if(file_exists($target_file)){
        $uploadOk = 0;
    }
    if($image["size"] > 10485760){
        $uploadOk = 0;
    }
    //Check if image file is a actual image or fake image
    $check = getimagesize("file://".$image["tmp_name"]);
    if($check === 0) {
        $uploadOk = 0;
    }
    if($uploadOk === 1){
        move_uploaded_file($image["tmp_name"], $target_file);
        $retour = [1, $target_file];
    }
        return $retour;

}
function maximumBDD ($bdd, $nomtable){
    $max = $bdd -> query("SELECT max(ID) FROM ".$nomtable);
    $max = $max ->fetch();
    return $max[0];
}
function verif_Stock($quantitevoulu, $quantiteStock){
    $resultat = (($quantitevoulu > 0) AND ($quantitevoulu < 5) AND ($quantiteStock >= $quantitevoulu)) ? true : false;
    return $resultat;
}
function VerifCodePostal ($CP){
    return (preg_match('/\d{4}/', $CP)) ? true : false;
}
function VerifNumero ($numero){
    return (preg_match('/(\d{1,4})/', $numero)) ? true : false;
}
function VerifNom ($nom){
    return (preg_match('/.[^0-9]+/ixs', $nom)) ? true : false;
}
function modifier_stock_tshirt($bdd, $plusOUmoins, $differenceModification, $idTshirt){
    $quantiteFinal = NULL;
    $quantitePresente = $bdd->prepare("SELECT Quantite_stock, ID FROM teeshirts WHERE ID = :id");
    $quantitePresente->execute(array(':id' => $idTshirt));
    $quantitePresente = $quantitePresente->fetch();
    $reponse = $bdd->prepare("UPDATE teeshirts SET Quantite_stock = ? WHERE ID = ?");
    if($plusOUmoins == "+"){
        $quantiteFinal = $quantitePresente[0] + $differenceModification;
    }elseif($plusOUmoins == "-"){
        $quantiteFinal = $quantitePresente[0] - $differenceModification;
    }else{
        return false;
    }
    if($quantiteFinal >= 0){
        $reponse->execute(array($quantiteFinal, $idTshirt));
        return true;   
    }else{
        return false;
    }
}
function creationCommande($bdd, $idUtilisateur, array $tabmodele, array $tabteeshirt, array $tabtaille, array $tabquantite){
    $creationCommande = $bdd->query("INSERT INTO commandes (Date_commande, Etat_Livraison) VALUES (NOW(), 1)");
    $commandes = "commandes";
    $recupID = maximumBDD ($bdd, $commandes);
    $recupTailles = $bdd->prepare("SELECT ID FROM tailles WHERE Nom = :taille");
    $recupModeles = $bdd->prepare("SELECT ID FROM modeles WHERE Modele = :modele");
    $creationCommande = $bdd->prepare("INSERT INTO teeshirt_commande (ID_commande, ID_utilisateur, ID_modele, ID_teeshirt, ID_taille, Quantite_commande) VALUES (?,?,?,?,?,?)");
    foreach($tabteeshirt as $k => $v){
        $recupTailles->execute(array(":taille" => $tabtaille[$k]));
        $recupModeles->execute(array(":modele" => $tabmodele[$k]));
        $taille = $recupTailles->fetch();
        $modele = $recupModeles->fetch();
        $creationCommande->execute(array($recupID, $idUtilisateur, $modele["ID"], $tabteeshirt[$k], $taille["ID"], $tabquantite[$k]));
    }

}