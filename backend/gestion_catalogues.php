<?php
    include "../initialize.php";
    include "../backend/functioncatalogue.php";


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
    
    //suprimer categorie
    if (isset($_POST["delete"])) {
        // Récupérez l'idCategorie à partir du formulaire
        $idCategorie = $_POST["idCategorie"];
        deleteCategorie($idCategorie);

    }

    if (isset($_POST['edit'])) {
        // Récupérez l'id de la catégorie à partir du formulaire
        $idCategorie = $_POST['idCategorie'];
    
        // Récupérez le nouveau nom de la catégorie à partir du formulaire
        $nouveauNomCategorie = $_POST['nouveauNomCategorie'];
        updateNameCategorie($idCategorie, $nouveauNomCategorie);
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Catalogues</title>
    <link rel="stylesheet" href="../backend/styles/gestioncategorie.css">
</head>
<body>
    <h1>Gestion des Catalogues</h1>
    <div class="lien">
        <a href="index.php">Page d'Accueil</a>
        <a href="inventaire_commandes.php">Inventaire Commandes</a>
        <a href="gestion_produits.php">Gestion des produits</a>
        <form action="../logout.php" method="POST"> 
            <input type="hidden" value="logout" name="logout"></input>
            <button type="submit"><span>Se déconnecter</span></button>
        </form>
    </div>     

    <section class="commandes">
            <h2>Catégories</h2>
            <?php
                $query="SELECT c.idCategorie AS idCategorie, c.nom AS category, c.photo AS imageCategorie, GROUP_CONCAT(t.nom ORDER BY t.nom ASC) AS types
                        FROM categorie c
                        LEFT JOIN typeproduit t ON c.idCategorie = t.idCategorie
                        GROUP BY c.nom";
                
                $result = $SQLconn->conn->query($query);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Affichez les détails du produit
                        echo '<div class="product">';
                        echo '<div class="product-image"><img src="../' . $row['imageCategorie'] . '" alt="Photo categorie"></div>';
                        echo '<div class="product-info">';
                        echo '<p>Nom : ' . $row['category'] . '</p>';
                        echo '<p>Types : ' . $row['types'] . '</p>';
                        echo '<form method="post" action="gestion_catalogues.php">';
                        echo '<input type="hidden" name="idCategorie" value="' . $row['idCategorie'] . '">';
                        echo '<input type="text" name="nouveauNomCategorie" data-id="' . $row['idCategorie'] . '" id="nouveauNomCategorie" placeholder="Nouveau nom" required style="display: none;">';
                        echo '<button class="edit-button" type="button" onclick="afficherChampModification(\'' . $row['idCategorie'] . '\')">Renommer</button>';
                        echo '<button class="edit-button" type="submit" name="edit" data-id="' . $row['idCategorie'] . '" style="display: none;">Enregistrer</button>';
                        echo '</form>';
                        echo '<form method="post" action="gestion_catalogues.php">';
                        echo '<input type="hidden" name="idCategorie" value="' . $row['idCategorie'] . '">';
                        echo '<button class="delete-button" type="submit" name="delete" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette commande ?\');">Supprimer</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }

                    // Fermez le dernier groupe de produits
                    echo '</div></li>';
                } else {
                    echo '<li>Aucune categorie trouvée.</li>';
                }
            ?>
    </section>
    <script>
        function afficherChampModification(idCategorie) {
            // Masquer tous les champs de modification existants
            var tousLesChamps = document.querySelectorAll('input[name="nouveauNomCategorie"]');
            tousLesChamps.forEach(function(champ) {
                champ.style.display = 'none';
            });

            // Afficher le champ de modification spécifique
            var champSpecifique = document.querySelector('input[name="nouveauNomCategorie"][data-id="' + idCategorie + '"]');
            champSpecifique.style.display = 'inline-block';

            // Masquer tous les boutons "Modifier" existants
            var tousLesBoutonsModifier = document.querySelectorAll('.edit-button');
            tousLesBoutonsModifier.forEach(function(bouton) {
                bouton.style.display = 'none';
            });

            // Afficher le bouton "Enregistrer" spécifique
            var boutonEnregistrer = document.querySelector('.edit-button[data-id="' + idCategorie + '"]');
            boutonEnregistrer.style.display = 'inline-block';
        }
</script>
</body>
</html>