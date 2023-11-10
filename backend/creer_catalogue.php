<?php
    session_start();
    include 'db.php';

    // Vérification si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        // Utilisateur non connecté, redirection vers la page d'index du back-end
        header('Location: index.php');
        exit;
    } elseif ($_SESSION['role'] != 'gerant') {
        // Utilisateur connecté en tant que client, redirection vers la page d'index du front-end
        header('Location: ../../home.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nomCatalogue = !empty($_POST['nomCatalogue']) ? trim($_POST['nomCatalogue']) : null;

        // Vérification si le nom du catalogue n'est pas vide
        if ($nomCatalogue) {
            // Préparation de la requête SQL pour insérer le nouveau catalogue
            $sql = "INSERT INTO categorie (nom) VALUES (:nomCatalogue)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nomCatalogue', $nomCatalogue, PDO::PARAM_STR);

            // Exécution de la requête d'insertion
            if ($stmt->execute()) {
                // Redirection vers la page de gestion des catalogues
                header('Location: gestion_catalogues.php');
                exit;
            } else {
                echo "Erreur lors de la création du catalogue.";
            }
        } else {
            echo "Le nom du catalogue ne peut pas être vide.";
        }
    } else {
        echo "Requête non valide.";
    }
?>
