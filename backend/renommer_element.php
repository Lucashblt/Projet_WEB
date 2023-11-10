<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nouveauNom = $_POST['nouveauNom'];
    $type = $_POST['type'];

    if ($type == 'catalogue') {
        $sql = "UPDATE categorie SET nom = :nouveauNom WHERE idCategorie = :id";
    } elseif ($type == 'produit') {
        $sql = "UPDATE produit SET nom = :nouveauNom WHERE idProduit = :id";
    }

    $stmt = $conn->prepare($sql);
    $result = $stmt->execute(['nouveauNom' => $nouveauNom, 'id' => $id]);

    if ($result) {
        echo "Mise à jour réussie";
    } else {
        echo "Erreur lors de la mise à jour";
    }
}
?>
