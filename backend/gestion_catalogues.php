<?php
    session_start();
    include 'db.php'; // Assurez-vous que ce chemin est correct

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

    // Exécution de la requête pour récupérer les catalogues et leur nombre de produits
    $sql = "SELECT c.nom, COUNT(p.idProduit) as nombreProduits FROM categorie c LEFT JOIN produit p ON c.idCategorie = p.idCategorie GROUP BY c.idCategorie";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $catalogues = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Catalogues</title>
    <!-- Liens vers CSS et autres ressources -->
</head>
<body>
    <h1>Gestion des Catalogues</h1>

    <button id="toggle-form-button">Ajouter un catalogue</button>

    <div class="catalogues">
        <?php foreach ($catalogues as $catalogue): ?>
            <div class="catalogue">
                <div id="display-catalogue-<?php echo $catalogue['idCategorie']; ?>">
                    <h2><?php echo htmlspecialchars($catalogue['nom']); ?></h2>
                    <p>Nombre de produits : <?php echo htmlspecialchars($catalogue['nombreProduits']); ?></p>
                    
                </div>
                <div id="edit-catalogue-<?php echo $catalogue['idCategorie']; ?>" style="display: none;">
                    <!-- Formulaire pour renommer -->
                    <form onsubmit="updateName(<?php echo $catalogue['idCategorie']; ?>, 'catalogue'); return false;">
                        <input type="hidden" id="input-catalogue-<?php echo $catalogue['idCategorie']; ?>" value="<?php echo htmlspecialchars($catalogue['nom']); ?>">
                        <input type="submit" value="Sauvegarder">
                    </form>
                </div>

                <!-- Bouton pour basculer en mode édition -->
                <button onclick="toggleEditMode(<?php echo $catalogue['idCategorie']; ?>, 'catalogue')">Renommer</button>

                <!-- Formulaire pour effacer -->
                <form action="effacer_catalogue.php" method="post">
                    <input type="hidden" name="idCategorie" value="<?php echo htmlspecialchars($catalogue['idCategorie']); ?>">
                    <button onclick="confirmDelete(<?php echo $catalogue['idCategorie']; ?>, 'catalogue')">Effacer</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Formulaire de création d'un nouveau catalogue -->
    <form id="create-catalogue-form" style="display: none;" action="creer_catalogue.php" method="post">
        <label for="nouveauCatalogue">Nom du nouveau catalogue :</label>
        <input type="text" id="nouveauCatalogue" name="nomCatalogue" placeholder="Nom du catalogue" required>
        <input type="submit" value="Créer">

        <!-- Message d'erreur (initiallement masqué) -->
        <p id="error-message" style="color: red; display: none;"></p>
    </form>

    <script src="assets/js/gestion.js"></script>
</body>
</html>