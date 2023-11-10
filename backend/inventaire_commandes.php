<?php
    session_start();
    include 'db.php';

    // Redirection si on n'est pas connecté
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php'); // Redirection vers la page d'accueil du back end
        exit;
    }

    if ($_SESSION['role'] !== 'gerant') {
        header('Location: ../../home.php'); // Redirection vers la page d’accueil des clients
        exit;
    }

    // Récupération du chiffre d'affaires du mois
    $firstDayOfMonth = date('Y-m-01');
    $sql = "SELECT SUM(total) AS chiffreAffaireMois FROM commandes WHERE DATE(dateCommande) >= :firstDayOfMonth";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['firstDayOfMonth' => $firstDayOfMonth]);
    $chiffreAffaireMois = $stmt->fetch()['chiffreAffaireMois'] ?? 0;

    // Pagination
    $commandesParPage = 30;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $debut = ($page - 1) * $commandesParPage;


    // Récupération des commandes
    $sql = "SELECT c.idCommande, c.dateCommande, c.total, u.nom AS nomClient, u.prenom,
            GROUP_CONCAT(CONCAT(p.nom, ' - ', p.description, ' - Quantité: ', cl.quantite, ' - Prix: ', px.prixNet, '€', ' - <img src=\"', p.photoProduit, '\" style=\"width:50px;\">') SEPARATOR '<br>') AS detailsProduits
            FROM commandes AS c
            JOIN utilisateur AS u ON c.idUtilisateur = u.idUtilisateur
            JOIN commandeslignes AS cl ON c.idCommande = cl.idCommande
            JOIN produit AS p ON cl.idDeclinaison = p.idProduit
            JOIN prixproduit AS px ON p.idProduit = px.idProduit
            GROUP BY c.idCommande
            ORDER BY c.dateCommande DESC
            LIMIT :debut, :commandesParPage";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':debut', $debut, PDO::PARAM_INT);
    $stmt->bindValue(':commandesParPage', $commandesParPage, PDO::PARAM_INT);
    $stmt->execute();
    $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT COUNT(*) FROM commandes";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $totalCommandes = $stmt->fetchColumn();
    $pagesTotales = ceil($totalCommandes / $commandesParPage);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Inventaire des Commandes</title>
        <!-- Styles -->
    </head>
    <body>
        <h1>Inventaire des Commandes</h1>
        <h2>Chiffre d'affaires du mois : €<?= htmlspecialchars($chiffreAffaireMois) ?></h2>

        <table>
            <thead>
                <tr>
                    <th>Nom du client</th>
                    <th>Date/Heure</th>
                    <th>Prix total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                <tr>
                    <td><?= htmlspecialchars($commande['prenom'] . ' ' . $commande['nomClient']) ?></td>
                    <td><?= htmlspecialchars($commande['dateCommande']) ?></td>
                    <td><?= htmlspecialchars($commande['total']) ?> €</td>
                    <td><?= $commande['detailsProduits'] ?></td>
                    <td>
                        <a href="delete_commande.php?idCommande=<?= $commande['idCommande'] ?>" onclick="return confirm('Confirmez-vous la suppression de cette commande ?');">Effacer</a>
                     </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div>
            <?php for ($i = 1; $i <= $pagesTotales; $i++): ?>
            <a href="?page=<?= $i ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>

    </body>
</html>
