<?php
    //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php");

    include("./affichageproduit.php");

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
    <?php
        include('navbar.php');
    ?>
    <!--
    <div class="filtres">
        <button class="filter-button">Filtrer</button>
        <div class="filter-options">
            <form action="CatalogueProduit.php" method="post">
                <div class="filter-group">
                    <label for="categorie">Catégorie</label>
                    <select name="categorie" id="categorie">
                        <option value="toutes">Toutes les catégories</option>
                        <option value="vetements">Vêtements</option>
                        <option value="chaussures">Chaussures</option>
                        <option value="accessoires">Accessoires</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="typeProduits">Type de produits</label>
                    <select name="typeProduits" id="typeProduits">
                        <option value="tous">Toutes les produits</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="taille">Taille</label>
                    <select name="taille" id="taille">
                        <option value="aucune">Aucune Taille</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="prix">Prix</label>
                    <select name="prix" id="prix">
                        <option value="tous">Tous les prix</option>
                        <option value="moins20">Moins de 20 €</option>
                        <option value="20-50">20 € - 50 €</option>
                        <option value="50-100">50 € - 100€</option>
                        <option value="plus100">100+ €</option>
                    </select>
                </div>
                <button class="button-submit" type="submit" name="submit"><span>Filtrer & Trier</span></button>
            </form>
        </div>
    </div>
    -->
    <div class="products">
        <?php
            // Récupérez la catégorie à partir de l'URL
            $allProducts = getAllProducts($categories, 8, 0);
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

    <div class="load-more">
        <button id="load-more-button">
            <span> Afficher plus de produit </span>
        </button>
    </div>
    <div class="footer">
    <?php
        include('footer.html');
    ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //----------------------------------------------------------------------------
        /*
        // JavaScript pour activer l'affichage des options de filtrage
        const filterButton = document.querySelector('.filter-button');
        const filterOptions = document.querySelector('.filter-options');

        filterButton.addEventListener('click', () => {
            if (filterOptions.style.display === "none" || filterOptions.style.display === "") {
                filterOptions.style.display = "block";
            } else {
                filterOptions.style.display = "none";
            }
        });

        // Sélectionnez les éléments de menu déroulant
        const categorieSelect = document.getElementById("categorie");
        const typeProduitsSelect = document.getElementById("typeProduits");
        const tailleSelect = document.getElementById("taille");
        const prixSelect = document.getElementById("prix");

        // Options par catégorie
        const optionsParCategorie = {
            toutes: {
                typeProduits: ["Toutes les produits", "Vestes", "Pulls", "Tee-shirt", "Claquettes", "Running", "Baskets", "Lunettes de soleil", "Sac à dos"],
                taille: ["Toutes les tailles", "S", "M", "L", "XL", "2XL", "3XL", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47"],
                prix: ["Tous les prix", "- 20€", "20€ - 50€", "50€ - 100€", "+ 100€"]
            },
            vetements: {
                typeProduits: ["Tous les produits", "Vestes", "Pulls", "Tee-shirt"],
                taille: ["Toutes les tailles", "S", "M", "L", "XL", "2XL", "3XL"],
                prix: ["Tous les prix", "- 20€", "20€ - 50€", "50€ - 100€", "+ 100€"]
            },
            chaussures: {
                typeProduits: ["Tous les produits", "Claquettes", "Running", "Baskets"],
                taille: ["Toutes les tailles", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47"],
                prix: ["Tous les prix", "- 20€", "20€ - 50€", "50€ - 100€", "+ 100€"]
            },
            accessoires: {
                typeProduits: ["Tous les produits", "Lunettes de soleil", "Sac à dos"],
                taille: ["-"],
                prix: ["Tous les prix", "- 20€", "20€ - 50€", "50€ - 100€", "+ 100€"]
            }
        };

        function mettreAJourOptions() {
            const categorieSelectionnee = categorieSelect.value;
            const options = optionsParCategorie[categorieSelectionnee] || { typeProduits: [], taille: [], prix: [] };

            typeProduitsSelect.innerHTML = "";
            tailleSelect.innerHTML = "";
            prixSelect.innerHTML = "";

            for (const typeProduit of options.typeProduits) {
                const nouvelElementOption = document.createElement("option");
                nouvelElementOption.value = typeProduit;
                nouvelElementOption.textContent = typeProduit;
                typeProduitsSelect.appendChild(nouvelElementOption);
            }

            for (const taille of options.taille) {
                const nouvelElementOption = document.createElement("option");
                nouvelElementOption.value = taille;
                nouvelElementOption.textContent = taille;
                tailleSelect.appendChild(nouvelElementOption);
            }

            for (const prix of options.prix) {
                const nouvelElementOption = document.createElement("option");
                nouvelElementOption.value = prix;
                nouvelElementOption.textContent = prix;
                prixSelect.appendChild(nouvelElementOption);
            }
        }

        // Écouteur d'événement pour la modification de la catégorie
        categorieSelect.addEventListener("change", mettreAJourOptions);

        // Appel initial pour mettre à jour les options
        mettreAJourOptions();
        */
        //----------------------------------------------------------------------------

        //----------------------------------------------------------------------------
        // Afficher plus de produit
        $(document).ready(function () {
            // Compteur pour suivre le nombre de produits chargés
            var currentCount = 8;
            var categorie = "<?php echo $categories; ?>";

            // Bouton "Load More"
            $("#load-more-button").click(function () {
                // Faites un appel AJAX pour récupérer plus de produits
                $.ajax({
                    url: "getMoreProducts.php?categorie=" + categorie, // Le fichier PHP pour récupérer les produits supplémentaires
                    type: "POST",
                    //envoye le nombre actuel d'article afficher
                    data: { count: currentCount}, 
                    success: function (response) {
                        if (response.trim() === "") {
                            // Aucun produit supplémentaire n'a été trouvé, affichez le message d'erreur
                            $("#load-more-button").attr("disabled", "disabled");
                            //alert("Aucun produit supplémentaire n'est disponible");

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
