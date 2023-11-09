<?php
    //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php");
    include("./function/affichageproduit.php");
    include('navbar.php');

    // Obtenez toutes les catégories avec images et types
    $allCategoriesWithImagesAndTypes = getAllCategoriesWithImagesAndTypes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/boutique.css">
    <link rel="stylesheet" type="text/css" href="./styles/affichageproduit.css">
    <title>Boutique</title>
</head>
<body>
    <h3>Catalogue</h3>
    <div class="products">
        <?php
            if (empty($allCategoriesWithImagesAndTypes)) {
                echo '<h3 class="errorMessage">Aucun produit ne correspond à votre recherche</h3>';
            } else {
                foreach ($allCategoriesWithImagesAndTypes as $categoryData) {
                    $categoryName = $categoryData['category'];
                    $imageSrc = $categoryData['image'];
                    $types = explode(',', $categoryData['types']);

                    echo '<a href="CatalogueProduit.php?categorie=' . urlencode($categoryName) . '">';
                    echo createProductCard($categoryName, $imageSrc, $types, "");
                    echo '</a>';
                }
            }
        ?>
    </div>
    <?php
        include('footer.php');
    ?>
</body>
</html>