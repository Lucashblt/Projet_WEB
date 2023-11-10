<?php
    session_start();
    include 'db.php'; // Assurez-vous que ce chemin est correct

    // Étape 1 : Vérification de la connexion et redirection en fonction du rôle de l'utilisateur
    if (!isset($_SESSION['user_id'])) {
        // Utilisateur non connecté, redirection vers la page d'index du back-end (page d'accueil des gérants)
        header('Location: index.php');
        exit;
    } elseif ($_SESSION['role'] != 'gerant') {
        // Utilisateur connecté en tant que client, redirection vers la page d'index du front-end (page d'accueil des clients)
        header('Location: ../../home.php');
        exit;
    }

    // Étape 2 : Récupération du numéro de page depuis la requête GET
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;

    // Étape 3 : Calcul de l'offset
    $produitsParPage = 20;
    $offset = ($page - 1) * $produitsParPage;

    // Étape 4 : Modification de la requête SQL avec LIMIT, OFFSET et tri par nom
    $sql = "SELECT p.nom AS nomProduit, p.reference, p.prix, c.nom AS nomCategorie
            FROM produit p
            LEFT JOIN categorie c ON p.idCategorie = c.idCategorie
            ORDER BY p.nom ASC  -- Tri par nom en ordre croissant
            LIMIT '$produitsParPage' OFFSET '$offset'";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':produitsParPage', $produitsParPage, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll();

    // Étape 5 : Récupération du nombre total de produits
    $sqlCount = "SELECT COUNT(*) as total FROM produit";
    $stmtCount = $conn->prepare($sqlCount);
    $stmtCount->execute();
    $resultCount = $stmtCount->fetch();
    $totalProduits = $resultCount['total'];

    // Calcul de $pagesTotales
    $pagesTotales = ceil($totalProduits / $produitsParPage);

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Gestion des Produits</title>
        <!-- Liens vers CSS et autres ressources -->
    </head>
    <body>
        <h1>Gestion des Produits</h1>
        <!-- Affichage des produits depuis la base de données -->
        <div class="products">
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <h2><?php echo htmlspecialchars($product['nomProduit']); ?></h2>
                    <p>Référence : <?php echo htmlspecialchars($product['reference']); ?></p>
                    <p>Prix : <?php echo htmlspecialchars($product['prix']); ?></p>
                    <p>Catégorie : <?php echo htmlspecialchars($product['nomCategorie']); ?></p>

                    <!-- Bouton Renommer -->
                    <button onclick="toggleEditMode(<?php echo $product['idProduit']; ?>, 'product')">Renommer</button>

                    <!-- Formulaire pour effacer -->
                    <form action="effacer_produit.php" method="post">
                        <input type="hidden" name="idProduit" value="<?php echo htmlspecialchars($product['idProduit']); ?>">
                        <button onclick="confirmDelete(<?php echo $product['idProduit']; ?>, 'product')">Effacer</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>


        <!-- Affichage des liens de pagination -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $pagesTotales; $i++): ?>
                <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>

    <!-- Le reste de la page peut être ajouté ici pour d'autres fonctionnalités -->
        <script src="assets/js/gestion.js"></script>
    </body>
</html>