<?php
echo "<div ".$classDivEtiquette.">
<a href=\"pageArticle.php?idArticle=".utf8_encode($e["id"])."\" ".$classAEtiquette.">
<img ".$classimgEtiquette." src=\"".$e['Image']."\">
<p ".$classNomTShirtEtiquette.">".$e['nom']."</p>
<p ".$classAuteurEtiquette.">".$e['auteur_nom']."</p>
</a></div>";
?>

            