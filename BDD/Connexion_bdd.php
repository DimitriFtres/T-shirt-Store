<?php
    $host = "185.98.131.109";
    $user = "fastr1522145";
    $password = "pcs33ctjva";
    $table_name = "fastr1522145";
try {
    $bdd = new PDO("mysql:host=$host; dbname=$table_name;charset=UTF8", $user, $password);
} 
catch(Exception $e) {
    die('Erreur ; ' .$e->getMessage());
}
?>