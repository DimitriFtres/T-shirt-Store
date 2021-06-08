<?php
echo "<article ".$classDivEtiquette.">
<a href=\"pageArticle.php?idArticle=".utf8_encode($e["id"])."\" ".$classAEtiquette.">
<img alt=\"T-shirt personnalisé t-shirt-store\" ".$classimgEtiquette." src=\"".$e['Image']."\">
<h2 ".$classNomTShirtEtiquette.">".$e['nom']."</h2>
<h3 ".$classAuteurEtiquette.">".$e['auteur_nom']."</h3>
</a>
</article>";
?>

            