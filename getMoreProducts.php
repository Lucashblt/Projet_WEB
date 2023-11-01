<?php

include("initialize.php");
include("affichageproduit.php");

if (isset($_POST["count"])) {
    $count = $_POST["count"];
    $categories = $_GET['categorie'];
    $moreProducts = getAllProducts($categories, 12, $count);
    
    if (!empty($moreProducts)) {
        foreach ($moreProducts as $productData) {
            // Créez ici les cartes de produits pour les produits supplémentaires
            $productID = $productData['idProduit'];
            $productName = $productData['productName'];
            $productImage = $productData['productImage'];
            $colors = explode(',', $productData['colors']);
            $productPrice = $productData['productPrice'];
            echo createProductCard($productName, $productImage, $colors, $productPrice);
        }
    } else {
        echo "Aucun produit supplémentaire n'a été trouvé.";
    }
}
?>
