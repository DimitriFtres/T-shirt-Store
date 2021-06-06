<?php
    $host = "localhost";
    $user = "root";
    $password = "root";
    $table_name = "tshirt_store";
try {
    $bdd = new PDO("mysql:host=$host; dbname=$table_name;charset=UTF8", $user, $password);
} 
catch(Exception $e) {
    die('Erreur ; ' .$e->getMessage());
}
?>