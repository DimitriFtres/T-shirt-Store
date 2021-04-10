<?php
echo "<div ".$classDivEtiquette.">
<a href=\"pageArticle.php?idArticle=".$e["id"]."\" ".$classAEtiquette.">
<img ".$classimgEtiquette." src=\"".$e['Image']."\">
<p ".$classNomTShirtEtiquette.">".$e['nom']."</p>
<p ".$classAuteurEtiquette.">".$e['auteur_nom']." ".$e['prenom']."</p>
</a></div>";
?>

            