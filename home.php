<?php
    //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php");
    include("./function/affichageproduit.php");
    include("./function/avis.php");
    include('navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./styles/home.css">
        <link rel="stylesheet" href="./styles/affichageproduit.css">
        <title>Accueil</title>
    </head>
    <body>
        <div class="acceuil">
            <h1> Bienvenue sur Woolify 
                <?php 
                    //affiche le pseudo de l'utilisateur connecté
                    $queryPseudo = "SELECT pseudo FROM utilisateur WHERE email = '" . $SQLconn->loginStatus->userEmail . "'";
                    $result = $SQLconn->conn->query($queryPseudo);
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $pseudo = $row["pseudo"];
                        echo $pseudo;
                    }
                    ?>
            </h1>
            <br>
            <button  onclick="window.location.href ='boutique.php'"><span> J'en profite </span></button>
        </div>
        <div class="products">
            <?php
                $categories="Vetements";
                $trieproduit = "nomCroissant";
                $typeProduits = "tous";
                $allProducts = getAllProducts($categories, 3, 0, $trieproduit, $typeProduits);
                foreach ($allProducts as $productData) {
                    $productID = $productData['idProduit'];
                    $productName = $productData['productName'];
                    $productImage = $productData['productImage'];
                    $colors = explode(',', $productData['colors']);
                    $productPrice = $productData['productPrice'];

                    echo '<a href="produits.php?idProduit=' . urlencode($productID) . '">';
                    echo createProductCard($productName, $productImage, $colors, $productPrice);
                    echo '</a>';
                }
            ?>
        </div>
        <div class="Quality">
            <div class="column">
                <img src="./img/factory.png" alt="Made in France">
                <h3>Made in France</h3>
                <p>Nos produits sont fabriqués en France, dans notre propre usine située au cœur de la région textile. Notre engagement en faveur de la production locale nous permet de maintenir des normes de qualité élevées tout en soutenant l'économie locale. Chaque vêtement que nous fabriquons est le fruit d'un travail artisanal méticuleux.</p>
            </div>
            <div class="column">
                <img src="./img/recycle.png" alt="Recyclage">
                <h3>Matériaux recyclés</h3>
                <p>Nous sommes déterminés à minimiser notre impact sur l'environnement. Pour ce faire, nous utilisons principalement des matériaux recyclés dans la confection de nos vêtements. Notre engagement envers le recyclage réduit la demande de nouvelles matières premières, contribuant ainsi à la préservation de notre planète. Nous croyons en la mode durable.</p>
            </div>
            <div class="column">
                <img src="./img/sewing.png" alt="Couture">
                <h3>Couture de précision</h3>
                <p>Nous prenons la couture au sérieux. Chaque vêtement que nous fabriquons est le résultat d'une attention méticuleuse aux détails. Nos artisans couturiers possèdent une expertise inégalée, garantissant que chaque couture est parfaitement exécutée. La qualité est notre priorité, et c'est ce qui fait la différence dans chaque vêtement que nous créons.</p>
            </div>
        </div>

        <div class="products">
            <?php
                $categories="Chaussures";
                $trieproduit = "nomCroissant";
                $typeProduits = "tous";
                $allProducts = getAllProducts($categories, 3, 0, $trieproduit, $typeProduits);
                foreach ($allProducts as $productData) {
                    $productID = $productData['idProduit'];
                    $productName = $productData['productName'];
                    $productImage = $productData['productImage'];
                    $colors = explode(',', $productData['colors']);
                    $productPrice = $productData['productPrice'];
        
                    echo '<a href="produits.php?idProduit=' . urlencode($productID) . '">';
                    echo createProductCard($productName, $productImage, $colors, $productPrice);
                    echo '</a>';
                }
            ?>
        </div>

        <div class="Avis">
            <?php
                $avis=getAvis();
                foreach ($avis as $avisItem) {
                    $note = $avisItem['noteAvis'];
                    $commentaire = $avisItem['Avis'];
                    $nomUtilisateur = $avisItem['nomUtilisateur'];
                    $nomProduit = $avisItem['nomProduit'];
                               
                    // Affichage de chaque avis
                    echo '<div class="avis-item">';
                    echo '<div class="avis-header">';
                    echo '<span class="user">' . $nomUtilisateur . '</span>';
                    echo '<span class="rating">';
                    echo '<span class="stars">' . generateStars($note) . '</span>';
                    echo '<span class="note">' . $note . '.0</span>';
                    echo '</span>';
                    echo '</div>';
                    echo '<p class="commentaire">' . $commentaire . '
                    <br><i>Avis laissé pour le produit ' . $nomProduit . '</i></p>';
                    echo '</div>';
                }
            ?>
        </div>
        <div class="footer">
        <?php
            include('footer.php');
        ?>
        </div>
    </body>
</html>
