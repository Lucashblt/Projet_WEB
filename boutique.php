<?php
    //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php");

    include("./affichageproduit.php")
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
    <?php
        include('navbar.php');
    ?>
    <h3>Catalogue</h3>
    <div class="products">
        <?php
            foreach ($allCategoriesWithImagesAndTypes as $categoryData) {
                $categoryName = $categoryData['category'];
                $imageSrc = $categoryData['image'];
                $types = explode(',', $categoryData['types']);

                echo '<a href="CatalogueProduit.php">';
                echo createProductCard($categoryName, $imageSrc, $types, "");
                echo '</a>';
            }
        ?>
    </div>
    <div class="footer">
    <?php
            include('footer.html');
    ?>

    </div>
</body>
</html>