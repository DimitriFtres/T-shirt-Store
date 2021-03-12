<?php
    $host = "localhost";
    $user = "root";
    $password = "root";
    $table_name = "tshirt_store";
try {
    $bdd = new mysqli($host, $user, $password, $table_name);
} 
catch(Exception $e) {
    die('Erreur ; ' .$e->getMessage());
}
?>