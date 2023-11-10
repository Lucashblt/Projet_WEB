<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'gerant') {
    header('Location: index.php');
    exit;
}

if (isset($_GET['idCommande'])) {
    $idCommande = $_GET['idCommande'];

    // Suppression de la commande
    $sql = "DELETE FROM commandes WHERE idCommande = :idCommande";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idCommande', $idCommande, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: inventaire_commandes.php');
    exit;
}
?>