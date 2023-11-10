<?php
    include "../initialize.php";
    $loggedIn = false;

    if ($SQLconn->loginStatus->loginSuccessful) {
        $loggedIn = true;
        
        $query ="SELECT role from utilisateur where email ='" . $SQLconn->loginStatus->userEmail . "'";
        $result = $SQLconn->conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $role = $row["role"];
            if ($role == "Client") {  
                $redirect = "Location:../home.php";
                header($redirect);
            } else {
                $redirect = "Location:../backend/index.php";
            }
            
        }
    } else {
        $loggedIn = false;
    }

    // Pagination
    $commandesParPage = 10;
    $pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $debut = ($pageActuelle - 1) * $commandesParPage;


    $firstDayOfMonth = date('Y-m-01');
    $sql = "SELECT SUM(total) AS chiffreAffaireMois FROM commandes WHERE DATE(dateCommande) >= $firstDayOfMonth";
    $result = $SQLconn->conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $chiffreAffaireMois = $row["chiffreAffaireMois"];
    }else{
        $chiffreAffaireMois = 0;
    }

    //suprimer commandes
    if (isset($_POST["delete"])) {
        // Récupérez l'idCommande à partir du formulaire
        $idCommande = $_POST["idCommande"];

        // Utilisez l'idCommande pour supprimer la commande de commandes lignes et commandes
        $querydeleteCL = "DELETE FROM commandeslignes WHERE idCommande = $idCommande";
        $resultCL = $SQLconn->conn->query($querydeleteCL);
        if ($resultCL) {
            $query = "DELETE FROM commandes WHERE idCommande = $idCommande";
            $result = $SQLconn->conn->query($query);
            if ($result) {
                echo "La commande a été supprimée avec succès.";
            } else {
                echo "Une erreur s'est produite lors de la suppression de la commande.";
            }
        } else {
            echo "Une erreur s'est produite lors de la suppression de la commande. ";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Inventaire des Commandes</title>
        <link rel="stylesheet" href="../backend/styles/inventaireCommandes.css">
    </head>
    <body>
        <h1>Inventaire des Commandes</h1>
        <h2>Chiffre d'affaires du mois : <?php echo $chiffreAffaireMois ?> €</h2>
        <div class="lien">
            <a href="index.php">Page d'Accueil</a>
            <a href="gestion_catalogues.php">Gestion des catalogues</a>
            <a href="gestion_produit.php">Gestion des produits</a>
            <form action="../logout.php" method="POST"> 
                <input type="hidden" value="logout" name="logout"></input>
                <button type="submit"><span>Se déconnecter</span></button>
            </form>
        </div>        
        <section class="commandes">
            <?php
                $query="SELECT c.*, cl.* , p.nom AS nomProduit, p.photoProduit AS photoProduit, 
                    tap.taille AS nomTaille, cp.nom AS nomCouleur, pp.prixNet AS prixNet,
                    c.status AS statusCommande, c.total AS totalCommande, u.pseudo AS pseudoUtilisateur
                    FROM commandes c
                    INNER JOIN utilisateur u ON c.idUtilisateur=u.idUtilisateur
                    INNER JOIN commandeslignes cl ON c.idCommande = cl.idCommande
                    INNER JOIN prixproduit pp ON cl.idPrix = pp.idPrix
                    INNER JOIN declinaisonproduit dp ON cl.idDeclinaison = dp.idDeclinaison
                    INNER JOIN couleurproduit cp ON dp.idCouleur = cp.idCouleur
                    INNER JOIN tailleproduit tap ON dp.idTaille = tap.idTaille
                    INNER JOIN produit p ON dp.idProduit = p.idProduit
                    ORDER BY c.dateCommande DESC
                    LIMIT $debut, $commandesParPage";
                
                $result = $SQLconn->conn->query($query);
                if ($result && $result->num_rows > 0) {
                    $currentCommandeId = null; // Initialisez une variable pour suivre la commande en cours
                    while ($row = $result->fetch_assoc()) {
                        if ($currentCommandeId !== $row['idCommande']) {
                            // Nouvelle commande, affichez les détails de la commande
                            if ($currentCommandeId !== null) {
                                echo '</div></li>';
                            }

                            echo '<li class="order-item">';
                            echo '<div class="order-details">';
                            echo '<p> Utilisateur : ' . $row['pseudoUtilisateur'] . '</p>';
                            echo '<p>Date de commande: ' . $row['dateCommande'] . '</p>';
                            echo '<p>Status: ' . $row['statusCommande'] . '</p>';
                            echo '<p>Total: ' . $row['totalCommande'] . ' €</p>';
                            echo '</div>';
                            echo '<div class="products">';
                            $currentCommandeId = $row['idCommande'];
                        }

                        // Affichez les détails du produit
                        echo '<div class="product">';
                        echo '<div class="product-image"><img src="../' . $row['photoProduit'] . '" alt="Photo du produit"></div>';
                        echo '<div class="product-info">';
                        echo '<p>Nom du Produit: ' . $row['nomProduit'] . '</p>';
                        echo '<p>Couleur: ' . $row['nomCouleur'] . '</p>';
                        echo '<p>Taille: ' . $row['nomTaille'] . '</p>';
                        echo '<p>Prix Unitaire : ' . $row['prixNet']. ' €</p>';
                        echo '<p>Quantité: ' . $row['quantite'] . '</p>';
                        echo '<p>Prix Total: ' . $row['prixNet'] * $row['quantite'] . ' €</p>';
                        echo '<form method="post" action="inventaire_commandes.php">';
                        echo '<input type="hidden" name="idCommande" value="' . $row['idCommande'] . '">';
                        echo '<button type="submit" name="delete" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette commande ?\');">Supprimer</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }

                    // Fermez le dernier groupe de produits
                    echo '</div></li>';
                } else {
                    echo '<li>Aucune commande précédente trouvée.</li>';
                }
            ?>
        </section>
        <!-- Pagination -->
        <div class="pagination">
            <?php
            $sql = "SELECT COUNT(*) FROM commandes";
            $result = $SQLconn->conn->query($sql);
            $totalCommandes = $result->fetch_row()[0];
            $pagesTotales = ceil($totalCommandes / $commandesParPage);

            for ($i = 1; $i <= $pagesTotales; $i++) {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }
            ?>
        </div>
    </body>
</html>
