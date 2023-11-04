<?php
    
    function createProductCard($title, $imageSrc, $tags, $price) {
        $cardHtml = '
            <div class="card">
                <div class="poster"><img src="' . $imageSrc . '" alt="Photo produitn"></div>
                <div class="details">
                    <h1>' . $title . '</h1>
                    <div class="tags">';
                    
        foreach ($tags as $tag) {
            $cardHtml .= '<span class="tag">' . $tag . '</span>';
        }

        // affiche le prix pour les produits et  rien pour les categories
        if ($price == NULL) {
            $prix = '<h2></h2>';
        } else {
            $prix = '<h2>' . $price . ' €</h2>';
        }
        $cardHtml .= '
                    </div>

                    <h2>' . $prix . '</h2>
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



    function getAllProducts($categories, $limit, $offset, $trieproduit, $typeProduits) {
        global $SQLconn; // Utilisez la connexion SQL

        // Requête SQL pour récupérer toutes les informations des produits
        $query = "SELECT p.idProduit AS idProduit, p.nom AS productName, p.photoProduit AS productImage,
                GROUP_CONCAT(DISTINCT cp.nom ORDER BY cp.nom ASC) AS colors, pp.prixNet AS productPrice
                FROM produit p
                INNER JOIN declinaisonproduit dp ON p.idProduit=dp.idProduit
                LEFT JOIN couleurproduit cp ON dp.idCouleur = cp.idCouleur
                LEFT JOIN prixproduit pp ON p.idProduit = pp.idProduit
                LEFT JOIN categorie c ON p.idCategorie = c.idCategorie
                LEFT JOIN typeproduit tp ON p.idCategorie = tp.idCategorie
                WHERE c.nom= '$categories'";

        $query ="SELECT p.idProduit AS idProduit, p.nom AS productName, p.photoProduit AS productImage,
               GROUP_CONCAT(td_couleur.nom order by td_couleur.nom ) as colors, pp.prixNet AS productPrice    
                FROM produit p
                LEFT JOIN typeproduit tp ON p.idType = tp.idType
                LEFT JOIN categorie c ON tp.idCategorie = c.idCategorie
                LEFT JOIN prixproduit pp ON p.idProduit = pp.idProduit
                LEFT JOIN 
                (SELECT idproduit , cp.nom from declinaisonproduit dp 
                INNER JOIN couleurproduit cp ON dp.idCouleur = cp.idCouleur 
                group by idproduit , cp.nom) as td_couleur on td_couleur.idproduit = p.idproduit
                WHERE c.nom= '$categories' AND CURRENT_DATE BETWEEN pp.dateDebut and pp.dateFin";

        if ($typeProduits != "tous") {
            $query .= " AND tp.nom = '$typeProduits'";
        }
        $query .= " GROUP BY p.idProduit";
                
            if ($limit == 3) {
                $query .= " ORDER BY RAND() LIMIT $limit";
            }else{
                switch ($trieproduit){
                    case "nomCroissant":
                        $query .= " ORDER BY p.nom ASC";
                        break;
                    case "nomDecroissant":
                        $query .= " ORDER BY p.nom DESC";
                        break;
                    case "prixCroissant":
                        $query .= " ORDER BY pp.prixNet ASC";
                        break;
                    case "prixDecroissant":
                        $query .= " ORDER BY pp.prixNet DESC";
                        break;
                    default:
                        $query .= " ORDER BY p.nom ASC";
                        break;
                }
                $query .= " LIMIT $limit OFFSET $offset";
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
            return 0;
        }
    }

    function getProductById($idProduit){
        global $SQLconn; // Utilisez la connexion SQL
        
        // Requête SQL pour récupérer toutes les informations des produits

        $query = "SELECT  p.nom AS productName,
            p.photoProduit AS productImage,
            p.description AS productDescription, 
            p.matiereProduit AS productMaterial,
            GROUP_CONCAT( DISTINCT cp.nom)  AS colors, 
            pp.prixNet AS productPrice,
            GROUP_CONCAT( DISTINCT tap.taille ) AS sizes
            FROM produit p
            INNER JOIN declinaisonproduit dp ON p.idProduit = dp.idProduit
            LEFT JOIN couleurproduit cp ON dp.idCouleur = cp.idCouleur
            LEFT JOIN prixproduit pp ON p.idProduit = pp.idProduit
            LEFT JOIN typeproduit tp ON p.idCategorie = tp.idCategorie
            INNER JOIN tailleproduit tap ON tp.idType=tap.idType
            WHERE p.idProduit = $idProduit";


        // Exécutez la requête SQL
        $result = $SQLconn->query($query);
        if ( $result->num_rows != 0 ){
            $products = $result->fetch_all(MYSQLI_ASSOC);
            return $products;
        }else{
            return 0;
        }
    }
?>
