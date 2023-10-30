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
    <link rel="stylesheet" type="text/css" href="./styles/CatalogueProduit.css">
    <link rel="stylesheet" type="text/css" href="./styles/affichageproduit.css">
    <title>Catalogue Produit</title>
</head>
<body>
    <?php
        include('navbar.php');
    ?>
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
    <div class="products">
        <a href="produits.php" >
            <?php
                echo createProductCard("Dream And Reality", "./img/imgBDD/produit1.jpg", ["White", "Black"], "50€");
            ?>
        </a>
        <?php
            echo createProductCard("#Wolf", "https://images.unsplash.com/photo-1560547126-ccd9d56db8af?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1936&q=80", ["Blue", "White", "Green"], "60€");
            echo createProductCard("Sweatshirt en lain", "https://img.freepik.com/free-photo/close-up-portrait-man-shirt-mockup_23-2149260967.jpg?w=360&t=st=1697036188~exp=1697036788~hmac=527d0d3eb9219978178f8820f6da2c869d4d54ad52ccc9496d05b6ca545744b5", ["Grey", "Red", "Black"], "70€");
        ?>
    </div>

    <div class="number">
        <div class="bar">
            <!-- Les numéros de page seront ajoutés ici via JavaScript -->
        </div>
    </div>
    <div class="footer">
    <?php
        include('footer.html');
    ?>
    </div>
    <script>
        //----------------------------------------------------------------------------
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
        //----------------------------------------------------------------------------

        //----------------------------------------------------------------------------
        // Numero de page
        // Sélectionnez l'élément avec la classe "bar"
        const bar = document.querySelector('.bar');

        const totalPages = 10; // Nombre total de pages
        const pagesToShow = 5; // Nombre de numéros de page à afficher simultanément
        let currentPage = 1; // Page actuelle

        function updatePageNumbers() {
            bar.innerHTML = "";

            // Calculez les numéros de page à afficher en fonction de la page actuelle
            const startPage = Math.max(1, currentPage - Math.floor(pagesToShow / 2));
            const endPage = Math.min(startPage + pagesToShow - 1, totalPages);

            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement("a");
                pageButton.textContent = i;
                pageButton.className = "button hover-black";
                pageButton.href = "#";
                if (i === currentPage) {
                    pageButton.className = "button black";
                    pageButton.style.backgroundColor = "#000";
                    pageButton.style.color = "#fff";
                    pageButton.href = "";
                }
                pageButton.addEventListener("click", () => {
                    if (i !== currentPage) {
                        currentPage = i;
                        updatePageNumbers();
                    }
                });
                bar.appendChild(pageButton);
            }
            //page precedente
            if (currentPage > 1) {
                const prevButton = document.createElement("a");
                prevButton.innerHTML = "&laquo;";
                prevButton.className = "button hover-black";
                prevButton.href = "#";
                prevButton.addEventListener("click", () => {
                    currentPage--;
                    updatePageNumbers();
                });
                bar.insertBefore(prevButton, bar.firstChild);
            }
            // page suivante
            if (currentPage < totalPages) {
                const nextButton = document.createElement("a");
                nextButton.innerHTML = "&raquo;";
                nextButton.className = "button hover-black";
                nextButton.href = "#";
                nextButton.addEventListener("click", () => {
                    currentPage++;
                    updatePageNumbers();
                });
                bar.appendChild(nextButton);
            }
        }
        updatePageNumbers(); // Appel initial pour afficher les numéros de page
        //----------------------------------------------------------------------------
    </script>
</body>
</html>
