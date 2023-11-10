<?php
session_start();
include 'db.php'; // Assurez-vous que ce chemin est correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous que l'utilisateur est connecté en tant que gérant
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'gerant') {
        // Rediriger l'utilisateur vers la page d'accueil appropriée s'il n'est pas connecté en tant que gérant
        echo "Accès non autorisé.";
        exit;
    }

    // Récupérer l'ID de l'élément à supprimer et son type depuis la requête POST
    $elementId = isset($_POST['id']) ? $_POST['id'] : '';
    $elementType = isset($_POST['type']) ? $_POST['type'] : '';

    // Vérifier si l'ID de l'élément n'est pas vide
    if (!empty($elementId) && !empty($elementType)) {
        // Utilisez un switch pour gérer différents types d'éléments
        switch ($elementType) {
            case 'catalogue':
                // Supprimer l'élément de la table "categorie" (exemples de requêtes à adapter à votre structure)
                $sql = "DELETE FROM categorie WHERE idCategorie = :elementId";
                break;
            case 'produit':
                // Supprimer l'élément de la table "produit" (exemples de requêtes à adapter à votre structure)
                $sql = "DELETE FROM produit WHERE idProduit = :elementId";
                break;
            // Ajoutez d'autres cas pour gérer d'autres types d'éléments si nécessaire
            default:
                echo "Type d'élément non valide.";
                exit;
        }

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':elementId', $elementId, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            // L'effacement a réussi, renvoyer une réponse réussie
            echo "Effacement réussi";
            exit;
        } else {
            // Une erreur s'est produite lors de la suppression, renvoyer un message d'erreur
            echo "Erreur lors de l'effacement.";
            exit;
        }
    } else {
        // L'ID de l'élément est vide, renvoyer un message d'erreur
        echo "ID de l'élément non valide.";
        exit;
    }
} else {
    // La requête n'est pas une requête POST, renvoyer un message d'erreur
    echo "Requête non autorisée.";
    exit;
}
?>
