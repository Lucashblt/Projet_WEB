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
                    <h2>' . $price . ' €</h2>
                </div>
            </div>';
            
        return $cardHtml;
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



    function getAllProducts($categories, $limit, $offset) {
        global $SQLconn; // Utilisez la connexion SQL
    
        // Requête SQL pour récupérer toutes les informations des produits
        $query = "SELECT p.idProduit AS idProduit, p.nom AS productName, p.photoProduit AS productImage, GROUP_CONCAT(DISTINCT cp.nom ORDER BY cp.nom ASC) AS colors, pp.prixNet AS productPrice
                FROM produit p
                INNER JOIN declinaisonproduit dp ON p.idProduit=dp.idProduit
                LEFT JOIN couleurproduit cp ON dp.idCouleur = cp.idCouleur
                LEFT JOIN prixproduit pp ON dp.idDeclinaison = pp.idDeclinaison
                LEFT JOIN categorie c ON p.idCategorie=c.idCategorie
                WHERE c.nom= '$categories'
                GROUP BY p.nom, p.photoProduit, pp.prixNet";
                
            if ($limit == 3) {
                $query .= " ORDER BY RAND() LIMIT $limit";
            }else{
                $query .= " ORDER BY p.nom ASC LIMIT $limit OFFSET $offset";
            }
            
        // Exécutez la requête SQL
        $result = $SQLconn->query($query);

        if ( $result->num_rows != 0 ){
            // Récupérez les résultats dans un tableau associatif
            $products = $result->fetch_all(MYSQLI_ASSOC);
            return $products;
        }else{
            return array();
        }
    }


    function getCategoryNameByProductId($idProduit) {
        global $SQLconn; // Utilisez la connexion SQL
    
        // Requête SQL pour récupérer le nom de la catégorie à partir de l'ID du produit
        $query = "SELECT c.nom AS categoryName
                  FROM produit p
                  INNER JOIN categorie c ON p.idCategorie = c.idCategorie
                  WHERE p.idProduit = $idProduit";
    
        // Exécutez la requête SQL
        $result = $SQLconn->query($query);
    
        if ($result->num_rows > 0) {
            // Récupérez le résultat de la requête
            $row = $result->fetch_assoc();
            return $row['categoryName'];
        } else {
            echo "Aucune categorie n'est associé à ce produit";
        }
    }

    function getProductById($idProduit){
        global $SQLconn; // Utilisez la connexion SQL
        
        // Requête SQL pour récupérer toutes les informations des produits
        $query = "SELECT p.nom AS productName,
                p.photoProduit AS productImage,
                p.description AS productDescription, 
                GROUP_CONCAT(DISTINCT cp.nom) AS colors, 
                pp.prixNet AS productPrice,
                GROUP_CONCAT(DISTINCT tap.taille) AS sizes
                FROM produit p
                INNER JOIN declinaisonproduit dp ON p.idProduit = dp.idProduit
                LEFT JOIN couleurproduit cp ON dp.idCouleur = cp.idCouleur
                LEFT JOIN prixproduit pp ON dp.idDeclinaison = pp.idDeclinaison
                LEFT JOIN typeproduit tp ON p.idCategorie = tp.idCategorie
                INNER JOIN tailleproduit tap ON tp.idType=tap.idType
                WHERE p.idProduit = $idProduit";

        // Exécutez la requête SQL
        $result = $SQLconn->query($query);
        if ( $result->num_rows != 0 ){
            $products = $result->fetch_all(MYSQLI_ASSOC);
            return $products;
        }else{
            return array();
        }
    }
?>
