<?php
    //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php");
    include("./function/affichageproduit.php");
    include('navbar.php');

    //recupere la categorie
    $categories = $_GET['categorie'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/CatalogueProduit.css">
    <link rel="stylesheet" type="text/css" href="./styles/affichageproduit.css">
    <title>Catalogue Produit</title>
</head>
<body>
    <div class="filtres">
        <form action="" method="post">
                <label for="trieproduit">Tier par :</label>
                <select name="trieproduit" id="trieproduit">
                    <option value="nomCroissant">De A à Z</option>
                    <option value="nomDecroissant">De Z à A</option>
                    <option value="prixCroissant">Prix : croissant</option>
                    <option value="prixDecroissant">Prix : decroissant</option>
                </select>
                <label for="typeProduits">Type de produit :</label>
                <select name="typeProduits" id="typeProduits">
                    <option value="tous">Toutes les produits</option>
                    <?php
                        global $SQLconn; // Utilisez la connexion SQL

                        $query = "SELECT tp.nom from typeproduit tp
                            INNER JOIN categorie c ON tp.idCategorie = c.idCategorie
                            WHERE c.nom = '".$categories."'";

                        $result = $SQLconn->conn->query($query);
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['nom'] . '">' . $row['nom'] . '</option>';
                            }
                        }
                    ?>
                </select>
            <button class="button-submit" type="submit" name="submit"><span>Filtrer & Trier</span></button>
        </form>
    </div>
        
    <div class="products">
        <?php
            if(isset($_POST['submit'])){
                $trieproduit = $_POST['trieproduit'];
                $typeProduits = $_POST['typeProduits'];
            }else{
                $trieproduit = "nomCroissant";
                $typeProduits = "tous";
            }

            // Récupérez la catégorie à partir de l'URL
            $allProducts = getAllProducts($categories, 8, 0, $trieproduit, $typeProduits);
            if (empty($allProducts)) {
                echo '<h3 class="errorMessage">Aucun produit ne correspond à votre recherche</h3>';
            } else {
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
            }
        ?>
    </div>
    <?php
        if(!empty($allProducts)){
            echo '<div class="load-more">
                    <button id="load-more-button">
                        <span> Afficher plus de produit </span>
                    </button>
                </div>';
        }
    ?>
    <div class="footer">
    <?php
        include('footer.php');
    ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //----------------------------------------------------------------------------
        // Afficher plus de produit
        $(document).ready(function () {
            // Compteur pour suivre le nombre de produits chargés
            var currentCount = 8;
            var categorie = "<?php echo $categories; ?>";
            var trieproduit = "<?php echo $trieproduit; ?>";
            var typeProduits = "<?php echo $typeProduits; ?>";

            // Bouton "Load More"
            $("#load-more-button").click(function () {
                // Faites un appel AJAX pour récupérer plus de produits
                $.ajax({
                    url: "function/getMoreProducts.php?categorie=" + categorie, 
                    type: "POST",
                    //envoye le nombre actuel d'article afficher plus les filtres
                    data: { count: currentCount, trieproduit: trieproduit, typeProduits: typeProduits}, 
                    success: function (response) {
                        if (response.trim() === "") {
                            // Aucun produit supplémentaire n'a été trouvé, affichez le message d'erreur
                            $("#load-more-button").attr("disabled", "disabled");
                            $("#load-more-button").text("Aucun produit supplémentaire n'est disponible");
                        }else {
                                // Ajoutez les produits supplémentaires à la page
                                $(".products").append(response);
                                currentCount += 8; // Mettez à jour le compteur
                        }   
                    },
                });
            });
        });
        //----------------------------------------------------------------------------
    </script>
</body>
</html>
