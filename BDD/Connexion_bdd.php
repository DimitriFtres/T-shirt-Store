<?php
    $host = "";
    $user = "";
    $password = "";
    $table_name = "";
try {
    $bdd = new PDO("mysql:host=$host; dbname=$table_name", $user, $password);
} 
catch(Exception $e) {
    die('Erreur ; ' .$e->getMessage());
}
?>
