<?php
    
    function createProductCard($title, $imageSrc, $tags, $price) {
        $cardHtml = '
            <div class="card">
                <div class="poster"><img src="' . $imageSrc . '" alt="Location Unknown"></div>
                <div class="details">
                    <h1>' . $title . '</h1>
                    <div class="tags">';
                    
        foreach ($tags as $tag) {
            $cardHtml .= '<span class="tag">' . $tag . '</span>';
        }
        
        $cardHtml .= '
                    </div>
                    <h2>' . $price . '</h2>
                </div>
            </div>';
            
        return $cardHtml;
    }

    function getAllProducts($categories) {
        global $SQLconn; // Utilisez la connexion SQL
    
        // Requête SQL pour récupérer toutes les informations des produits
        $query = "SELECT p.nom AS productName, p.photoProduit AS productImage, GROUP_CONCAT(DISTINCT cp.nom ORDER BY cp.nom ASC) AS colors, pp.prixNet AS productPrice
                FROM produit p
                INNER JOIN declinaisonproduit dp ON p.idProduit=dp.idProduit
                LEFT JOIN couleurproduit cp ON dp.idCouleur = cp.idCouleur
                LEFT JOIN prixproduit pp ON dp.idDeclinaison = pp.idDeclinaison
                LEFT JOIN categorie c ON p.idCategorie=c.idCategorie
                WHERE c.nom= '$categories'
                GROUP BY p.nom, p.photoProduit, pp.prixNet
                ORDER BY RAND()
                LIMIT 3";
    
        // Exécutez la requête SQL
        $result = $SQLconn->query($query);
    
        // Récupérez les résultats dans un tableau associatif
        $products = $result->fetch_all(MYSQLI_ASSOC);
    
        return $products;
    }

    function getAllCategoriesWithImagesAndTypes() {
        global $SQLconn; // Utilisez la connexion SQL

        // Requête SQL pour récupérer toutes les catégories
        $query = "SELECT c.nom AS category, c.photo AS image, GROUP_CONCAT(t.nom ORDER BY t.nom ASC) AS types
                  FROM categorie c
                  LEFT JOIN typeproduit t ON c.idCategorie = t.idCategorie
                  GROUP BY c.nom";

        // Exécutez la requête SQL
        $result = $SQLconn->query($query);

        // Récupérez les résultats dans un tableau associatif
        $categories = $result->fetch_all(MYSQLI_ASSOC);

        return $categories;
    }

    // Utilisez la fonction pour obtenir toutes les catégories avec images et types
    $allCategoriesWithImagesAndTypes = getAllCategoriesWithImagesAndTypes();


    /*
    function displayProducts() {
        // Incluez votre code de connexion à la base de données ici

        // Exécutez une requête SQL pour extraire les informations des produits
        $query = "SELECT title, imageSrc, tags, price FROM products";
        $result = mysqli_query($conn, $query);

        // Parcourez les données et affichez les cartes de produits
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="card">';
            echo '<div class="poster"><img src="' . $row['imageSrc'] . '" alt="Location Unknown"></div>';
            echo '<div class="details">';
            echo '<h1>' . $row['title'] . '</h1>';
            
            // Affichez les balises
            $tags = explode(',', $row['tags']);
            echo '<div class="tags">';
            foreach ($tags as $tag) {
                echo '<span class="tag">' . trim($tag) . '</span>';
            }
            echo '</div>';
            
            echo '<h2>' . $row['price'] . '</h2>';
            echo '</div>';
            echo '</div>';
        }
    }*/
?>
