<?php

    include("initialize.php");
    include("affichageproduit.php");

    if (isset($_POST["count"])) {
        $count = $_POST["count"];
        $categories = $_GET['categorie'];
        $trieproduit = $_POST['trieproduit'];
        $typeProduits = $_POST['typeProduits'];
        $moreProducts = getAllProducts($categories, 8, $count, $trieproduit, $typeProduits);

        if (!empty($moreProducts)) {
            foreach ($moreProducts as $productData) {
                // Créez ici les cartes de produits pour les produits supplémentaires
                $productID = $productData['idProduit'];
                $productName = $productData['productName'];
                $productImage = $productData['productImage'];
                $colors = explode(',', $productData['colors']);
                $productPrice = $productData['productPrice'];

                echo '<a href="produits.php?idProduit=' . urlencode($productID) . '">';
                echo createProductCard($productName, $productImage, $colors, $productPrice);
                echo '</a>';
            }
        } else {
            echo "";
            
        }
    }
?>
