<?php
    $host="localhost";
    $db="hublart_benzzine";
    $user="root";
    $password="root";

    // Connexion à la base de données
    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
?>