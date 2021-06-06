<?php
    $host = "";
    $user = "";
    $password = "";
    $table_name = "";
try {
    $bdd = new PDO("mysql:host=$host; dbname=$table_name;charset=UTF8", $user, $password);
} 
catch(Exception $e) {
    die('Erreur ; ' .$e->getMessage());
}
?>